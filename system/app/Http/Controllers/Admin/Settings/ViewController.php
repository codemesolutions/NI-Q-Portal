<?php

namespace App\Http\Controllers\Admin\Settings;

use Illuminate\Http\Request;
use Gufy\PdfToHtml\Config;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;
use App\Http\Controllers\Controller;
use Validator;
use App\Setting;

class ViewController extends Controller
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

    public function list(Request $request)
    {   
        
        $page = $this->getPage($request);

        $page['settings'] = Setting::all();
        $page['form_action_route'] = "/admin/settings/save";

        return view($page['template'], $page);
    }
}
