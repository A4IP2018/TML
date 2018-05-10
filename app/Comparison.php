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
        'homework_id_1', 'homework_id_2', 'plagiarism_degree', 'user_id', 'updated_at'
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

//    /**
//     * Comparison -> Homeworks relationship for the first Homework used in the Comparison.
//     *
//     * @return \Illuminate\Database\Eloquent\Relations\HasMany
//     */
//    public function homeworks_1() {
//        return $this->hasMany('App\Homework','homework_id_1',);
//    }
//
//    /**
//     * Comparison -> Homeworks relationship for the second Homework used in the Comparison.
//     *
//     * @return \Illuminate\Database\Eloquent\Relations\HasMany
//     */
//    public function homeworks_2() {
//        return $this->hasMany('App\Homework','homework_id_2',);
//    }
//
    /**
     * Comparison -> Users relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(){
        return $this->hasMany('App\User');
    }
}
