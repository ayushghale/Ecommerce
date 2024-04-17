<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function displayCategory()
    {
        $categories = Category::all();
        return view('admin.category.displayCategory', compact('categories'));
    }

    public function addCategory()
    {
        return view('admin.category.addCategory');
    }

    public function editCategory($id)
    {
        $category = Category::where('id', $id)->first();

        return view('admin.category.editCategory', compact('category'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required || unique:categories',
        ]);

        try {
            $category = Category::where('name', $request->name)->first();
            if ($category) {
                return redirect()->route('admin.category.addCategory')
                    ->with('error', 'Category already exists.');
            }

            $category = new Category();
            $category->name = $request->name;
            $category->save();

            return redirect()->route('admin.category.addCategory')
                ->with('success', 'Category added successfully.');

        } catch (\Exception $e) {
            return redirect()->route('admin.category.addCategory')
                ->with('error', 'Something went wrong.');
        }
    }

    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required || unique:categories',
        ]);

        try {
            $category = Category::where('id', $id)->first();
            if (!$category) {
                return redirect()->route('admin.category.editCategory')
                    ->with('error', 'Category not found.');
            }

            $category->name = $request->name;
            $category->save();

            return redirect()->route('admin.category.display')
                ->with('success', 'Category updated successfully.');

        } catch (\Exception $e) {
            return redirect()->route('admin.category.editCategory')
                ->with('error', 'Something went wrong.');
        }

    }

    public function deleteCategory($id)
    {
        if (Category::where('id', $id)->exists()) {
            Category::where('id', $id)->delete();
        } else {
            return redirect()->route('admin.category.display')
                ->with('error', 'Category not found.');
        }

        return redirect()->route('admin.category.display')
            ->with('success', 'Category deleted successfully.');
    }
}
