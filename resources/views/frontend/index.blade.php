@extends('layouts.frontend')

@section('title', 'Inksiders – ATK Store')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/shop.css') }}">
@endpush

@section('hero')
<section class="hero">
    <h1>Diskon 20% Starter Pack ATK</h1>
    <p>
        Lengkapi kebutuhan kantor dengan pulpen premium, notebook elegan,
        dan stapler kokoh. Praktis, stylish, siap kerja.
    </p>
    <a href="{{ route('shop.collections') }}" class="cta">Lihat Starter Sets</a>
</section>
@endsection

@section('content')
<section class="section">

    <h2>Produk Unggulan</h2>

    <div class="grid">
        <article class="card">
          <img src="img/pulpen.png" alt="Pulpen Premium">
          <h3>Pulpen Premium</h3>
          <p class="muted">Tinta halus, grip nyaman.</p>
          <p class="price">Rp 15.000</p>
          <div class="actions">

          <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="kode_produk" value="pen-1">
            <input type="hidden" name="nama_produk" value="Pulpen Premium">
            <input type="hidden" name="harga" value="15000">
            <input type="hidden" name="quantity" value="1">
            
            <button type="submit" class="btn btn-primary">
              Add to Cart
            </button>
          </form>

            <a href="{{ route('shop.index') }}" class="btn btn-outline">Detail</a>
          </div>
        </article>

        <article class="card">
          <img src="img/notebook.jpg" alt="Notebook">
          <h3>Notebook</h3>
          <p class="muted">Kertas halus, cover elegan.</p>
          <p class="price">Rp 25.000</p>
          <div class="actions">
            <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="kode_produk" value="nb-1">
            <input type="hidden" name="nama_produk" value="Notebook">
            <input type="hidden" name="harga" value="25000">
            <input type="hidden" name="quantity" value="1">
            
            <button type="submit" class="btn btn-primary">
              Add to Cart
            </button>
          </form>
            <a href="{{ route('shop.index') }}" class="btn btn-outline">Detail</a>
          </div>
        </article>

        <article class="card">
          <img src="img/stapler.png" alt="Stapler">
          <h3>Stapler</h3>
          <p class="muted">Body metal, kuat dan awet.</p>
          <p class="price">Rp 30.000</p>
          <div class="actions">
            <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="kode_produk" value="st-1">
            <input type="hidden" name="nama_produk" value="Stapler">
            <input type="hidden" name="harga" value="30000">
            <input type="hidden" name="quantity" value="1">
            
            <button type="submit" class="btn btn-primary">
              Add to Cart
            </button>
          </form>
            <a href="{{ route('shop.index') }}" class="btn btn-outline">Detail</a>
          </div>
        </article>

      </div>
</section>
@endsection

@push('scripts')
<script>
document.querySelectorAll('.add-to-cart-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        fetch(this.action, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                kode_produk: this.querySelector('[name="kode_produk"]').value,
                quantity: this.querySelector('[name="quantity"]').value
            })
        })
        .then(res => res.json())
        .then(data => {
            if(data.success) {
                alert(data.message);
                location.reload();
            } else {
                alert(data.message);
            }
        });
    });
});
</script>
@endpush