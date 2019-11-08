<?php

namespace App\Http\Controllers\Admin\Menu;

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
            
            return redirect()->route('admin.menu', ['id' => $user->id])->with('success','Menu created successfully!');
        }

    }


    public function update(Request $request){

        $validator = Validator::make($request->all(), [
            'id'   => ['required'],
            'name' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        else{
            $user = Menu::where('id', $request->input('id'))->first();
            $user->name = $request->input('name');
            $user->active = $request->input('status') == 'on' ? true:false;
            $user->update();
            
            return redirect()->route('admin.menu', ['id' => $user->id])->with('success','Menu updated successfully!');
        }

    }

    public function delete(Request $request){
        $form = Menu::where('id', $request->query('id'))->firstOrFail();
        $form->delete();
        return redirect()->route('admin.menus')->with('success', 'Successfully deleted Menu', $form->id);
     }


  
}
