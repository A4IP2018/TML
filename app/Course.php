<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'course_title', 'year', 'semester', 'credits'
    ];

    protected $guarded = [
        'id', 'created_at'
    ];

    protected $hidden = [
        'remember_token'
    ];

    public function users() {
        return $this->belongsToMany('App\User');
    }

}
