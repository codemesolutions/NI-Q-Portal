<?php

namespace App\Http\Controllers\Admin\Submission;

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
use App\NotificationTypes;
use App\Donor;
use App\Question;
use App\QuestionType;
use App\QuestionField;
use App\QuestionCondition;

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
            'question' => ['required', 'string'],
            'form' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        else{
           
            $question = new Question();
            $question->form_id = $request->input('form');
            $question->question = $request->input('question');
            $question->has_why_field = $request->input('why_field') == "on" ? true:false;
            $question->additional_info_field = $request->input('additional_info_field') == "on" ? true:false;
            $question->active = $request->input('status') == "on" ? true:false;
            $question->save();

            if($request->input('why_field') == "on"){
                $fields = new QuestionField();
                $fields->question_id = $question->id;
                $fields->question_field_type_id = 4;
                $fields->name =  "why";
                $fields->save();
            }

            if($request->input('additional_info_field') == "on"){
                $fields = new QuestionField();
                $fields->question_id = $question->id;
                $fields->question_field_type_id = 4;
                $fields->name =  "additional information";
                $fields->save();
            }
            
            $notify = new Notifications();
            $notify->notification_type_id = NotificationTypes::where('name', 'form created')->first()->id;
            $notify->message = 'There was a new form "'. $question->question .'" created';
            $notify->resource = Route('admin.forms');
            $notify->save();

            

            if($request->has('fields')){
                foreach($request->input('fields') as $k => $field){
                    if($k > 0 && !is_null($field) && is_array($field)){
                        $fields = new QuestionField();
                        $fields->question_id = $question->id;
                        $fields->question_field_type_id = $field['type'];
                        $fields->name =  $field['name'];
                        $fields->label = $field['label'];
                        $fields->value = $field['value'];
                        

                        if(isset($field['options'])){
                            $fields->options = $field['options'];
                        }

                        if(isset($request->file()['fields'][$k])){
                           
                            $fields->download = $request->file()['fields'][$k]['download']->store('form');
                        }


                        $fields->save();

                        if(isset($field['validation'])){
                            foreach($field['validation'] as $rule){
                                $fields->validations()->attach($rule['type'], ['value' => $rule['value']]); 
                            }
                        }
                    }
                }
            }

            

            if($request->has('conditions')){
                foreach($request->input('conditions') as $k => $field){
                    if($k > 0 && !is_null($field) && is_array($field)){
                        $fields = QuestionField::where('question_id', $question->id)->get();
                        

                        $cons = new QuestionCondition();
                        $cons->field_id = $fields[($field['field'] - 1)]->id;
                        $cons->question_condition_type_id = $field['type'];
                        $cons->condition =  $field['value'];
                        $cons->save();
                        
                    }
                }
               
            }
           
            return redirect()->route('admin.forms.questions', ['id' => $request->input('form')]);
        }

    }


    public function update(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required'],
            'id' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        else{
            $user = \App\Form::where('id', $request->input('id'))->first();
            $user->name = $request->input('name');
            $user->description = $request->input('description');
            $user->form_type_id = $request->input('type');
            $user->requires_approval = !is_null($request->input('approval')) && $request->input('approval') == 'on' ? true:false; 
            $user->active = !is_null($request->input('status')) && $request->input('status') == 'on' ? true:false; 
            $user->update();

           
            return redirect()->route('admin.form');
        }

    }


  
}
