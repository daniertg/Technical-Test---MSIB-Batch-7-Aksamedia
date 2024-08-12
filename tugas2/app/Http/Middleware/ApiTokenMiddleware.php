<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiTokenMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken(); // Mengambil token dari header Authorization

        // Ambil token yang valid dari .env
        $validToken = env('API_TOKEN');

        // Periksa token
        if ($token !== $validToken) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}

