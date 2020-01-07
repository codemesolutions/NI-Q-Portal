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
use App\Message;
use App\User;
use App\Conversation;

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

        $page['datasets']['list'] = [
            'columns' => [
                'Subject' => 'subject',
                'From' => function($row){
                    $comment =  \App\Comment::where('ticket_id', $row->id)->orderBy('created_at')->first();
                    $from = User::where('id', $comment->from_user_id)->first();
                    return $from->first_name . ' ' . $from->last_name;
                },

            ],
            'rows' => \App\Ticket::all()
        ];

        $page['list_actions'] = 'admin.sections.message-list-actions';

        $page['update_route'] = Route('admin.message.view');
        $page['create_route'] = Route('admin.message.create');
        $page['view_route'] = Route('admin.message.view');


        return view('admin.tickets-list', $page);
    }

    public function view(Request $request){
        $ticket = \App\Ticket::where('id', $request->query('id'))->first();
        if(!is_null($ticket)){
            $comments = \App\Comment::where('ticket_id', $ticket->id)->get();
        }


        if(isset($comments) && !is_null($comments)){
            $page = $this->getPage($request);
            $page['ticket'] = $ticket;

            $page['view_route'] = Route('admin.message.view');
            $page['delete_route'] = Route('admin.message.view');
            $page['comments'] = $comments;
            return view('admin.tickets-single', $page);
        }

        abort(404);



    }

    public function create(Request $request)
    {
        $page = $this->getPage($request);

        $page['form_action_route'] = 'admin.message.create';

        $page['fields'][] = [
            'name' => 'title',
            'type' => 'text',
            'label' => "Subject",
            'helper' => 'The Subject of the message',
            'value' => old('title')
        ];

        $page['fields'][] = [
            'name' => 'body',
            'type' => 'richtext',
            'label' => "Body",
            'helper' => 'The Body of the message',
            'value' => old('body')
        ];


        $page['fields']['users'] = [
            'name' => 'users',
            'type' => 'checkbox-select',
            'label' => "To",
            'helper' => 'The name you want the page to be titled',
            'options' => []
        ];

        foreach(User::all() as $perm){
            $page['fields']['users']['options'][] = [
                'name' => $perm->name,
                'value' => $perm->id,
                'selected' => false
            ];
        }

        return view($page['template'], $page);
    }

    public function update(Request $request)
    {

        $menu = Menu::where('id', $request->query('id'))->firstOrFail();

        $page = $this->getPage($request);

        $page['form_action_route'] = 'admin.message.update';

        $page['fields'][] = [
            'name' => 'id',
            'type' => 'hidden',
            'value' => $request->query('id'),
        ];

        $page['fields'][] = [
            'name' => 'title',
            'type' => 'text',
            'label' => "Subject",
            'helper' => 'The Subject of the message',
            'value' => old('title')
        ];

        $page['fields'][] = [
            'name' => 'body',
            'type' => 'richtext',
            'label' => "Body",
            'helper' => 'The Body of the message',
            'value' => old('body')
        ];


        $page['fields']['users'] = [
            'name' => 'users',
            'type' => 'checkbox-select',
            'label' => "To",
            'helper' => 'The name you want the page to be titled',
            'options' => []
        ];

        foreach(User::all() as $perm){
            $page['fields']['users']['options'][] = [
                'name' => $perm->name,
                'value' => $perm->id,
                'selected' => false
            ];
        }

        return view($page['template'], $page);
    }
}
