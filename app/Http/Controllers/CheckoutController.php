<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    /**
     * Show checkout page.
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong');
        }

        $total = $this->calculateTotal($cart);

        return view('frontend.checkout', compact('cart', 'total'));
    }

    /**
     * Process checkout and create order.
     */
    public function process(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'address' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'payment' => 'required|in:ewallet,card,transfer',
        ]);

        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong');
        }

        DB::beginTransaction();
        
        try {
            // Generate Order Number dengan format INK-YYYYMMDD-XXXXX
            $orderNumber = $this->generateOrderNumber();

            // Create Order
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => $orderNumber,
                'customer_name' => $validated['name'],
                'customer_email' => $validated['email'],
                'shipping_address' => $validated['address'],
                'shipping_city' => $validated['city'],
                'shipping_zip' => $validated['zip'],
                'payment_method' => $validated['payment'],
                'total' => $this->calculateTotal($cart),
                'status' => 'pending_payment', // PENTING: Set default status
            ]);

            // Create Order Items & Update Stock
            foreach ($cart as $kode_produk => $item) {
                // Buat order item
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_code' => $kode_produk,
                    'product_name' => $item['nama_produk'],
                    'price' => $item['harga'],
                    'quantity' => $item['quantity'],
                ]);

                // Update stok produk
                $product = Product::where('kode_produk', $kode_produk)->first();
                if ($product) {
                    $product->stok = $product->stok - $item['quantity'];
                    $product->save();
                } else {
                    Log::warning("Product not found: {$kode_produk}");
                }
            }

            DB::commit();

            // Clear cart
            session()->forget('cart');

            // PENTING: Cek metode pembayaran
            if ($validated['payment'] === 'transfer') {
                // Redirect ke halaman payment untuk Transfer Bank
                return redirect()->route('checkout.payment', $order->id)
                    ->with('success', 'Pesanan berhasil dibuat!');
            } else {
                // Redirect ke confirmation untuk metode lain (COD, E-Wallet)
                return redirect()->route('checkout.confirmation', $order->id)
                    ->with('success', 'Pesanan berhasil dibuat!');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Checkout Error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show payment page (hanya untuk Transfer Bank).
     */
    public function payment(Order $order)
    {
        // Pastikan user hanya bisa lihat order mereka sendiri
        if (auth()->user()->role !== 'user') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Pastikan metode pembayaran adalah transfer
        if ($order->payment_method !== 'transfer') {
            return redirect()->route('checkout.confirmation', $order->id);
        }

        return view('frontend.payment', compact('order'));
    }

    /**
     * Mark order as paid (untuk testing).
     */
    public function markAsPaid(Order $order)
    {
        // Pastikan user hanya bisa update order mereka sendiri
        if ($order->user_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ], 403);
        }

        try {
            // Update status order
            $order->status = 'paid';
            $order->save();

            // Log untuk debugging
            Log::info("Order {$order->order_number} marked as paid by user {$order->user_id}");

            return response()->json([
                'success' => true,
                'message' => 'Pembayaran berhasil dikonfirmasi',
                'redirect' => route('checkout.confirmation', $order->id)
            ]);

        } catch (\Exception $e) {
            Log::error('Mark as Paid Error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal memproses pembayaran: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show order confirmation.
     */
    public function confirmation(Order $order)
    {
        // Pastikan user hanya bisa lihat order mereka sendiri
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Load relationship items
        $order->load('items');

        return view('frontend.confirmation', compact('order'));
    }

    /**
     * Calculate cart total.
     */
    private function calculateTotal($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['harga'] * $item['quantity'];
        }
        return $total;
    }

    /**
     * Generate Order Number dengan format INK-YYYYMMDD-XXXXX.
     */
    private function generateOrderNumber()
    {
        $date = date('Ymd');
        $random = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
        return 'INK-' . $date . '-' . $random;
    }
}