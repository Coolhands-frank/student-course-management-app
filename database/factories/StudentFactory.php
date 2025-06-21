<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'gender' => fake()->randomElement(['Male', 'Female']),
            "date_of_birth" => fake()->dateTimeBetween('-30 years', '-18 years')->format('y-m-d'),
            'address'=> fake()->address(),
        ];
    }
}
