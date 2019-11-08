<?php

namespace App\Http\Controllers\Admin\Settings;

use Illuminate\Http\Request;
use Gufy\PdfToHtml\Config;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;
use App\Http\Controllers\Controller;
use Validator;
use App\Setting;


class ActionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function save(Request $request){
       
     
            
            $settings = Setting::all();

            foreach($settings as $setting){
                if($request->has(str_replace(' ', '_', $setting->name))){
                    $s = Setting::where('id', $setting->id)->first();
                    $s->value = $request->input(str_replace(' ', '_', $setting->name));
                    $s->update();
                }
            }
            
            
         
            return redirect()->route('admin.settings')->with('success', "Settings updated");
        

    }



  
}
