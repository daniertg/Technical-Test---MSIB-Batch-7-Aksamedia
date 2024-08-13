<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DivisionSeeder extends Seeder
{
    public function run()
    {
        $divisions = [
            'Mobile Apps',
            'QA',
            'Full Stack',
            'Backend',
            'Frontend',
            'UI/UX Designer'
        ];

        foreach ($divisions as $division) {
            DB::table('divisions')->insert([
                'id' => Str::uuid(),
                'name' => $division,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
