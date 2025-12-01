<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ArtisanReviewController extends Controller
{
    public function listReviews()
    {
        $artisan = Auth::user();

        $productIds = $artisan->products()->pluck('id');

        $reviews = Review::with(['product', 'user'])
            ->whereIn('product_id', $productIds)
            ->latest()
            ->paginate(10);

        return view('artisan.reviews', compact('reviews'));
    }
}
