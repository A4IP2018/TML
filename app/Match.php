<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $fillable = [
        'start', 'length', 'comparison_id', 'side'
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

    public function comparison() {
        return belongsTo('App\Comparison');
    }
}
