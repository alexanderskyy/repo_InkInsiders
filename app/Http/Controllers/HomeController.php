<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('stok', '>', 0)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('frontend.index', compact('featuredProducts'));
    }
}
