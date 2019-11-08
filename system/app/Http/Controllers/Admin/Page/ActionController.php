<?php

namespace App\Http\Controllers\Admin\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Form;
use App\Notifications;
use App\PageType;
use App\Page;

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
            'type' => ['required', 'numeric'],
            'slug' => ['required', 'string'],
            'title' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        else{
            $user = new Page();
            $user->page_type_id = PageType::where('id', $request->input('type'))->first()->id;
            $user->title = $request->input('title');
            $user->slug = $request->input('slug');
            $user->template = $request->input('template');
            $user->content = $request->input('content');
            $user->active = $request->input('status') == 'on' ? true:false;
            $user->save();

            if(!is_null($request->input('role'))){
                foreach($request->input('role') as $key => $value){
                    $user->permissions()->attach(\App\Permission::where('id', $key)->first());
                }
            }
            
            return redirect()->route('admin.page', ['id' => $user->id])->with('success','Page created successfully!');
        }

    }


    public function update(Request $request){

        $validator = Validator::make($request->all(), [
            'id'  => ['required'],
            'type' => ['required', 'numeric'],
            'slug' => ['required', 'string'],
            'title' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        else{
            $user = Page::where('id', $request->input('id'))->first();
            $user->page_type_id = PageType::where('id', $request->input('type'))->first()->id;
            $user->title = $request->input('title');
            $user->slug = $request->input('slug');
            $user->template = $request->input('template');
            $user->content = $request->input('content');
            $user->active = $request->input('status') == 'on' ? true:false;
            $user->update();

            $roles = [];

            if(!is_null($request->input('role'))){
                foreach($request->input('role') as $key => $value){
                    $roles[] = $key;
                }
            }
           

            $user->permissions()->sync($roles);
            
            return redirect()->route('admin.page', ['id' => $user->id])->with('success','Page updated successfully!');
        }


    }


    public function delete(Request $request){
        $form = Page::where('id', $request->query('id'))->firstOrFail();
        $form->delete();
        return redirect()->route('admin.pages')->with('success', 'Successfully deleted Page');
     }
  
}
