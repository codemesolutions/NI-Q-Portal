<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Page;

class Permission extends Model
{
    public function users(){
        return $this->belongsToMany(User::class, 'user_permission');
    }

    public function menuItems(){
        return $this->belongsToMany(MenuItem::class, 'menu_item_permission');
    }

    public function pages(){
        return $this->belongsToMany(Page::class);
    }

    public function getActiveAttribute($value){
        return $value == 1 ? 'Active':'Inactive';
    }
}
