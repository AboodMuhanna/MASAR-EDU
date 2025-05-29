<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FacultyDepartment>
 */
class FacultyDepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(2, true),
            'study_tracks' => fake()->sentence(),
            'acquired_skills' => fake()->sentence(),
            'introduction_paragraph' => fake()->paragraph(),
        ];
    }

}
