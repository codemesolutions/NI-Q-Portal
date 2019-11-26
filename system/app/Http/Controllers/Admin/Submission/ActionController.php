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
use App\FormSubmission;
use App\QuestionAnswer;

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

    public function deny(Request $request){
        $sub = FormSubmission::where('id', $request->input('id'))->first();

        if(is_null($sub)){
            return redirect()->back()->with('error', "could not find submission");
        }

        if($sub->form_id == 1){
            $sub->blocked = true;
            $sub->is_new = false;
            $sub->update();
        }

        return redirect('/admin/forms/form?id='. $sub->form_id)->with('success', 'Submission was processed');
    }

    public function resubmit(Request $request){
        $sub = FormSubmission::where('id', $request->input('id'))->first();

        if(is_null($sub)){
            return redirect()->back()->with('error', "could not find submission");
        }

        $sub->blocked = false;
        $sub->waited = false;
        $sub->completed = false;
        $sub->is_new = true;
        $sub->update();

        $qa = \App\QuestionAnswer::where('form_id', $sub->form_id)->where('user_id', $sub->user_id->id)->get();

        foreach($qa as $a){
            $a->delete();
        }

        mail(
            $sub->user_id->email,
            'NI-Q - Please Re-Submit ' . Form::where('id', $sub->form_id)->first()->name,
            "Ni-Q is notifying you of an incomplete submission in the donor portal. Log into the Ni-Q donor portal and review the new form carefully before submitting the form. <br /> <a href='https://portal.ni-q.com'>Click here to login into your donor account!</a>",
            'From: erica@ni-q.com' . "\r\n" .
            'Reply-To: erica@ni-q.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion()."\r\n".
            'MIME-Version: 1.0' . "\r\n".
            'Content-type: text/html; charset=iso-8859-1' . "\r\n"
        );

        return redirect('/admin/forms/form?id='. $sub->form_id)->with('success', 'Re-Submit Forced');
    }

}
