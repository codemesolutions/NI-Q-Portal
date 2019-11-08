<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Permission;

class Page extends Model
{
    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }

    
    public static function getTemplates($dir, $results = array()){
        $files = scandir($dir);
    
        foreach($files as $key => $value){
            $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
            if(!is_dir($path)) {
                if(basename(dirname($path)) != "site" && basename(dirname($path)) != "admin"){
                    $results[] = basename(dirname($path)) . '/' . str_replace(".blade.php", "", basename($path));
                }

                else{
                    $results[] = str_replace(".blade.php", "", basename($path)) ;
                }
               
            } else if($value != "." && $value != "..") {
                $results = self::getTemplates($path, $results);
            }
        }
        
        return $results;
    }

    public function getActiveAttribute($value){
        return $value == 1 ? 'Active':'Inactive';
    }

    

    public function getPageTypeIdAttribute($value){
        return PageType::where('id', $value)->first()->name;
    }
}
