<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Order;

class PaymentController extends Controller
{
    /**
     * Display a listing of payments
     */
    public function index(Request $request)
    {
        $query = Payment::with(['order.user'])
            ->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        // Search by order number
        if ($request->has('search') && $request->search) {
            $query->whereHas('order', function ($q) use ($request) {
                $q->where('order_number', 'like', '%' . $request->search . '%');
            });
        }

        $payments = $query->paginate(20);

        // Count by status
        $statusCounts = [
            'all' => Payment::count(),
            'pending' => Payment::where('status', 'pending')->count(),
            'verified' => Payment::where('status', 'verified')->count(),
            'rejected' => Payment::where('status', 'rejected')->count(),
        ];

        return view('admin.payments.index', compact('payments', 'statusCounts'));
    }

    /**
     * Display the specified payment
     */
    public function show($id)
    {
        $payment = Payment::with(['order.user', 'order.orderItems.product', 'verifiedBy'])
            ->findOrFail($id);

        return view('admin.payments.show', compact('payment'));
    }

    /**
     * Verify payment
     */
    public function verify($id)
    {
        $payment = Payment::findOrFail($id);

        $payment->status = 'verified';
        $payment->verified_by = auth()->id();
        $payment->verified_at = now();
        $payment->save();

        // Update order status to pending_cooking
        $payment->order->update([
            'status' => 'pending_cooking'
        ]);

        return redirect()->back()->with('success', 'Pembayaran berhasil diverifikasi!');
    }

    /**
     * Reject payment
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);

        $payment = Payment::findOrFail($id);

        $payment->status = 'rejected';
        $payment->rejection_reason = $request->rejection_reason;
        $payment->rejected_at = now();
        $payment->verified_by = auth()->id();
        $payment->save();

        return redirect()->back()->with('success', 'Pembayaran ditolak. User dapat mengupload ulang bukti pembayaran.');
    }
}
