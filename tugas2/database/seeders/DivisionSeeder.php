<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    public function run()
    {
        $divisions = [
            ['name' => 'Mobile Apps'],
            ['name' => 'QA'],
            ['name' => 'Full Stack'],
            ['name' => 'Backend'],
            ['name' => 'Frontend'],
            ['name' => 'UI/UX Designer']
        ];

        foreach ($divisions as $division) {
            Division::create($division);
        }
    }
}
