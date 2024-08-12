<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        // Mencari user berdasarkan username
        $user = User::where('username', $request->username)->first();

        // Mengecek apakah user ada dan password benar
        if ($user && Hash::check($request->password, $user->password)) {
            // Membuat token untuk user
            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'status' => 'success',
                'message' => 'Login berhasil',
                'data' => [
                    'token' => $token,
                    'admin' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'username' => $user->username,
                        'phone' => $user->phone,
                        'email' => $user->email,
                    ]
                ]
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Username atau password salah'
            ], 401);
        }
    }
}
