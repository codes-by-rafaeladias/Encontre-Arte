<?php

namespace App\Http\Controllers;

use App\Models\ProductReview;
use Illuminate\Support\Facades\Auth;

class ArtisanReviewController extends Controller
{
    public function listReviews()
    {
        $artisan = Auth::user();

        $productIds = $artisan->products()->pluck('id');

        $reviews = ProductReview::with(['product', 'user'])
            ->whereIn('product_id', $productIds)
            ->latest()
            ->paginate(10);
        
        $averageRating = $artisan->averageRating();
        $totalReviews = $artisan->totalReviews();
        $bestProduct = $artisan->bestRatedProduct();

        return view('artisan.reviews', compact('reviews', 'averageRating', 'totalReviews', 'bestProduct'));
    }
}
