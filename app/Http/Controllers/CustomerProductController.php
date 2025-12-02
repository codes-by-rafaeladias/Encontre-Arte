<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CustomerProductController extends Controller
{
    public function listAllProducts(Request $request)
    {

        $search = $request->input('search');
        
        $query = Product::query();
        
        if ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        }

         $products = $query->latest()->paginate(9);

         $favoriteIds = auth()->user()
        ->favoriteProducts()
        ->pluck('product_id')
        ->toArray();
        
        return view('customer.products', compact('products', 'favoriteIds', 'search'));
    }

    public function showProduct($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        $user = auth()->user();
        
        $userReview = null;
        
        if ($user) {
            $userReview = $product->reviews()
            ->where('customer_id', $user->id)
            ->first();
        }
        
        $isFavorited = auth()->check()
        ? auth()->user()->favoriteProducts()->where('product_id', $product->id)->exists()
        : false;
        
        $averageRating = round($product->averageRating(), 1); 

        return view('customer.product_info', compact('product', 'userReview', 'isFavorited', 'averageRating'));
    }

}