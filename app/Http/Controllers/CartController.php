<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    /**
     * Display user's cart
     */
    public function index()
    {
        $carts = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();

        $total = $carts->sum(fn($cart) => $cart->subtotal);

        return view('user.cart.index', compact('carts', 'total'));
    }

    /**
     * Add product to cart
     */
    public function add(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        // Check if product is available
        if (!$product->is_available || $product->stock < 1) {
            return redirect()->back()->with('error', 'Produk tidak tersedia!');
        }

        // Check if already in cart
        $cart = Cart::where('user_id', auth()->id())
            ->where('product_id', $productId)
            ->first();

        if ($cart) {
            // Update quantity
            $newQuantity = $cart->quantity + ($request->quantity ?? 1);
            
            if ($newQuantity > $product->stock) {
                return redirect()->back()->with('error', 'Stok tidak mencukupi!');
            }

            $cart->quantity = $newQuantity;
            $cart->save();
        } else {
            // Create new cart item
            $quantity = $request->quantity ?? 1;

            if ($quantity > $product->stock) {
                return redirect()->back()->with('error', 'Stok tidak mencukupi!');
            }

            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $product->price,
            ]);
        }

        return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang!');
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::where('user_id', auth()->id())->findOrFail($id);
        
        // Check stock
        if ($request->quantity > $cart->product->stock) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi!');
        }

        $cart->quantity = $request->quantity;
        $cart->save();

        return redirect()->back()->with('success', 'Keranjang diupdate!');
    }

    /**
     * Remove item from cart
     */
    public function remove($id)
    {
        $cart = Cart::where('user_id', auth()->id())->findOrFail($id);
        $cart->delete();

        return redirect()->back()->with('success', 'Item dihapus dari keranjang!');
    }

    /**
     * Clear all cart items
     */
    public function clear()
    {
        Cart::where('user_id', auth()->id())->delete();

        return redirect()->back()->with('success', 'Keranjang dikosongkan!');
    }
}
