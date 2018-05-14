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
        'description','name','slug', 'category_id', 'updated_at', 'deadline', 'course_id', 'user_id'
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
     * Homework -> Grade relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function grades()
    {
        return $this->hasMany('App\Grade');
    }

    /**
     * Homework -> Category relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    /**
     * Homework -> Comparisons relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comparisons()
    {
        return $this->hasMany('App\Comparison');

    }

    /**
     * Homework -> User relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Homework -> Files relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function files(){
        return $this->hasMany('App\File');
    }

    /**
     * Homework -> Extension relationship
     *
     * NOTE : Homework ONLY has one Extension TYPE (which includes MULTIPLE extensions)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function extension(){
        return $this->hasOne('App\Extension');
    }

    public function formats()
    {
        return $this->belongsToMany('App\Format');
    }

    /**
     * Homework -> Course relationship
     *
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course() {
        return $this->belongsTo('App\Course');
    }
}
