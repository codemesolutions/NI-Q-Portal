<?php

namespace App\Http\Controllers\Admin\Submission;

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
use App\QuestionAnswer;
use App\FormSubmission;
use App\FormQuestionMap;
use App\Permission;
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
        $form_id = $request->query('id');

        $form = Form::where('id', $form_id)->first();


        if(is_null($form)){
            return redirect()->back()->with('error', 'Invalid Form Id');
        }

        $page = $this->getPage($request);



        $page['datasets']['list'] = [
            'columns' => [
                'First Name' => function($row){
                    $user = User::where('id', $row->user_id->id)->first();
                    return $user->first_name;
                },
                'Last Name' => function($row){
                    $user = User::where('id', $row->user_id->id)->first();
                    return $user->last_name;
                },
                'Email' => function($row){
                    $user = User::where('id', $row->user_id->id)->first();
                    return $user->email;
                },

                'Disqualified' => function($row){
                    if($row->blocked){
                        return '<span class="badge badge-danger rounded-0 px-3">Disqualified</span>';
                    }

                    else{
                        return '';
                    }
                },
                'Completed' => function($row){
                    if($row->completed){
                        return '<span class="badge badge-success rounded-0 px-3">Yes</span>';
                    }

                    else{
                        return '<span class="badge badge-danger rounded-0 px-3">No</span>';
                    }
                },
                'Question' => function($row) use($form){
                    $total = $form->questions()->count();

                    $count = 0;
                    foreach($form->questions()->orderBy('order')->get() as $q){
                        $answer = QuestionAnswer::where('user_id', $row->user_id->id)->where('question_id', $q->id)->first();

                        if(is_null($answer)){
                            $count;
                            break;
                        }

                        $count++;
                    }

                    return $count . "/" . $total;
                },
            ],

            'rows' => FormSubmission::where('form_id', $form->id)->where('is_new', true)->get()
        ];

        $page['update_route'] = Route('admin.form.update');
        $page['create_route'] = url('/')."/form?name=".$form->name;
        $page['view_route'] = "/admin/forms/submissions/submission?form=". $form->name;


        return view($page['template'], $page);
    }

    public function single(Request $request)
    {

        $form_id = $request->query('form');
        $submission = $request->query('id');

        $form = Form::where('name', $form_id)->first();


        if(is_null($form)){
            return redirect()->back()->with('error', 'Invalid Form Id');
        }

        $page = $this->getPage($request);

        $page['submission'] = FormSubmission::where('id', $submission)->first();



        $page['datasets']['list'] = [
            'columns' => [

                'Blocked' => 'blocked',
                'Question' => 'question_id',
            ],

            'rows' => $form->questions()->orderBy('order')->get()
        ];

        $page['forms'] = Form::where('form_type_id', '!=', FormType::where('name', 'Lab')->first()->id)->where('active', true)->get();


        $page['form_action_route'] = 'admin.forms.questions.save';
        $page['update_route'] = Route('admin.form.update');
        $page['create_route'] = url('/')."/form?name=".$form->name;
        $page['view_route'] = "/form?name=". $form->name;

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
            'validation-types' => QuestionFieldValidation::all()
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

        $menu = Form::where('id', $request->query('id'))->firstOrFail();

        $page = $this->getPage($request);

        $page['form_action_route'] = 'admin.form.update';

        $page['fields'][] = [
            'name' => 'id',
            'type' => 'hidden',
            'value' => $request->query('id'),
        ];

        $page['fields'][] = [
            'name' => 'name',
            'type' => 'text',
            'label' => "Name",
            'helper' => 'The name you want the menu to be referenced in the system',
            'value' => $menu->name
        ];

        $page['fields'][] = [
            'name' => 'description',
            'type' => 'textarea',
            'label' => "Description",
            'helper' => 'The name you want the menu to be referenced in the system',
            'value' => $menu->description
        ];

        $page['fields']['type'] = [
            'name' => 'type',
            'type' => 'select',
            'label' => "Type",
            'helper' => 'The name you want the page to be titled',
            'options' => []
        ];

        foreach(FormType::all() as $pageType){
            $page['fields']['type']['options'][] = [
                'name' => $pageType->name,
                'value' => $pageType->id,
                'selected' => $pageType->name === $menu->form_type_id ? true:false
            ];
        }

        $page['fields']['donors'] = [
            'name' => 'donors',
            'type' => 'checkbox-select',
            'label' => "Donors",
            'helper' => 'The name you want the page to be titled',
            'options' => []
        ];

        foreach(Donor::all() as $perm){
            $page['fields']['donors']['options'][] = [
                'name' => $perm->name,
                'value' => $perm->id,
                'selected' => false
            ];
        }

        $page['fields'][] = [
            'name' => 'approval',
            'type' => 'checkbox',
            'label' => "Requires Approval",
            'checked' => $menu->requires_approval == 1 ? true:false,
        ];

        $page['fields'][] = [
            'name' => 'status',
            'type' => 'checkbox',
            'label' => "Active",
             'checked' => $menu->active == 'Active' ? true:false
        ];

        return view($page['template'], $page);
    }

    public function map(Request $request){
        if(!$request->has('submission')){
            return redirect()->back();
        }

        $submission = FormSubmission::where('id', $request->input('submission'))->first();

        if(is_null($submission)){
            return redirect()->back()->with('errors', "Submission not found!");
        }

        $form = Form::where('id', $submission->form_id)->first();
        $questions = $form->questions()->get();

        $insert = [];
        foreach($questions as $question){
            $fields = $question->fields()->get();
            foreach($fields as $field){
                $map = FormQuestionMap::where('form_id', $form->id)
                    ->where('question_id', $question->id)
                    ->where('field_id', $field->id)->first();

                if(!is_null($map)){

                    if(!isset($insert[$map->table])){
                        $insert[$map->table] = [];
                    }

                    $answer = QuestionAnswer::where('form_id', $form->id)
                    ->where('question_id', $question->id)
                    ->where('field_id', $field->id)
                    ->where('user_id', $submission->user_id->id)
                    ->first();


                    if(!is_null($map->value)){
                        $insert[$map->table][$map->column] = $map->value;
                    }

                    elseif(is_null($map->value) && !is_null($answer)){
                        $insert[$map->table][$map->column] = $answer->answer;
                    }

                    else{
                        $insert[$map->table][$map->column] = null;
                    }
                }

            }
        }

        if(is_null($submission->user_id->donors()->first())){
            foreach($insert as $table => $col){
                $col['active'] = true;
                $col['user_id'] =  $submission->user_id->id;
                $col['donor_number'] = \uniqid();
                $col['created_at'] = now();
                $col['updated_at'] = now();
                $inserted = \DB::table($table)->insert($col);
            }
        }

        else{

            foreach($insert as $table => $col){

                $inserted = \DB::table($table)->where('user_id', $submission->user_id->id)->update($col);
            }
        }




        $submission->user_id->permissions()->attach(Permission::where('name', 'Donor')->first()->id);

        $submission->is_new = false;
        $submission->update();

        if($request->has('forms')){
            foreach($request->input('forms') as $formId => $status){

                $_form = Form::where('id', $formId)->first();
                $submission->user_id->forms()->attach($_form->id, ['action' => 'assign']);

                $user = new \App\Notifications();
                $user->notification_type_id = \App\NotificationTypes::where('name', 'Form Assigned')->first()->id;
                $user->message = 'You have been assigned form: ' . $_form->name;
                $user->resource = '/donor/form';
                $user->save();
                $user->users()->attach($submission->user_id->id);
            }
        }

        if($form->name == 'Donor Application'){

            mail(
                $submission->user_id->email,
                'NI-Q - Congratulations you have been approved!',
                "Ni-Q has reviewed your application and we are excited to notify you that you have been accepted as a donor. The next step in the process is reading and signing the consent and financial forms.
                 Ni-Q requires these forms filled out. At the end of the year, Ni-Q will provide you with a 1099 form. It will be your responsibility to incorporate this in filing your taxes.
                 Thank you for choosing to donate with Ni-Q! \n <a href='https://portal.ni-q.com'>Click here to login into your donor account!</a>",
                'From: erica@ni-q.com' . "\r\n" .
                'Reply-To: erica@ni-q.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion()."\r\n".
                'MIME-Version: 1.0' . "\r\n".
                'Content-type: text/html; charset=iso-8859-1' . "\r\n"
            );


            $donor = $submission->user_id->donors()->first();
            $api = new DonorAPI('https://donortrack.ni-q.com:443/', 'api1', 'Api1Rand0M');

            $_response = $api->post('api/donor', [
                "Url"=> "",
                "DonorId"=> $donor->donor_number,
                "FirstName"=> $donor->user_id->first_name,
                "LastName"=> $donor->user_id->last_name,
                "DateOfBirth"=> $donor->date_of_birth,
                "Email"=> $donor->user_id->email,
                "ReceiveConsentForm"=> $donor->recieved_consent_form,
                "ReceiveFinancialForm"=> $donor->recieved_finacial_form,
                "InactiveDate"=> "",
                "InactiveReason"=> "",
                "Active"=> $donor->active,
                "Notes"=> ""
            ]);

            if($_response !== 400){
                $api->post('api/donor/'.$donor->donor_number.'/mailingaddress', [
                    "DonorId"=> $donor->donor_number,
                    "DonorUrl"=> null,
                    "Address1"=> $donor->mailing_address,
                    "Address2"=> $donor->mailing_address2,
                    "City"=> $donor->mailing_city,
                    "State"=> $donor->mailing_state,
                    "Zipcode"=> $donor->mailing_zipcode
                ]);

                $api->post('api/donor/'.$donor->donor_number.'/shippingaddress', [
                    "DonorId"=> $donor->donor_number,
                    "DonorUrl"=> null,
                    "Address1"=> $donor->shipping_address,
                    "Address2"=> $donor->shipping_address2,
                    "City"=> $donor->shipping_city,
                    "State"=> $donor->shipping_state,
                    "Zipcode"=> $donor->shipping_zipcode
                ]);
            }

            elseif($_response === 400){
                throw new \Exception("Unable to create donor in donor track!  Please contact IT!");
            }



        }

        elseif($form->name == "NI-Q Consent Form" || $form->name == "Consent Form"){

            if($request->has('lab_order')){

                $path = $request->lab_order->store('form');

                $form = new Form();
                $form->name = "Lab Order - ". $submission->user_id->first_name . " " . $submission->user_id->last_name;
                $form->form_type_id = FormType::where('name', 'Lab')->first()->id;
                $form->active = true;
                $form->save();
                $form->users()->attach( $submission->user_id->id, ['action' => 'assign']);

                $question = new \App\Question();
                $question->form_id = $form->id;
                $question->question = "<p>Ni-Q is excited to advance you to the next step in the process to becoming a donor with Ni-Q! The next step is to have your blood drawn. We have partnered with Quest Diagnostics Labs to complete the blood draw and testing.  Our partnership allows the full process, from the blood draw to the testing to be provided to you free of charge.</p>

                <p>Attached is your Quest Diagnostics Lab Order Form. The Order Form provides directions to visit Quest Diagnostics Website to locate the lab nearest you and schedule an appointment at your convenience. Please remember to take the form with you to the lab when you go.

                Again, there is no charge to you or your insurance for the blood draw or testing. We understand that it is a detailed process to become a breastmilk donor, and our goal is to make that as easy and efficient as possible for you. </p>

                <p>Thank you for choosing to become a donor with Ni-Q.  Your contributions are directly making an impact to the health of premature infants across the country. We are committed to working with you to ensure you have a great experience as a donor.

                After printing and completing the blood work, please push submit in the lower left corner. </p>";
                $question->active = true;
                $question->order = 1;
                $question->save();

                $field = new \App\QuestionField();
                $field->question_id = $question->id;
                $field->question_field_type_id = \App\QuestionFieldType::where('name', 'file download')->first()->id;
                $field->name = "lab_order";
                $field->value = null;
                $field->label = "Lab Order";
                $field->options = NULL;
                $field->download = $path;
                $field->save();

                mail(
                    $submission->user_id->email,
                    'Ni-Q is excited to advance you to the next step in the process to becoming a donor with Ni-Q!',
                    "The final step is to have your blood drawn. We have partnered with Quest Diagnostics Labs to complete the blood draw and testing.  Our partnership allows the full process, from the blood draw to the testing to be provided to you FREE of charge.
                    Attached is your Quest Diagnostics Lab Order Form. The Order Form provides directions to visit Quest Diagnostics Website to locate the lab nearest you and schedule an appointment at your convenience. Please remember to take the form with you to the lab when you go.
                    Again, there is no charge to you or your insurance for the blood draw or testing. DO NOT take give them your insurance card. We understand that it is a detailed process to become a breastmilk donor, and our goal is to make it as easy and efficient as possible for you.
                    Thank you for choosing to become a donor with Ni-Q.  Your contributions are directly making an impact to the health of premature infants across the country. We are committed to working with you to ensure you have a great experience as a donor.
                    As soon as lab results are back, Ni-Q will notify you to request a milk kit and get started!
                    After printing and completing the blood work, please push submit in the lower left corner.
                     <br /> <a href='https://portal.ni-q.com'>Click here to login into your donor account!</a>",
                    'From: erica@ni-q.com' . "\r\n" .
                    'Reply-To: erica@ni-q.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion()."\r\n".
                    'MIME-Version: 1.0' . "\r\n".
                    'Content-type: text/html; charset=iso-8859-1' . "\r\n"
                );

            }
        }

        $user = new \App\Notifications();
        $user->notification_type_id = \App\NotificationTypes::where('name', 'Donor Approved')->first()->id;
        $user->message = 'Congratuations you have been approved.';
        $user->resource = '/donor/form';
        $user->save();
        $user->users()->attach($submission->user_id->id);





        return redirect('/admin/forms/form?id='. $submission->form_id)->with('success', 'Submission was proccessed');
    }
}
