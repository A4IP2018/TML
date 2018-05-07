<?php
/**
 * Created by PhpStorm.
 * User: Teo
 * Date: 5/5/2018
 * Time: 4:26 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Group extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'updated_at'
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
     * Group->Student_information relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student_information() {
        return $this->belongsTo('App\StudentInformation');
    }
//    /**
//     * Groups -> TeacherInformations relationship
//     *
//     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
//     */
//    public function teacher_informations(){
//        return $this->belongsToMany('App\TeacherInformation');
//    }
//
//    /**
//     * Group -> StudentInformations relationship
//     *
//     * @return \Illuminate\Database\Eloquent\Relations\HasMany
//     */
//    public function student_informations(){
//        return $this->hasMany('App\StudentInformation');
//    }
}
