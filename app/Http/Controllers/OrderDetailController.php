<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use DB;

class OrderDetailController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public static function store(int $user_id, int $order_id, string $uCode)
    {

        if ($order_id == null) {
            return response()->json([
                'success' => false,
                'message' => 'Order details already exist',
            ], 400);
        } else {
            // dd($user_id, $order_id);
            $cartData = DB::table('carts')
                ->join('products', 'carts.product_id', '=', 'products.id')
                ->select('carts.*', 'products.price as product_price', 'products.id as product_id')
                ->where('carts.user_id', $user_id)
                ->get();

            // dd($user_id, $order_id, $uCode, $cartData);
            foreach ($cartData as $cart) {
                $product_id = intval($cart->product_id);
                $quantity = intval($cart->quantity);
                $price = intval($cart->product_price);
                $total_Price = $price * $quantity;

                // Ensure $order_id is accessible within the loop
                // dd($order_id);

                $orderDetail = new OrderDetail();
                $orderDetail->order_id = $order_id; // Assign $order_id to order_id field
                $orderDetail->product_id = $product_id; // Corrected variable name
                $orderDetail->quantity = $quantity;
                $orderDetail->total = $total_Price; // Use the calculated total price
                $orderDetail->uCode = $uCode;
                $orderDetail->save();
                // dd($orderDetail); // Debug if needed
            }


            return response()->json([
                'success' => true,
                'message' => 'Order details created',
            ], 200);

        }

    }
}
