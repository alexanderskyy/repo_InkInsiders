@extends('layouts.admin')

@section('title', 'Order Detail - InkSiders Admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/confirmation.css') }}">
<style>
    .order-detail-page {
        padding: 30px;
        background: #f5f5f5;
        min-height: 100vh;
    }
    
    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        background: white;
        border: 1px solid #ddd;
        border-radius: 6px;
        text-decoration: none;
        color: #333;
        font-weight: 600;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }
    
    .back-button:hover {
        background: #f8f9fa;
        border-color: #0052a3;
        color: #0052a3;
    }
    
    .order-header {
        background: white;
        padding: 25px;
        border-radius: 8px;
        margin-bottom: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .order-title {
        font-size: 24px;
        font-weight: 700;
        color: #333;
    }
    
    .status-selector {
        display: flex;
        gap: 10px;
        align-items: center;
    }
    
    .status-selector select {
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
    }
    
    .btn-update-status {
        padding: 10px 20px;
        background: #28a745;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
    }
    
    .btn-update-status:hover {
        background: #218838;
    }
    
    .confirmation-container {
        max-width: 1200px;
        margin: 0 auto;
    }
</style>
@endpush

@section('content')
<div class="order-detail-page">
    <a href="{{ route('admin.orders.index') }}" class="back-button">
        ← Back to Orders
    </a>
    
    <div class="order-header">
        <h1 class="order-title">Order Detail: {{ $order->order_number }}</h1>
        
        <div class="status-selector">
            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" id="status-form">
                @csrf
                @method('PATCH')
                <select name="status" id="status-select">
    <option value="pending_payment" {{ $order->status == 'pending_payment' ? 'selected' : '' }}>
        Pending Payment
    </option>
    <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>
        Paid
    </option>
    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>
        Processing
    </option>
    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>
        Completed
    </option>
    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>
        Cancelled
    </option>
</select>

                <button type="submit" class="btn-update-status">Update Status</button>
            </form>
        </div>
    </div>
    
    <div class="confirmation-container">

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
                        @elseif($order->status === 'pending_payment')
                            <span class="badge badge-warning">⏳ Menunggu Pembayaran</span>
                        @elseif($order->status === 'completed')
                            <span class="badge badge-success">✓ Selesai</span>
                        @elseif($order->status === 'cancelled')
                            <span class="badge badge-secondary">✕ Dibatalkan</span>
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

        <!-- Action Buttons -->
        <div class="action-buttons" style="margin-top: 30px;">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">← Back to Orders</a>
            <button onclick="window.print()" class="btn btn-secondary">🖨️ Print</button>
        </div>
    </div>
</div>

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
@endsection