<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Validator;
use App\Helper\TokenService;
use Illuminate\Support\Str;

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
     * Store a newly created resource in storage.
     */
    public function store(Request $request,)
    {
        $validater=validator::make($request->all(),[
            'user_id'=>'required | exists:users,id',
        ]);
        if ($validater->fails()) {
            // Return JSON response with errors and HTTP status code 422 (Unprocessable Entity)
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validater->errors(),
            ], 422);
        }else{
            try{
                $token = $this->generateToken("order");


                $cartData = Cart::where('user_id', $request->user_id)->get();

                $total = 0;
                foreach ($cartData as $cart) {
                    $total += $cart->product->price * $cart->quantity;
                }

                dd($total);




                $order = new Order();
                $order->user_id = $request->user_id;
                $order->total = $request->total;
                $order->uCode = $token;
                $order->save();





                return response()->json([
                    'success' => true,
                    'message' => 'Order created',
                    'data' => $order
                ], 201);
            }
            catch(\Exception $e){
                return response()->json([
                    'success' => false,
                    'message' => 'Order not created',
                    'error' => $e->getMessage()
                ], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
