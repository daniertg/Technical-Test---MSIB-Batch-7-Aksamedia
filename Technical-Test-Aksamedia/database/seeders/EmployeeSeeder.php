<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Division;
use Illuminate\Support\Str;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        // Pastikan ada data di tabel Division terlebih dahulu
        $division1 = Division::create(['name' => 'Engineering']);
        $division2 = Division::create(['name' => 'Marketing']);
        
        // Tambahkan data dummy ke tabel Employee dengan UUID
        Employee::create([
            'id' => (string) Str::uuid(),
            'name' => 'John Doe',
            'phone' => '1234567890',
            'image' => 'http://example.com/image.jpg',
            'position' => 'Software Engineer',
            'division_id' => $division1->id,
        ]);

        Employee::create([
            'id' => (string) Str::uuid(),
            'name' => 'Jane Smith',
            'phone' => '0987654321',
            'image' => 'http://example.com/image2.jpg',
            'position' => 'Marketing Specialist',
            'division_id' => $division2->id,
        ]);

        // Tambahkan lebih banyak data sesuai kebutuhan
    }
}
