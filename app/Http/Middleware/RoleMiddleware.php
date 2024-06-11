<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Periksa apakah pengguna memiliki peran yang diperlukan
        if (!$request->user() || !$request->user()->hasAnyRole($roles)) {
            abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
}
