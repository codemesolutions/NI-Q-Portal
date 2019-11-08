<?php

namespace App\Http\Controllers\Admin\Message;

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
use App\User;
use App\NotificationTypes;
use App\Message;
use App\Conversation;

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
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'users' => ['required']
           
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        else{

            if(!is_null($request->input('users'))){
            
            
                foreach($request->input('users') as $key => $value){

                    $conversation = new Conversation();
                    $conversation->subject = $request->input('title');
                    $conversation->save();
                    $conversation->users()->attach(User::where('id', $key)->first());
                    $conversation->users()->attach($request->user());

                    $user = new \App\Message();
                    $user->conversation_id = $conversation->id;
                    $user->to_user_id = User::where('id', $key)->first()->id;
                    $user->from_user_id = $request->user()->id;
                    $user->message = $request->input('body');
                    $user->save();
    
                    $notify = new Notifications();
                    $notify->notification_type_id = NotificationTypes::where('name', 'Message')->first()->id;
                    $notify->message = 'You have recieved a new message from "'. $request->user()->name .'"';
                    $notify->resource = Route('admin.forms');
                    $notify->save();
                    $notify->users()->attach(User::where('id', $key)->first());
                }

                return redirect('admin/message')->with('success','Message sent successfully!');
            }

          
            
        }

    }

    public function reply(Request $request){

        

        $validator = Validator::make($request->all(), [
            'conversation' => ['required'],
            'message' => ['required', 'string'],
            'to' => ['required'],

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        else{

            $convo = Conversation::where('id', $request->input('conversation'))->first();
            $convo->is_seen = false;
            $convo->update();

            $user = new \App\Message();
            $user->conversation_id = $convo->id;
            $user->to_user_id = User::where('name', $request->input('to'))->first()->id;
            $user->from_user_id = $request->user()->id;
            $user->message = $request->input('message');
            $user->save();

            $notify = new Notifications();
            $notify->notification_type_id = NotificationTypes::where('name', 'Message')->first()->id;
            $notify->message = 'You recieved a reply from "'. $user->from_user_id .'"';
            $notify->resource = Route('admin.forms');
            $notify->save();
            $notify->users()->attach(User::where('name', $request->input('to'))->first());

         
        

            if($request->user()->permissions()->first()->name == 'donor'){
                return redirect('messages/message?id='. $user->conversation_id)->with('success','Message sent successfully!');
            }
            return redirect('admin/message')->with('success','Message sent successfully!');
            

          
            
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
            
            return redirect()->route('admin.menu-item', ['id' => $user->id])->with('success','Menu updated successfully!');
        }

    }

    public function seen(Request $request){

        if(!is_null($request->input('id')))
        {
            $convo = Conversation::where('id', $request->input('id'))->first();
            $convo->is_seen = true;
            $convo->update();
            return response()->json(['message' => "ok"]);
        }

        return response()->json(['message' => "bad"]);
       
    }
  
}
