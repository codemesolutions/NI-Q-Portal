<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    public function donor(){
        return $this->belongsTo(Donor::class);
    }
}
