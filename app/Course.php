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

    /**
     * Course -> User relationship
     *
     * NOTE : Many to Many between teachers and courses
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users() {
        return $this->belongsToMany('App\User');
    }

    /**
     * Course -> Homework relationship
     *
     * NOTE: Courses have multiple homeworks, a homework has only one course
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function homeworks() {
        return $this->hasMany('App\Homework');
    }

}
