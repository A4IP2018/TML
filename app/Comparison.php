<?php
/**
 * Created by PhpStorm.
 * User: Teo
 * Date: 5/5/2018
 * Time: 4:36 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Comparison extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'file_id_1', 'file_id_2', 'match_count', 'token_count', 'similarityA', 'similarityB', 'homework_id', 'requirement_id'
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
     * Comparison -> Users relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function matches() {
        return $this->hasMany('App\Match');
    }

    public function homework() {
        return $this->belongsTo('App\Homework');
    }

    public function file_1() {
        return $this->hasOne('App\File', 'id', 'file_id_1');
    }

    public function file_2() {
        return $this->hasOne('App\File', 'id','file_id_2');
    }
}
