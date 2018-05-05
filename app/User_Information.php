<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User_Information extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'phone_number', 'street_name', 'street_number', 'email', 'updated_at'
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
     * User_Information -> student_informations relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function student_informations() {
        return $this->hasMany('App\Student_Information');
    }

}
