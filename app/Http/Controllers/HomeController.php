<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display homepage for guests/users
     */
    public function index()
    {
        // Data untuk homepage
        $featuredProducts = [
            [
                'id' => 1,
                'name' => 'Dimsum Ayam Original',
                'price' => 15000,
                'image' => 'dimsum-ayam.jpg',
                'category' => 'Dimsum',
                'rating' => 4.8
            ],
            [
                'id' => 2,
                'name' => 'Pangsit Kuah Spesial',
                'price' => 20000,
                'image' => 'pangsit-kuah.jpg',
                'category' => 'Pangsit',
                'rating' => 4.9
            ],
            [
                'id' => 3,
                'name' => 'Lumpia Semarang',
                'price' => 25000,
                'image' => 'lumpia.jpg',
                'category' => 'Lumpia',
                'rating' => 4.7
            ]
        ];

        $stats = [
            'total_products' => 45,
            'happy_customers' => 1250,
            'years_experience' => 5,
            'daily_orders' => 150
        ];

        return view('home', compact('featuredProducts', 'stats'));
    }

    /**
     * Display product catalog
     */
    public function products()
    {
        // Nanti akan ambil dari database
        $products = [];
        return view('products', compact('products'));
    }

    /**
     * Display about page
     */
    public function about()
    {
        return view('about');
    }

    /**
     * Display contact page
     */
    public function contact()
    {
        return view('contact');
    }

    /**
     * Display promo page
     */
    public function promo()
    {
        return view('promo');
    }
}
