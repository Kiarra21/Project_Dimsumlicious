<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display reports page
     */
    public function index(Request $request)
    {
        $role = auth()->user()->role->name;
        $period = $request->get('period', 'monthly'); // daily, weekly, monthly, yearly
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        // Set default date range based on period
        if (!$startDate || !$endDate) {
            switch ($period) {
                case 'daily':
                    $startDate = Carbon::today()->toDateString();
                    $endDate = Carbon::today()->toDateString();
                    break;
                case 'weekly':
                    $startDate = Carbon::now()->startOfWeek()->toDateString();
                    $endDate = Carbon::now()->endOfWeek()->toDateString();
                    break;
                case 'yearly':
                    $startDate = Carbon::now()->startOfYear()->toDateString();
                    $endDate = Carbon::now()->endOfYear()->toDateString();
                    break;
                default: // monthly
                    $startDate = Carbon::now()->startOfMonth()->toDateString();
                    $endDate = Carbon::now()->endOfMonth()->toDateString();
            }
        }

        // Sales Statistics
        $salesStats = $this->getSalesStatistics($startDate, $endDate);
        
        // Previous period for comparison
        $previousPeriod = $this->getPreviousPeriodStats($startDate, $endDate);
        
        // Top Products
        $topProducts = $this->getTopProducts($startDate, $endDate, 5);
        
        // Recent Orders
        $recentOrders = Order::with(['user', 'orderItems'])
            ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Revenue by Category
        $revenueByCategory = $this->getRevenueByCategory($startDate, $endDate);

        // Payment Statistics
        $paymentStats = $this->getPaymentStatistics($startDate, $endDate);

        // Stock Alerts (low stock products)
        $lowStockProducts = Product::where('stock', '<=', 10)
            ->where('stock', '>', 0)
            ->orderBy('stock', 'asc')
            ->limit(10)
            ->get();

        // Out of Stock
        $outOfStockProducts = Product::where('stock', 0)
            ->orderBy('name', 'asc')
            ->limit(10)
            ->get();

        // Daily Revenue Chart Data (last 7 days or custom range)
        $dailyRevenue = $this->getDailyRevenueChart($startDate, $endDate);

        // Customer Statistics (Admin only)
        $customerStats = null;
        if ($role === 'admin') {
            $customerStats = [
                'total_customers' => User::where('role_id', function($query) {
                    $query->select('id')->from('roles')->where('name', 'user')->limit(1);
                })->count(),
                'new_customers_this_period' => User::where('role_id', function($query) {
                    $query->select('id')->from('roles')->where('name', 'user')->limit(1);
                })->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])->count(),
            ];
        }

        return view('admin.reports.index', compact(
            'salesStats',
            'previousPeriod',
            'topProducts',
            'recentOrders',
            'revenueByCategory',
            'paymentStats',
            'lowStockProducts',
            'outOfStockProducts',
            'dailyRevenue',
            'customerStats',
            'role',
            'period',
            'startDate',
            'endDate'
        ));
    }

    /**
     * Get sales statistics for a period
     */
    private function getSalesStatistics($startDate, $endDate)
    {
        $orders = Order::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->where('status', '!=', 'rejected');

        return [
            'total_orders' => $orders->count(),
            'completed_orders' => (clone $orders)->where('status', 'completed')->count(),
            'pending_orders' => (clone $orders)->where('status', 'pending_payment')->count(),
            'processing_orders' => (clone $orders)->where('status', 'pending_cooking')->count(),
            'total_revenue' => (clone $orders)->where('status', 'completed')->sum('total'),
            'average_order_value' => (clone $orders)->where('status', 'completed')->avg('total') ?? 0,
        ];
    }

    /**
     * Get previous period statistics for comparison
     */
    private function getPreviousPeriodStats($startDate, $endDate)
    {
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);
        $diff = $start->diffInDays($end) + 1;

        $prevStart = $start->copy()->subDays($diff)->toDateString();
        $prevEnd = $end->copy()->subDays($diff)->toDateString();

        $orders = Order::whereBetween('created_at', [$prevStart . ' 00:00:00', $prevEnd . ' 23:59:59'])
            ->where('status', '!=', 'rejected');

        return [
            'total_orders' => $orders->count(),
            'total_revenue' => (clone $orders)->where('status', 'completed')->sum('total'),
        ];
    }

    /**
     * Get top selling products
     */
    private function getTopProducts($startDate, $endDate, $limit = 10)
    {
        return OrderItem::select('product_id', 'product_name', DB::raw('SUM(quantity) as total_sold'), DB::raw('SUM(subtotal) as total_revenue'))
            ->whereHas('order', function($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
                      ->where('status', 'completed');
            })
            ->groupBy('product_id', 'product_name')
            ->orderBy('total_sold', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get revenue by category
     */
    private function getRevenueByCategory($startDate, $endDate)
    {
        return DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('categories.name as category_name', DB::raw('SUM(order_items.subtotal) as total_revenue'))
            ->whereBetween('orders.created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->where('orders.status', 'completed')
            ->groupBy('categories.id', 'categories.name')
            ->orderBy('total_revenue', 'desc')
            ->get();
    }

    /**
     * Get payment statistics
     */
    private function getPaymentStatistics($startDate, $endDate)
    {
        $payments = Payment::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);

        return [
            'total_payments' => $payments->count(),
            'verified_payments' => (clone $payments)->where('status', 'verified')->count(),
            'pending_payments' => (clone $payments)->where('status', 'pending')->count(),
            'rejected_payments' => (clone $payments)->where('status', 'rejected')->count(),
        ];
    }

    /**
     * Get daily revenue chart data
     */
    private function getDailyRevenueChart($startDate, $endDate)
    {
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);
        
        $dailyData = Order::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total) as revenue'),
                DB::raw('COUNT(*) as orders')
            )
            ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->where('status', 'completed')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // Fill missing dates with zero
        $result = [];
        $current = $start->copy();
        while ($current <= $end) {
            $dateStr = $current->toDateString();
            $found = $dailyData->firstWhere('date', $dateStr);
            
            $result[] = [
                'date' => $dateStr,
                'formatted_date' => $current->format('d M'),
                'revenue' => $found ? $found->revenue : 0,
                'orders' => $found ? $found->orders : 0,
            ];
            
            $current->addDay();
        }

        return $result;
    }

    /**
     * Generate sales report (Download)
     */
    public function generateSales(Request $request)
    {
        // TODO: Generate PDF or Excel report
        return response()->json(['message' => 'Sales report generation coming soon']);
    }

    /**
     * Generate stock report (Download)
     */
    public function generateStock(Request $request)
    {
        // TODO: Generate stock report
        return response()->json(['message' => 'Stock report generation coming soon']);
    }
}
