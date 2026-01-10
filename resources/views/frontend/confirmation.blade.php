@extends('layouts.frontend')

@section('title', 'Konfirmasi Pesanan - InkSiders')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/confirmation.css') }}">
@endpush

@section('content')
<div class="confirmation-container">
    <div class="success-animation">
        <div class="checkmark-circle">
            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                <circle class="checkmark-circle-path" cx="26" cy="26" r="25" fill="none"/>
                <path class="checkmark-check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
            </svg>
        </div>
    </div>

    <h1 class="confirmation-title">
        @if($order->status === 'paid' || $order->status === 'processing')
            Pembayaran Berhasil Dikonfirmasi! 🎉
        @else
            Pesanan Berhasil Dibuat!
        @endif
    </h1>
    
    <p class="confirmation-subtitle">
        @if($order->status === 'paid' || $order->status === 'processing')
            Terima kasih! Pembayaran Anda telah kami terima dan pesanan sedang diproses.
        @else
            Terima kasih telah berbelanja di InkSiders!
        @endif
    </p>

    <!-- Order Summary Card -->
    <div class="order-summary-card">
        <div class="card-header">
            <h3>📦 Detail Pesanan</h3>
        </div>
        <div class="card-body">
            <div class="summary-row">
                <span class="label">No Pesanan</span>
                <span class="value order-number">{{ $order->order_number }}</span>
            </div>
            <div class="summary-row">
                <span class="label">Tanggal</span>
                <span class="value">{{ $order->created_at->format('d F Y, H:i') }} WIB</span>
            </div>
            <div class="summary-row">
                <span class="label">Status</span>
                <span class="value">
                    @if($order->status === 'paid' || $order->status === 'processing')
                        <span class="badge badge-success">✓ Dibayar</span>
                    @elseif($order->status === 'pending')
                        <span class="badge badge-warning">⏳ Menunggu Pembayaran</span>
                    @else
                        <span class="badge badge-secondary">{{ ucfirst($order->status) }}</span>
                    @endif
                </span>
            </div>
            <div class="summary-row">
                <span class="label">Metode Pembayaran</span>
                <span class="value">
                    @if($order->payment_method === 'transfer')
                        Transfer Bank
                    @elseif($order->payment_method === 'ewallet')
                        COD (Cash on Delivery)
                    @else
                        {{ ucfirst($order->payment_method) }}
                    @endif
                </span>
            </div>
            
            <div class="divider"></div>
            
            <!-- Items List -->
            <div class="items-section">
                <h4 class="items-title">Item Pesanan:</h4>
                @foreach($order->items as $item)
                <div class="item-row">
                    <div class="item-info">
                        <span class="item-name">{{ $item->product_name }}</span>
                        <span class="item-qty">x{{ $item->quantity }}</span>
                    </div>
                    <span class="item-price">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                </div>
                @endforeach
            </div>
            
            <div class="divider"></div>
            
            <div class="summary-row total-row">
                <span class="label">Total Pembayaran</span>
                <span class="value total-amount">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <!-- Shipping Info Card -->
    <div class="shipping-card">
        <div class="card-header">
            <h3>🚚 Informasi Pengiriman</h3>
        </div>
        <div class="card-body">
            <p><strong>Nama:</strong> {{ $order->customer_name }}</p>
            <p><strong>Email:</strong> {{ $order->customer_email }}</p>
            <p><strong>Alamat:</strong> {{ $order->shipping_address }}</p>
            <p><strong>Kota:</strong> {{ $order->shipping_city }}</p>
            <p><strong>Kode Pos:</strong> {{ $order->shipping_zip }}</p>
        </div>
    </div>

    <!-- Next Steps -->
    @if($order->status === 'paid' || $order->status === 'processing')
    <div class="next-steps-card">
        <h3>✅ Langkah Selanjutnya</h3>
        <ul>
            <li>Pesanan Anda sedang diproses oleh tim kami</li>
            <li>Anda akan menerima email konfirmasi dalam 1x24 jam</li>
            <li>Pesanan akan dikirim dalam 2-3 hari kerja</li>
            <li>Nomor resi pengiriman akan dikirimkan via email</li>
        </ul>
    </div>
    @else
    @endif

    <!-- Action Buttons -->
    <div class="action-buttons">
        <a href="{{ route('home') }}" class="btn btn-primary">🏠 Kembali ke Beranda</a>
        <a href="{{ route('shop.index') }}" class="btn btn-secondary">🛍️ Belanja Lagi</a>
    </div>

    <!-- Print Order Button -->
    <div class="print-section">
        <button onclick="window.print()" class="btn-print">🖨️ Cetak Detail Pesanan</button>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto scroll to top
    window.scrollTo(0, 0);
    
    // Animate checkmark on load
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(() => {
            document.querySelector('.checkmark-circle').classList.add('animate');
        }, 100);
    });
</script>
@endpush