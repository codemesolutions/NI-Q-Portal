<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Form;
use App\FormType;
use Validator;
use App\QuestionAnswer;
use App\QuestionFieldType;
use App\FormSubmission;
use App\Setting;
use App\Question;

class PublicFormController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    
    }

    public function form(Request $request)
    {
        $name = $request->query('name');
        $_question = $request->query('id');
        
        $formTypePublic = FormType::where('name', 'public')->first();
        $form = Form::where('name', $name)->where('form_type_id', $formTypePublic->id)->where('active', true)->first();

        if(is_null($form)){
            abort(404, 'No Form');
        }

        $fs = FormSubmission::where('form_id', $form->id)->where('user_id', $request->user()->id)->first();

        if(!is_null($fs) && $fs->blocked){
            return redirect('/form/disqualified');
        }
        
        elseif(!is_null($fs) && $fs->waited){
            return redirect('/form/waitlisted');
        }

        elseif(!is_null($fs) && $fs->completed){
            return redirect('/form/thankyou');
        }

        
        $questions = $form->questions()->where('id', $_question)->first();

        if(is_null($questions)){
            $questions = $form->questions()->orderby('order')->first();

            if(is_null($questions)){
                abort(404);
            }
        }

        
        $answer = QuestionAnswer::where('user_id', $request->user()->id)->where('question_id', $questions->id)->first();

        $nextQ = $questions->id;
        $redirect = false;
        $thankyou = false;
       
        if(!is_null($answer)){
            $qs = Question::where('form_id', $form->id)->orderBy('order')->get();
            foreach($qs as $k => $q){
                if($q->id == $nextQ){
                    if(isset($qs[$k + 1])){
                        $nextQ = $qs[$k + 1]->id;
                        $redirect = true;
                        break;
                    }

                    else{
                        $redirect = true;
                        $thankyou = true;
                    }
                    
                }
            }
        }

        if($redirect && !$thankyou){
            return redirect("/form?name=". $form->name . "&id=" . $nextQ);
        }

        elseif($redirect && $thankyou){
            return redirect("/form/thankyou");
        }

        $number = 1;

        foreach($form->questions()->orderBy('order')->get() as $q){
            if($q->id == $questions->id){
                break;
            }

            $number++;
        }

        $page = $this->getPage($request);
        $page['current_question_number'] = $number;
        $page['question_total'] = $form->questions()->count();
        $page['question'] = $questions;
        $page['title'] = $form->name;
        $page['form_id'] = $form->id;
 

        return view($page['template'], $page);
    }

    public function formSubmit(Request $request){
        $validator = Validator::make($request->all(), [
            'question' => ['required', 'numeric'],
            'form' => ['required', 'string'],
           
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $form = Form::where('name', $request->input('form'))->first();
        $_question = $form->questions()->where('id', $request->input('question'))->first();

        $fields = $_question->fields()->get();
        $fieldValidations = [];
        $fieldConditions  = [];

        foreach($fields as $field){
            if($field->validations()->count() > 0){
                if(!isset($fieldValidations[$field->name])){
                    $fieldValidations[$field->name] = [];
                }

                $fieldValidations[$field->name] = $field->validations()->get();
            }

            if($field->conditions()->count() > 0){
                if(!isset($fieldConditions[$field->name])){
                    $fieldConditions[$field->name] = [];
                }

                $fieldConditions[$field->name] = $field->conditions()->get();
            }
        }

        $validateArray = [];
       
        if(count($fieldValidations) > 0){
            foreach($fieldValidations as $name => $rules){

                foreach($rules as $rule){
                    if(!isset($validateArray[$name])){
                        $validateArray[$name] = [];
                    }
                    
                   
                    if(is_null($rule->pivot->value)){
                        $validateArray[$name][] = $rule->name;
                    }

                    elseif($rule->name == "file"){
                        $validateArray[$name."*"][] = "mimes:" . $rule->pivot->value;
                    }
    
                    else{
                        $validateArray[$name][] = $rule->name . ":" . $rule->pivot->value;
                    }
                }
               
               
            }
        }
        
       
        $validator = Validator::make($request->all(), $validateArray);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

       $disqualified = false;
       $waited = false;

        if(count($fieldConditions) > 0){
            foreach($fieldConditions as $fieldName => $condition){
                if($request->has($fieldName)){
                    foreach($condition as $con){
                        if($request->input($fieldName) === $con->condition){
                           
                            if($con->actions()->first()->name == "Disqualify"){
                              
                                $disqualified = true;
                                break;
                            }

                            else{
                                $waited = true;
                                $waitTime = 14;

                                if($con->actions()->first()->name === "Wait 14 days"){
                                    $waitTime = 14;
                                }

                                elseif($con->actions()->first()->name === "Wait 30 days"){
                                    $waitTime = 30;
                                }

                                elseif($con->actions()->first()->name === "Wait 60 days"){
                                    $waitTime = 60;
                                }

                                elseif($con->actions()->first()->name === "Wait 90 days"){
                                    $waitTime = 90;
                                }

                                elseif($con->actions()->first()->name === "Wait 6 months"){
                                    $waitTime = 182;
                                }

                                elseif($con->actions()->first()->name === "Wait 9 months"){
                                    $waitTime = (182 + 60);
                                }

                                elseif($con->actions()->first()->name === "Wait 1 year"){
                                    $waitTime = (182 * 2);
                                }
                               
                            }
                            
                        }

                        
                    }
                }
            }
        }



        foreach($fields as $field){
           
            if($field->question_field_type_id->name ==='file upload'){
               
                $answer = $request->file($field->name)->store('submissions');
               
                if(!is_null($answer) && $answer !== false){
                    $qa = new QuestionAnswer();
                    $qa->form_id = $form->id;
                    $qa->question_id = $_question->id;
                    $qa->field_id = $field->id;
                    $qa->user_id = $request->user()->id;
                    $qa->answer = $answer;
                   
                    $qa->save();
                }

            }

            else{
                
                $answer = $request->input($field->name);
            
                if(!is_null($answer) && $answer !== false){
                    $qa = new QuestionAnswer();
                    $qa->form_id = $form->id;
                    $qa->question_id = $_question->id;
                    $qa->field_id = $field->id;
                    $qa->user_id = $request->user()->id;
                    $qa->answer = $answer;
                    $qa->save();
                }
            }

        }

        $fs = FormSubmission::where('user_id', $request->user()->id)->where('form_id', $form->id)->first();

        if(is_null($fs)){
            $fs = new FormSubmission();
            $fs->form_id = $form->id;
            $fs->question_id = $_question->id;
            $fs->user_id = $request->user()->id;
            $fs->save();
        }

        

        if($disqualified){
            $fs->blocked = true;
            $fs->update();

            return redirect('/form/disqualified');
        }

        elseif($waited){
            $fs->waited = true;
            $fs->waited_time = date('Y-m-d', strtotime(date('Y-m-d'). ' + '.$waitTime.' days'));
            $fs->update();
            return redirect('/form/waitlisted');
        }

        $questions = $form->questions()->orderBy('order')->get();
        $nextQuestion = null;
        
        foreach($questions as $index => $question){
           
            if($question->id === $_question->id){
                //check to see if there is a next question
                if(isset($questions[$index + 1])){
                    $nextQuestion = $questions[$index + 1];
                   
                    break;
                }
            }
        }



        if(!is_null($nextQuestion)){
            $fs->question_id = $nextQuestion->id;
            $fs->update();

            return redirect('/form?name='. $form->name . '&id=' . $nextQuestion->id);

        }

        else{
            $fs->completed = true;
            $fs->update();

            $notify = new \App\Notifications();
            $notify->notification_type_id = \App\NotificationTypes::where('name', 'form submission')->first()->id;
            $notify->message = 'There is a new ' . $form->name . ' submission!';
            $notify->resource = '/admin/forms/submissions/submission?form='.$form->name.'&id=' . $fs->id;
            $notify->save();

            
            
            foreach($form->users()->where('action', 'notify')->get() as $user)
            {
                $notify->users()->attach($user->id);
            }

            return redirect('/form/thankyou');
        }
    }

    public function thankyou(Request $request){
        $page = $this->getPage($request);
        $page['ty_title'] = \App\Setting::where('name', 'Completed Donor Title')->first()->value;
        $page['ty_message'] = \App\Setting::where('name', 'Completed Donor Message')->first()->value;
        return view($page['template'], $page);
    }

    public function disqualified(Request $request){
        $page = $this->getPage($request);
        $page['disqualified_title'] = \App\Setting::where('name', 'Disqualified Donor Title')->first()->value;
        $page['disqualified_message'] = \App\Setting::where('name', 'Disqualified Donor Message')->first()->value;
        return view($page['template'], $page);
    }

    public function waitlisted(Request $request){
        $page = $this->getPage($request);
        $page['wait_title'] = \App\Setting::where('name', 'Wait Listed Donor Title')->first()->value;
        $page['wait_message'] = \App\Setting::where('name', 'Wait Listed Donor Message')->first()->value;
        $submission = FormSubmission::where('user_id', $request->user()->id)->where('form_id', 1)->first();
        $page['time'] = $submission->waited_time;
        return view($page['template'], $page);
    }


    public function file(Request $request, $file){
        return response()->download(storage_path() .'/app/form/'. $file);
    }

}
