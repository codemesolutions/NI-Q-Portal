<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Gufy\PdfToHtml\Config;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;
use App\Http\Controllers\Controller;
use App\Notifications;
use App\Form;
use App\User;
use App\Library\DonorAPI;

class ViewsController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */



    public function dashboard(Request $request)
    {
        
        
            
        $page = $this->getPage($request);
        //$page['sidebarHide'] = true;
        
        return view($page['template'], $page);
    }

    public function settings(Request $request)
    {
        
        
            
        $page = $this->getPage($request);
        $page['settings'] = \App\Setting::all();
        $page['form_action_route'] = '';
        return view($page['template'], $page);
    }

    public function forms()
    {
        return view('admin.forms');
    }

    public function documents()
    {
        return view('admin.documents');
    }

    public function file()
    {
        return view('admin.file');
    }

    public function edit()
    {
        return view('site.editpdf');
    }

    public function messages()
    {
        return view('admin.messages.messages');
    }

    public function payments()
    {
        return view('admin.payments');
    }

    public function account()
    {
        return view('admin.account');
    }

    public function users()
    {
        return view('admin.users', [
            'users' => \App\User::all()
        ]);
    }

    public function message()
    {
        return view('admin.messages.message');
    }
}
