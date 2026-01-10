@extends('layouts.frontend')

@section('title', 'Checkout – Inksiders')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
@endpush

@section('content')
<section class="section">
    <h2>Checkout</h2>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('checkout.process') }}" method="POST" class="form" id="checkout-form">
        @csrf
        
        <!-- Nama & Email -->
        <div class="inline-fields">
            <div class="field">
                <label for="name">Nama lengkap</label>
                <input id="name" name="name" value="{{ auth()->user()->name }}" required>
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" required>
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="field">
            <label for="address">Alamat</label>
            <input id="address" name="address" value="{{ old('address') }}" required>
            @error('address')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="inline-fields">
            <div class="field">
                <label for="city">Kota</label>
                <input id="city" name="city" value="{{ old('city') }}" required>
                @error('city')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="field">
                <label for="zip">Kode pos</label>
                <input id="zip" name="zip" value="{{ old('zip') }}" required>
                @error('zip')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="field">
            <label for="payment">Metode pembayaran</label>
            <select id="payment" name="payment" required>
                <option value="ewallet" {{ old('payment') == 'ewallet' ? 'selected' : '' }}>COD (Cash On Delivery)</option>
                <option value="transfer" {{ old('payment') == 'transfer' ? 'selected' : '' }}>Transfer Bank</option>
            </select>
            @error('payment')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="summary" style="margin-top:12px;">
            <h4>Ringkasan Pesanan</h4>
            @foreach($cart as $item)
            <div class="summary-row">
                <span>{{ $item['nama_produk'] }} ({{ $item['quantity'] }}x)</span>
                <span>Rp {{ number_format($item['harga'] * $item['quantity'], 0, ',', '.') }}</span>
            </div>
            @endforeach
            
            <hr style="margin:1rem 0;">
            
            <div class="summary-row">
                <span><strong>Total</strong></span>
                <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong>
            </div>
        </div>

        <button class="btn-primary" type="submit" id="place-order-btn">Place Order</button>
    </form>
</section>
@endsection

@push('scripts')
<script>
    // Validasi form sebelum submit
    document.getElementById('checkout-form').addEventListener('submit', function(e) {
        const paymentMethod = document.getElementById('payment').value;
        
        // Validasi semua field terisi
        const requiredFields = this.querySelectorAll('[required]');
        let allFilled = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                allFilled = false;
                field.style.borderColor = 'red';
            } else {
                field.style.borderColor = '';
            }
            
        });
        
        if (!allFilled) {
            e.preventDefault();
            alert('Mohon lengkapi semua field yang diperlukan');
            return false;
        }
        
        // Tampilkan loading pada tombol
        const btn = document.getElementById('place-order-btn');
        btn.disabled = true;
        btn.textContent = 'Processing...';
    });
</script>
@endpush