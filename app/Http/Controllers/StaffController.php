<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    /**
     * Display staff management page (admin only)
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        // Get staff role ID
        $staffRole = Role::where('name', 'staff')->first();
        
        if (!$staffRole) {
            return redirect()->back()->with('error', 'Role staff tidak ditemukan!');
        }

        // Query users with staff role
        $staffList = User::with('role')
            ->where('role_id', $staffRole->id)
            ->when($search, function($query, $search) {
                return $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('phone', 'like', "%{$search}%");
                });
            })
            ->paginate(10);

        // Stats
        $stats = [
            'total_staff' => User::where('role_id', $staffRole->id)->count(),
            'active_staff' => User::where('role_id', $staffRole->id)->where('is_active', true)->count(),
            'inactive_staff' => User::where('role_id', $staffRole->id)->where('is_active', false)->count(),
        ];

        return view('admin.staff.index', compact('staffList', 'stats'));
    }

    /**
     * Store new staff (admin only)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'avatar' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'is_active' => 'boolean',
        ]);

        // Get staff role ID
        $staffRole = Role::where('name', 'staff')->first();
        
        if (!$staffRole) {
            return redirect()->back()->with('error', 'Role staff tidak ditemukan!');
        }

        $validated['role_id'] = $staffRole->id;
        $validated['password'] = Hash::make($validated['password']);
        $validated['is_active'] = $request->has('is_active');

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        User::create($validated);

        return redirect()->route('staff.index')->with('success', 'Staff berhasil ditambahkan!');
    }

    /**
     * Update staff (admin only)
     */
    public function update(Request $request, $id)
    {
        $staff = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'avatar' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'is_active' => 'boolean',
        ]);

        // Update password only if provided
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $validated['is_active'] = $request->has('is_active');

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar
            if ($staff->avatar) {
                Storage::disk('public')->delete($staff->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $staff->update($validated);

        return redirect()->route('staff.index')->with('success', 'Data staff berhasil diupdate!');
    }

    /**
     * Delete staff (admin only)
     */
    public function destroy($id)
    {
        $staff = User::findOrFail($id);

        // Delete avatar if exists
        if ($staff->avatar) {
            Storage::disk('public')->delete($staff->avatar);
        }

        $staff->delete();

        return redirect()->route('staff.index')->with('success', 'Staff berhasil dihapus!');
    }
}
