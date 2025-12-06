<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Storage;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of all orders
     */
    public function index(Request $request)
    {
        $query = Order::with('user', 'orderItems.product');

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Search by order number or customer name
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_phone', 'like', "%{$search}%");
            });
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display the specified order
     */
    public function show(Order $order)
    {
        $order->load('user', 'orderItems.product');

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update order status
     */
    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled',
        ]);

        $order->update([
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Status pesanan berhasil diperbarui.');
    }

    /**
     * Upload payment proof for order
     */
    public function uploadPaymentProof(Request $request, Order $order)
    {
        $validated = $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // Max 5MB
        ]);

        // Delete old payment proof if exists
        if ($order->payment_proof) {
            Storage::disk('public')->delete($order->payment_proof);
        }

        // Store new payment proof
        $path = $request->file('payment_proof')->store('payment-proofs', 'public');
        
        $order->update([
            'payment_proof' => $path,
        ]);

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Bukti pembayaran berhasil diunggah.');
    }

    /**
     * Delete payment proof
     */
    public function deletePaymentProof(Order $order)
    {
        if ($order->payment_proof) {
            Storage::disk('public')->delete($order->payment_proof);
            $order->update(['payment_proof' => null]);
            
            return redirect()->route('admin.orders.show', $order)
                ->with('success', 'Bukti pembayaran berhasil dihapus.');
        }

        return redirect()->route('admin.orders.show', $order)
            ->with('error', 'Tidak ada bukti pembayaran untuk dihapus.');
    }

    /**
     * Update order notes
     */
    public function updateNotes(Request $request, Order $order)
    {
        $validated = $request->validate([
            'notes' => 'nullable|string|max:1000',
        ]);

        $order->update([
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Catatan pesanan berhasil diperbarui.');
    }

    /**
     * Delete order
     */
    public function destroy(Order $order)
    {
        // Delete payment proof if exists
        if ($order->payment_proof) {
            Storage::disk('public')->delete($order->payment_proof);
        }

        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Pesanan berhasil dihapus.');
    }
}
