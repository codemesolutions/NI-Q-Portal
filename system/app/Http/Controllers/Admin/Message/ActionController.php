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
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
            'user' => ['required']

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        else{

            if(!is_null($request->input('user'))){


                foreach($request->input('user') as $key => $id){
                    if($request->has('donor_message')){

                        $ticket = new \App\Ticket();
                        $ticket->subject = $request->input('subject');
                        $ticket->from_user_id = $request->user()->id;
                        $ticket->to_user_id = 6421;
                        $ticket->is_new = 1;
                        $ticket->save();

                        $comment = new \App\Comment();
                        $comment->ticket_id = $ticket->id;
                        $comment->from_user_id = $request->user()->id;
                        $comment->to_user_id = 6421;
                        $comment->message = $request->input('message');
                        $comment->save();
                        return redirect('messages')->with('success','Message sent successfully!');
                    }

                    $ticket = new \App\Ticket();
                    $ticket->subject = $request->input('subject');
                    $ticket->from_user_id = 6421;
                    $ticket->to_user_id = $id;
                    $ticket->is_new = 1;
                    $ticket->save();

                    $comment = new \App\Comment();
                    $comment->ticket_id = $ticket->id;
                    $comment->from_user_id = 6421;
                    $comment->to_user_id = $id;
                    $comment->message = $request->input('message');
                    $comment->save();
                }

                return redirect('admin/message')->with('success','Message sent successfully!');
            }



        }

    }

    public function reply(Request $request){



        $validator = Validator::make($request->all(), [

            'message' => ['required', 'string'],


        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        else{

            $ticket = \App\Ticket::where('id', $request->input('ticket'))->first();
            $ticket->is_new = 1;
            $ticket->update();

            if($request->has('donor_message')){
                $comment = new \App\Comment();
                $comment->ticket_id = $ticket->id;
                $comment->message = $request->input('message');
                $comment->to_user_id = 6421;
                $comment->from_user_id = $request->input('from');
                $comment->save();

                return redirect('messages/message?id='.$ticket->id)->with('success','Message sent successfully!');
            }

            else{
                $comment = new \App\Comment();
                $comment->ticket_id = $ticket->id;
                $comment->message = $request->input('message');
                $comment->to_user_id = $request->input('to');
                $comment->from_user_id = 6421;
                $comment->save();

            }

            return redirect('admin/message/view?id='.$ticket->id)->with('success','Message sent successfully!');




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
