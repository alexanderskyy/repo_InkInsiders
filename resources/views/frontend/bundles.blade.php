@extends('layouts.frontend')

@section('title', 'Bundles – Inksiders')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/cbl.css') }}">
@endpush

@section('content')
<section class="section">
  <div class="container">
    <h2>Paket hemat</h2>
    <p class="muted">Diskon otomatis saat membeli bundle.</p>

    <div class="grid collections-grid">
      <article class="card">
        <img src="img/Office Starter Bundle.webp" alt="Office Starter Bundle">
        <h3>Office Starter Bundle</h3>
        <p class="muted">Pulpen + notebook + stapler</p>
        <p class="price">Rp 75.000</p>
        <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="kode_produk" value="bundle-office-starter-bundle">
            <input type="hidden" name="nama_produk" value="Office Starter Bundle">
            <input type="hidden" name="harga" value="75000">
            <input type="hidden" name="quantity" value="1">
            
            <button type="submit" class="btn btn-primary btn-full">
              Add to Cart
            </button>
        </form>
      </article>

      <article class="card">
        <img src="img/Writer Pack.jpeg" alt="Writer Pack">
        <h3>Writer Pack</h3>
        <p class="muted">Pulpen premium + refill</p>
        <p class="price">Rp 55.000</p>
        <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="kode_produk" value="bundle-writer-pack">
            <input type="hidden" name="nama_produk" value="Writer Pack">
            <input type="hidden" name="harga" value="55000">
            <input type="hidden" name="quantity" value="1">
            
            <button type="submit" class="btn btn-primary btn-full">
              Add to Cart
            </button>
        </form>
      </article>

      <article class="card">
        <img src="img/note pack.webp" alt="Note Pack">
        <h3>Note Pack</h3>
        <p class="muted">Notebook + sticky notes</p>
        <p class="price">Rp 40.000</p>
        <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="kode_produk" value="bundle-note-pack">
            <input type="hidden" name="nama_produk" value="Note Pack">
            <input type="hidden" name="harga" value="40000">
            <input type="hidden" name="quantity" value="1">
            
            <button type="submit" class="btn btn-primary btn-full">
              Add to Cart
            </button>
        </form>
      </article>
    </div>

</section>
@endsection

@push('scripts')
<script src="{{ asset('js/cart.js') }}"></script>
@endpush