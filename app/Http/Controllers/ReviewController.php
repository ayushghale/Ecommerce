<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Validator;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function reviewData()
    {
        $reviews = Review::all();
        return response()->json([
            'success' => true,
            'message' => 'Review found',
            'data' => $reviews
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function showReviewById($id)
    {
        $review = Review::find($id);
        return response()->json([
            'success' => true,
            'message' => 'Review found',
            'data' => $review
        ], 200);
    }

    /**
     * Show review data by user id.
     */
    public function showReviewByUserId($id)
    {
        $review = Review::where('user_id', $id)->get();
        return response()->json([
            'success' => true,
            'message' => 'Review found',
            'data' => $review
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id',
            'rating' => 'required | integer | max:5',
            'review' => 'required',
            'description' => 'nullable'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }
        try {
            $review = new Review();
            $review->product_id = $request->product_id;
            $review->user_id = $request->user_id;
            $review->rating = $request->rating;
            $review->review = $request->review;
            $review->description = $request->description;
            $review->save();
            return response()->json([
                'success' => true,
                'message' => 'Review created',
                'data' => $review
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review, $id)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id',
            'rating' => 'required | integer | max:5',
            'review' => 'required',
            'description' => 'nullable'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }
        try {
            $review = Review::find($id);
            $review->product_id = $request->product_id;
            $review->user_id = $request->user_id;
            $review->rating = $request->rating;
            $review->review = $request->review;
            $review->description = $request->description;
            $review->save();
            return response()->json([
                'success' => true,
                'message' => 'Review updated',
                'data' => $review
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review, $id)
    {
        try {
            $review = Review::find($id);
            $review->delete();
            return response()->json([
                'success' => true,
                'message' => 'Review deleted',
                'data' => $review
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
