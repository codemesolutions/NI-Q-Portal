<?php

namespace App\Http\Controllers\Admin\Donor;

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
use App\Donor;
use App\Library\DonorAPI;

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
            'user' => ['required', 'integer'],
            'date_of_birth' => ['required', 'date'],
            'mailing_address' => ['required', 'string'],
            'mailing_city' => ['required', 'string'],
            'mailing_state' => ['required', 'string'],
            'mailing_zipcode' => ['required', 'numeric'],
            'active' => ['required'],
            'shipping_address' => ['sometimes', 'nullable', 'string'],
            'shipping_city' => ['sometimes', 'nullable', 'string'],
            'shipping_state' => ['sometimes','nullable', 'string'],
            'shipping_zipcode' => ['sometimes', 'nullable', 'numeric'],
            'consent_form' => ['sometimes', 'nullable', 'mimes:doc,docx'],
        ]);

        

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        else{
            $user = new \App\Donor();
            $user->user_id = $request->input('user');
            $user->donor_number = \uniqid();
            $user->date_of_birth = $request->input('date_of_birth');
            $user->mailing_address= $request->input('mailing_address');
            $user->mailing_address2= $request->input('mailing_address2');
            $user->mailing_city= $request->input('mailing_city');
            $user->mailing_state= $request->input('mailing_state');
            $user->mailing_zipcode= $request->input('mailing_zipcode');
            if($request->input('use_mailing_address') == "on"){
                $user->shipping_address= $request->input('mailing_address');
                $user->shipping_address2= $request->input('mailing_address2');
                $user->shipping_city= $request->input('mailing_city');
                $user->shipping_state= $request->input('mailing_state');
                $user->shipping_zipcode= $request->input('mailing_zipcode');
            }

            else{
                $user->shipping_address= $request->input('shipping_address');
                $user->shipping_address2= $request->input('shipping_address2');
                $user->shipping_city= $request->input('shipping_city');
                $user->shipping_state= $request->input('shipping_state');
                $user->shipping_zipcode= $request->input('shipping_zipcode');
            }

            $user->active = $request->input('active') == "on" ? true:false;

            if(isset($request->consent_form)){
                $user->consent_form = $request->consent_form->store('form');
                $user->recieved_consent_form = true;
            }
            
          
            $user->save();

            $api = new DonorAPI('https://donortrack.ni-q.com:443/', 'api1', 'Api1Rand0M');

            try{
                $api->post('api/donor', [
                    "Url"=> "",
                    "DonorId"=> $user->id,
                    "FirstName"=> $user->user_id->first_name,
                    "LastName"=> $user->user_id->last_name,
                    "DateOfBirth"=> $user->date_of_birth,
                    "Email"=> $user->user_id->email,
                    "ReceiveConsentForm"=> $user->recieved_consent_form,
                    "ReceiveFinancialForm"=> $user->recieved_finacial_form,
                    "InactiveDate"=> "",
                    "InactiveReason"=> "",
                    "Active"=> $user->active,
                    "Notes"=> ""
                ]);
            }catch(Exception $e){
                return redirect()->route('admin.donors')->with('success','Donor created successfully!');
            }
           

            $api->post('api/donor/'.$user->id.'/mailingaddress', [
                "DonorId"=> $user->id,
                "DonorUrl"=> null,
                "Address1"=> $user->mailing_address,
                "Address2"=> $user->mailing_address2,
                "City"=> $user->mailing_city,
                "State"=> $user->mailing_state,
                "Zipcode"=> $user->mailing_zipcode
            ]);

            $api->post('api/donor/'.$user->id.'/shippingaddress', [
                "DonorId"=> $user->id,
                "DonorUrl"=> null,
                "Address1"=> $user->shipping_address,
                "Address2"=> $user->shipping_address2,
                "City"=> $user->shipping_city,
                "State"=> $user->shipping_state,
                "Zipcode"=> $user->shipping_zipcode
            ]);

            return redirect()->route('admin.donors')->with('success','Donor created successfully!');
        }

    }


    public function update(Request $request){

        $validator = Validator::make($request->all(), [
            'id'   => ['required'],
            'user' => ['required', 'integer'],
            'date_of_birth' => ['required', 'date'],
            'mailing_address' => ['required', 'string'],
            'mailing_city' => ['required', 'string'],
            'mailing_state' => ['required', 'string'],
            'mailing_zipcode' => ['required', 'numeric'],
            'active' => ['required'],
            'shipping_address' => ['string'],
            'shipping_city' => [ 'string'],
            'shipping_state' => [ 'string'],
            'shipping_zipcode' => [ 'numeric'],
            'consent_form' => [ 'mimes:doc, docx'],
        ]);

        if ($validator->fails()) {
            return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        else{
            $user = \App\Donor::where('id', $request->input('id'))->first();
            $user->user_id = $request->input('user');
            $user->date_of_birth = $request->input('date_of_birth');
            $user->mailing_address= $request->input('mailing_address');
            $user->mailing_address2= $request->input('mailing_address2');
            $user->mailing_city= $request->input('mailing_city');
            $user->mailing_state= $request->input('mailing_state');
            $user->mailing_zipcode= $request->input('mailing_zipcode');
            $user->shipping_address= $request->input('shipping_address');
            $user->shipping_address2= $request->input('shipping_address2');
            $user->shipping_city= $request->input('shipping_city');
            $user->shipping_state= $request->input('shipping_state');
            $user->shipping_zipcode= $request->input('shipping_zipcode');
            $user->active = $request->input('active') == "on" ? true:false;
            $user->update();
            
            return redirect()->route('admin.donor', ['id' => $user->id])->with('success','Donor updated successfully!');
        }

    }

    public function delete(Request $request){
        $form = Donor::where('id', $request->query('id'))->firstOrFail();
        $form->active = false;
        $form->update();
        return redirect()->route('admin.donors')->with('success', 'Successfully inactivated Donor', $form->id);
     }


  
}
