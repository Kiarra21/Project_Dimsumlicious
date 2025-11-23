<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Promo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display product management page
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        $products = Product::with('category')
            ->when($search, function($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                            ->orWhere('description', 'like', "%{$search}%")
                            ->orWhereHas('category', function($q) use ($search) {
                                $q->where('name', 'like', "%{$search}%");
                            });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        $categories = Category::where('is_active', true)->get();
        $promos = Promo::where('is_active', true)
                      ->where('end_date', '>=', now())
                      ->orderBy('title')
                      ->get();
        
        // Management stats
        $stats = [
            'total_products' => Product::count(),
            'available_products' => Product::where('is_available', true)->count(),
            'low_stock_products' => Product::where('stock', '>', 0)->where('stock', '<=', 5)->count(),
            'out_of_stock' => Product::where('stock', 0)->count()
        ];
        
        return view('admin.products.index', compact('products', 'categories', 'promos', 'stats'));
    }

    /**
     * Store new product
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'promo_id' => 'nullable|exists:promos,id',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_available' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $validated['slug'] = Str::slug($request->name);
        $validated['is_available'] = $request->has('is_available');
        $validated['is_featured'] = $request->has('is_featured');
        
        // Auto calculate discount
        if ($request->promo_id) {
            $promo = Promo::find($request->promo_id);
            if ($promo && $promo->discount > 0) {
                $validated['has_discount'] = true;
                $validated['discount_price'] = $request->price - ($request->price * $promo->discount / 100);
            }
        } else {
            $validated['has_discount'] = false;
            $validated['discount_price'] = null;
        }

        Product::create($validated);

        return redirect()->route('products.index')
                        ->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Update product
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'promo_id' => 'nullable|exists:promos,id',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'is_available' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $validated['slug'] = Str::slug($request->name);
        $validated['is_available'] = $request->has('is_available');
        $validated['is_featured'] = $request->has('is_featured');
        
        // Auto calculate discount
        if ($request->promo_id) {
            $promo = Promo::find($request->promo_id);
            if ($promo && $promo->discount > 0) {
                $validated['has_discount'] = true;
                $validated['discount_price'] = $request->price - ($request->price * $promo->discount / 100);
            }
        } else {
            $validated['has_discount'] = false;
            $validated['discount_price'] = null;
            $validated['promo_id'] = null;
        }

        $product->update($validated);

        return redirect()->route('products.index')
                        ->with('success', 'Produk berhasil diupdate!');
    }

    /**
     * Delete product
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        // Delete image if exists
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index')
                        ->with('success', 'Produk berhasil dihapus!');
    }
}
