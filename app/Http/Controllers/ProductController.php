<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function productData()
    {
        $userId = 0;

        if($userId == null){
            $products = DB::table('products')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->select('products.*', 'categories.name as category_name')
                ->get();
        }else{
            $products = DB::table('products')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->leftJoin('favorites', function ($join) use ($userId) {
                    $join->on('products.id', '=', 'favorites.product_id')
                        ->where('favorites.user_id', '=', $userId);
                })
                ->select('products.*', 'categories.name as category_name', 'favorites.user_id as favorite_user_id')
                ->get();
        }
        return response()->json([
            'success' => true,
            'message' => 'Products found',
            'data' => $products
        ], 200);

    }

    public function showProductByCategoryId($id)
    {
        if (Product::where('category_id', $id)->doesntExist()) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found',
                'data' => null
            ], 404);
        } else {
            $product = DB::table('products')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->select('products.*', 'categories.name as category_name')
                ->where('products.category_id', $id)
                ->get();
            return response()->json([
                'success' => true,
                'message' => 'Product found',
                'data' => $product
            ], 200);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function showProductById($id)
    {
        if (Product::where('id', $id)->doesntExist()) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found',
                'data' => null
            ], 404);
        } else {
            $product = DB::table('products')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->select('products.*', 'categories.name as category_name')
                ->where('products.id', $id)
                ->get();
            return response()->json([
                'success' => true,
                'message' => 'Product found',
                'data' => $product
            ], 200);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Product $product)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string',
            'image' => 'required | image | mimes:jpeg,png,jpg | max:2048',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|numeric',
        ]);
        if ($validate->fails()) {
            // Return JSON response with errors and HTTP status code 422 (Unprocessable Entity)
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validate->errors(),
            ], 422);
        }
        try {
            $product = new Product();
            $product->name = $request->name;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $new_image = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $image->move('site/uploads/product/', $new_image);
                $save_url = '/site/uploads/product/' . $new_image;
                $product->image = $save_url;
            }

            $product->description = $request->description;
            $product->price = $request->price;
            $product->category_id = $request->category_id;
            $product->save();
            return response()->json([
                'success' => true,
                'message' => 'Product created successfully',
                'data' => $product
            ], 201);
        } catch (\Exception $e) {
            // Return JSON response with errors and HTTP status code 500 (Internal Server Error)
            return response()->json([
                'success' => false,
                'message' => 'Product creation failed!',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string',
            'image' => 'required | image | mimes:jpeg,png,jpg | max:2048',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|numeric',
        ]);

        if ($validate->fails()) {
            // Return JSON response with errors and HTTP status code 422 (Unprocessable Entity)
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validate->errors(),
            ], 422);
        }

        try {
            $product = Product::find($id);
            $product->name = $request->name;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $new_image = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $image->move('site/uploads/product/', $new_image);
                $save_url = '/site/uploads/product/' . $new_image;
                $product->image = $save_url;
            }

            $product->description = $request->description;
            $product->price = $request->price;
            $product->category_id = $request->category_id;
            $product->save();
            return response()->json([
                'success' => true,
                'message' => 'Product updated successfully',
                'data' => $product
            ], 200);
        } catch (\Exception $e) {
            // Return JSON response with errors and HTTP status code 500 (Internal Server Error)
            return response()->json([
                'success' => false,
                'message' => 'Product not updated',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, $id)
    {
        if (!$id) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found',
            ], 404);
        }
        try {
            $product = Product::find($id);
            $product->delete();
            return response()->json([
                'success' => true,
                'message' => 'Product deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Product not deleted',
                'errors' => $e->getMessage()
            ], 500);
        }
    }
}
