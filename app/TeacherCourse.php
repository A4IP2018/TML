<?php

namespace App;

use App\Teacher;
use Illuminate\Database\Eloquent\Model;

class TeacherCourse extends Model
{
    protected $table = 'teacher_course';

    protected $fillable = [
        'user_id', 'course_id'
    ];

    protected $guarded = [
        'id', 'created_at'
    ];

    protected $hidden = [
        'remember_token'
    ];
}
