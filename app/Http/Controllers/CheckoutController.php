<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Display checkout page
     */
    public function index()
    {
        $carts = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');
        }

        $subtotal = $carts->sum(fn($cart) => $cart->subtotal);
        $tax = $subtotal * 0.10; // 10% tax
        $total = $subtotal + $tax;

        return view('user.checkout.index', compact('carts', 'subtotal', 'tax', 'total'));
    }

    /**
     * Process checkout and create order
     */
    public function process(Request $request)
    {
        $request->validate([
            'delivery_address' => 'required|string|max:500',
            'notes' => 'nullable|string|max:500',
        ]);

        $carts = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');
        }

        DB::beginTransaction();

        try {
            // Calculate totals
            $subtotal = $carts->sum(fn($cart) => $cart->subtotal);
            $tax = $subtotal * 0.10;
            $total = $subtotal + $tax;

            // Create order
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => Order::generateOrderNumber(),
                'status' => 'pending_payment',
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total' => $total,
                'delivery_address' => $request->delivery_address,
                'notes' => $request->notes,
            ]);

            // Create order items
            foreach ($carts as $cart) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'product_name' => $cart->product->name,
                    'product_price' => $cart->product->price,
                    'quantity' => $cart->quantity,
                    'subtotal' => $cart->subtotal,
                ]);

                // Reduce stock
                $cart->product->decrement('stock', $cart->quantity);
            }

            // Create payment record
            Payment::create([
                'order_id' => $order->id,
                'amount' => $total,
                'payment_method' => 'qris',
                'status' => 'pending',
            ]);

            // Clear cart
            Cart::where('user_id', auth()->id())->delete();

            DB::commit();

            return redirect()->route('user.orders.show', $order->id)
                ->with('success', 'Pesanan berhasil dibuat! Silakan upload bukti pembayaran.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
