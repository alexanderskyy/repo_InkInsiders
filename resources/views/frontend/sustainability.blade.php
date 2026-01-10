@extends('layouts.frontend')

@section('title', 'Sustainability – Inksiders')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/sustainability.css') }}">
@endpush

@section('content')
<section class="section">
    <h2>Komitmen Keberlanjutan</h2>

    <div style="max-width:800px; margin:0 auto;">
        <p style="margin-bottom:2rem;">
            Di Inksiders, kami berkomitmen untuk mengurangi dampak lingkungan melalui 
            praktik bisnis yang berkelanjutan dan bertanggung jawab.
        </p>

        <div style="background:#f8f9fa; padding:2rem; border-radius:12px; margin-bottom:2rem;">
            <h3 style="margin-bottom:1rem;">Praktik Keberlanjutan Kami</h3>
            
            <ul style="list-style:none; padding:0;">
                <li style="padding:0.75rem 0; border-bottom:1px solid #e0e0e0;">
                    ♻️ <strong>Produk Ramah Lingkungan</strong><br>
                    <span class="muted">Produk kertas dari bahan daur ulang terverifikasi.</span>
                </li>
                
                <li style="padding:0.75rem 0; border-bottom:1px solid #e0e0e0;">
                    📦 <strong>Kemasan Minimal</strong><br>
                    <span class="muted">Kemasan minim plastik, mudah didaur ulang.</span>
                </li>
                
                <li style="padding:0.75rem 0; border-bottom:1px solid #e0e0e0;">
                    ⭐ <strong>Kualitas Jangka Panjang</strong><br>
                    <span class="muted">Produk berkualitas tinggi untuk umur pakai lebih panjang, mengurangi limbah.</span>
                </li>
                
                <li style="padding:0.75rem 0;">
                    🌱 <strong>Program Penghijauan</strong><br>
                    <span class="muted">1 produk terjual = 1 pohon ditanam melalui kemitraan kami.</span>
                </li>
            </ul>
        </div>

        <div style="text-align:center; margin-top:3rem;">
            <h3 style="margin-bottom:1rem;">Mari Bersama Menjaga Bumi</h3>
            <p class="muted">
                Setiap pembelian Anda berkontribusi untuk masa depan yang lebih hijau.
            </p>
            <a href="{{ route('shop.index') }}" class="btn btn-primary" style="margin-top:1.5rem;">
                Belanja Sekarang
            </a>
        </div>
    </div>
</section>
@endsection