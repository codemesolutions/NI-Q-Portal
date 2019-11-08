<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\FormPageField;
use App\FormPageContent;

class FormPage extends Model
{
    public function fields(){
        return $this->hasOne(FormPageField::class);
    }

    public function contents(){
        return $this->hasOne(FormPageContent::class);
    }
}
