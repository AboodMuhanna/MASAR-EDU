<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\FacultyDepartment;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContactForm>
 */
class ContactFormFactory extends Factory
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
            'email' => fake()->safeEmail(),
            'message_title' => fake()->sentence(3),
            'message' => fake()->paragraph(2),
            'faculty_department_id' => FacultyDepartment::inRandomOrder()->first()?->id ?? 1,
        ];
    }
}
