<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * Role allowed: admin, petugas, user
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // jika belum login → redirect ke login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // cek apakah role user sesuai dengan route yang diizinkan
        if (!in_array(auth()->user()->role, $roles)) {
            abort(403, "Anda tidak punya akses ke halaman ini.");
        }

        return $next($request);
    }
}
