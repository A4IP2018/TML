<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Message extends Model
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id_sender', 'user_id_receiver', 'subject', 'context' , 'updated_at'
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
     * Message -> User relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user() {
        return $this->hasMany('App\User','user_id');
    }
}