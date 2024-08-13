<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

        // Simpan token di tabel personal_access_tokens
        DB::table('personal_access_tokens')->insert([
            'tokenable_type' => User::class,
            'tokenable_id' => $user->id,
            'name' => 'Default',
            'token' => $token,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

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

    public function logout(Request $request)
    {
        try {
            $token = $request->bearerToken();

            if ($token) {
                // Hapus token dari tabel personal_access_tokens
                DB::table('personal_access_tokens')
                    ->where('token', $token)
                    ->delete();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Logout berhasil',
                ]);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Tidak ada sesi aktif untuk di-logout',
            ], 401); // Unauthorized
        } catch (\Exception $e) {
            Log::error('Logout failed: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Logout gagal',
            ], 500); // Internal Server Error
        }
    }
}
