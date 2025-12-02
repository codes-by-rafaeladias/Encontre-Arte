<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class CustomerReviewController extends Controller
{
    public function showReviews()
    {
        $reviews = auth()->user()
            ->reviews()
            ->with('product')   
            ->latest()
            ->paginate(10);

        return view('customer.reviews', compact('reviews'));
    }

    public function destroy($id)
    {
        $review = Review::where('id', $id)
                        ->where('customer_id', auth()->id())
                        ->firstOrFail();

        $review->delete();

        return back()->with('success', 'Avaliação excluída com sucesso!');
    }
}
