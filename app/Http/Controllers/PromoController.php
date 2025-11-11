<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PromoController extends Controller
{
    /**
     * Display promo management page
     */
    public function index()
    {
        // Mock promo data
        $promos = [
            [
                'id' => 1,
                'title' => 'Diskon 20% Paket Hemat',
                'description' => 'Beli 3 paket dimsum, hemat 20%',
                'discount' => 20,
                'start_date' => '2024-01-01',
                'end_date' => '2024-01-31',
                'status' => 'active',
                'image' => 'promo1.jpg'
            ],
            [
                'id' => 2,
                'title' => 'Gratis Delivery',
                'description' => 'Gratis ongkir untuk pembelian min. Rp 100.000',
                'discount' => 0,
                'start_date' => '2024-01-15',
                'end_date' => '2024-02-15',
                'status' => 'active',
                'image' => 'promo2.jpg'
            ],
            [
                'id' => 3,
                'title' => 'Buy 1 Get 1',
                'description' => 'Beli 1 Lumpia dapat 1 gratis',
                'discount' => 50,
                'start_date' => '2024-01-10',
                'end_date' => '2024-01-20',
                'status' => 'expired',
                'image' => 'promo3.jpg'
            ]
        ];

        $role = 'admin';
        
        return view('promos.index', compact( 'promos', 'role'));
    }

    /**
     * Store new promo
     */
    public function store(Request $request)
    {
        // TODO: Implement promo creation
        return redirect()->route('promos.index', ['username' => $username])
                        ->with('success', 'Promo berhasil ditambahkan!');
    }

    /**
     * Update promo
     */
    public function update(Request $request, $id)
    {
        // TODO: Implement promo update
        return redirect()->route('promos.index', ['username' => $username])
                        ->with('success', 'Promo berhasil diupdate!');
    }

    /**
     * Delete promo
     */
    public function destroy($id)
    {
        // TODO: Implement promo deletion
        return redirect()->route('promos.index', ['username' => $username])
                        ->with('success', 'Promo berhasil dihapus!');
    }
}
