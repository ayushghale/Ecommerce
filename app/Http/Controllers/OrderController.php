<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Validator;
use App\Helper\TokenService;
use Illuminate\Support\Str;
use DB;

class OrderController extends Controller
{
    /**
     * Generate a unique token
     */
    public function generateToken($tokenType)
    {
        $length = 32;

        switch ($tokenType) {
            case 'order':
                do {
                    $token = Str::random($length);
                } while (self::orderTokenExists($token));
                return $token; // Return the generated token
            default:
                return Str::random($length);
        }
    }

    public static function orderTokenExists($token)
    {
        return Order::where('uCode', $token)->exists();
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();
        return response()->json([
            'success' => true,
            'message' => 'Order found',
            'data' => $orders
        ], 200);
    }

    /**
     * Show order data by their id.
     */
    public function showOrderById($id)
    {
        $order = Order::find($id);
        return response()->json([
            'success' => true,
            'message' => 'Order found',
            'data' => $order
        ], 200);
    }

    /*
     * Show order data by user id.
     */

    public function showOrderByUserId($id)
    {
        $order = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->join('payments', 'orders.id', '=', 'payments.order_id')
            ->select(
                'orders.*',
                'users.name as user_name',
                'users.email as user_email',
                'users.contact_number as users_contact_number',
                'payments.payment_method'
            )
            ->where('orders.user_id', $id)
            ->get();



        $data = [];
        foreach ($order as $item) {
            $orderDetails = DB::table('order_details')
                ->join('products', 'order_details.product_id', '=', 'products.id')
                ->select(
                    'order_details.id as order_detail_id',
                    'order_details.quantity as order_detail_quantity',
                    'products.name as product_name',
                    'products.price as product_price',
                    DB::raw('order_details.quantity * products.price as total_price')
                )
                ->where('order_details.order_id', $item->id)
                ->get();



            $data[] = [
                'order_id' => $item->id,
                'user_id' => $item->user_id,
                'user_contact_number' => $item->users_contact_number,
                'total' => $item->total,
                'payment_method' => $item->payment_method,
                'created_at' => $item->created_at,
                'order_details' => $orderDetails
            ];
        }
        return response()->json([
            'success' => true,
            'message' => 'Order found',
            'data' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'payment_method' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $token = $this->generateToken("order"); // Generate a unique token
            // Get all cart data for the user
            $cartData = DB::table('carts')
                ->join('products', 'carts.product_id', '=', 'products.id')
                ->join('users', 'carts.user_id', '=', 'users.id')
                ->select('carts.*', 'products.price as product_price', 'users.name as user_name')
                ->where('carts.user_id', $request->user_id)
                ->get();

            // Calculate the total amount of the order
            $total = 0;
            // Loop through the cart data and calculate the total amount
            foreach ($cartData as $cart) {
                $total += $cart->product_price * $cart->quantity;
            }

            if ($total == 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cart is empty',
                ], 400);
            }

            // Create the order
            $order = new Order();
            $order->user_id = $request->user_id;
            $order->total = $total;
            $order->uCode = $token;
            $order->save();

            // Call the store method of OrderDetailController
            $orderDetailMessage = OrderDetailController::store($request->user_id, $order->id, $token, );
            if ($orderDetailMessage->getStatusCode() != 200) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order details not created',
                ], 400);
            }
            $paymentMessage = PaymentController::store($order->id, $request->user_id, $request->payment_method, $total);

            if ($paymentMessage->getStatusCode() != 200) {
                return response()->json([
                    'success' => false,
                    'message' => 'Payment not created',
                ], 400);
            }

            // Delete the cart data
            Cart::where('user_id', $request->user_id)->delete();
            


            return response()->json([
                'success' => true,
                'message' => 'Order created',
                'order' => $order,
                'paymrent' => $paymentMessage,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Order not created',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }


}
