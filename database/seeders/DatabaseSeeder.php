<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{
    FacultyDepartment,
    Course,
    User,
    ContactForm,
    Login
};
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        FacultyDepartment::factory(3)->create();

        User::factory(10)->create();
        Course::factory(10)->create();
        ContactForm::factory(10)->create();
        Login::factory(15)->create();
    }
}
