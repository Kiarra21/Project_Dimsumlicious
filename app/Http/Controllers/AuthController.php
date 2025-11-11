<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display login form
     */
    public function showLoginForm()
    {
        return view('authentication.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.'
        ]);
        
        // Try to find user by email or name
        $user = User::where('email', $request->username)
                    ->orWhere('name', $request->username)
                    ->first();

        // Check if user exists and password is correct
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'username' => 'Username atau password salah.',
            ])->withInput($request->only('username'));
        }

        // Check if user is active
        if (!$user->is_active) {
            return back()->withErrors([
                'username' => 'Akun Anda telah dinonaktifkan. Silakan hubungi administrator.',
            ])->withInput($request->only('username'));
        }

        // Login user
        Auth::login($user, $request->filled('remember'));

        // Update last login
        $user->last_login_at = now();
        $user->save();

        // Regenerate session
        $request->session()->regenerate();

        // Redirect based on role
        if ($user->isAdmin() || $user->isStaff()) {
            return redirect()->route('dashboard')
                            ->with('success', 'Selamat datang, ' . $user->name . '!');
        }

        // Regular user goes to homepage
        return redirect()->route('home')
                        ->with('success', 'Login berhasil! Selamat datang, ' . $user->name);
    }

    /**
     * Display register form
     */
    public function showRegisterForm()
    {
        return view('authentication.register');
    }

    /**
     * Handle register request
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:6|confirmed',
            'terms' => 'required|accepted'
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'terms.accepted' => 'Anda harus menyetujui syarat & ketentuan.'
        ]);

        // Get user role (default)
        $userRole = Role::where('name', Role::USER)->first();

        // Create new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role_id' => $userRole->id,
            'is_active' => true
        ]);

        // Auto login after register
        Auth::login($user);

        // Update last login
        $user->last_login_at = now();
        $user->save();

        return redirect()->route('home')
                        ->with('success', 'Pendaftaran berhasil! Selamat datang, ' . $user->name);
    }

    /**
     * Handle logout request
     */
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('home')
                        ->with('success', 'Logout berhasil!');
    }
}
