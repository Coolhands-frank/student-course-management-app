<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'course_code' => strtoupper(fake()->bothify('CSC###')),
            'course_name' => fake()->sentence(3),                   
            'description' => fake()->paragraph(),                   
            'unit' => fake()->numberBetween(1, 3), 
        ];
    }
}
