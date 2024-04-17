<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function displayProduct()
    {
        $products = Product::join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name')
            ->get();

        return view('admin.product.displayProduct', compact('products'));
    }

    public function addProduct()
    {
        $categories = Category::all();

        return view('admin.product.addProduct', compact('categories'));
    }

    public function editProduct($id)
    {
        $product = Product::join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name', 'categories.id as category_id')
            ->where('products.id', $id)
            ->first();
        $categories = Category::all();


        return view('admin.product.editProduct', compact('product', 'categories'));
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required || unique:products',
            'price' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'image' => 'required || mimes:jpeg,png,jpg || max:2048',
        ]);

        try {
            $product = Product::where('name', $request->name)->first();
            if ($product) {
                return redirect()->route('admin.products.add')
                    ->with('error', 'Product already exists.');
            }

            $product = new Product();
            $product->name = $request->name;
            $product->price = $request->price;
            $product->category_id = $request->category_id;

            $image = $request->file('image');

            if ($image) {
                $new_image = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $image->move('site/uploads/product/', $new_image);
                $save_url = '/site/uploads/product/' . $new_image;
            }
            $product->image = $save_url;
            $product->description = $request->description;

            $product->save();

            return redirect()->route('admin.products.add')
                ->with('success', 'Product added successfully.');

        } catch (\Exception $e) {
            return redirect()->route('admin.products.add')
                ->with('error', 'Something went wrong.');
        }
    }

    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'image' => 'mimes:jpeg,png,jpg || max:2048',
        ]);

        try {
            $product = Product::where('id', $id)->first();
            if (!$product) {
                return redirect()->route('admin.product.display')
                    ->with('error', 'Product not found.');
            }

            $product->name = $request->name;
            $product->price = $request->price;
            $product->category_id = $request->category_id;

            $image = $request->file('image');

            if ($image) {
                $new_image = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $image->move('site/uploads/product/', $new_image);
                $save_url = '/site/uploads/product/' . $new_image;
                $product->image = $save_url;
            }

            $product->description = $request->description;

            $product->save();

            return redirect()->route('admin.product.display', $id)
                ->with('success', 'Product updated successfully.');

        } catch (\Exception $e) {
            return redirect()->route('admin.products.edit', $id)
                ->with('error', 'Something went wrong.');
        }
    }


    public function deleteProduct($id)
    {
        try {
            $product = Product::where('id', $id)->first();
            if (!$product) {
                return redirect()->route('admin.product.display')
                    ->with('error', 'Product not found.');
            }

            $product->delete();

            return redirect()->route('admin.product.display')
                ->with('success', 'Product deleted successfully.');

        } catch (\Exception $e) {
            return redirect()->route('admin.product.display')
                ->with('error', 'Something went wrong.');
        }
    }

}
