<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description_paragraph',
        'duration',
        'number_of_lessons',
        'instructor_name',
        'faculty_department_id',
        'image'
    ];
    
   public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function facultyDepartment()
    {
        return $this->belongsTo(FacultyDepartment::class);
    }

    public function users()
{
    return $this->belongsToMany(User::class, 'user_courses');
}


 
}
