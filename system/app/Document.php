<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    public function donors(){
        return $this->belongsToMany(App\Donor::class);
    }
}
