<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;

class OrderController extends Controller
{
    /**
     * Display a listing of orders (Admin & Staff)
     */
    public function index(Request $request)
    {
        $query = Order::with(['user', 'payment'])
            ->orderBy('created_at', 'desc');

        // Filter by status if provided
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        // Search by order number or customer name
        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('order_number', 'like', '%' . $request->search . '%')
                  ->orWhereHas('user', function ($userQuery) use ($request) {
                      $userQuery->where('name', 'like', '%' . $request->search . '%');
                  });
            });
        }

        $orders = $query->paginate(20);

        // Count by status
        $statusCounts = [
            'all' => Order::count(),
            'pending_payment' => Order::where('status', 'pending_payment')->count(),
            'pending_cooking' => Order::where('status', 'pending_cooking')->count(),
            'completed' => Order::where('status', 'completed')->count(),
            'rejected' => Order::where('status', 'rejected')->count(),
        ];

        return view('admin.orders.index', compact('orders', 'statusCounts'));
    }

    /**
     * Display the specified order
     */
    public function show($id)
    {
        $order = Order::with(['user', 'orderItems.product', 'payment'])
            ->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update order status
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending_payment,pending_cooking,completed,rejected',
            'rejection_reason' => 'required_if:status,rejected',
        ]);

        $order = Order::findOrFail($id);

        $order->status = $request->status;

        if ($request->status === 'rejected') {
            $order->rejection_reason = $request->rejection_reason;
            $order->rejected_at = now();
        }

        $order->save();

        return redirect()->back()->with('success', 'Status pesanan berhasil diupdate!');
    }

    /**
     * Remove the specified order (Admin only)
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        
        // Delete related order items and payment
        $order->orderItems()->delete();
        $order->payment()->delete();
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dihapus!');
    }
}
