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
use App\NotificationTypes;
use App\PageType;
use App\Donor;
use App\User;
use App\Message;

class MessagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }


    public function view(Request $request)
    {
        $this->middleware('auth');
        $page = $this->getPage($request);
        return view($page['template'], $page);
    }

    public function message(Request $request)
    {
        $msg = Message::where('id', $request->query('id'))->first();

        if(!is_null($msg)){
            $page = $this->getPage($request);
            $page['message'] = $msg;
            return view($page['template'], $page);
        }

        abort(404);
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'user' => ['required']
        ]);

        if ($validator->fails()) {
            return redirect('admin/messages')
                        ->withErrors($validator)
                        ->withInput();
        }

        else{
            $user = new \App\Message();
            $user->user_id = $request->user()->id;
            $user->title = $request->input('title');
            $user->body = $request->input('body');
            $user->parent_id = $request->input('parent');
            $user->save();

          
            $_user = $request->input('user');
            
            if(is_array($_user)){
                foreach($request->input('user') as $key => $value){
                    $user->users()->attach(User::where('id', $key)->first());
    
                    $notify = new Notifications();
                    $notify->notification_type_id = NotificationTypes::where('name', 'Message')->first()->id;
                    $notify->message = 'There was a new message sent to "'. User::where('id', $key)->first()->name .'"';
                    $notify->resource = Route('admin.forms');
                    $notify->save();
                    $notify->users()->attach(User::where('id', $key)->first());
                }

                
                return redirect('admin/messages')->with('success','Message sent successfully!');
            }

            else{
                $user->users()->attach(User::where('id', $_user)->first());
    
                $notify = new Notifications();
                $notify->notification_type_id = NotificationTypes::where('name', 'Message')->first()->id;
                $notify->message = 'There was a new message sent to "'. User::where('id', $_user)->first()->name .'"';
                $notify->resource = Route('admin.forms');
                $notify->save();
                $notify->users()->attach(User::where('id', $_user)->first());

              
                
                if($request->path() === 'admin/messages/create'){
                    return redirect('/admin/messages')->with('success','Message sent successfully!');
                }

                else{
                    return redirect('/messages')->with('success','Message sent successfully!');
                }
              
            }
           

            
        }

    }


    public function update(Request $request){
        $this->middleware('auth');
        $validator = Validator::make($request->all(), [
            'id' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['sometimes', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect('admin/users')
                        ->withErrors($validator)
                        ->withInput();
        }

        else{
            $user = \App\User::where('id', $request->input('id'))->first();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->active = $request->input('status') == "on" ? 1:0;
            $user->update();

            $roles = [];
            foreach($request->input('role') as $key => $value){
                $roles[] = $key;
            }

            $user->permissions()->sync($roles);

            return redirect('admin/users')->with('success','User updated successfully!');
        }

    }


  
}
