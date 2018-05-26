<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Extension extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'homework_id', 'extensions_string', 'updated_at'
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
     * Extension -> Homework relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function homework(){
        return $this->belongsTo('App\Homework');
    }
}
