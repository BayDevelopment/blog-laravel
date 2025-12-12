<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PreventIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika sudah login
        if (Auth::check()) {
            $role = Auth::user()->role;

            // Cegah akses ke rute tertentu
            $blockedRoutes = [
                '/',                 // default
                'auth/login',
                'auth/register',
            ];

            // Jika user mencoba mengakses route tersebut
            if ($request->is($blockedRoutes)) {
                switch ($role) {
                    case 'admin':
                        return redirect('/admin/dashboard');
                    case 'user':
                        return redirect('/user/dashboard');
                }
            }
        }

        return $next($request);
    }
}
