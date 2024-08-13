<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required',
        ]);

        // Cek apakah pengguna ada
        $user = User::where('username', $request->username)->first();

        // Cek password dengan hash
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Username atau password tidak ditemukan'
            ], 404);
        }

        // Generate token random 6 digit
        $token = $this->generateRandomToken();

        // Jika diperlukan, simpan token di database untuk pengguna
        // $user->update(['token' => $token]);

        return response()->json([
            'status' => 'success',
            'message' => 'Login Berhasil',
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
    }

    // Fungsi untuk menghasilkan token random 6 digit
    private function generateRandomToken()
    {
        return rand(100000, 999999);
    }
}
