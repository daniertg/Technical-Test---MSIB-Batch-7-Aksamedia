<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\DivisionsTableSeeder;
use Database\Seeders\EmployeeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            DivisionsTableSeeder::class,
            EmployeeSeeder::class,
        ]);
    }
}
