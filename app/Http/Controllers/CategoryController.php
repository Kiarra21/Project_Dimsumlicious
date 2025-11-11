<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display category management page
     */
    public function index()
    {
        // Mock category data
        $categories = [
            [
                'id' => 1,
                'name' => 'Dimsum',
                'description' => 'Berbagai varian dimsum kukus',
                'product_count' => 15,
                'status' => 'active'
            ],
            [
                'id' => 2,
                'name' => 'Dimsum Goreng',
                'description' => 'Dimsum dengan tekstur crispy',
                'product_count' => 8,
                'status' => 'active'
            ],
            [
                'id' => 3,
                'name' => 'Pangsit',
                'description' => 'Pangsit goreng dan kuah',
                'product_count' => 6,
                'status' => 'active'
            ],
            [
                'id' => 4,
                'name' => 'Bakpao',
                'description' => 'Bakpao dengan berbagai isian',
                'product_count' => 10,
                'status' => 'active'
            ],
            [
                'id' => 5,
                'name' => 'Lumpia',
                'description' => 'Lumpia basah dan goreng',
                'product_count' => 6,
                'status' => 'active'
            ]
        ];

        $role = 'admin';
        
        return view('categories.index', compact( 'categories', 'role'));
    }

    /**
     * Store new category
     */
    public function store(Request $request)
    {
        // TODO: Implement category creation
        return redirect()->route('categories.index', ['username' => $username])
                        ->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Update category
     */
    public function update(Request $request, $id)
    {
        // TODO: Implement category update
        return redirect()->route('categories.index', ['username' => $username])
                        ->with('success', 'Kategori berhasil diupdate!');
    }

    /**
     * Delete category
     */
    public function destroy($id)
    {
        // TODO: Implement category deletion
        return redirect()->route('categories.index', ['username' => $username])
                        ->with('success', 'Kategori berhasil dihapus!');
    }
}
