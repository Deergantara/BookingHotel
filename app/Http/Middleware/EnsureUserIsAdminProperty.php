<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdminProperty
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || auth()->user()->role !== 'admin property') {
            abort(403, 'Unauthorized access. Only Admin Property can access this panel.');
        }

        return $next($request);
    }
}
