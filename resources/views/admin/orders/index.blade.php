@extends('layouts.admin')

@section('title', 'Orders - InkSiders Admin')

@push('styles')
<style>
    .orders-page {
        padding: 30px;
        background: #f5f5f5;
        min-height: 100vh;
    }
    
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }
    
    .page-title {
        font-size: 28px;
        font-weight: 700;
        color: #333;
    }
    
    /* Stats Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .stat-card {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .stat-label {
        font-size: 13px;
        color: #666;
        margin-bottom: 8px;
        text-transform: uppercase;
        font-weight: 600;
    }
    
    .stat-value {
        font-size: 28px;
        font-weight: 700;
        color: #333;
    }
    
    .stat-card.revenue .stat-value {
        color: #28a745;
    }
    
    .stat-card.pending .stat-value {
        color: #ffc107;
    }
    
    .stat-card.paid .stat-value {
        color: #17a2b8;
    }
    
    /* Filters */
    .filters-section {
        background: white;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .filters-row {
        display: flex;
        gap: 15px;
        align-items: center;
        flex-wrap: wrap;
    }
    
    .filter-group {
        flex: 1;
        min-width: 200px;
    }
    
    .filter-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 5px;
        color: #666;
    }
    
    .filter-group input,
    .filter-group select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
    }
    
    .btn-filter {
        padding: 10px 24px;
        background: #0052a3;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
        margin-top: 24px;
    }
    
    .btn-filter:hover {
        background: #003d7a;
    }
    
    /* Orders Table */
    .orders-table-container {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    
    .orders-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .orders-table thead {
        background: #f8f9fa;
    }
    
    .orders-table th {
        padding: 15px;
        text-align: left;
        font-size: 13px;
        font-weight: 700;
        color: #666;
        text-transform: uppercase;
        border-bottom: 2px solid #e9ecef;
    }
    
    .orders-table td {
        padding: 15px;
        border-bottom: 1px solid #e9ecef;
        font-size: 14px;
    }
    
    .orders-table tbody tr:hover {
        background: #f8f9fa;
    }
    
    .order-number {
        font-weight: 600;
        color: #0052a3;
        font-family: 'Courier New', monospace;
    }
    
    .customer-info {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    
    .customer-name {
        font-weight: 600;
        color: #333;
    }
    
    .customer-email {
        font-size: 12px;
        color: #666;
    }
    
    /* Status Badge */
    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
    }
    
    .status-pending {
        background: #fff3cd;
        color: #856404;
    }
    
    .status-paid {
        background: #d1ecf1;
        color: #0c5460;
    }
    
    .status-processing {
        background: #cce5ff;
        color: #004085;
    }
    
    .status-completed {
        background: #d4edda;
        color: #155724;
    }
    
    .status-cancelled {
        background: #f8d7da;
        color: #721c24;
    }
    
    /* Payment Badge */
    .payment-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 13px;
        color: #666;
    }
    
    /* Actions */
    .actions {
        display: flex;
        gap: 8px;
    }
    
    .btn-action {
        padding: 6px 12px;
        border: none;
        border-radius: 4px;
        font-size: 12px;
        cursor: pointer;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
    }
    
    .btn-view {
        background: #17a2b8;
        color: white;
    }
    
    .btn-view:hover {
        background: #138496;
    }
    
    .btn-delete {
        background: #dc3545;
        color: white;
    }
    
    .btn-delete:hover {
        background: #c82333;
    }
    
    /* Pagination */
    .pagination-container {
        padding: 20px;
        display: flex;
        justify-content: center;
    }
    
    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }
    
    .empty-state-icon {
        font-size: 64px;
        margin-bottom: 20px;
        opacity: 0.3;
    }
    
    .empty-state-text {
        font-size: 18px;
        color: #666;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .orders-table-container {
            overflow-x: auto;
        }
        
        .filters-row {
            flex-direction: column;
        }
        
        .filter-group {
            width: 100%;
        }
    }
</style>
@endpush

@section('content')
<div class="orders-page">
    <div class="page-header">
        <h1 class="page-title">📦 Orders Management</h1>
    </div>
    
    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-label">Total Orders</div>
            <div class="stat-value">{{ $stats['total'] }}</div>
        </div>
        
        <div class="stat-card pending">
            <div class="stat-label">Pending</div>
            <div class="stat-value">{{ $stats['pending'] }}</div>
        </div>
        
        <div class="stat-card paid">
            <div class="stat-label">Paid</div>
            <div class="stat-value">{{ $stats['paid'] }}</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-label">Processing</div>
            <div class="stat-value">{{ $stats['processing'] }}</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-label">Completed</div>
            <div class="stat-value">{{ $stats['completed'] }}</div>
        </div>
        
        <div class="stat-card revenue">
            <div class="stat-label">Total Revenue</div>
            <div class="stat-value">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</div>
        </div>
    </div>
    
    <!-- Filters -->
    <div class="filters-section">
        <form action="{{ route('admin.orders.index') }}" method="GET">
            <div class="filters-row">
                <div class="filter-group">
                    <label>Search</label>
                    <input type="text" name="search" placeholder="Order number, customer name..." value="{{ request('search') }}">
                </div>
                
                <div class="filter-group">
                    <label>Status</label>
                    <select name="status">
                        <option value="">All Status</option>
                        <option value="pending_payment" {{ request('status') == 'pending_payment' ? 'selected' : '' }}>
                            Pending Payment
                        </option>
                        <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label>Payment Method</label>
                    <select name="payment_method">
                        <option value="">All Methods</option>
                        <option value="transfer" {{ request('payment_method') == 'transfer' ? 'selected' : '' }}>Transfer Bank</option>
                        <option value="ewallet" {{ request('payment_method') == 'ewallet' ? 'selected' : '' }}>COD</option>
                    </select>
                </div>
                
                <button type="submit" class="btn-filter">🔍 Filter</button>
            </div>
        </form>
    </div>
    
    <!-- Orders Table -->
    <div class="orders-table-container">
        @if($orders->count() > 0)
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Order Number</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Items</th>
                        <th>Total</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>
                            <span class="order-number">{{ $order->order_number }}</span>
                        </td>
                        <td>
                            <div class="customer-info">
                                <span class="customer-name">{{ $order->customer_name }}</span>
                                <span class="customer-email">{{ $order->customer_email }}</span>
                            </div>
                        </td>
                        <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                        <td>{{ $order->items->count() }} item(s)</td>
                        <td><strong>Rp {{ number_format($order->total, 0, ',', '.') }}</strong></td>
                        <td>
                            <span class="payment-badge">
                                @if($order->payment_method == 'transfer')
                                    🏦 Transfer Bank
                                @elseif($order->payment_method == 'ewallet')
                                    💵 COD
                                @else
                                    {{ ucfirst($order->payment_method) }}
                                @endif
                            </span>
                        </td>
                        <td>
                            <span class="status-badge status-{{ $order->status }}">
                                {{ strtoupper(str_replace('_', ' ', $order->status)) }}
                            </span>
                        </td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-action btn-view">
                                    👁️ View
                                </a>
                                <form action="{{ route('admin.orders.destroy', $order->id) }}" 
                                        method="POST" 
                                        onsubmit="return confirm('Yakin ingin menghapus order ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete">
                                        🗑️ Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div class="pagination-container">
                {{ $orders->links() }}
            </div>
        @else
            <div class="empty-state">
                <div class="empty-state-icon">📦</div>
                <div class="empty-state-text">Belum ada order yang masuk</div>
            </div>
        @endif
    </div>
</div>
@endsection