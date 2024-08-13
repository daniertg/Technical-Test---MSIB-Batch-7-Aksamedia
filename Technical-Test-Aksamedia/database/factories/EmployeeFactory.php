<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Division;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'image' => $this->faker->imageUrl(640, 480, 'people'),
            'position' => $this->faker->jobTitle(),
            'division_id' => Division::factory(), // Asosiasikan dengan Division
        ];
    }
}
