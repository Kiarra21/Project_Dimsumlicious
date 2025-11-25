<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Promo;
use App\Models\CompanyProfile;

class HomeController extends Controller
{
    /**
     * Display homepage for guests/users
     */
    public function index()
    {
        // Ambil 3 produk unggulan (featured/terpopuler)
        $featuredProducts = Product::where('is_available', true)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Ambil 3 promo terbaru
        $latestPromos = Promo::where('is_active', true)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $stats = [
            'total_products' => Product::where('is_available', true)->count(),
            'happy_customers' => 1250,
            'years_experience' => 5,
            'daily_orders' => 150
        ];

        return view('home', compact('featuredProducts', 'latestPromos', 'stats'));
    }

    /**
     * Display product catalog
     */
    public function products(Request $request)
    {
        $query = Product::where('is_available', true)->with('category');

        // Filter by category if provided
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        $products = $query->orderBy('created_at', 'desc')->paginate(12);

        $categories = \App\Models\Category::all();

        return view('user.products', compact('products', 'categories'));
    }

    /**
     * Display about & contact page (combined)
     */
    public function about()
    {
        $companyProfile = CompanyProfile::first();
        return view('user.about', compact('companyProfile'));
    }

    /**
     * Display promo page
     */
    public function promo()
    {
        $promos = Promo::where('is_active', true)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        return view('user.promo', compact('promos'));
    }
}
