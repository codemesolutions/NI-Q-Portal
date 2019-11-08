<?php

namespace App\Http\Controllers\Admin\Question;

use Illuminate\Http\Request;
use Gufy\PdfToHtml\Config;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;
use App\Http\Controllers\Controller;
use Validator;
use App\Form;
use App\FormType;
use App\Notifications;
use App\PageType;
use App\Menu;
use App\Donor;
use App\User;
use App\Question;
use App\QuestionType;
use App\QuestionConditionType;
use App\QuestionFieldType;
use App\QuestionFieldValidation;
use App\FormQuestionMap;
use App\QuestionConditionAction;

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
        $form_id = $request->query('id');

        $form = Form::where('id', $form_id)->first();

        if(is_null($form)){
            return redirect()->back()->with('error', 'Invalid Form Id');
        }

        $page = $this->getPage($request);
        
        $page['datasets']['list'] = [
            'columns' => [
                'Question' => function($row){
                    return strip_tags($row['question']);
                },
            ],
            'rows' => $form->questions()->orderBy('order', 'desc')->get()
        ];

        $page['show_map'] = true;
        $page['update_route'] = Route('admin.forms.questions.update', ['form' => $form->id]);
        $page['create_route'] = Route('admin.forms.questions.create', ['form' => $form->id]);
        $page['map_route'] = Route('admin.forms.questions.map', ['form' => $form->id]);
        $page['view_route'] = "/form?name=". $form->name;


        return view($page['template'], $page);
    }

    public function single(Request $request)
    {
       
        $id = $request->query('id');
        
        $page = $this->getPage($request);

  
        $results = Question::where('id', $id)->first();
       
        
        if(is_null($results)){
            abort(404);
        }

        
        $page['data_item'] = $results;

        
        $page['previous'] = '/admin/forms/form?id=' . $results->form_id->id;
        $page['delete_route'] = Route('admin.forms.questions.delete');
        $page['update_route'] = Route('admin.forms.questions.update');
        
        return view($page['template'], $page);
    }

    public function map(Request $request)
    {
        $form_id = $request->query('id');

        $form = Form::where('id', $form_id)->first();

        if(is_null($form)){
            return redirect()->back()->with('error', 'Invalid Form Id');
        }

        $page = $this->getPage($request);

        $page['form_action_route'] = 'admin.forms.questions.map.save';

        $page['fields'][] = [
            'name' => 'form',
            'type' => 'hidden',
            'value' => $form->id,
        ];
        
        $page['datasets']['questions'] = [
            'rows' => $form->questions()->get()
        ];

        $tables = [];

        foreach(\DB::select('SHOW TABLES') as $table){
            $columns = \DB::getSchemaBuilder()->getColumnListing($table->Tables_in_portaldb);
            $tables[$table->Tables_in_portaldb] = $columns;
        }

        $page['datasets']['map'] = [
            'rows' => FormQuestionMap::where('form_id', $form->id)->get()
        ];

        $page['datasets']['tables'] = [
            'rows' =>  $tables
        ];

        $page['form'] = $form;

        return view($page['template'], $page);
    }

    public function create(Request $request)
    {
        $form_id = $request->query('id');

        $form = Form::where('id', $form_id)->first();

        if(is_null($form)){
            return redirect()->back()->with('error', 'Invalid Form Id');
        }

        $page = $this->getPage($request);

        $page['form_action_route'] = 'admin.forms.questions.save';

        $page['fields'][] = [
            'name' => 'form',
            'type' => 'hidden',
            'value' => $form->id,
        ];
        

        
        $page['fields'][] = [
            'name' => 'question',
            'type' => 'richtext',
            'label' => "Question",
            'helper' => 'The name you want the menu to be referenced in the system',
            'value' => old('question')
        ];

       

        $page['fields'][] = [
            'name' => 'fields[]',
            'type' => 'fields',
            'button' => "Add Fields",
            'helper' => 'The name you want the menu to be referenced in the system',
            'field-types' => QuestionFieldType::all(),
            'condition-types' => QuestionConditionType::all(), 
            'condition-actions' => QuestionConditionAction::all(),
            'validation-types' => QuestionFieldValidation::all() 
        ];


        $page['fields'][] = [
            'name' => 'order',
            'type' => 'number',
            'label' => "Order",
            'helper' => 'The order number for this question',
            'value' => is_null(old('order')) ? 0 : old('order') 
        ];

        $page['fields'][] = [
            'name' => 'why_field',
            'type' => 'checkbox',
            'label' => "Has a why field?",
            'checked' => false,
        ];

        $page['fields'][] = [
            'name' => 'additional_info_field',
            'type' => 'checkbox',
            'label' => "Has additional information field?",
            'checked' => false,
        ];


        $page['fields'][] = [
            'name' => 'status',
            'type' => 'checkbox',
            'label' => "Active",
            'checked' => false,
        ];

       

        return view($page['template'], $page);
    }

    public function update(Request $request)
    {
       
        $q = Question::where('id', $request->query('id'))->firstOrFail();
       
        $page = $this->getPage($request);

        $page['question'] = $q;

        $page['form_action_route'] = 'admin.forms.questions.update';

        $page['fields'][] = [
            'name' => 'id',
            'type' => 'hidden',
            'value' => $request->query('id'),
        ];

             
        $page['fields'][] = [
            'name' => 'question',
            'type' => 'richtext',
            'label' => "Question",
            'helper' => 'The name you want the menu to be referenced in the system',
            'value' => is_null(old('question')) ? $q->question:old('question')
        ];

       

        $page['fields'][] = [
            'name' => 'fields[]',
            'type' => 'fields',
            'button' => "Add Fields",
            'helper' => 'The name you want the menu to be referenced in the system',
            'field-types' => QuestionFieldType::all(),
            'condition-types' => QuestionConditionType::all(), 
            'condition-actions' => QuestionConditionAction::all(),
            'validation-types' => QuestionFieldValidation::all() 
        ];


        $page['fields'][] = [
            'name' => 'order',
            'type' => 'number',
            'label' => "Order",
            'helper' => 'The order number for this question',
            'value' => is_null(old('order')) ? $q->order: old('older') 
        ];

        $page['fields'][] = [
            'name' => 'why_field',
            'type' => 'checkbox',
            'label' => "Has a why field?",
            'checked' => old('why_field') == 1 || $q->has_why_field == 1 ? true:false,
        ];

        $page['fields'][] = [
            'name' => 'additional_info_field',
            'type' => 'checkbox',
            'label' => "Has additional information field?",
            'checked' => old('additional_info_field') == 1 || $q->additional_info_field == 1 ? true:false,
        ];


        $page['fields'][] = [
            'name' => 'status',
            'type' => 'checkbox',
            'label' => "Active",
            'checked' => old('active') == 1 || $q->active == 1 ? true:false,
        ];

        return view($page['template'], $page);
    }
}
