<?php

namespace App\Http\Controllers\Admin\Question;

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
use App\FormQuestionMap;

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
            'fields.*' => [new \App\Rules\Fields, new \App\Rules\Type]
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
            $question->order = $request->input('order');
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
           
            

            if($request->has('fields')){


                foreach($request->input('fields') as $k => $field){
                    if($k > 0 && !is_null($field) && is_array($field)){
                        $fields = new QuestionField();
                        $fields->question_id = $question->id;
                        $fields->question_field_type_id = $field['type'];
                        $fields->name =  $field['name'];
                        $fields->label = $field['label'];
                        $fields->value = $field['value'];
                        $fields->field_order = $field['order'];
                        

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
                        $cons->question_condition_action_id = $field['action'];
                        $cons->condition =  $field['value'];
                        $cons->show_date_field = isset($field['date']) && $field['date'] == "on" ? true:false;
                        $cons->save();
                        
                    }
                }
               
               
            }
           
            return redirect()->route('admin.form', ['id' => $request->input('form')]);
        }

    }


    public function update(Request $request){

        
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'numeric'],
            'question' => ['required', 'string'],
            'fields.*' => [new \App\Rules\Fields, new \App\Rules\Type],
            'order' => ['required', 'numeric']
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        else{

            

            $question = Question::where('id', $request->input('id'))->firstOrFail();
            $question->question = $request->input('question');
            $question->order = $request->input('order');
            $question->has_why_field = $request->input('why_field') == "on" ? true:false;
            $question->additional_info_field = $request->input('additional_info_field') == "on" ? true:false;
            $question->active = $request->input('status') == "on" ? true:false;
            $question->update();

            QuestionField::where('question_id', $question->id)->delete();

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
                        $fields->field_order = $field['order'];
                        

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
                        $cons->question_condition_action_id = $field['action'];
                        $cons->condition =  $field['value'];
                        $cons->show_date_field = isset($field['date']) && $field['date'] == "on" ? true:false;
                        $cons->save(); 
                        
                    }
                }

            
               
            }
           
            return redirect()->route('admin.forms.question', ['id' => $request->input('id')])->with('success', "Question Updated Successfully");
        }

    }


    public function map(Request $request){
        $validator = Validator::make($request->all(), [
            'form' => ['required', 'numeric'],
            'questions' => ['required']
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

       
        foreach($request->input('questions') as $questionId => $questionFields){
            foreach($questionFields as $qfield => $tableCol){
                
                $fqm = FormQuestionMap::where('form_id', $request->input('form'))
                    ->where('question_id', $questionId)
                    ->where('field_id', $qfield)->first();
                    
                $col = str_replace(' ', '', $tableCol['col']);
                $parts = explode(":", $col);
                
                
                if(is_null($fqm)){
                   
                    $fqm = new FormQuestionMap();
                    $fqm->form_id = $request->input('form');
                    $fqm->question_id = $questionId;
                    $fqm->field_id = $qfield;
                    $fqm->table = $parts[0];
                    $fqm->column = $parts[1];
                    $fqm->value = $tableCol['val'];
                    $fqm->save();
                    return redirect('/admin/forms/form?id='.$request->input('form'))->with('success', "Successfully saved map");
                }

                else{
                  
                    $fqm->table = $parts[0];
                    $fqm->column = $parts[1];
                    $fqm->value = $tableCol['val'];
                    $fqm->update();
                    return redirect('/admin/forms/form?id='.$request->input('form'))->with('success', "Successfully updated map");
                }
            }
        }

       
    }

    public function delete(Request $request){
        $form = Question::where('id', $request->query('id'))->firstOrFail();
        $formId = $form->form_id;
        $form->delete();

        return redirect()->route('admin.form', ['id' => $formId])->with('success', 'Successfully deleted question');
     }
}
