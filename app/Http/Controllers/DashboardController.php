<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display admin/staff dashboard
     */
    public function index()
    {
        // Get current authenticated user
        $user = auth()->user();
        
        // Get role and username from authenticated user
        $role = $user->role->name; // 'admin' or 'staff'
        $username = $user->name;
        
        // Mock data - nanti diganti dengan data dari database
        $stats = [
            'total_products' => 45,
            'low_stock' => 8,
            'total_sales' => 1250,
            'revenue' => 15670000
        ];
        
        // Data chart
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
        
        // Recent activities
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
        
        // Return different views based on role
        if ($role === 'staff') {
            // Staff dashboard - limited access, no sensitive admin data
            return view('dashboard-staff', compact('username', 'stats', 'chartData', 'recentActivities', 'role'));
        }
        
        // Admin dashboard - full access
        return view('dashboard', compact('username', 'stats', 'chartData', 'recentActivities', 'role'));
    }
}
