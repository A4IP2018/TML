<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'homework_id', 'file_name', 'updated_at', 'batch_id', 'storage_path'
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
     * File -> User relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo('App\User');
    }

    /**
     * File -> Homework relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function homework(){
        return $this->belongsTo('App\Homework');
    }

    /**
     * File -> Grade relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function grade(){
        return $this->HasOne('App\Grade');
    }
}
