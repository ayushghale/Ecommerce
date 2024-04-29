<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;


class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function productInventory()
    {
        $products = Product::join('categories', 'products.category_id', '=', 'categories.id')
            ->leftJoin('inventories', 'products.id', '=', 'inventories.product_id')
            ->select('products.*', 'categories.name as category_name', 'inventories.stock')
            ->get();

        return view('admin.product.productInventory', compact('products'));
    }

    /**
     * Show edit inventory form.
     */
    public function editInventory($id)
    {
        $product = Product::join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name', 'categories.id as category_id')
            ->where('products.id', $id)
            ->first();
        $inventory = Inventory::where('product_id', $id)->first();

        return view('admin.product.editInventory', compact('product', 'inventory'));
    }



    public function updateInventory(Request $request, $id)
    {
        $request->validate([
            'stock' => 'required || integer || min:1',
        ]);

        try {
            $inventory = Inventory::where('product_id', $id)->first();
            if (!$inventory) {
                return redirect()->route('admin.products.inventory')
                    ->with('error', 'Product not found.');
            }

            $inventory->stock = intval($request->stock);
            $inventory->save();

            return redirect()->route('admin.products.inventory')
                ->with('success', 'Inventory updated successfully.');

        } catch (\Exception $e) {
            return redirect()->route('admin.products.inventory')
                ->with('error', 'Something went wrong.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory, $id)
    {
        try {
            $inventory = Inventory::where('product_id', $id)->first();
            if (!$inventory) {
                return redirect()->route('admin.products.inventory')
                    ->with('error', 'Product not found.');
            }

            $inventory->delete();

            return redirect()->route('admin.products.inventory')
                ->with('success', 'Inventory deleted successfully.');

        } catch (\Exception $e) {
            return redirect()->route('admin.products.inventory')
                ->with('error', 'Something went wrong.');
        }
    }
}
