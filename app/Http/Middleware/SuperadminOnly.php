<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuperadminOnly
{
    /**
     * Handle an incoming request.
     * Only allow Superadmin users to access the route.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user || !$user->isSuperadmin()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Akses ditolak. Hanya Superadmin yang dapat mengakses halaman ini.',
                ], 403);
            }

            abort(403, 'Akses ditolak. Hanya Superadmin yang dapat mengakses halaman ini.');
        }

        return $next($request);
    }
}
