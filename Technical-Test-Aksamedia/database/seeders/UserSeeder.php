<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'admin',
            'username' => 'admin',
            'phone' => '0812111',
            'email' => 'admin@example.com',
            'password' => Hash::make('pastibisa'), // Password di-hash
            'remember_token' => Str::random(10),
        ]);
    }
}
