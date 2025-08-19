<?php

namespace Database\Factories;

use App\Models\Healthcare;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Healthcare>
 */
class HealthcareFactory extends Factory
{
    protected $model = Healthcare::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_healthcare' => $this->faker->company . ' EPS',
        ];
    }
}
