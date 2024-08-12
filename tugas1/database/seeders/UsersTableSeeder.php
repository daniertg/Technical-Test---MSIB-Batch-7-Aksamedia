<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'username' => 'admin',
                'phone' => '0812111',
                'email' => 'admin@admin.com',
                'password' => Hash::make('pastibisa'), // Pastikan password di-hash
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Anda dapat menambahkan lebih banyak data di sini jika perlu
        ]);
    }
}
