@extends('layouts.frontend')

@section('title', 'Cart – Inksiders')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endpush

@section('content')
<section class="section">
    <h2>Keranjang belanja</h2>

        @if(session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif
    
    @if(!empty($cart) && count($cart) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $kode => $item)
                <tr>
                    <td>
                        <strong>{{ $item['nama_produk'] }}</strong><br>
                        <small class="muted">{{ $kode }}</small>
                    </td>
                    <td>Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                    <td>
                        <form action="{{ route('cart.update') }}" method="POST" class="quantity-form">
                            @csrf
                            <input type="hidden" name="kode_produk" value="{{ $kode }}">
                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" required>
                            @auth
                                @if(auth()->user()->role === 'admin')
                                    <!-- konten admin -->
                            @endif
                            @endauth

                            @guest
                                <!-- konten untuk user belum login -->
                            @endguest
                        </form>
                    </td>
                    <td>Rp {{ number_format($item['harga'] * $item['quantity'], 0, ',', '.') }}</td>
                    <td>
                        <form action="{{ route('cart.remove', $kode) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')" style="margin: 0;">
                            @csrf
                                @auth
                                @if(auth()->user()->role === 'admin')
                                    <!-- konten admin -->
                            @endif
                            @endauth

                            @guest
                                <!-- konten untuk user belum login -->
                            @endguest
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div style="text-align:center; padding:3rem;">
            <p class="muted">Keranjang belanja Anda kosong.</p>
            <a href="{{ route('shop.index') }}" class="btn btn-primary" style="margin-top:1rem">Mulai Belanja</a>
        </div>
    @endif
</section>

@if(!empty($cart) && count($cart) > 0)
<section class="section">
    <div class="summary">
        <div class="summary-row">
            <span>Total</span>
            <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong>
        </div>
        
        @auth
            @if(auth()->user()->role === 'user')
                <a href="{{ route('checkout.index') }}" class="btn btn-accent">Checkout</a>
            @else
                <p class="muted">Admin tidak dapat melakukan checkout.</p>
            @endif
        @else
            <a href="{{ route('login') }}" class="btn btn-accent">Login untuk Checkout</a>
        @endauth
        
        <form action="{{ route('cart.clear') }}" method="POST" style="margin-top:1rem;" onsubmit="return confirm('Kosongkan keranjang?')">
            @csrf
            @auth
                                @if(auth()->user()->role === 'admin')
                                    <!-- konten admin -->
                            @endif
                            @endauth

                            @guest
                                <!-- konten untuk user belum login -->
                            @endguest
                 @method('DELETE')
                 <button type="submit" class="btn btn-outline btn-full">Kosongkan Keranjang</button>
            @else
            @endif
        </form>
    </div>
</section>
@endsection