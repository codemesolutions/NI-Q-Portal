<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\NotificationTypes;
use App\User;

class Notifications extends Model
{
    public function types(){
        return $this->belongsTo(NotificationTypes::class, 'notification_type_id');
    }

    public function users(){
        return $this->belongsToMany(User::class, 'notification_user', 'notification_id', 'user_id');
    }

    public function getNotificationTypeIdAttribute($value){
        return NotificationTypes::where('id', $value)->first()->name;
    }
}
