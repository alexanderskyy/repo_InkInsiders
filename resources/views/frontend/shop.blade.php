@extends('layouts.frontend')

@section('title', 'Shop – Inksiders')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/shop.css') }}">
@endpush

@section('content')
<section class="section">
    <h2>Semua Produk</h2>
    <p class="muted">
        Pens & Markers • Paper & Notebooks • Office Essentials • Storage & Organization
    </p>

    <div class="grid">

      <article class="card">
        <img src="img/pulpen.png" alt="Pulpen Gel">
        <h3>Pulpen Gel</h3>
        <p class="muted">Tinta gel cepat kering.</p>
        <p class="price">Rp 18.000</p>
        
        <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="kode_produk" value="pen-gel-001">
            <input type="hidden" name="nama_produk" value="Pulpen Gel">
            <input type="hidden" name="harga" value="18000">
            <input type="hidden" name="quantity" value="1">
            
            <button type="submit" class="btn btn-primary">
              Add to Cart
            </button>
        </form>
      </article>

      <article class="card">
        <img src="img/notebook.jpg" alt="Notebook A5">
        <h3>Notebook A5</h3>
        <p class="muted">Ukuran ringkas, 120 halaman.</p>
        <p class="price">Rp 28.000</p>
        <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="kode_produk" value="nb-a5-001">
            <input type="hidden" name="nama_produk" value="Notebook A5">
            <input type="hidden" name="harga" value="28000">
            <input type="hidden" name="quantity" value="1">
            
            <button type="submit" class="btn btn-primary">
              Add to Cart
            </button>
        </form>
      </article>

      <article class="card">
        <img src="img/stapler mini.webp" alt="Stapler Mini">
        <h3>Stapler Mini</h3>
        <p class="muted">Ringkas, mudah dibawa.</p>
        <p class="price">Rp 22.000</p>
        <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="kode_produk" value="stapler-mini-001">
            <input type="hidden" name="nama_produk" value="Stapler Mini">
            <input type="hidden" name="harga" value="22000">
            <input type="hidden" name="quantity" value="1">
            
            <button type="submit" class="btn btn-primary">
              Add to Cart
            </button>
        </form>
      </article>

      <article class="card">
        <img src="img/highlighter.jpg" alt="Highlighter Set">
        <h3>Highlighter Set</h3>
        <p class="muted">5 warna pastel.</p>
        <p class="price">Rp 35.000</p>
        <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="kode_produk" value="highlighter-set-001">
            <input type="hidden" name="nama_produk" value="Highlighter Set">
            <input type="hidden" name="harga" value="35000">
            <input type="hidden" name="quantity" value="1">
            
            <button type="submit" class="btn btn-primary">
              Add to Cart
            </button>
        </form>
      </article>

      <article class="card">
        <img src="img/sticky notes.webp" alt="Sticky Notes">
        <h3>Sticky Notes</h3>
        <p class="muted">Pad berwarna-warni.</p>
        <p class="price">Rp 12.000</p>
        <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="kode_produk" value="sticky-notes-001">
            <input type="hidden" name="nama_produk" value="Sticky Notes">
            <input type="hidden" name="harga" value="12000">
            <input type="hidden" name="quantity" value="1">
            
            <button type="submit" class="btn btn-primary">
              Add to Cart
            </button>
        </form>
      </article>

      <article class="card">
        <img src="img/penggaris metal.jpg" alt="Penggaris Metal">
        <h3>Penggaris Metal</h3>
        <p class="muted">Skala presisi 30cm.</p>
        <p class="price">Rp 20.000</p>
        <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="kode_produk" value="ruler-metal-001">
            <input type="hidden" name="nama_produk" value="Penggaris Metal">
            <input type="hidden" name="harga" value="20000">
            <input type="hidden" name="quantity" value="1">
            
            <button type="submit" class="btn btn-primary">
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