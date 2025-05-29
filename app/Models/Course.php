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
        'faculty_department_id'
    ];

    public function facultyDepartment()
    {
        return $this->belongsTo(FacultyDepartment::class);
    }
}
