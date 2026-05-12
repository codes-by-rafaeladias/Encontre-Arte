<?php

namespace App\Http\Controllers;

use App\Models\User;

class ArtisanPublicController extends Controller
{
    public function show($slug)
    {
        $artisan = User::where('slug', $slug)
                    ->where('type', 'artisan') 
                    ->with(['products.category',
                    'products.technique',
                    'followers'
                    ])
                    ->firstOrFail();

        $products = $artisan->products()
                            ->latest()
                            ->take(6)
                            ->get();
        
        $categories = $products->pluck('category.name')->unique();

        $techniques = $products->pluck('technique.name')->unique();

        $followersCount = $artisan->followers->count();

        $productsCount = $products->count();

        $isFollowing = auth()->user()
        ->following()
        ->where('artisan_id', $artisan->id)
        ->exists();

        return view('customer.artisan_profile', compact('artisan', 'products', 'categories',
        'techniques', 'followersCount', 'productsCount', 'isFollowing'));
    }
}
