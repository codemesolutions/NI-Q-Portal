<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function users(){
        return $this->belongsToMany(User::class, 'message_user');
    }

   

    public function getToUserIdAttribute($value){
        return User::where('id', $value)->first()->name;
    }

    public function getFromUserIdAttribute($value){
        return User::where('id', $value)->first()->name;
    }

    
}
