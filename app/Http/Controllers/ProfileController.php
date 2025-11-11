<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display user profile
     */
    public function show()
    {
        // Mock user profile data
        $userProfile = [
            'name' => $username,
            'email' => $username . '@dimsumlicious.com',
            'role' => 'Administrator',
            'join_date' => '2024-01-15',
            'last_login' => '2024-01-20 14:30:00',
            'avatar' => '👨‍💼',
            'bio' => 'Halo, ini adalah halaman profileku',
            'phone' => '081234567890',
            'address' => 'Jl. Dimsum No. 123, Jakarta',
            'preferences' => [
                'theme' => 'Light Mode',
                'language' => 'Bahasa Indonesia',
                'notifications' => 'Enabled'
            ]
        ];
        
        $role = 'admin';
        
        return view('profile', compact( 'userProfile', 'role'));
    }

    /**
     * Update user profile
     */
    public function update(Request $request)
    {
        // TODO: Implement profile update
        return redirect()->route('profile.show', ['username' => $username])
                        ->with('success', 'Profile berhasil diupdate!');
    }

    /**
     * Update password
     */
    public function updatePassword(Request $request)
    {
        // TODO: Implement password update
        return redirect()->route('profile.show', ['username' => $username])
                        ->with('success', 'Password berhasil diupdate!');
    }
}
