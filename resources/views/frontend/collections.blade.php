@extends('layouts.frontend')

@section('title', 'Collections – Inksiders')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/cbl.css') }}">
@endpush

@section('content')
<section class="section">
  <div class="container">
    <h2>Starter sets</h2>
    <p class="muted">Paket awal untuk kantor baru atau back-to-school.</p>

    <div class="grid collections-grid">

      <article class="card">
        <img src="img/Office Starter Bundle.webp" alt="Office Starter">
        <h3>Office Starter</h3>
        <p class="muted">Pulpen, notebook, stapler, highlighter.</p>
        <p class="price">Rp 95.000</p>
        <form action="{{ route('cart.add') }}" method="POST">
          @csrf
          <input type="hidden" name="kode_produk" value="bundle-office-starter">
          <input type="hidden" name="nama_produk" value="Office Starter">
          <input type="hidden" name="harga" value="95000">
          <input type="hidden" name="quantity" value="1">

          <button type="submit" class="btn btn-primary btn-full">
            Add to Cart
          </button>
        </form>
      </article>

      <article class="card">
        <img src="img/study kit.webp" alt="Study Kit">
        <h3>Study Kit</h3>
        <p class="muted">Pensil, penghapus, notebook, penggaris.</p>
        <p class="price">Rp 65.000</p>
        <form action="{{ route('cart.add') }}" method="POST">
          @csrf
          <input type="hidden" name="kode_produk" value="bundle-study-kit">
          <input type="hidden" name="nama_produk" value="Study Kit">
          <input type="hidden" name="harga" value="65000">
          <input type="hidden" name="quantity" value="1">

          <button type="submit" class="btn btn-primary btn-full">
            Add to Cart
          </button>
        </form>
      </article>

      <article class="card">
        <img src="img/creative pack.jpg" alt="Creative Pack">
        <h3>Creative Pack</h3>
        <p class="muted">Marker warna, sticky notes, notebook.</p>
        <p class="price">Rp 80.000</p>
        <form action="{{ route('cart.add') }}" method="POST">
          @csrf
          <input type="hidden" name="kode_produk" value="bundle-creative-pack">
          <input type="hidden" name="nama_produk" value="Creative Pack">
          <input type="hidden" name="harga" value="80000">
          <input type="hidden" name="quantity" value="1">

          <button type="submit" class="btn btn-primary btn-full">
            Add to Cart
          </button>
        </form>
      </article>
    </div>
  </div>

</section>
@endsection

@push('scripts')
<script src="{{ asset('js/cart.js') }}"></script>
@endpush