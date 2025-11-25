<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        
        // Get dynamic statistics from database
        $stats = $this->getStatistics();
        
        // Get chart data for last 6 months
        $chartData = $this->getChartData();
        
        // Get recent activities
        $recentActivities = $this->getRecentActivities();
        
        // Return different views based on role
        if ($role === 'staff') {
            // Staff dashboard - limited access, no sensitive admin data
            return view('dashboard-staff', compact('username', 'stats', 'chartData', 'recentActivities', 'role'));
        }
        
        // Admin dashboard - full access
        return view('dashboard', compact('username', 'stats', 'chartData', 'recentActivities', 'role'));
    }

    /**
     * Get statistics data from database
     */
    private function getStatistics()
    {
        // Total products in database
        $totalProducts = Product::count();
        $lastMonthProducts = Product::where('created_at', '<=', Carbon::now()->subMonth())->count();
        $productGrowth = $lastMonthProducts > 0 
            ? round((($totalProducts - $lastMonthProducts) / $lastMonthProducts) * 100, 1)
            : 0;
        
        // Products with low stock (stock <= 10)
        $lowStock = Product::where('stock', '<=', 10)->count();
        $yesterdayLowStock = Product::where('stock', '<=', 10)
            ->where('updated_at', '<', Carbon::today())
            ->count();
        $lowStockChange = $lowStock - $yesterdayLowStock;
        
        // Total completed orders this month
        $totalSales = Order::where('status', 'completed')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
        
        $lastMonthSales = Order::where('status', 'completed')
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->count();
        
        $salesGrowth = $lastMonthSales > 0
            ? round((($totalSales - $lastMonthSales) / $lastMonthSales) * 100, 1)
            : 0;
        
        // Total revenue from completed orders this month
        $revenue = Order::where('status', 'completed')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total');
        
        $lastMonthRevenue = Order::where('status', 'completed')
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->sum('total');
        
        $revenueGrowth = $lastMonthRevenue > 0
            ? round((($revenue - $lastMonthRevenue) / $lastMonthRevenue) * 100, 1)
            : 0;
        
        return [
            'total_products' => $totalProducts,
            'product_growth' => $productGrowth,
            'low_stock' => $lowStock,
            'low_stock_change' => $lowStockChange,
            'total_sales' => $totalSales,
            'sales_growth' => $salesGrowth,
            'revenue' => $revenue,
            'revenue_growth' => $revenueGrowth
        ];
    }

    /**
     * Get chart data for last 6 months
     */
    private function getChartData()
    {
        $labels = [];
        $salesData = [];
        $itemsData = [];
        
        // Get data for last 6 months
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $labels[] = $month->format('M');
            
            // Count completed orders in this month
            $salesCount = Order::where('status', 'completed')
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
            
            // Count total items sold in this month
            $itemsCount = OrderItem::whereHas('order', function($query) use ($month) {
                    $query->where('status', 'completed')
                        ->whereYear('created_at', $month->year)
                        ->whereMonth('created_at', $month->month);
                })
                ->sum('quantity');
            
            $salesData[] = $salesCount > 0 ? $salesCount * 10 : 0; // Scale for better visualization
            $itemsData[] = $itemsCount > 0 ? $itemsCount : 0;
        }
        
        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Penjualan Dimsum',
                    'data' => $salesData,
                    'backgroundColor' => '#72BF78'
                ],
                [
                    'label' => 'Produk Terjual',
                    'data' => $itemsData,
                    'backgroundColor' => '#A0D683'
                ]
            ]
        ];
    }

    /**
     * Get recent activities from database
     */
    private function getRecentActivities()
    {
        $activities = [];
        
        // Get latest products added
        $latestProduct = Product::latest()->first();
        if ($latestProduct) {
            $activities[] = [
                'icon' => 'shopping-cart',
                'action' => 'Produk "' . $latestProduct->name . '" ditambahkan',
                'time' => $latestProduct->created_at->diffForHumans(),
                'user' => 'Admin'
            ];
        }
        
        // Get latest order
        $latestOrder = Order::latest()->first();
        if ($latestOrder) {
            $activities[] = [
                'icon' => 'chart-bar',
                'action' => 'Pesanan baru #' . $latestOrder->id . ' diterima',
                'time' => $latestOrder->created_at->diffForHumans(),
                'user' => $latestOrder->user->name ?? 'Pelanggan'
            ];
        }
        
        // Get low stock products
        $lowStockProduct = Product::where('stock', '<=', 10)
            ->where('stock', '>', 0)
            ->orderBy('stock', 'asc')
            ->first();
        
        if ($lowStockProduct) {
            $activities[] = [
                'icon' => 'exclamation-triangle',
                'action' => 'Stok "' . $lowStockProduct->name . '" rendah (' . $lowStockProduct->stock . ' unit)',
                'time' => 'Sekarang',
                'user' => 'System'
            ];
        }
        
        // Get out of stock products
        $outOfStockCount = Product::where('stock', 0)->count();
        if ($outOfStockCount > 0) {
            $activities[] = [
                'icon' => 'exclamation-triangle',
                'action' => $outOfStockCount . ' produk habis stok',
                'time' => 'Sekarang',
                'user' => 'System'
            ];
        }
        
        // Calculate sales trend (compare last 7 days with previous 7 days)
        $currentWeekSales = Order::where('status', 'completed')
            ->whereBetween('created_at', [Carbon::now()->subDays(7), Carbon::now()])
            ->count();
        
        $previousWeekSales = Order::where('status', 'completed')
            ->whereBetween('created_at', [Carbon::now()->subDays(14), Carbon::now()->subDays(7)])
            ->count();
        
        if ($currentWeekSales > $previousWeekSales && $previousWeekSales > 0) {
            $percentage = round((($currentWeekSales - $previousWeekSales) / $previousWeekSales) * 100);
            $activities[] = [
                'icon' => 'trending-up',
                'action' => 'Penjualan meningkat ' . $percentage . '% minggu ini',
                'time' => '7 hari terakhir',
                'user' => 'System'
            ];
        }
        
        // If no activities, add default message
        if (empty($activities)) {
            $activities[] = [
                'icon' => 'chart-bar',
                'action' => 'Belum ada aktivitas',
                'time' => 'Sekarang',
                'user' => 'System'
            ];
        }
        
        return array_slice($activities, 0, 4); // Return max 4 activities
    }
}
