<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Comment extends Model
{
    use Notifiable;
    //
    /**
     * Fillable fields for a course
     *
     * @return array
     */
    protected $fillable = ['comment','homework_id','user_id'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'íd'
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
     * Comment-> User relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo('App\User');
    }

    /**
     * Comment-> Homework relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function homework() {
        return $this->belongsTo('App\Homework');
    }
}