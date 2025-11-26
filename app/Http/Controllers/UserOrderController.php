<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\Storage;

class UserOrderController extends Controller
{
    /**
     * Display user's orders
     */
    public function index()
    {
        $orders = Order::with(['orderItems.product', 'payment'])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.orders.index', compact('orders'));
    }

    /**
     * Display specific order details
     */
    public function show($id)
    {
        $order = Order::with(['orderItems.product', 'payment'])
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view('user.orders.show', compact('order'));
    }

    /**
     * Upload payment proof
     */
    public function uploadPayment(Request $request, $id)
    {
        $request->validate([
            'proof_image' => 'required|image|mimes:jpg,jpeg,png|max:2048', // Max 2MB
        ]);

        $order = Order::where('user_id', auth()->id())->findOrFail($id);
        $payment = $order->payment;

        if (!$payment) {
            return redirect()->back()->with('error', 'Data pembayaran tidak ditemukan!');
        }

        // Only allow upload if status is pending or rejected
        if (!in_array($payment->status, ['pending', 'rejected'])) {
            return redirect()->back()->with('error', 'Pembayaran sudah diverifikasi!');
        }

        // Delete old proof if exists
        if ($payment->proof_image) {
            Storage::disk('public')->delete($payment->proof_image);
        }

        // Store new proof
        $path = $request->file('proof_image')->store('payment_proofs', 'public');

        // Update payment
        $payment->proof_image = $path;
        $payment->status = 'pending';

        // Reset rejection data on ORDER (because user uploads new proof)
        $order->rejection_reason = null;
        $order->rejected_at = null;

        $payment->save();
        $order->save();

        return redirect()->back()->with('success', 'Bukti pembayaran berhasil diupload! Menunggu verifikasi.');
    }
}
