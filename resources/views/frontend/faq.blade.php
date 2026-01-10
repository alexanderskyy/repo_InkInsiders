@extends('layouts.frontend')

@section('title', 'FAQ – Inksiders')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/faq.css') }}">
@endpush

@section('content')
<section class="section">
    <h2>Pertanyaan Umum</h2>

    <div class="summary" style="max-width:800px; margin:0 auto;">
        <div style="margin-bottom:2rem;">
            <h4>Pengiriman</h4>
            <p><strong>Berapa lama waktu pengiriman?</strong></p>
            <p class="muted">1–3 hari kerja di Jawa, 3–7 hari luar Jawa.</p>
        </div>

        

        <div style="margin-bottom:2rem;">
            <h4>Retur & Pengembalian</h4>
            <p><strong>Bagaimana kebijakan retur?</strong></p>
            <p class="muted">Anda dapat mengembalikan produk dalam 7 hari dengan kondisi produk tidak rusak dan masih dalam kemasan asli.</p>
        </div>

        <div style="margin-bottom:2rem;">
            <h4>Pembayaran</h4>
            <p><strong>Metode pembayaran apa yang tersedia?</strong></p>
            <p class="muted">Kami menerima E-Wallet, Kartu Kredit/Debit, dan Transfer Bank.</p>
        </div>

        <div style="margin-bottom:2rem;">
            <h4>Stok Produk</h4>
            <p><strong>Bagaimana jika produk yang saya inginkan habis?</strong></p>
            <p class="muted">Anda dapat menghubungi customer service kami untuk informasi restock produk.</p>
        </div>
    </div>

    <div style="text-align:center; margin-top:3rem;">
        <p class="muted">Masih ada pertanyaan?</p>
        <a href="{{ route('contact') }}" class="btn btn-primary" style="margin-top:1rem;">Hubungi Kami</a>
    </div>
</section>
@endsection