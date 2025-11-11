<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display product management page
     */
    public function index()
    {
        // Mock product data
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
        
        // Management stats
        $managementStats = [
            'total_products' => count($dataList),
            'available_products' => count(array_filter($dataList, fn($product) => $product['status'] === 'Available')),
            'low_stock_products' => count(array_filter($dataList, fn($product) => $product['status'] === 'Low Stock')),
            'out_of_stock' => count(array_filter($dataList, fn($product) => $product['status'] === 'Out of Stock'))
        ];
        
        $role = 'admin';
        
        return view('pengelolaan', compact( 'dataList', 'managementStats', 'role'));
    }

    /**
     * Show form to create new product
     */
    public function create()
    {
        $role = 'admin';
        return view('products.create', compact( 'role'));
    }

    /**
     * Store new product
     */
    public function store(Request $request)
    {
        // TODO: Implement product creation
        return redirect()->route('products.index', ['username' => $username])
                        ->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Show form to edit product
     */
    public function edit($id)
    {
        // TODO: Get product from database
        $role = 'admin';
        return view('products.edit', compact( 'id', 'role'));
    }

    /**
     * Update product
     */
    public function update(Request $request, $id)
    {
        // TODO: Implement product update
        return redirect()->route('products.index', ['username' => $username])
                        ->with('success', 'Produk berhasil diupdate!');
    }

    /**
     * Delete product
     */
    public function destroy($id)
    {
        // TODO: Implement product deletion
        return redirect()->route('products.index', ['username' => $username])
                        ->with('success', 'Produk berhasil dihapus!');
    }
}
