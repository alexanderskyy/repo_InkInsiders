@extends('layouts.frontend')

@section('title', 'Limited Editions – Inksiders')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/shop.css') }}">
<link rel="stylesheet" href="{{ asset('css/cbl.css') }}">
@endpush

@section('content')
<section class="section">
  <div class="container">
    <h2>Edisi Terbatas</h2>
    <p class="muted">Desain artistik dan koleksi eksklusif.</p>

    <div class="grid collections-grid">
      <article class="card">
        <img src="img/Pulpen Artist Series.jpg" alt="Pulpen Artist Series">
        <h3>Gold Bond Oversized Stonite Fountain Pen (1930s)</h3>
        <p class="muted">FOUNTAIN PEN.</p>
        <p class="price">Rp 3.600.000</p>
        <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="kode_produk" value="limited-gold-bond-oversized-stonite-fountain-pen-1930s">
            <input type="hidden" name="nama_produk" value="Gold Bond Oversized Stonite Fountain Pen (1930s)">
            <input type="hidden" name="harga" value="3600000">
            <input type="hidden" name="quantity" value="1">
            
            <button type="submit" class="btn btn-primary btn-full">
              Add to Cart
            </button>
        </form>
      </article>

      <article class="card">
        <img src="img/Notebook Limited.jpg" alt="Notebook Limited">
        <h3>Hobbit Moleskine Notebooks</h3>
        <p class="muted"><br> HOBBIT MOVIE.</p>
        <p class="price">Rp 272.000</p>
        <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="kode_produk" value="limited-hobbit-moleskine-notebooks">
            <input type="hidden" name="nama_produk" value="Hobbit Moleskine Notebooks">
            <input type="hidden" name="harga" value="272000">
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
<script src="{{ asset('javascript/cart.js') }}"></script>
@endpush