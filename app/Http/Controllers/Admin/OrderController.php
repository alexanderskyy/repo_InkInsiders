<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of orders.
     */
    public function index(Request $request)
    {
        $query = Order::with(['user', 'items'])
            ->orderBy('created_at', 'desc');
        
        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        // Filter by payment method
        if ($request->has('payment_method') && $request->payment_method != '') {
            $query->where('payment_method', $request->payment_method);
        }
        
        // Search by order number or customer name
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_email', 'like', "%{$search}%");
            });
        }
        
        // Paginate results
        $orders = $query->paginate(15);
        
        // Get statistics
        $stats = [
    'total' => Order::count(),

    // PENTING: pakai pending_payment
    'pending' => Order::where('status', 'pending_payment')->count(),

    'paid' => Order::where('status', 'paid')->count(),
    'processing' => Order::where('status', 'processing')->count(),
    'completed' => Order::where('status', 'completed')->count(),

    // Revenue hanya dari yang sudah dibayar
    'total_revenue' => Order::whereIn('status', ['paid', 'processing', 'completed'])
        ->sum('total'),
];
        
        return view('admin.orders.index', compact('orders', 'stats'));
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        $order->load(['user', 'items']);
        
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update order status.
     */
    public function updateStatus(Request $request, Order $order)
    {
    $request->validate([
        'status' => 'required|in:pending_payment,paid,processing,completed,cancelled',
    ]);

    $order->update([
        'status' => $request->status,
    ]);

    return redirect()
        ->route('admin.orders.show', $order->id)
        ->with('success', 'Status order berhasil diperbarui');
    }

    /**
     * Delete order.
     */
    public function destroy(Order $order)
    {
    $order->items()->delete();
    $order->delete();

    return redirect()
        ->route('admin.orders.index')
        ->with('success', 'Order berhasil dihapus');
    }  
}