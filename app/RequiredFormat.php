<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class RequiredFormat extends Model
{
    use Notifiable;
    protected $table = 'required_formats';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'homework_id', 'format_id', 'description'
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

    public function homework() {
        return $this->belongsTo('App\Homework');
    }

    public function format() {
        return $this->hasOne('App\Format', 'id', 'format_id');
    }
}
