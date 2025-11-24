<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function toggle($productId)
    {
        $user = auth()->user();

        $favorite = Favorite::where('customer_id', $user->id)
                            ->where('product_id', $productId)
                            ->first();

        if ($favorite) {
            $favorite->delete();
            return back()->with('success', 'Produto removido dos favoritos');
        }

        Favorite::create([
            'customer_id' => $user->id,
            'product_id' => $productId,
        ]);

        return back()->with('success', 'Produto adicionado aos favoritos');
    }
}
