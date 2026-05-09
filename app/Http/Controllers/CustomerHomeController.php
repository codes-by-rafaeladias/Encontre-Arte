<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;

class CustomerHomeController extends Controller
{
    public function home()
    {

        $user = auth()->user();

        $favoriteIds = $user->favoriteProducts()->pluck('product_id');

        $products = Product::query()->whereNotIn('id', $favoriteIds)
        ->latest()->take(3)->get();

        $followingIds = $user->following()->pluck('artisan_id');

        $artisans = User::query()->where('type', 'artisan')
        ->whereNotIn('id', $followingIds)->latest()->take(3)->get();

        return view('customer.home', compact('products', 'artisans'));
    }
}
