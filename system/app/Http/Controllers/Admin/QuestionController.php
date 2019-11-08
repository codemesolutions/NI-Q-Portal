<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuestionController extends Controller{
    
    public function view(Request $request)
    {
        $page = $this->getPage($request);
        return view($page['template'], $page);
    }

    public function form(Request $request)
    {
        $page = $this->getPage($request);
        return view($page['template'], $page);
    }

}