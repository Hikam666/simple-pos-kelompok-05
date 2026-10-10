<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // Gunakan in_array untuk mengecek apakah role user ada di dalam daftar $roles
        if (! $request->user() || ! in_array($request->user()->role, $roles)) {
            $peran = implode(' atau ', $roles);
            abort(403, "Akses ditolak. Halaman ini hanya untuk peran: {$peran}.");
        }

        return $next($request);
    }
}