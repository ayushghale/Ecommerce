<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FavoriteController extends Controller
{
    public function showFavoritesByUserId($id)
    {
        $favorites = DB::table('favorites')
            ->join('products', 'favorites.product_id', '=', 'products.id')
            ->select('products.*')
            ->where('favorites.user_id', $id)
            ->get();

        if ($favorites->isEmpty()) {
            return response()->json(['message' => 'No favorites found'], 404);
        }
        return response()->json($favorites, 200);
    }

    /**
     *  add product to favorites.
     */
    public function addProductToFavorites($user_id, $product_id)
    {
        if (Favorite::where('user_id', $user_id)->where('product_id', $product_id)->exists()) {
            return response()->json(['message' => 'Product already in favorites'], 400);
        }

        $favorite = new Favorite();
        $favorite->user_id = $user_id;
        $favorite->product_id = $product_id;
        $favorite->save();
        return response()->json(['message' => 'Product added to favorites'], 201);
    }

    /**
     *  remove product from Favorites.
     */
    public function removeProductFromFavorites($user_id, $product_id)
    {
        if (!Favorite::where('user_id', $user_id)->where('product_id', $product_id)->exists()) {
            return response()->json(['message' => 'Product not in favorites'], 404);
        }

        $favorite = Favorite::where('user_id', $user_id)->where('product_id', $product_id)->first();
        $favorite->delete();
        return response()->json(['message' => 'Product removed from favorited'], 200);
    }
}
