@extends('layouts.frontend')

@section('title', 'Pembayaran - InkSiders')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/payment.css') }}">
@endpush

@section('content')
<div class="container-payment">

    <div class="order-info">
        <h1 class="page-title">💳 Instruksi Pembayaran</h1>
        <div class="order-info-row">
            <span class="order-info-label">No Pesanan</span>
            <span class="order-info-value">{{ $order->order_number }}</span>
        </div>
        <div class="order-info-row">
            <span class="order-info-label">Tanggal Pesanan</span>
            <span class="order-info-value">{{ $order->created_at->format('d F Y, H:i') }} WIB</span>
        </div>
        <div class="order-info-row">
            <span class="order-info-label">Total Pembayaran</span>
            <span class="order-info-value">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
        </div>
    </div>

    <div class="info-mode-box">
    <div class="info-mode-content">
        <span>ℹ️</span>
        <p>
            <span class="highlight">Silakan selesaikan pembayaran Anda</span><br>
            dengan mengikuti instruksi di bawah ini.
            Pastikan jumlah transfer sesuai dengan total checkout dan gunakan
            No Pesanan sebagai referensi pembayaran.
        </p>
    </div>
    </div>

    <div class="section">
        <h2 class="section-title">🏦 Detail Transfer Bank</h2>
        <div class="info-box">
            <div class="info-row">
                <span class="info-label">Nama Bank</span>
                <span class="info-value">InkSiders Bank</span>
            </div>
            <div class="info-row">
                <span class="info-label">Nomor Rekening</span>
                <span class="info-value">123456789</span>
            </div>
            <div class="info-row">
                <span class="info-label">Atas Nama</span>
                <span class="info-value">PT InkSiders Indonesia</span>
            </div>
            <div class="info-row">
                <span class="info-label">No Pesanan / Referensi</span>
                <span class="info-value" style="color: #0052a3;">{{ $order->order_number }}</span>
            </div>
        </div>
    </div>

    <div class="section-LP">
        <h2 class="section-title">📝 Langkah Pembayaran</h2>
        <div class="steps">
            <div class="step">
                Masuk ke layanan mobile banking / internet banking atau kunjungi cabang bank terdekat.
            </div>
            <div class="step">
                Transfer sejumlah <strong style="color: #0052a3;">Rp {{ number_format($order->total, 0, ',', '.') }}</strong> ke rekening yang tertera di atas.
            </div>
            <div class="step">
                Masukkan No Pesanan (<strong style="color: #0052a3;">{{ $order->order_number }}</strong>) pada kolom berita atau referensi transfer.
            </div>
            <div class="step">
                Simpan bukti pembayaran untuk keperluan verifikasi.
            </div>
            <div class="step">
                Pesanan akan diproses setelah pembayaran dikonfirmasi (maksimal 1x24 jam).
            </div>
        </div>
    </div>

    <!-- Testing Mode Section -->
    <div class="testing-mode-box">
        <div class="testing-content">
            <span>ℹ️</span>
            <p>
            <strong>Testing Mode:</strong><br>
            Setelah melakukan transfer, gunakan tombol di bawah untuk simulasi konfirmasi 
            pembayaran (hanya untuk testing).
            </p>
        </div>
        <form action="{{ route('checkout.mark-paid', $order->id) }}" method="POST" id="mark-paid-form">
            @csrf
            <button type="submit" class="btn btn-warning" id="mark-paid-btn">
                ✓ Mark as Paid (Mock)
            </button>
        </form>
    </div>

    <div class="action-buttons">
        <button class="btn btn-primary" onclick="copyPaymentInfo()">📋 Salin Info Pembayaran</button>
        <a href="{{ route('home') }}" class="btn btn-secondary">🏠 Kembali ke Beranda</a>
    </div>
</div>

<!-- Data untuk JavaScript -->
<script>
    window.orderData = {
        orderNumber: "{{ $order->order_number }}",
        totalPrice: {{ $order->total }},
        orderDate: "{{ $order->created_at->toISOString() }}",
        bankName: "InkSiders Bank",
        accountNumber: "123456789",
        accountName: "PT InkSiders Indonesia"
    };
</script>
@endsection

@push('scripts')
<script src="{{ asset('js/payment.js') }}"></script>
<script>
    // Handle Mark as Paid form submission
    document.getElementById('mark-paid-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const btn = document.getElementById('mark-paid-btn');
        const originalText = btn.innerHTML;
        
        // Konfirmasi dulu
        if (!confirm('Apakah Anda yakin ingin menandai pesanan ini sebagai sudah dibayar?')) {
            return;
        }
        
        // Show loading
        btn.disabled = true;
        btn.innerHTML = '⏳ Processing...';
        
        // Submit form via AJAX
        fetch(this.action, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                btn.innerHTML = '✓ Pembayaran Berhasil Dikonfirmasi!';
                btn.style.background = '#28a745';
                
                // Show success message
                alert('Pembayaran berhasil dikonfirmasi! Redirecting...');
                
                // Redirect after 1.5 second
                setTimeout(() => {
                    window.location.href = data.redirect;
                }, 1500);
            } else {
                throw new Error(data.message || 'Gagal memproses pembayaran');
            }
        })
        .catch(error => {
            btn.disabled = false;
            btn.innerHTML = originalText;
            alert('Error: ' + error.message);
            console.error('Error:', error);
        });
    });
</script>
@endpush