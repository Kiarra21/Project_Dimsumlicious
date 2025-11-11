<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$permissions
     */
    public function handle(Request $request, Closure $next, string ...$permissions): Response
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login')
                ->with('error', 'Anda harus login terlebih dahulu.');
        }

        $user = auth()->user();

        // Check if user account is active
        if (!$user->is_active) {
            auth()->logout();
            return redirect()->route('login')
                ->with('error', 'Akun Anda telah dinonaktifkan. Silakan hubungi administrator.');
        }

        // Check if user has all required permissions
        foreach ($permissions as $permission) {
            if (!$user->hasPermission($permission)) {
                return redirect()->back()
                    ->with('error', 'Anda tidak memiliki izin untuk melakukan aksi ini.');
            }
        }

        return $next($request);
    }
}
