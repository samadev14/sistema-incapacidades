<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Healthcare;
use App\Models\Position;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    protected $model = Employee::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_employee' => $this->faker->firstName,
            'last_name_employee' => $this->faker->lastName,
            'id_employee' => $this->faker->unique()->numerify('##########'),
            'email_employee' => $this->faker->unique()->safeEmail,
            'position_id' => Position::factory(),
            'healthcare_id' => Healthcare::factory(),
        ];
    }
}
