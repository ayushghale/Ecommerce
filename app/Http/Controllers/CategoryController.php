<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function categoryData()
    {
        $categories = Category::all();
        return json_encode($categories);
    }


    /**
     * Display a listing of the resource.
     */
    public function showCategoryById($id)
    {
        $category = Category::find($id);
        return json_encode($category);
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
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string',
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
            $category = new Category();
            $category->name = $request->name;
            $category->save();
            return response()->json([
                'success' => true,
                'message' => 'Category created successfully',
                'data' => $category
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Category not created',
                'errors' => $e->getMessage()
            ], 500);

        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string',
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
            $category = Category::find($id); // Use $id instead of $category->id
            $category->name = $request->name;
            $category->save();

            return response()->json([
                'success' => true,
                'message' => 'Category updated successfully',
                'data' => $category
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Category not updated',
                'errors' => $e->getMessage()
            ], 500);
        }
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category, $id)
    {
        if (!$id) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found',
            ], 404);
        }
        try {
            $category = Category::find($id); // Use $id instead of $category->id
            $category->delete();

            return response()->json([
                'success' => true,
                'message' => 'Category deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Category not deleted',
                'errors' => $e->getMessage()
            ], 500);
        }

    }
}
