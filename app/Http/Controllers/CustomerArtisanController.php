<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CustomerArtisanController extends Controller
{
    public function listArtisans(Request $request)
    {
        $search = $request->input('search');

        $query = User::where('type', 'artisan');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('business_name', 'LIKE', "%{$search}%");
            });
        }

        $artisans = $query->paginate(10)->withQueryString();

        return view('customer.artisans', compact('artisans', 'search'));
    }
}
