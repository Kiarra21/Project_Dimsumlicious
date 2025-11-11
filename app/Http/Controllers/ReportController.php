<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display reports page
     */
    public function index()
    {
        // Mock report data
        $salesReport = [
            'daily' => [
                'total_sales' => 150,
                'revenue' => 2500000,
                'growth' => 8.5
            ],
            'weekly' => [
                'total_sales' => 980,
                'revenue' => 16800000,
                'growth' => 12.3
            ],
            'monthly' => [
                'total_sales' => 4250,
                'revenue' => 68500000,
                'growth' => 15.7
            ]
        ];

        $topProducts = [
            [
                'name' => 'Dimsum Ayam Isi 6',
                'sold' => 450,
                'revenue' => 6750000
            ],
            [
                'name' => 'Pangsit Kuah',
                'sold' => 320,
                'revenue' => 6400000
            ],
            [
                'name' => 'Lumpia Semarang',
                'sold' => 280,
                'revenue' => 7000000
            ]
        ];

        $role = 'admin';
        
        return view('reports.index', compact( 'salesReport', 'topProducts', 'role'));
    }

    /**
     * Generate sales report
     */
    public function generateSales(Request $request)
    {
        // TODO: Generate sales report based on date range
        return response()->download('path/to/report.pdf');
    }

    /**
     * Generate stock report
     */
    public function generateStock(Request $request)
    {
        // TODO: Generate stock report
        return response()->download('path/to/stock-report.pdf');
    }
}
