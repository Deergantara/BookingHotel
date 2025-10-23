<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Middleware\EnsureUserIsResepsionis;

class EnsureUserIsResepsionis
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role !== 'resepsionis') {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}