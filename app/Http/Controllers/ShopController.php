<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display all products in shop.
     */
    public function index()
    {
        $products = Product::where('stok', '>', 0)
            ->orderBy('nama_produk')
            ->get();

        return view('frontend.shop', compact('products'));
    }

    /**
     * Display collections/starter sets.
     */
    public function collections()
    {
        // Filter produk berdasarkan kategori "Starter Set" atau "Collection"
        $collections = Product::whereIn('kategori', ['Starter Set', 'Collection'])
            ->where('stok', '>', 0)
            ->get();

        return view('frontend.collections', compact('collections'));
    }

    /**
     * Display bundle products.
     */
    public function bundles()
    {
        // Filter produk berdasarkan kategori "Bundle"
        $bundles = Product::where('kategori', 'Bundle')
            ->where('stok', '>', 0)
            ->get();

        return view('frontend.bundles', compact('bundles'));
    }

    /**
     * Display limited edition products.
     */
    public function limited()
    {
        // Filter produk berdasarkan kategori "Limited Edition"
        $limitedProducts = Product::where('kategori', 'Limited Edition')
            ->where('stok', '>', 0)
            ->get();

        return view('frontend.limited', compact('limitedProducts'));
    }
}