<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    
    public function login()
    {
        return view('login');
    }
    
 
    public function processLogin(Request $request)
    {
        $request->validate([
            'username' => 'required|string|min:3',
            'password' => 'required|string|min:6'
        ]);
        
        $username = $request->input('username');
        
       
        return redirect()->route('dashboard', ['username' => $username]);
    }
    

    public function dashboard(Request $request)
    {
        $username = $request->get('username');
       
        $stats = [
            'total_products' => 45,
            'low_stock' => 8,
            'total_sales' => 1250,
            'revenue' => 15670000
        ];
        
       
        $chartData = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            'datasets' => [
                [
                    'label' => 'Penjualan Dimsum',
                    'data' => [65, 78, 90, 85, 95, 110],
                    'backgroundColor' => '#72BF78'
                ],
                [
                    'label' => 'Produk Terjual',
                    'data' => [45, 60, 75, 80, 88, 95],
                    'backgroundColor' => '#A0D683'
                ]
            ]
        ];
        
       
        $recentActivities = [
            [
                'icon' => 'shopping-cart',
                'action' => 'Produk baru ditambahkan',
                'time' => '2 menit yang lalu',
                'user' => 'Ahmad Rizki'
            ],
            [
                'icon' => 'chart-bar',
                'action' => 'Laporan penjualan dibuat',
                'time' => '15 menit yang lalu',
                'user' => 'Siti Nurhaliza'
            ],
            [
                'icon' => 'exclamation-triangle',
                'action' => 'Stok Siomay Ayam rendah',
                'time' => '1 jam yang lalu',
                'user' => 'System'
            ],
            [
                'icon' => 'trending-up',
                'action' => 'Penjualan meningkat 15%',
                'time' => '2 jam yang lalu',
                'user' => 'System'
            ]
        ];
        
        return view('dashboard', compact('username', 'stats', 'chartData', 'recentActivities'));
    }
    
    
    public function profile(Request $request)
    {
        $username = $request->get('username');
        
        
        $userProfile = [
            'name' => $username,
            'email' => $username . '@gmail.com',
            'role' => 'Administrator',
            'join_date' => '2024-01-15',
            'last_login' => '2024-01-20 14:30:00',
            'avatar' => '👨‍💼',
            'bio' => 'Halo, ini adalah halaman profileku',
            'preferences' => [
                'theme' => 'Light Mode',
                'language' => 'Bahasa Indonesia',
                'notifications' => 'Enabled'
            ]
        ];
        
        return view('profile', compact('username', 'userProfile'));
    }
    
    
    public function pengelolaan(Request $request)
    {
        $username = $request->get('username');
        
      
        $dataList = [
            [
                'id' => 1,
                'name' => 'Dimsum Ayam Isi 6',
                'category' => 'Dimsum',
                'price' => 15000,
                'stock' => 25,
                'status' => 'Available',
                'last_restock' => '2024-01-20 10:30',
                'image' => 'dimsum-ayam.jpg'
            ],
            [
                'id' => 2,
                'name' => 'Dimsum Ayam Isi 8',
                'category' => 'Dimsum',
                'price' => 28000,
                'stock' => 5,
                'status' => 'Low Stock',
                'last_restock' => '2024-01-19 09:15',
                'image' => 'dimsum-ayam-isi-8.jpg'
            ],
            [
                'id' => 3,
                'name' => 'Dimsum Goreng',
                'category' => 'Dimsum Goreng',
                'price' => 20000,
                'stock' => 0,
                'status' => 'Out of Stock',
                'last_restock' => '2024-01-18 16:45',
                'image' => 'dimsum-goreng.jpg'
            ],
            [
                'id' => 4,
                'name' => 'Pangsit Kuah',
                'category' => 'Pangsit',
                'price' => 20000,
                'stock' => 15,
                'status' => 'Available',
                'last_restock' => '2024-01-20 11:20',
                'image' => 'pangsit-kuah.jpg'
            ],
            [
                'id' => 5,
                'name' => 'Bakpao Ayam',
                'category' => 'Bakpao',
                'price' => 8000,
                'stock' => 30,
                'status' => 'Available',
                'last_restock' => '2024-01-20 13:10',
                'image' => 'bakpao-ayam.jpg'
            ],
            [
                'id' => 6,
                'name' => 'Bakpao Kacang Merah',
                'category' => 'Bakpao',
                'price' => 8000,
                'stock' => 3,
                'status' => 'Low Stock',
                'last_restock' => '2024-01-19 12:05',
                'image' => 'bakpao-kacang.jpg'
            ],
            [
                'id' => 7,
                'name' => 'Lumpia Semarang',
                'category' => 'Lumpia',
                'price' => 25000,
                'stock' => 12,
                'status' => 'Available',
                'last_restock' => '2024-01-20 08:30',
                'image' => 'lumpia-semarang.jpg'
            ],
            [
                'id' => 8,
                'name' => 'Lumpia Basah',
                'category' => 'Lumpia',
                'price' => 22000,
                'stock' => 8,
                'status' => 'Low Stock',
                'last_restock' => '2024-01-19 14:20',
                'image' => 'lumpia-basah.jpg'
            ]
        ];
        
      
        $managementStats = [
            'total_products' => count($dataList),
            'available_products' => count(array_filter($dataList, fn($product) => $product['status'] === 'Available')),
            'low_stock_products' => count(array_filter($dataList, fn($product) => $product['status'] === 'Low Stock')),
            'out_of_stock' => count(array_filter($dataList, fn($product) => $product['status'] === 'Out of Stock'))
        ];
        
        return view('pengelolaan', compact('username', 'dataList', 'managementStats'));
    }
}