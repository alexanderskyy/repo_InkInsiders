@extends('layouts.frontend')

@section('title', 'Login – Inksiders')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}?v={{ time() }}">
@endpush

@section('content')
<section class="auth">
  <div class="auth-card">
    <div class="auth-header">
      <h1>Login</h1>
      <p class="muted">Masuk untuk melanjutkan checkout dan melihat pesanan.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="auth-form">
      @csrf

      <div class="field">
        <label for="email">Email</label>
        <input
          id="email"
          type="email"
          name="email"
          value="{{ old('email') }}"
          required
          autofocus
          class="@error('email') is-invalid @enderror"
          placeholder="contoh: kamu@inksiders.com"
        >
        @error('email')
          <small class="error">{{ $message }}</small>
        @enderror
      </div>

      <div class="field">
        <label for="password">Password</label>
        <input
          id="password"
          type="password"
          name="password"
          required
          class="@error('password') is-invalid @enderror"
          placeholder="••••••••"
        >
        @error('password')
          <small class="error">{{ $message }}</small>
        @enderror
      </div>

      <div class="row">
        <label class="check">
          <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
          <span>Remember me</span>
        </label>
      </div>

      <button type="submit" class="btn-primary w-full">Login</button>
    </form>
  </div>
</section>
@endsection
