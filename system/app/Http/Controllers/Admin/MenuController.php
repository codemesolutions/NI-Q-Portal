<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Gufy\PdfToHtml\Config;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;
use App\Http\Controllers\Controller;
use Validator;
use App\Form;
use App\Notifications;
use App\PageType;
use App\Menu;

class MenuController extends Controller
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


    public function view(Request $request)
    {
        $page = $this->getPage($request);
        return view($page['template'], $page);
    }

    public function viewCreate(Request $request)
    {
        $page = $this->getPage($request);
        return view($page['template'], $page);
    }

    public function viewUpdate(Request $request)
    {
        $page = $this->getPage($request);
        return view($page['template'], $page);
    }


    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        else{
            $user = new \App\Menu();
            $user->name = $request->input('name');
            $user->active = $request->input('status') == 'on' ? true:false;
            $user->save();
            
            return redirect()->route('admin.menu-item', ['id' => $user->id])->with('success','Menu created successfully!');
        }

    }


    public function update(Request $request){

        $validator = Validator::make($request->all(), [
            'id'   => ['required'],
            'name' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect('admin/menu')
                        ->withErrors($validator)
                        ->withInput();
        }

        else{
            $user = Menu::where('id', $request->input('id'))->first();
            $user->name = $request->input('name');
            $user->active = $request->input('status') == 'on' ? true:false;
            $user->update();
            
            return redirect()->route('admin.menu-item', ['id' => $user->id])->with('success','Menu updated successfully!');
        }

    }


  
}
