<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Product;

class FavoriteController extends Controller
{
    public function toggle($productSlug)
    {
        $user = auth()->user();

        $product = Product::where('slug', $productSlug)->firstOrFail();

        $favorite = Favorite::where('customer_id', $user->id)
        ->where('product_id', $product->id)->first();

        if ($favorite) {
            $favorite->delete();
        } else {
            Favorite::create([
                'customer_id' => $user->id,
                'product_id' => $product->id,
                ]);
        }
        
        return back();
    }

    public function listFavorites()
    {

        $user = auth()->user();
        $favoriteProducts = $user->favoriteProducts()
        ->latest()
        ->paginate(9);

        return view('customer.favorites', compact('favoriteProducts'));
    }
}
