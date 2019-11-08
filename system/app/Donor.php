<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Document;
use App\Form;
use App\Message;
use App\Notifications;

class Donor extends Model
{
    public function documents(){
        return $this->belongsToMany(Document::class);
    }

    public function forms(){
        return $this->belongsToMany(Form::class, 'form_donor');
    }

    public function milkkits(){
        return $this->hasMany(MilkKit::class);
    }

    public function bloodkits(){
        return $this->hasMany(BloodKit::class);
    }

    public function getUserIdAttribute($value){
        return User::where('id', $value)->first();
    }
}
