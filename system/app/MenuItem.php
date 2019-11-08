<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Permission;

class MenuItem extends Model
{
    public function getMenuIdAttribute($value){
        return Menu::where('id', $value)->first();
    }
    
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
