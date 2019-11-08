<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ValidationRule;

class FormPageField extends Model
{
    public function rules(){
        return $this->belongsToMany(ValidationRule::class, 'form_page_field_validation');
    }

    public static function createTable($tableName){
        Schema::create($tableName, function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });

        return $tableName;
    }
}
