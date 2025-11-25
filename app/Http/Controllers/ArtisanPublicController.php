<?php

namespace App\Http\Controllers;

use App\Models\User;

class ArtisanPublicController extends Controller
{
    public function show($id)
    {
        $artisan = User::where('id', $id)
                    ->where('type', 'artisan') 
                    ->firstOrFail();

        $products = $artisan->products()
                            ->latest()
                            ->get();

        return view('customer.artisan_profile', compact('artisan', 'products'));
    }
}
