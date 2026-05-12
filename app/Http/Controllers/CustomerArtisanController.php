<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CustomerArtisanController extends Controller
{
    public function listArtisans(Request $request)
    {
        $search = $request->input('search');
        $searchType = $request->input('search_type', 'artisan');

        $query = User::where('type', 'artisan');

        if ($search) {
            match ($searchType) {
                'artisan' => $query->where(function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('business_name', 'LIKE', "%{$search}%");
                    }),

                'location' => $query->where(function ($q) use ($search) {
                    $q->where('city', 'LIKE', "%{$search}%")
                    ->orWhere('state', 'LIKE', "%{$search}%");
                    }),
                
                default => null
            };
        }

        $artisans = $query->paginate(9)->withQueryString();

        return view('customer.artisans', compact('artisans', 'search', 'searchType'));
    }

    public function toggleFollow($slug) {
        $artisan = User::where('slug', $slug)
        ->where('type', 'artisan')
        ->firstOrFail();
        
        $customer = auth()->user();
        
        if ($customer->following()
            ->where('artisan_id', $artisan->id)
            ->exists()) {
                $customer->following()->detach($artisan->id);
                } 
                else {
                    $customer->following()->attach($artisan->id);
                    }

        return back();
    }

    public function followingArtisans(){

        $customer = auth()->user();

        $artisans = $customer
        ->following()
        ->where('type', 'artisan')
        ->paginate(9);

        return view(
        'customer.following_artisans',
        compact('artisans')
        );
    }
}
