<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // ✅ أضف هذا
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory; // ✅ أضف هذا
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'gender',
        'faculty_department_id',
        'password',
        'api_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'api_token',
    ];

    public function facultyDepartment()
    {
        return $this->belongsTo(FacultyDepartment::class);
    }

    public function courses()
{
    return $this->belongsToMany(Course::class, 'user_courses');
}
}
