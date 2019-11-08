<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function handler(Request $request)
    {
        $page = $this->getPage($request);
       

        if($page['type'] == 'public' || $page['type'] == 'donor'){
            $type = 'site';
        }

        else{
            $type = $type['type'];
        }

        return view($type . '/' . $page['template'], $page);
    }

 
}
