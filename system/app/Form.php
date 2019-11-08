<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\FormType;
use App\FormPage;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use DB;

class Form extends Model
{
    public function formType(){
        return $this->belongsTo(FormType::class);
    }

    public function users(){
        return $this->belongsToMany(User::class, 'user_form');
    }

    public function questions(){
        return $this->hasMany(Question::class);
    }

    public function submissions(){
        return $this->hasMany(FormSubmission::class);
    }

    public function getActiveAttribute($value){
        return $value == 1 ? 'Active':'Inactive';
    }

    public function getFormTypeIdAttribute($value){
        return FormType::where('id', $value)->first()->name;
    }

    public static function createTable($tableName, Array $fields){
        if (!Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) use($fields) {
            //dd($fields);
                $table->increments('id');
                
                if(count($fields) > 0){
                    foreach($fields as $field){
                        $table->string($field)->nullable();
                    }
                }
            
                $table->timestamps();
            });
        }

        else{
           
            
            $results = DB::table($tableName)->get();

            Schema::table($tableName, function (Blueprint $table) use($tableName, $fields) {
                if(count($fields) > 0){
                    foreach($fields as $field){
                        if (!Schema::hasColumn($tableName, $field))
                        {
                            $table->string($field)->nullable();
                        }
                    }
                }
            });
        }

        return $tableName;
    }
}
