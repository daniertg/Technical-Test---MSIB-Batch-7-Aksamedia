<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckGuest
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            return response()->json([
                'message' => 'Unauthorized access'
            ], 403);
        }

        return $next($request);
    }
}
