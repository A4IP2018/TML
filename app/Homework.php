<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Homework extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description', 'cateory_id', 'updated_at'
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
    public function homeworks_grades()
    {
        return $this->hasMany('App\Grade');
    }

    public function homeworks_categories()
    {
        return $this->belongsTo('App\Categories');
    }

    public function homeworks_comparisons()
    {
        return $this->hasMany('App\Comparisons');

    }

    public function homeworks_users()
    {
        return $this->belongsTo('App\Users');
    }
}
