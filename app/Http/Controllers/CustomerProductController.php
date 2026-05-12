<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Technique;
use App\Models\Material;
use Illuminate\Support\Facades\Auth;

class CustomerProductController extends Controller
{
    public function listAllProducts(Request $request)
    {
        $categories = Category::orderBy('name')->get();
        $techniques = Technique::orderBy('name')->get();
        $materials = Material::orderBy('name')->get();

        $search = $request->input('search');
        $searchType = $request->input('search_type', 'product');

        $query = Product::query()
        ->with([
            'artisan',
            'category',
            'materials',
            'technique'
        ]);

        if ($search) {
            
            match ($searchType) {
                'product' => $query->where(
                    'name',
                    'LIKE',
                    "%{$search}%"
                    ),

                'artisan' => $query->whereHas('artisan', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")->orWhere('business_name', 'LIKE', "%{$search}%");
                    }),

                'category' => $query->whereHas('category', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%");
                    }),
                    
                'technique' => $query->whereHas('technique', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%");
                    }),

                'material' => $query->whereHas('materials', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%");
                    }),

                'location' => $query->whereHas('artisan', function ($q) use ($search) {
                    $q->where('city', 'LIKE', "%{$search}%")->orWhere('state', 'LIKE', "%{$search}%");
                    }),

                default => null
            };
        }

    $products = $query->latest()->paginate(9);

    $favoriteIds = auth()->user()
        ->favoriteProducts()
        ->pluck('product_id')
        ->toArray();

    return view('customer.products', compact(
        'products',
        'favoriteIds',
        'search',
        'searchType',
        'categories',
        'techniques',
        'materials',
    ));
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