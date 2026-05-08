<?php

namespace App\Http\Controllers;

use App\Models\User;

class ArtisanHomeController extends Controller
{
    public function home()
    {
        
        $user = auth()->user();

        $latestProducts = $user->products()->latest()->take(3)->get();

        $productsCount = $user->totalProducts();
        $followersCount = $user->totalFollowers();
        $averageRating = $user->averageRating();

        return view('artisan.home', compact('latestProducts', 'productsCount', 'followersCount', 'averageRating'));
    }
}
