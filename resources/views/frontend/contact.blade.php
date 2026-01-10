@extends('layouts.frontend')

@section('title', 'Contact – Inksiders')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endpush

@section('content')
<section class="section">
    <h2>Kontak Kami</h2>

    <div>
        @if(session('success'))
            <div>
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('contact.send') }}" method="POST" class="contact-form">
            @csrf
            
            <div class="inline-fields">
                <div class="field">
                    <label for="name">Nama</label>
                    <input id="name" name="name" type="text" placeholder="Nama kamu" value="{{ old('name') }}" required>
                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="field">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" placeholder="email@domain.com" value="{{ old('email') }}" required>
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="field">
                <label for="message">Pesan</label>
                <textarea id="message" name="message" rows="5" placeholder="Tulis pesan kamu..." required>{{ old('message') }}</textarea>
                @error('message')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                Kirim
            </button>
        </form>

        <div style="margin-top:3rem; text-align:center;">
            <h4>Informasi Kontak</h4>
            <p class="muted" style="margin-top:1rem;">
                Email: support@inksiders.com<br>
                WhatsApp: +62 812-3456-7890<br>
                Senin - Jumat: 09:00 - 17:00 WIB
            </p>
        </div>
    </div>
</section>
@endsection