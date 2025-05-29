<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\FacultyDepartment;

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
            'title' => fake()->words(3, true),
            'description_paragraph' => fake()->paragraph(),
            'duration' => fake()->numberBetween(4, 12) . ' weeks',
            'number_of_lessons' => fake()->numberBetween(10, 40),
            'instructor_name' => fake()->name(),
            'faculty_department_id' => FacultyDepartment::inRandomOrder()->first()?->id ?? 1,
        ];
    }
}
