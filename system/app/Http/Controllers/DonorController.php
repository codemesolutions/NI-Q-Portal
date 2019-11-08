<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gufy\PdfToHtml\Config;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;
use App\Message;
use Illuminate\Support\Str;
use App\Conversation;

class DonorController extends Controller
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
    public function index(Request $request)
    {
      

        $page = $this->getPage($request);

        if(!is_array($page)){
            return redirect($page);
        }

        return view($page['template'], $page);
    }

    public function form(Request $request, $form)
    {
        $page = $this->getPage($request);
        return view($page['template'], $page);
    }

    public function forms(Request $request)
    {
        $page = $this->getPage($request);
        return view($page['template'], $page);
    }

    public function milkkitSend(Request $request)
    {
        if(!is_null($request->user()->donors()->first())){
            $user = new \App\Shipping();
            $user->donor_id  = $request->user()->donors()->first()->id;
            $user->save();
            return redirect()->back()->with('success', "Milk Kit Request Sent");
        }

        else{
            return redirect()->back()->with('errors', "Invalid donor ID");
        }
    }

    public function bloodkit(Request $request)
    {
        $page = $this->getPage($request);
        $donorID = $request->user()->donors()->first();

        if(!is_null($donorID)){
            $donor = \App\Donor::where('id', $request->user()->donors()->first()->id)->first();
            $page['donor'] = $donor;
        }
        return view($page['template'], $page);
    }

    public function documents(Request $request)
    {
        $page = $this->getPage($request);
        return view($page['template'], $page);
    }

    public function file(Request $request)
    {
        $page = $this->getPage($request);
        return view($page['template'], $page);
    }

    public function edit(Request $request)
    {
        $page = $this->getPage($request);
        return view($page['template'], $page);
    }

    public function messages(Request $request)
    {
        $page = $this->getPage($request);
        return view($page['template'], $page);
        
    }

    public function payments(Request $request)
    {
        $page = $this->getPage($request);
        return view($page['template'], $page);
    }

    public function account(Request $request)
    {
        $page = $this->getPage($request);
        return view($page['template'], $page);
    }

    public function message(Request $request)
    {
        $msg = Conversation::where('id', $request->query('id'))->first();

        if(!is_null($msg)){
            $page = $this->getPage($request);
            $page['message'] = $msg;
            return view($page['template'], $page);
        }

        abort(404);
    }
}
