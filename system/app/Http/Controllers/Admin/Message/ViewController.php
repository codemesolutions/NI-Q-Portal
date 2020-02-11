<?php

namespace App\Http\Controllers\Admin\Message;

use Illuminate\Http\Request;
use Gufy\PdfToHtml\Config;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Validator;
use App\Form;
use App\Notifications;
use App\PageType;
use App\Menu;
use App\Message;
use App\User;
use App\Conversation;
use App\Donor;

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
                'Status' => function($row){
                    $comments = $row->comments()->orderBy('created_at', 'desc')->first();
                    if(!is_null($comments) && $row->is_new && $comments->from_user_id === 5568){
                       return '<i class="fas fa-comment text-dark mr-1"></i><span class="small text-muted"></span>';
                    }

                    else{
                        return '<i class="fas fa-comment text-primary mr-1"></i><span class="small text-success"></span>';
                    }

                },
                'Subject' => 'subject',
                'Donor' => function($row){
                    $donor = Donor::where('user_id', $row->from_user_id)->orWhere('user_id', $row->to_user_id)->first();
                    if(!is_null($donor)){
                        return $donor->user_id->first_name . ' ' . $donor->user_id->last_name;
                    }

                    return "";

                },
                'Sent Date' => function($row){
                    return date('m-d-Y h:i:s:A', strtotime($row->created_at));
                }

            ],
            'rows' => \App\Ticket::where('is_new', 1)->where('updated_at', '>', Carbon::now()->subdays(7))->orderBy('updated_at', 'desc')->get()
        ];

        $page['list_actions'] = 'admin.sections.message-list-actions';

        $page['update_route'] = Route('admin.message.view');
        $page['create_route'] = Route('admin.message.create');
        $page['view_route'] = Route('admin.message.view');


        return view('admin.tickets-list', $page);
    }

    public function view(Request $request){
        $ticket = \App\Ticket::where('id', $request->query('id'))->first();




        $page = $this->getPage($request);
        $page['ticket'] = $ticket;

        $page['view_route'] = Route('admin.message.view');
        $page['delete_route'] = Route('admin.message.view');
        $page['comments'] = $ticket->comments()->orderBy('created_at', 'asc')->get();
        return view('admin.tickets-single', $page);



    }

    public function create(Request $request)
    {
        $page = $this->getPage($request);

        $page['form_action_route'] = 'admin.message.create';
        $page['users'] = User::orderBy('last_name', 'asc')->paginate(50);

        if($request->has('search')){



            $page['users'] = User::where('first_name', "LIKE", "%".$request->query('search')."%")->orWhere('last_name', "LIKE", "%".$request->query('search')."%")->orderBy('last_name', 'asc')->paginate(50);
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
