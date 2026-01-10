/**
 * Payment Page JavaScript
 * InkSiders Payment System
 */

// Fungsi untuk format rupiah
function formatRupiah(amount) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(amount);
}

// Fungsi untuk copy info pembayaran
function copyPaymentInfo() {
    try {
        // Ambil data dari window.orderData yang sudah di-set di blade
        const data = window.orderData;
        
        if (!data) {
            alert('Data pesanan tidak ditemukan. Silakan refresh halaman.');
            return;
        }

        const info = `INFORMASI PEMBAYARAN INKSIDERS

No Pesanan: ${data.orderNumber}
Total Pembayaran: ${formatRupiah(data.totalPrice)}

Detail Transfer:
Bank: ${data.bankName}
No Rekening: ${data.accountNumber}
Atas Nama: ${data.accountName}
Referensi: ${data.orderNumber}

Pastikan mengisi No Pesanan pada berita transfer!`.trim();

        // Copy ke clipboard
        navigator.clipboard.writeText(info).then(() => {
            // Ubah tombol untuk feedback
            const btn = event.target;
            const originalText = btn.textContent;
            btn.textContent = '✓ Berhasil Disalin!';
            btn.style.background = '#28a745';
            
            setTimeout(() => {
                btn.textContent = originalText;
                btn.style.background = '#0052a3';
            }, 2000);
        }).catch(err => {
            console.error('Error copying to clipboard:', err);
            // Fallback: tampilkan alert dengan info
            alert('Gagal menyalin otomatis. Salin manual:\n\n' + info);
        });
        
    } catch (error) {
        console.error('Error in copyPaymentInfo:', error);
        alert('Terjadi kesalahan saat menyalin informasi.');
    }
}

// Event listener untuk DOMContentLoaded
document.addEventListener('DOMContentLoaded', function() {
    console.log('Payment page loaded successfully');
    console.log('Order data:', window.orderData);
});