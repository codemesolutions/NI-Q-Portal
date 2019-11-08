<?php

namespace App\Http\Controllers\Admin\Notification;

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
            'type' => ['required', 'numeric'],
            'message' => ['string'],
            'resource' => ['string'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        else{
            $user = new \App\Notifications();
            $user->notification_type_id = $request->input('type');
            $user->message = $request->input('message');
            $user->resource = $request->input('resource');
            $user->save();

            if(!is_null($request->input('users'))){
                foreach($request->input('users') as $key => $value){
                    $user->users()->attach(\App\User::where('id', $key)->first());
                }
            }
            
            return redirect()->route('admin.notifications')->with('success','Notification created successfully!');
        }

    }


    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'numeric'],
            'type' => ['required', 'numeric'],
            'message' => ['string'],
            'resource' => ['string'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        else{
            $user = \App\Notifications::where('id', $request->input('id'))->first();
            $user->notification_type_id = $request->input('type');
            $user->message = $request->input('message');
            $user->resource = $request->input('resource');
            $user->update();

            
            $users = [];

            if(!is_null($request->input('user'))){
                foreach($request->input('user') as $key => $value){
                    $users[] = $key;
                }
            }
           
            

            $user->users()->sync($users);
            
            return redirect()->route('admin.notification', ['id' => $user->id])->with('success','Notification updated successfully!');
        }

    }

    public function delete(Request $request){
        $form = Notifications::where('id', $request->query('id'))->firstOrFail();
        $form->delete();
        return redirect()->route('admin.notifications')->with('success', 'Successfully deleted Notifcation', $form->id);
     }


  
}
