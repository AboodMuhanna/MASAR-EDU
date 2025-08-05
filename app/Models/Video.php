<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['course_id', 'video_path'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
