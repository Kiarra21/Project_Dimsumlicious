<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display staff management page (admin only)
     */
    public function index()
    {
        // Mock staff data
        $staffList = [
            [
                'id' => 1,
                'name' => 'Ahmad Rizki',
                'email' => 'ahmad@dimsumlicious.com',
                'role' => 'Staff',
                'phone' => '081234567890',
                'join_date' => '2024-01-15',
                'status' => 'active'
            ],
            [
                'id' => 2,
                'name' => 'Siti Nurhaliza',
                'email' => 'siti@dimsumlicious.com',
                'role' => 'Staff',
                'phone' => '081234567891',
                'join_date' => '2024-02-10',
                'status' => 'active'
            ],
            [
                'id' => 3,
                'name' => 'Budi Santoso',
                'email' => 'budi@dimsumlicious.com',
                'role' => 'Staff',
                'phone' => '081234567892',
                'join_date' => '2024-03-05',
                'status' => 'active'
            ]
        ];

        $role = 'admin'; // Only admin can access this page
        
        return view('staff.index', compact( 'staffList', 'role'));
    }

    /**
     * Store new staff (admin only)
     */
    public function store(Request $request)
    {
        // TODO: Implement staff creation
        return redirect()->route('staff.index', ['username' => $username])
                        ->with('success', 'Staff berhasil ditambahkan!');
    }

    /**
     * Update staff (admin only)
     */
    public function update(Request $request, $id)
    {
        // TODO: Implement staff update
        return redirect()->route('staff.index', ['username' => $username])
                        ->with('success', 'Data staff berhasil diupdate!');
    }

    /**
     * Delete staff (admin only)
     */
    public function destroy($id)
    {
        // TODO: Implement staff deletion
        return redirect()->route('staff.index', ['username' => $username])
                        ->with('success', 'Staff berhasil dihapus!');
    }
}
