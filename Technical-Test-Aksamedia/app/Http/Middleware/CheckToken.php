<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckToken
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        if (!$token || !$this->isValidToken($token)) {
            return response()->json(['message' => 'Unauthoriaed'], 401);
        }

        return $next($request);
    }

    private function isValidToken($token)
    {
        // Ganti logika ini dengan validasi token yang sesuai dengan aplikasi kamu
        // Contoh sederhana: validasi token 6 digit
        return is_numeric($token) && strlen($token) === 6;
    }
}
