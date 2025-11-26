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
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang kosong!');
        }

        $subtotal = $carts->sum(fn($cart) => $cart->subtotal);

        $total = $subtotal; // tanpa tax

        return view('user.checkout.index', compact(
            'carts',
            'subtotal',
            'total'
        ));
    }

    /**
     * Process checkout and create order
     */
    public function process(Request $request)
    {
        
        // HANYA catatan opsional
        $request->validate([
            'notes' => 'nullable|string|max:500',
        ]);

        $carts = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang kosong!');
        }

        DB::beginTransaction();

        try {
            // Hitung total
            $subtotal = $carts->sum(fn($cart) => $cart->subtotal);
            $total = $subtotal;

            // Buat order (tanpa address, tanpa tax, tanpa notes)
            $order = Order::create([
                'user_id'        => auth()->id(),
                'order_number'   => Order::generateOrderNumber(),
                'status'         => 'pending_payment',
                'subtotal'       => $subtotal,
                'total'          => $total,
                'phone_number'   => auth()->user()->phone ?? null,
            ]);

            // Simpan item pesanan
            foreach ($carts as $cart) {
                OrderItem::create([
                    'order_id'      => $order->id,
                    'product_id'    => $cart->product_id,
                    'product_name'  => $cart->product->name,
                    'price' => $cart->product->price,
                    'quantity'      => $cart->quantity,
                    'subtotal'      => $cart->subtotal,
                ]);

                // Kurangi stok
                $cart->product->decrement('stock', $cart->quantity);
            }

            // Buat pembayaran
            Payment::create([
                'order_id'       => $order->id,
                'amount'         => $total,
                'payment_method' => 'qris',
                'status'         => 'pending',
            ]);

            // Hapus cart user
            Cart::where('user_id', auth()->id())->delete();

            DB::commit();
            
            return redirect()->route('user.orders.show', $order->id)
                ->with('success', 'Pesanan berhasil dibuat! Silakan upload bukti pembayaran.');

        } catch (\Exception $e) {
            DB::rollBack();
            
        
            // dd($e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
