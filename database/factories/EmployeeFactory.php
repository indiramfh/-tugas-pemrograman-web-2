<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Employee>
 */
class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition(): array
    {
        return [
            'employee_number' => fake()->unique()->numerify('EMP-#####'),
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'position' => fake()->jobTitle(),
            'department' => fake()->randomElement(['Operasional', 'Keuangan', 'Teknologi', 'Sumber Daya Manusia']),
            'employment_status' => fake()->randomElement(['Aktif', 'Kontrak', 'Masa Percobaan', 'Nonaktif']),
            'joined_at' => fake()->dateTimeBetween('-5 years')->format('Y-m-d'),
        ];
    }
}