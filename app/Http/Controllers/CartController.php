<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    /**
     * Display cart page.
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = $this->calculateTotal($cart);
        
        return view('frontend.cart', compact('cart', 'total'));
    }

    /**
     * Add product to cart.
     */
    public function add(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'kode_produk' => 'required|string',
            'nama_produk' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
        ]);

        // Ambil cart dari session
        $cart = session()->get('cart', []);
        
        $kode = $validated['kode_produk'];
        
        // Jika produk sudah ada di cart, tambah quantity
        if (isset($cart[$kode])) {
            $cart[$kode]['quantity'] += $validated['quantity'];
        } else {
            // Jika produk baru, tambahkan ke cart
            $cart[$kode] = [
                'kode_produk' => $validated['kode_produk'],
                'nama_produk' => $validated['nama_produk'],
                'harga' => $validated['harga'],
                'quantity' => $validated['quantity'],
            ];
        }
        
        // Simpan cart ke session
        session()->put('cart', $cart);
        
        // Log untuk debugging
        Log::info('Product added to cart', [
            'kode' => $kode,
            'nama' => $validated['nama_produk'],
            'cart_count' => count($cart)
        ]);
        
        // Redirect back dengan success message
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    /**
     * Update cart item quantity.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'kode_produk' => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);
        $kode = $validated['kode_produk'];
        
        if (isset($cart[$kode])) {
            $cart[$kode]['quantity'] = $validated['quantity'];
            session()->put('cart', $cart);
            
            return redirect()->back()->with('success', 'Keranjang berhasil diupdate!');
        }
        
        return redirect()->back()->with('error', 'Produk tidak ditemukan di keranjang');
    }

    /**
     * Remove item from cart.
     */
    public function remove($kode_produk)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$kode_produk])) {
            unset($cart[$kode_produk]);
            session()->put('cart', $cart);
            
            return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang!');
        }
        
        return redirect()->back()->with('error', 'Produk tidak ditemukan');
    }

    /**
     * Clear entire cart.
     */
    public function clear()
    {
        session()->forget('cart');
        
        return redirect()->route('cart.index')->with('success', 'Keranjang berhasil dikosongkan!');
    }

    /**
     * Calculate total price.
     */
    private function calculateTotal($cart)
    {
        $total = 0;
        
        foreach ($cart as $item) {
            $total += $item['harga'] * $item['quantity'];
        }
        
        return $total;
    }
}