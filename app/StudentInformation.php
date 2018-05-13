<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class StudentInformation extends Model
{
    use Notifiable;
    protected $table = 'student_informations';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'an','group_id', 'updated_at', 'first_name', 'last_name'
    ];

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'íd', 'created_at'
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
     * Student_information -> User relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function users() {
        return $this->belongsTo('App\User');
    }
    /**
     * Student_information -> Group relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function groups() {
        return $this->hasMany('App\Group','group_id');
    }

}
