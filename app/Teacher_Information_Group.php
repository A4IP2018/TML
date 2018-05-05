<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Teacher_Information_Group extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'group_id', 'teacher_information_id', 'updated_at'
    ];

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id', 'created_at'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token'
    ];

    /**
     * Teacher_Information_Group -> teacher_informations relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function teacher_informations() {
        return $this->hasMany('App\Teacher_Information');
    }

    /**
     * Teacher_Information_Group -> groups relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function groups() {
        return $this->hasMany('App\Group');
    }
}
