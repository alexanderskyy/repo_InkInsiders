@extends('layouts.frontend')

@section('title', 'About – Inksiders')

@section('content')
<section class="section">
    <h2>Tentang Inksiders</h2>
    
    <div style="max-width:800px; margin:0 auto;">
        <p style="margin-bottom:1.5rem;">
            Inksiders adalah toko perlengkapan alat tulis kantor (ATK) premium yang berkomitmen 
            untuk menyediakan produk berkualitas tinggi untuk meningkatkan produktivitas harian Anda.
        </p>

        <h3 style="margin-top:2rem; margin-bottom:1rem;">Misi Kami</h3>
        <p style="margin-bottom:1.5rem;">
            Kami percaya bahwa alat tulis yang baik dapat membuat perbedaan besar dalam pekerjaan 
            sehari-hari. Oleh karena itu, kami hanya menyediakan produk pilihan yang telah melalui 
            kurasi ketat untuk memastikan kualitas terbaik.
        </p>

        <h3 style="margin-top:2rem; margin-bottom:1rem;">Nilai Kami</h3>
        <ul style="list-style:disc; padding-left:2rem; margin-bottom:1.5rem;">
            <li>Kualitas Premium</li>
            <li>Pelayanan Terbaik</li>
            <li>Keberlanjutan Lingkungan</li>
            <li>Inovasi Produk</li>
        </ul>

        <h3 style="margin-top:2rem; margin-bottom:1rem;">Hubungi Kami</h3>
        <p>
            Ada pertanyaan? Jangan ragu untuk <a href="{{ route('contact') }}" style="color:#F53003; text-decoration:underline;">menghubungi kami</a>.
        </p>
    </div>
</section>
@endsection