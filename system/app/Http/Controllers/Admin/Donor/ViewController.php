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
use App\User;
use App\Library\DonorAPI;

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
                'Donor ID' => 'donor_number',
                'First Name' => function($row){
                    return $row['user_id']->first_name;
                },
                'Last Name' => function($row){
                    return $row['user_id']->last_name;
                },
                'Email' => function($row){
                    return $row['user_id']->email;
                },
                'Status' => function($row){
                    if($row['active'] == 0){
                        return '<span class="badge badge-danger rounded-0">Inactive</span>';
                    }

                    else{
                        return '<span class="badge badge-success rounded-0">Active</span>';
                    }
                },
            ],
            'rows' => Donor::all()
        ];

        $page['view_route'] = "/admin/donors/donor";
        $page['delete_route'] = "/admin/donors/delete";
        $page['update_route'] = Route('admin.donor.update');
        $page['create_route'] = Route('admin.donor.create');

        return view($page['template'], $page);
    }

    public function single(Request $request)
    {
        $donorID = $request->query('id');
        $page = $this->getPage($request);

       
        $donor = Donor::where('id', $donorID)->first();
       
        
        if(is_null($donor)){
            abort(404);
        }

        
        $page['donor'] = $donor;

        $page['view_route'] = "";
        $page['update_route'] = Route('admin.donor.update');
        $page['create_route'] = Route('admin.donor.create');

        return view($page['template'], $page);
    }

    public function create(Request $request)
    {
        $page = $this->getPage($request);

        $page['form_action_route'] = 'admin.donor.create';

        $page['fields']['user'] = [
            'name' => 'user',
            'type' => 'select',
            'label' => "User",
            'helper' => 'The user account you want to assign the donor to',
            'options' => []
        ];

        foreach(User::all() as $pageType){
            $page['fields']['user']['options'][] = [
                'name' => $pageType->name,
                'value' => $pageType->id,
                'selected' => false
            ];
        }
        
        $page['fields'][] = [
            'name' => 'date_of_birth',
            'type' => 'text',
            'label' => "Date of Birth",
            'helper' => 'Please enter your date of birth (01/01/1999)',
            'value' => old('date_of_birth')
        ];
     
        $page['fields'][] = [
            'name' => 'mailing_address',
            'type' => 'text',
            'label' => "Mailing Address",
            'helper' => 'Your Mailing Address',
            'value' => old('mailing_address')
        ];

        $page['fields'][] = [
            'name' => 'mailing_address2',
            'type' => 'text',
            'label' => "Mailing Address Line 2",
            'helper' => 'Your Mailing Address Line 2',
            'value' => old('mailing_address2')
        ];

        $page['fields'][] = [
            'name' => 'mailing_city',
            'type' => 'text',
            'label' => "Mailing City",
            'helper' => 'Your Mailing City',
            'value' => old('mailing_city')
        ];

        $page['fields'][] = [
            'name' => 'mailing_state',
            'type' => 'text',
            'label' => "Mailing State",
            'helper' => 'Your Mailing state',
            'value' => old('mailing_state')
        ];

        $page['fields'][] = [
            'name' => 'mailing_zipcode',
            'type' => 'text',
            'label' => "Mailing Zip Code",
            'helper' => 'Your Mailing Zip Code',
            'value' => old('mailing_zipcode')
        ];


        $page['fields'][] = [
            'name' => 'shipping_address',
            'type' => 'text',
            'label' => "Shipping Address",
            'helper' => 'Your Shipping Address',
            'value' => old('shipping_address')
        ];

        $page['fields'][] = [
            'name' => 'shipping_address2',
            'type' => 'text',
            'label' => "Shipping Address Line 2",
            'helper' => 'Your Shipping Address Line 2',
            'value' => old('shipping_address2')
        ];

        $page['fields'][] = [
            'name' => 'shipping_city',
            'type' => 'text',
            'label' => "Shipping City",
            'helper' => 'Your Shipping City',
            'value' => old('shipping_city')
        ];

        $page['fields'][] = [
            'name' => 'shipping_state',
            'type' => 'text',
            'label' => "Shipping State",
            'helper' => 'Your Shipping state',
            'value' => old('shipping_state')
        ];

        $page['fields'][] = [
            'name' => 'shipping_zipcode',
            'type' => 'text',
            'label' => "Shipping Zip Code",
            'helper' => 'Your Shipping Zip Code',
            'value' => old('shipping_zipcode')
        ];


        $page['fields'][] = [
            'name' => 'consent_form',
            'type' => 'file',
            'label' => "Consent Form",
            'helper' => 'Upload the signed consent form',
            'value' => old('consent_form')
        ];


        $page['fields'][] = [
            'name' => 'notes',
            'type' => 'textarea',
            'label' => "Notes",
            'helper' => 'Notes',
            'value' => old('notes')
        ];

        $page['fields'][] = [
            'name' => 'use_mailing_address',
            'type' => 'checkbox',
            'label' => "Use Mailing Address as shipping address",
            'value' => old('use_mailing_address'),
            'checked' => false
        ];
       

        $page['fields'][] = [
            'name' => 'active',
            'type' => 'checkbox',
            'label' => "Active",
            'checked' => false,
        ];

        return view($page['template'], $page);
    }

    public function update(Request $request)
    {
        $donor = Donor::where('id', $request->query('id'))->first();

        if(is_null($donor)){
            abort(404);
        }

        $page = $this->getPage($request);

        $page['form_action_route'] = 'admin.donor.update';

        $page['fields'][] = [
            'name' => 'id',
            'type' => 'hidden',
            'value' => $donor->id,
        ];


        $page['fields']['user'] = [
            'name' => 'user',
            'type' => 'select',
            'label' => "User",
            'helper' => 'The user account you want to assign the donor to',
            'options' => []
        ];

        foreach(User::all() as $pageType){
            if($donor->user_id->id == $pageType->id){
                $page['fields']['user']['options'][] = [
                    'name' => $pageType->name,
                    'value' => $pageType->id,
                    'selected' => true
                ];
            }

            else{
                $page['fields']['user']['options'][] = [
                    'name' => $pageType->name,
                    'value' => $pageType->id,
                    'selected' => false
                ];
            }
          
        }
        
        $page['fields'][] = [
            'name' => 'date_of_birth',
            'type' => 'text',
            'label' => "Date of Birth",
            'helper' => 'Please enter your date of birth (01/01/1999)',
            'value' => is_null(old('date_of_birth')) ? $donor->date_of_birth: old('date_of_birth')
        ];
     
        $page['fields'][] = [
            'name' => 'mailing_address',
            'type' => 'text',
            'label' => "Mailing Address",
            'helper' => 'Your Mailing Address',
            'value' => is_null(old('mailing_address')) ? $donor->mailing_address: old('mailing_address')
        ];

        $page['fields'][] = [
            'name' => 'mailing_address2',
            'type' => 'text',
            'label' => "Mailing Address Line 2",
            'helper' => 'Your Mailing Address Line 2',
            'value' => is_null(old('mailing_address2')) ? $donor->mailing_address2: old('mailing_address2')
        ];

        $page['fields'][] = [
            'name' => 'mailing_city',
            'type' => 'text',
            'label' => "Mailing City",
            'helper' => 'Your Mailing City',
            'value' => is_null(old('mailing_city')) ? $donor->mailing_city: old('mailing_city')
        ];

        $page['fields'][] = [
            'name' => 'mailing_state',
            'type' => 'text',
            'label' => "Mailing State",
            'helper' => 'Your Mailing state',
            'value' => is_null(old('mailing_state')) ? $donor->mailing_state: old('mailing_state')
        ];

        $page['fields'][] = [
            'name' => 'mailing_zipcode',
            'type' => 'text',
            'label' => "Mailing Zip Code",
            'helper' => 'Your Mailing Zip Code',
            'value' => is_null(old('mailing_zipcode')) ? $donor->mailing_zipcode: old('mailing_zipcode')
        ];


        $page['fields'][] = [
            'name' => 'shipping_address',
            'type' => 'text',
            'label' => "Shipping Address",
            'helper' => 'Your Shipping Address',
            'value' => is_null(old('shipping_address')) ? $donor->shipping_address: old('shipping_address')
        ];

        $page['fields'][] = [
            'name' => 'shipping_address2',
            'type' => 'text',
            'label' => "Shipping Address Line 2",
            'helper' => 'Your Shipping Address Line 2',
            'value' => is_null(old('shipping_address2')) ? $donor->shipping_address2: old('shipping_address2')
        ];

        $page['fields'][] = [
            'name' => 'shipping_city',
            'type' => 'text',
            'label' => "Shipping City",
            'helper' => 'Your Shipping City',
            'value' => is_null(old('shipping_city')) ? $donor->shipping_city: old('shipping_city')
        ];

        $page['fields'][] = [
            'name' => 'shipping_state',
            'type' => 'text',
            'label' => "Shipping State",
            'helper' => 'Your Shipping state',
            'value' => is_null(old('shipping_state')) ? $donor->shipping_state: old('shipping_state')
        ];

        $page['fields'][] = [
            'name' => 'shipping_zipcode',
            'type' => 'text',
            'label' => "Shipping Zip Code",
            'helper' => 'Your Shipping Zip Code',
            'value' => is_null(old('shipping_zipcode')) ? $donor->shipping_zipcode: old('shipping_zipcode')
        ];


        $page['fields'][] = [
            'name' => 'consent_form',
            'type' => 'file',
            'label' => "Consent Form",
            'helper' => 'Upload the signed consent form',
            'value' => old('consent_form')
        ];

        $page['fields'][] = [
            'name' => 'notes',
            'type' => 'textarea',
            'label' => "Notes",
            'helper' => 'Notes',
            'value' => is_null(old('notes')) ? $donor->notes: old('notes')
        ];

     

        $page['fields'][] = [
            'name' => 'consent_form',
            'type' => 'checkbox',
            'label' => "Consent Form",
            'value' => is_null(old('consent_form')) ? $donor->consent_form: old('consent_form'),
            'checked' => $donor->consent_form
        ];
        

        $page['fields'][] = [
            'name' => 'financial_form',
            'type' => 'checkbox',
            'label' => "Financial Form",
            'value' => is_null(old('financial_form')) ? $donor->financial_form: old('financial_form'),
            'checked' => $donor->financial_form
        ];

       

        $page['fields'][] = [
            'name' => 'active',
            'type' => 'checkbox',
            'label' => "Active",
            'checked' => $donor->active,
        ];

        return view($page['template'], $page);
    }
}
