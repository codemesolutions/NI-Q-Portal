<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Gufy\PdfToHtml\Config;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;
use App\Http\Controllers\Controller;
use Validator;
use App\Form;
use App\FormPage;
use App\FormType;
use DB;
use Carbon\Carbon;
use App\Notifications;
use App\NotificationTypes;

class FormPageController extends Controller
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

    public function page(Request $request){

        $form = Form::where('name', $request->route('form'))->first();
        $formPage;

        if(is_null($request->route('page'))){
            $formPage = Form::where('name', $request->route('form'))->first()->pages()->first();
        }

        else{
            $formPage = Form::where('name', $request->route('form'))->first()->pages()->where('name', $request->route('page'))->first();
        }

       
        

        return view('admin.preview', [
            'footer' => false,
            'types' => FormType::all(),
            'form' => $form,
            'site_menu' => \App\Menu::where('name', 'Site Menu')->first(),
            'form_page' => $formPage,
            
        ]);
    }

    public function submit(Request $request){
       
        $form = Form::where('name', $request->route('form'))->first();
        $formPageLast = $form->pages()->get()->last();
        $formPageFirst = $form->pages()->get()->first();
        $formPage = $form->pages()->where('name', $request->route('page'))->first();

        if($formPageFirst->id === $formPage->id){
            
            $request->session()->put($request->ip(), -1);
           
        }

        $vals = [];

        foreach($formPage->fields()->get() as $field){
            if($field->rules()->count() > 0){
                $fn = str_replace(' ', '_', $field->name);
                $vals[$fn] = [];
                foreach($field->rules()->get() as $rule){
                    $vals[$fn][] = $rule->rule;
                }
            }
           
        }

        
       // dd($request->all());

        $validator = Validator::make($request->all(), $vals);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

       
        $reqData = array_change_key_case($request->all(), CASE_LOWER);

        if(isset($reqData['_token'])){
            unset($reqData['_token']);
        }

        if(count($reqData) > 0){
            $reqData['created_at'] = Carbon::now();
            $reqData['updated_at'] = Carbon::now();
           
            if($request->session()->get($request->ip()) == -1){
                DB::table($form->table_name)->insert($reqData); 
                $request->session()->put($request->ip(), DB::getPdo()->lastInsertId());
            }

            else{
                DB::table($form->table_name)->where('id', $request->session()->get($request->ip()))->update($reqData);
            }
            
        }
       


        $notify = new Notifications();
        $notify->notification_type_id = NotificationTypes::where('name', 'form submission')->first()->id;
        $notify->message = 'There was a new '. $form->name .' form submission';
        $notify->resource = Route('admin.forms.submissions') . '?id=' . $form->id;
        $notify->save();
        
        return redirect($formPage->redirect_url)->with('success','Permission updated successfully!');
    }

    public function save(Request $request){

        $validator = Validator::make($request->all(), [
            'form' => ['required','numeric'],
            'name' => ['required', 'string', 'max:255'],
            'url'  => ['required'],
            'redirect' => ['required']
            
            
        ]);

        if ($validator->fails()) {
            return redirect('admin/forms/create?id='.$request->input('form'))
                        ->withErrors($validator)
                        ->withInput();
        }

        else{
            $user                 = new FormPage();
            $user->form_id        = $request->input('form');
            $user->name           = $request->input('name');
            $user->url            = $request->input('url');
            $user->redirect_url   = $request->input('redirect');
            $user->description    = $request->input('description');
            $user->keywords       = $request->input('keywords');
            $user->active         = !is_null($request->input('active')) && $request->input('active') == 'on' ? true:false; 
            $user->save();

            return redirect('admin/forms/create?id='. $user->form_id  .'&page='. $user->id )->with('success','Form Page created successfully!');
        }

    }


    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'form' => ['required','numeric'],
            'name' => ['required', 'string', 'max:255'],
            'url'  => ['required'],
            'redirect' => ['required'],
            'page' => ['required', 'numeric']
            
            
        ]);

        if ($validator->fails()) {
            return redirect('admin/forms/create?id='.$request->input('form'))
                        ->withErrors($validator)
                        ->withInput();
        }

        else{
            $user                 = FormPage::where('id', $request->input('page'))->first();
            $user->form_id        = $request->input('form');
            $user->name           = $request->input('name');
            $user->url            = $request->input('url');
            $user->redirect_url   = $request->input('redirect');
            $user->description = $request->input('description');
            $user->keywords = $request->input('keywords');
            $user->active = !is_null($request->input('active')) && $request->input('active') == 'on' ? true:false; 
            $user->update();

            return redirect('admin/forms/create?id='. $user->form_id  .'&page='. $user->id )->with('success','Form Page created successfully!');
        }

    }

    public function preview(Request $request){
        return view('admin.preview', [
            'footer' => false,
            'types' => \App\FormType::all(),
            'form' => \App\Form::where('id', $request->query('id'))->first(),
            'site_menu' => \App\Menu::where('name', 'Site Menu')->first(),
            'form_page' => \App\FormPage::where('id', $request->query('page'))->first(),
            
        ]);
    }


  
}
