<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyProfileController extends Controller
{
    /**
     * Display company profile page (admin only)
     */
    public function index()
    {
        // Mock company data
        $companyData = [
            'name' => 'Dimsumlicious',
            'tagline' => 'Kelezatan Dimsum Autentik',
            'description' => 'Dimsumlicious adalah bisnis dimsum yang menyediakan berbagai varian dimsum berkualitas dengan cita rasa autentik. Kami berkomitmen memberikan produk terbaik untuk pelanggan.',
            'address' => 'Jl. Raya Dimsum No. 123, Jakarta Pusat',
            'phone' => '021-12345678',
            'email' => 'info@dimsumlicious.com',
            'whatsapp' => '08123456789',
            'operating_hours' => [
                'weekdays' => '09:00 - 21:00',
                'weekend' => '08:00 - 22:00'
            ],
            'social_media' => [
                'instagram' => '@dimsumlicious',
                'facebook' => 'Dimsumlicious Official',
                'tiktok' => '@dimsumlicious'
            ],
            'founded_year' => 2019,
            'logo' => 'logo.png',
            'hero_image' => 'hero.jpg'
        ];

        $role = 'admin'; // Only admin can edit company profile
        
        return view('company-profile.index', compact( 'companyData', 'role'));
    }

    /**
     * Update company profile (admin only)
     */
    public function update(Request $request)
    {
        // TODO: Implement company profile update
        return redirect()->route('company-profile.index', ['username' => $username])
                        ->with('success', 'Company profile berhasil diupdate!');
    }
}
