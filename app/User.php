<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nr_matricol', 'email', 'password','role_id', 'updated_at'
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
        'password', 'remember_token'
    ];
    /**
     * User -> category relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category() {
        return $this->belongsTo('App\Category');
    }
    /**
     * User -> Group relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group(){
        return $this->belongsTo('App\Group');
    }
    /**
     * User -> role relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function role() {
        return $this->belongsTo('App\Role');
    }
    /**
     * User->Student_information relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function student_information() {
        return $this->hasOne('App\StudentInformation');
    }

    /**
     * User->TeacherInformation relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function teacher_information() {
        return $this->hasOne('App\TeacherInformation');
    }

    /**
     * User->Message relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function message(){
        return $this->belongsTo('App\Message');
    }

    /**
     * User -> Files relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function files(){
        return $this->hasMany('App\File');
    }

    public function courses(){
        return $this->belongsToMany('App\Course');
    }

    public function teacher() {
        return $this->hasOne('App\TeacherInformation');
    }
}