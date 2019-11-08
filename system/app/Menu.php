<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\MenuItem;

class Menu extends Model
{
    public function items(){
        return $this->hasMany(MenuItem::class);
    }

    public function getActiveAttribute($value)
    {
        return $value == 1 ? 'Active':'Inactive';
    }
}
