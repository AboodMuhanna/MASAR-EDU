<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FacultyDepartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'study_tracks',
        'acquired_skills',
        'introduction_paragraph'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function contactForms()
    {
        return $this->hasMany(ContactForm::class);
    }
}
