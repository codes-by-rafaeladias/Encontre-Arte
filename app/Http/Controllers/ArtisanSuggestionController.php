<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AIInsight;

class ArtisanSuggestionController extends Controller
{
    public function index()
    {

        $insights = AIInsight::where(
            'user_id',
            auth()->id()
        )
        ->latest()
        ->get();

        return view(
            'artisan.smart_suggestions',
            compact('insights')
        );
    }
}
