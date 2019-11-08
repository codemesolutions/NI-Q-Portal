<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{

    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function users(){
        return $this->belongsToMany(User::class, 'user_conversation');
    }

   
}
