<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
        public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('products.home', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function edit($kode_produk)
    {
        $product = Product::where('kode_produk', $kode_produk)->firstOrFail();
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $kode_produk)
    {
    $product = Product::where('kode_produk', $kode_produk)->firstOrFail();

    $request->validate([
        'nama_produk' => 'required',
        'kategori' => 'required',
        'harga' => 'required|numeric',
        'stok' => 'required|integer',
    ]);

    $product->update([
        'nama_produk' => $request->nama_produk,
        'kategori' => $request->kategori,
        'harga' => $request->harga,
        'stok' => $request->stok,
    ]);

    return redirect()
        ->route('admin.products.index')
        ->with('success', 'Produk berhasil diperbarui');
    }

        public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_produk' => 'required|unique:products,kode_produk',
            'nama_produk' => 'required',
            'kategori'    => 'required',
            'harga'       => 'required|numeric',
            'stok'        => 'required|integer',
        ]);

        Product::create($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

}