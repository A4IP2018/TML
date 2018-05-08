<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Grade extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'grade', 'user_id','homework_id', 'updated_at'
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
     * Report -> Report_type relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function grades_users() {
        return $this->belongsTo('App\User');
	 }
	 public function grades_homeworks() {
        return $this->belongsTo('App\Homework');
    }
    

}
