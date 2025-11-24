<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CustomerProductController extends Controller
{
    public function listAllProducts()
    {
        $products = Product::latest()->get();

         $favoriteIds = auth()->user()
        ->favoriteProducts()
        ->pluck('product_id')
        ->toArray();
        
        return view('customer.products', compact('products', 'favoriteIds'));
    }
}