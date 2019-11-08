<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Permission;
use DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'first_name', 'last_name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function permissions(){
        return $this->belongsToMany(Permission::class, 'user_permission');
    }

    public function donors(){
        return $this->hasOne(Donor::class);
    }

    public function conversations(){
            return $this->belongsToMany(Conversation::class, 'user_conversation');
    }

    public function notifications(){
        return $this->belongsToMany(Notifications::class, 'notification_user', 'user_id', 'notification_id');
    }

    public function forms(){
        return $this->belongsToMany(Form::class, 'user_form');
    }
}
