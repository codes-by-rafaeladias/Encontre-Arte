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

         $products = $query->latest()->paginate(10);

         $favoriteIds = auth()->user()
        ->favoriteProducts()
        ->pluck('product_id')
        ->toArray();
        
        return view('customer.products', compact('products', 'favoriteIds', 'search'));
    }
}