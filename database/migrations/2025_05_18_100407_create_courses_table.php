<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description_paragraph');
            $table->string('duration'); // e.g. '8 weeks'
            $table->integer('number_of_lessons');
            $table->string('instructor_name');
            $table->unsignedBigInteger('faculty_department_id');

              $table->foreign('faculty_department_id')
          ->references('id')->on('faculty_departments')
          ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
