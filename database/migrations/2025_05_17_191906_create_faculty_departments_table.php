<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('faculty_departments', function (Blueprint $table) {
            $table->id(); // primary key
            $table->string('name');
            $table->text('study_tracks')->nullable();
            $table->text('acquired_skills')->nullable();
            $table->text('introduction_paragraph')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faculty_departments');
    }
};
