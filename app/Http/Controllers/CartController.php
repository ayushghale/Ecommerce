<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function cartData()
    {
        $carts = DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->join('users', 'carts.user_id', '=', 'users.id')
            ->select('carts.*', 'products.name as product_name', 'users.name as user_name')
            ->get();
        return response()->json([
            'success' => true,
            'message' => 'Cart found',
            'data' => $carts
        ], 200);

    }

    public function showCartByUserId($id)
    {
        if (Cart::where('user_id', $id)->doesntExist()) {
            return response()->json([
                'success' => false,
                'message' => 'Cart not found',
                'data' => null
            ], 404);
        } else {
            $cart = DB::table('carts')
                ->join('products', 'carts.product_id', '=', 'products.id')
                ->join('users', 'carts.user_id', '=', 'users.id')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->select('carts.*', 'products.name as product_name', 'users.name as user_name', 'products.price', 'categories.name as category_name')
                ->where('carts.user_id', $id)
                ->get();

            $total_price = 0;
            foreach ($cart as $item) {
                $total_price += $item->price * $item->quantity;
            }

            $productData = [];
            foreach ($cart as $item) {
                $productData[] = [
                    'cart_id' => $item->id,
                    'category_name' => $item->category_name,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product_name,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'total_price' => $item->price * $item->quantity
                ];
            }

            $data = [
                'user_id' => $id,
                'product_data' => $productData,
                'total_price' => $total_price
            ];
            return response()->json([
                'success' => true,
                'message' => 'Cart found',
                'data' => $data
            ], 200);
        }
    }

    /**
     * Show cart data by their id.
     */
    public function showCartById($id)
    {
        if (Cart::where('id', $id)->doesntExist()) {
            return response()->json([
                'success' => false,
                'message' => 'Cart not found',
                'data' => null
            ], 404);
        } else {
            $cart = DB::table('carts')
                ->join('products', 'carts.product_id', '=', 'products.id')
                ->join('users', 'carts.user_id', '=', 'users.id')
                ->select('carts.*', 'products.name as product_name', 'users.name as user_name')
                ->where('carts.id', $id)
                ->get();

            if ($cart->isEmpty()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Cart not found',
                    'data' => [] // Empty array
                ], 200);
            } else {
                return response()->json([
                    'success' => true,
                    'message' => 'Cart found',
                    'data' => $cart
                ], 200);
            }     
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'user_id' => 'required | integer | exists:users,id',
            'product_id' => 'required  | integer | exists:products,id',
            'quantity' => 'required | integer | min:1'
        ]);
        if ($validate->fails()) {
            // Return JSON response with errors and HTTP status code 422 (Unprocessable Entity)
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validate->errors(),
            ], 422);
        }

        $cart = new Cart();
        $cart->user_id = $request->user_id;
        $cart->product_id = $request->product_id;
        $cart->quantity = $request->quantity;
        $cart->save();

        return response()->json([
            'success' => true,
            'message' => 'Cart created',
            'data' => $cart
        ], 201);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart, $id)
    {
        $validate = Validator::make($request->all(), [
            'user_id' => 'required | integer | exists:users,id',
            'product_id' => 'required  | integer | exists:products,id',
        ]);
        if ($validate->fails()) {
            // Return JSON response with errors and HTTP status code 422 (Unprocessable Entity)
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validate->errors(),
            ], 422);
        }

        $cart = Cart::find($id);
        $cart->user_id = $request->user_id;
        $cart->product_id = $request->product_id;
        $cart->save();

        return response()->json([
            'success' => true,
            'message' => 'Cart updated',
            'data' => $cart
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart, $id)
    {
        if (Cart::where('id', $id)->doesntExist()) {
            return response()->json([
                'success' => false,
                'message' => 'Cart not found',
                'data' => null
            ], 404);
        } else {
            $cart = Cart::find($id);
            $cart->delete();
            return response()->json([
                'success' => true,
                'message' => 'Cart deleted',
                'data' => $cart
            ], 200);
        }
    }

    /**
     * increment the quantity of the specified resource in storage.
     */
    public function increaseQuantity($user_id, $product_id)
    {
        $cart = Cart::where('user_id', $user_id)->where('product_id', $product_id)->first();
        if (!$cart || $cart->quantity == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Cart not found',
                'data' => null
            ], 404);
        }
        $cart->quantity = $cart->quantity + 1;
        $cart->save();
        return response()->json([
            'success' => true,
            'message' => 'Cart updated',
            'data' => $cart
        ], 200);
    }

    /**
     * decrement the quantity of the specified resource in storage.
     */
    public function decreaseQuantity($user_id, $product_id)
    {
        $cart = Cart::where('user_id', $user_id)->where('product_id', $product_id)->first();

        if (!$cart || $cart->quantity <= 1) {
            return response()->json([
                'success' => false,
                'message' => 'Cart not found',
                'data' => null
            ], 404);
        }
        $cart->quantity = $cart->quantity - 1;
        $cart->save();
        return response()->json([
            'success' => true,
            'message' => 'Cart updated',
            'data' => $cart
        ], 200);
    }


}
