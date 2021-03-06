<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\FormPageField;
use App\FormPage;
use App\ValidationRule;

class FormPageFieldController extends Controller
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

    public function save(Request $request){
       //dd($request->all());
        $validator = Validator::make($request->all(), [
            'form' => ['required','numeric'],
            'page' => ['required','numeric'],
            'name' => ['required', 'string', 'max:255'],
            'type'  => ['required'],
            'position' => ['numeric']
        ]);

        

        if ($validator->fails()) {
            return redirect('admin/forms/create?id='.$request->input('form') . '&page=' . $request->input('page'))
                        ->withErrors($validator)
                        ->withInput();
        }

        else{

            $user                 = new FormPageField();
            $user->form_page_id   = $request->input('page');
            $user->name           = $request->input('name');
            $user->type           = $request->input('type');
            $user->input_id       = $request->input('id');
            $user->class          = $request->input('classes');
            $user->placeholder    = $request->input('placeholder');
            $user->style          = $request->input('style');
            $user->value          = $request->input('value');
            $user->label          = $request->input('label');
            $user->helper_text    = $request->input('text');
            $user->options        = $request->input('options');
            $user->position       = $request->input('position');
            $user->mapped_table    = !is_null($request->input('map')) ? explode(':', trim($request->input('map')))[0]:null;
            $user->mapped_column   = !is_null($request->input('map')) ? explode(':', trim($request->input('map')))[1]:null;
            $user->save();

            if(!is_null($request->input('rules'))){
                foreach($request->input('rules') as $rule){
                    $user->rules()->attach(ValidationRule::where('id', $rule)->first());
                }
            }
           

            return redirect('admin/forms/create?id='. $request->input('form')  .'&page='. $request->input('page') )->with('success','Form Page created successfully!');
        }

    }


    public function update(Request $request){

        $validator = Validator::make($request->all(), [
            'form' => ['required','numeric'],
            'page' => ['required','numeric'],
            'name' => ['required', 'string', 'max:255'],
            'type'  => ['required'],
            'field' => ['required', 'numeric'],
            'position' => ['numeric']
        ]);

        

        if ($validator->fails()) {
            return redirect('admin/forms/create?id='.$request->input('form') . '&page=' . $request->input('page'))
                        ->withErrors($validator)
                        ->withInput();
        }

        else{

            $user                 = FormPageField::where('id', $request->input('field'))->first();
            $user->form_page_id   = $request->input('page');
            $user->name           = $request->input('name');
            $user->type           = $request->input('type');
            $user->input_id       = $request->input('id');
            $user->class          = $request->input('classes');
            $user->placeholder    = $request->input('placeholder');
            $user->style          = $request->input('style');
            $user->value          = $request->input('value');
            $user->label          = $request->input('label');
            $user->helper_text    = $request->input('text');
            $user->position       = $request->input('position');
            $user->update();

            return redirect('admin/forms/create?id='. $request->input('form')  .'&page='. $request->input('page') )->with('success','Form Page created successfully!');
        }

    }


    public function updatePosition(Request $request){

        $validator = Validator::make($request->all(), [
            'form' => ['required','numeric'],
            'page' => ['required','numeric'],
            'field' => ['required', 'numeric'],
            'position' => ['numeric']
        ]);

        

        if ($validator->fails()) {
            return redirect('admin/forms/create?id='.$request->input('form') . '&page=' . $request->input('page'))
                        ->withErrors($validator)
                        ->withInput();
        }

        else{

            $user                 = FormPageField::where('id', $request->input('field'))->first();
            $user->form_page_id   = $request->input('page');
            $user->position       = $request->input('position');
            $user->update();

            return redirect('admin/forms/create?id='. $request->input('form')  .'&page='. $request->input('page') )->with('success','Form Page created successfully!');
        }

    }

    public function delete(Request $request){
        FormPage::where('id', $request->query('page'))->first()->fields()->where('id', $request->query('field'))->delete();
        return redirect('admin/forms/create?id='.  $request->query('form')  .'&page='. $request->query('page') )->with('success','Form Page created successfully!');
    }
  
}
