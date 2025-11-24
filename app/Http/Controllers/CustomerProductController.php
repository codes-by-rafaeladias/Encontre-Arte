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
        
        return view('customer.products', compact('products'));
    }
}