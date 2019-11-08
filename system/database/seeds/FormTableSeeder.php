<?php

use Illuminate\Database\Seeder;
use App\Form;
use App\FormType;
use App\FormQuestion;
use App\Question;
use App\QuestionField;
use App\QuestionFieldType;
use App\QuestionFieldValidation;
use App\FormQuestionMap;
use App\QuestionCondition;
use App\QuestionConditionType;
use App\QuestionConditionAction;
use App\User;

class FormTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $form = new Form();
        $form->form_type_id = FormType::where('name', 'public')->first()->id;
        $form->name = "Donor Application";
        $form->active = true;
        $form->save();
        $form->users()->attach(User::where('email', 'jgetner@gmail.com')->first()->id, ['action' => 'notify']);

        
        



        /* mailing address */
        $question = new Question();
        $question->form_id = $form->id;
        $question->question = "<h5>What is your mailing address?</h5>";
        $question->active = true;
        $question->order = 1;
        $question->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'text')->first()->id;
        $field->name = "address";
        $field->value = null;
        $field->label = "Address";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);
        $field->validations()->attach(QuestionFieldValidation::where('name', 'string')->first()->id);

        $fm = new FormQuestionMap();
        $fm->form_id = $form->id;
        $fm->question_id = $question->id;
        $fm->field_id = $field->id;
        $fm->table = "donors";
        $fm->column = "mailing_address";
        $fm->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'text')->first()->id;
        $field->name = "address_2";
        $field->value = null;
        $field->label = "Address Line 2";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();

        $fm = new FormQuestionMap();
        $fm->form_id = $form->id;
        $fm->question_id = $question->id;
        $fm->field_id = $field->id;
        $fm->table = "donors";
        $fm->column = "mailing_address2";
        $fm->save();


        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'text')->first()->id;
        $field->name = "city";
        $field->value = null;
        $field->label = "City";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);
        $field->validations()->attach(QuestionFieldValidation::where('name', 'string')->first()->id);

        $fm = new FormQuestionMap();
        $fm->form_id = $form->id;
        $fm->question_id = $question->id;
        $fm->field_id = $field->id;
        $fm->table = "donors";
        $fm->column = "mailing_city";
        $fm->save();


        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'select')->first()->id;
        $field->name = "state";
        $field->value = null;
        $field->label = "State";
        $field->options = "AL:Alabama, AK:Alaska, AZ:Arizona, AR:Arkansas, CA:California, CO:Colorado, CT:Connecticut, DE:Delaware, DC:District of Columbia, FL:Florida, GA:Georgia, HI:Hawaii, ID:Idaho, IL:Illinois, IN:Indiana, IA:Iowa, KS:Kansas, KY:Kentucky, LA:Louisiana,ME: Maine, MD:Maryland, MA:Massachusetts, MI:Michigan, MN:Minnesota, MS:Mississippi, MO:Missouri, MT:Montana, NE:Nebraska, NV:Nevada, NH:New Hampshire, NJ:New Jersey, NM:New Mexico, NY:New York, NC:North Carolina, ND:North Dakota, OH:Ohio, OK:Oklahoma, OR:Oregon, PN:Pennsylvania, RI:Rhode Island, SC:South Carolina, SD:South Dakota, TN:Tennessee, TX:Texas, UT:Utah, VT:Vermont, VA:Virginia, WA:Washington, WV:West Virginia, WI:Wisconsin, WY:Wyoming";
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);
        $field->validations()->attach(QuestionFieldValidation::where('name', 'string')->first()->id);

        $fm = new FormQuestionMap();
        $fm->form_id = $form->id;
        $fm->question_id = $question->id;
        $fm->field_id = $field->id;
        $fm->table = "donors";
        $fm->column = "mailing_state";
        $fm->save();


        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'text')->first()->id;
        $field->name = "zipcode";
        $field->value = null;
        $field->label = "Zip Code";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);
        $field->validations()->attach(QuestionFieldValidation::where('name', 'numeric')->first()->id);

        $fm = new FormQuestionMap();
        $fm->form_id = $form->id;
        $fm->question_id = $question->id;
        $fm->field_id = $field->id;
        $fm->table = "donors";
        $fm->column = "mailing_zipcode";
        $fm->save();


        
        /* end mailing address */

        /* --------------------------------------------------------------------------------------------------- */

        /* shipping address */

        $question = new Question();
        $question->form_id = $form->id;
        $question->question = "<h5>What is your shipping address?</h5>";
        $question->order = 2;
        $question->active = true;
        $question->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'text')->first()->id;
        $field->name = "address";
        $field->value = null;
        $field->label = "Address";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);
        $field->validations()->attach(QuestionFieldValidation::where('name', 'string')->first()->id);

        $fm = new FormQuestionMap();
        $fm->form_id = $form->id;
        $fm->question_id = $question->id;
        $fm->field_id = $field->id;
        $fm->table = "donors";
        $fm->column = "shipping_address";
        $fm->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'text')->first()->id;
        $field->name = "address_2";
        $field->value = null;
        $field->label = "Address Line 2";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();

        $fm = new FormQuestionMap();
        $fm->form_id = $form->id;
        $fm->question_id = $question->id;
        $fm->field_id = $field->id;
        $fm->table = "donors";
        $fm->column = "shipping_address2";
        $fm->save();


        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'text')->first()->id;
        $field->name = "city";
        $field->value = null;
        $field->label = "City";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);
        $field->validations()->attach(QuestionFieldValidation::where('name', 'string')->first()->id);

        $fm = new FormQuestionMap();
        $fm->form_id = $form->id;
        $fm->question_id = $question->id;
        $fm->field_id = $field->id;
        $fm->table = "donors";
        $fm->column = "shipping_city";
        $fm->save();


        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'select')->first()->id;
        $field->name = "state";
        $field->value = null;
        $field->label = "State";
        $field->options = "AL:Alabama, AK:Alaska, AZ:Arizona, AR:Arkansas, CA:California, CO:Colorado, CT:Connecticut, DE:Delaware, DC:District of Columbia, FL:Florida, GA:Georgia, HI:Hawaii, ID:Idaho, IL:Illinois, IN:Indiana, IA:Iowa, KS:Kansas, KY:Kentucky, LA:Louisiana,ME: Maine, MD:Maryland, MA:Massachusetts, MI:Michigan, MN:Minnesota, MS:Mississippi, MO:Missouri, MT:Montana, NE:Nebraska, NV:Nevada, NH:New Hampshire, NJ:New Jersey, NM:New Mexico, NY:New York, NC:North Carolina, ND:North Dakota, OH:Ohio, OK:Oklahoma, OR:Oregon, PN:Pennsylvania, RI:Rhode Island, SC:South Carolina, SD:South Dakota, TN:Tennessee, TX:Texas, UT:Utah, VT:Vermont, VA:Virginia, WA:Washington, WV:West Virginia, WI:Wisconsin, WY:Wyoming";
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);
        $field->validations()->attach(QuestionFieldValidation::where('name', 'string')->first()->id);

        $fm = new FormQuestionMap();
        $fm->form_id = $form->id;
        $fm->question_id = $question->id;
        $fm->field_id = $field->id;
        $fm->table = "donors";
        $fm->column = "shipping_state";
        $fm->save();


        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'text')->first()->id;
        $field->name = "zipcode";
        $field->value = null;
        $field->label = "Zip Code";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);
        $field->validations()->attach(QuestionFieldValidation::where('name', 'numeric')->first()->id);

        $fm = new FormQuestionMap();
        $fm->form_id = $form->id;
        $fm->question_id = $question->id;
        $fm->field_id = $field->id;
        $fm->table = "donors";
        $fm->column = "shipping_zipcode";
        $fm->save();

        //--------------------------------------------------------------------------------------------------

        $question = new Question();
        $question->form_id = $form->id;
        $question->question = "<h5>What is your date of birth?</h5>";
        $question->order = 3;
        $question->active = true;
        $question->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'text')->first()->id;
        $field->name = "date_of_birth";
        $field->value = null;
        $field->label = "Date of birth";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);
        $field->validations()->attach(QuestionFieldValidation::where('name', 'date')->first()->id);

        $fm = new FormQuestionMap();
        $fm->form_id = $form->id;
        $fm->question_id = $question->id;
        $fm->field_id = $field->id;
        $fm->table = "donors";
        $fm->column = "date_of_birth";
        $fm->save();
        


        //---------------------------------------------------------
        $question = new Question();
        $question->form_id = $form->id;
        $question->question = "<h5>Is your baby older than 3 months?</h5>";
        $question->order = 4;
        $question->active = true;
        $question->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "baby_older_than_3_months";
        $field->value = 'yes';
        $field->label = "Yes";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "baby_older_than_3_months";
        $field->value = 'no';
        $field->label = "No";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);
       

        $qc = new QuestionCondition();
        $qc->field_id = $field->id;
        $qc->question_condition_type_id = QuestionConditionType::where('name', "Value Equals")->first()->id;
        $qc->question_condition_action_id = QuestionConditionAction::where('name', "Wait 90 days")->first()->id;
        $qc->condition = "No";
        $qc->save();

        //----------------------------------------------------------------

        $question = new Question();
        $question->form_id = $form->id;
        $question->question = "<h5>Do you smoke, use tobacco products, e-cigarettes, or wear a nicotine patch?</h5>";
        $question->order = 5;
        $question->active = true;
        $question->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "tabacco";
        $field->value = "Yes";
        $field->label = "Yes";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

        $qc = new QuestionCondition();
        $qc->field_id = $field->id;
        $qc->question_condition_type_id = QuestionConditionType::where('name', "Value Equals")->first()->id;
        $qc->question_condition_action_id = QuestionConditionAction::where('name', "Disqualify")->first()->id;
        $qc->condition = "Yes";
        $qc->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "tabacco";
        $field->value = "No";
        $field->label = "No";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

        //----------------------------------------------------------------------------------------

        
        $question = new Question();
        $question->form_id = $form->id;
        $question->question = "<h5>Have you had a history of recurrent breast yeast infections?</h5>";
        $question->order = 6;
        $question->active = true;
        $question->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "yeast_infections";
        $field->value = "Yes";
        $field->label = "Yes";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

        $qc = new QuestionCondition();
        $qc->field_id = $field->id;
        $qc->question_condition_type_id = QuestionConditionType::where('name', "Value Equals")->first()->id;
        $qc->question_condition_action_id = QuestionConditionAction::where('name', "Disqualify")->first()->id;
        $qc->condition = "Yes";
        $qc->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "yeast_infections";
        $field->value = "No";
        $field->label = "No";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

        //-----------------------------------------------------------------------------------------------------


        $question = new Question();
        $question->form_id = $form->id;
        $question->question = "<h5>Have you been exposed to the Zika virus or have been sexually active with anyone exposed to the Zika virus??</h5>";
        $question->order = 7;
        $question->active = true;
        $question->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "zika_virus";
        $field->value = "Yes";
        $field->label = "Yes";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

        $qc = new QuestionCondition();
        $qc->field_id = $field->id;
        $qc->question_condition_type_id = QuestionConditionType::where('name', "Value Equals")->first()->id;
        $qc->question_condition_action_id = QuestionConditionAction::where('name', "Disqualify")->first()->id;
        $qc->condition = "Yes";
        $qc->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "zika_virus";
        $field->value = "No";
        $field->label = "No";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

        //--------------------------------------------------------------------------------------------------------
       
        $question = new Question();
        $question->form_id = $form->id;
        $question->question = "<h5>Did your baby receive an in utero, blood or platelet transfusion?</h5>";
        $question->order = 8;
        $question->active = true;
        $question->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "utero_blood_platelet_transfusion";
        $field->value = "Yes";
        $field->label = "Yes";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

        $qc = new QuestionCondition();
        $qc->field_id = $field->id;
        $qc->question_condition_type_id = QuestionConditionType::where('name', "Value Equals")->first()->id;
        $qc->question_condition_action_id = QuestionConditionAction::where('name', "Disqualify")->first()->id;
        $qc->condition = "Yes";
        $qc->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "utero_blood_platelet_transfusion";
        $field->value = "No";
        $field->label = "No";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

       



        $question = new Question();
        $question->form_id = $form->id;
        $question->order = 9;
        $question->question = "<h5>Have you ever been denied in the past for trying to donate blood, tissue, or milk?</h5>";
        $question->active = true;
        $question->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "donate_denied_blood_tissue_milk";
        $field->value = "Yes";
        $field->label = "Yes";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "donate_denied_blood_tissue_milk";
        $field->value = "No";
        $field->label = "No";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);




        $question = new Question();
        $question->form_id = $form->id;
        $question->order = 10;
        $question->question = "<h5>Have you been diagnosed with jaundice, liver problems, or disease, viral hepatitis, or tested positive for hepatitis after the age of 11?</h5>";
        $question->active = true;
        $question->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "diagnosed_jaundice_liver_hepatitis";
        $field->value = "Yes";
        $field->label = "Yes";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

        $qc = new QuestionCondition();
        $qc->field_id = $field->id;
        $qc->question_condition_type_id = QuestionConditionType::where('name', "Value Equals")->first()->id;
        $qc->question_condition_action_id = QuestionConditionAction::where('name', "Disqualify")->first()->id;
        $qc->condition = "Yes";
        $qc->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "diagnosed_jaundice_liver_hepatitis";
        $field->value = "No";
        $field->label = "No";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);




        $question = new Question();
        $question->form_id = $form->id;
        $question->order = 11;
        $question->question = "<h5>Do you recall ever receiving Factor VIII or Factor IX for the treatment of bleeding disorders, which have not been heat treated or virally inactivated?</h5>";
        $question->active = true;
        $question->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "factor_viii_factor_xi";
        $field->value = "Yes";
        $field->label = "Yes";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

        $qc = new QuestionCondition();
        $qc->field_id = $field->id;
        $qc->question_condition_type_id = QuestionConditionType::where('name', "Value Equals")->first()->id;
        $qc->question_condition_action_id = QuestionConditionAction::where('name', "Disqualify")->first()->id;
        $qc->condition = "Yes";
        $qc->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "factor_viii_factor_xi";
        $field->value = "No";
        $field->label = "No";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);





        $question = new Question();
        $question->form_id = $form->id;
        $question->question = "<h5>	Have you had any of the following STD's?</h5>";
        $question->order = 12;
        $question->active = true;
        $question->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'checkbox')->first()->id;
        $field->name = "Trichomoniasis";
        $field->value = "Trichomoniasis";
        $field->label = "Trichomoniasis";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();

        $qc = new QuestionCondition();
        $qc->field_id = $field->id;
        $qc->question_condition_type_id = QuestionConditionType::where('name', "Value Equals")->first()->id;
        $qc->question_condition_action_id = QuestionConditionAction::where('name', "Wait 60 days")->first()->id;
        $qc->condition = "Trichomoniasis";
        $qc->save();
        

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'checkbox')->first()->id;
        $field->name = "Syphilis";
        $field->value = "Syphilis";
        $field->label = "Syphilis";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();

        

        $qc = new QuestionCondition();
        $qc->field_id = $field->id;
        $qc->question_condition_type_id = QuestionConditionType::where('name', "Value Equals")->first()->id;
        $qc->question_condition_action_id = QuestionConditionAction::where('name', "Disqualify")->first()->id;
        $qc->condition = "Syphilis";
        $qc->save();
        

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'checkbox')->first()->id;
        $field->name = "HIV_AIDS";
        $field->value = "HIV/AIDS";
        $field->label = "HIV/AIDS";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();

        $qc = new QuestionCondition();
        $qc->field_id = $field->id;
        $qc->question_condition_type_id = QuestionConditionType::where('name', "Value Equals")->first()->id;
        $qc->question_condition_action_id = QuestionConditionAction::where('name', "Disqualify")->first()->id;
        $qc->condition = "HIV/AIDS";
        $qc->save();
        

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'checkbox')->first()->id;
        $field->name = "Genital_Herpes";
        $field->value = "Genital Herpes";
        $field->label = "Genital Herpes";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();

        $qc = new QuestionCondition();
        $qc->field_id = $field->id;
        $qc->question_condition_type_id = QuestionConditionType::where('name', "Value Equals")->first()->id;
        $qc->question_condition_action_id = QuestionConditionAction::where('name', "Wait 60 days")->first()->id;
        $qc->condition = "Genital Herpes";
        $qc->save();
        

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'checkbox')->first()->id;
        $field->name = "Gonorrhea";
        $field->value = "Gonorrhea";
        $field->label = "Gonorrhea";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();

        $qc = new QuestionCondition();
        $qc->field_id = $field->id;
        $qc->question_condition_type_id = QuestionConditionType::where('name', "Value Equals")->first()->id;
        $qc->question_condition_action_id = QuestionConditionAction::where('name', "Wait 60 days")->first()->id;
        $qc->condition = "Gonorrhea";
        $qc->save();
        

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'checkbox')->first()->id;
        $field->name = "Chlamydia";
        $field->value = "Chlamydia";
        $field->label = "Chlamydia";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();

        $qc = new QuestionCondition();
        $qc->field_id = $field->id;
        $qc->question_condition_type_id = QuestionConditionType::where('name', "Value Equals")->first()->id;
        $qc->question_condition_action_id = QuestionConditionAction::where('name', "Wait 60 days")->first()->id;
        $qc->condition = "Chlamydia";
        $qc->save();
       

        
        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'checkbox')->first()->id;
        $field->name = "Viral_Hepatitis";
        $field->value = "Viral Hepatitis";
        $field->label = "Viral Hepatitis";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        

        $qc = new QuestionCondition();
        $qc->field_id = $field->id;
        $qc->question_condition_type_id = QuestionConditionType::where('name', "Value Equals")->first()->id;
        $qc->question_condition_action_id = QuestionConditionAction::where('name', "Disqualify")->first()->id;
        $qc->condition = "Viral Hepatitis";
        $qc->save();

       

        
        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'checkbox')->first()->id;
        $field->name = "none";
        $field->value = "none";
        $field->label = "I do not have any ST's";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        



        $question = new Question();
        $question->form_id = $form->id;
        $question->question = "<h5>Have you been exposed to Hepatitis A and/or received a gamma globulin shot in the last month?</h5>";
        $question->active = true;
        $question->order = 13;
        $question->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "hep_A";
        $field->value = "Yes";
        $field->label = "Yes";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

        $qc = new QuestionCondition();
        $qc->field_id = $field->id;
        $qc->question_condition_type_id = QuestionConditionType::where('name', "Value Equals")->first()->id;
        $qc->question_condition_action_id = QuestionConditionAction::where('name', "Wait 30 days")->first()->id;
        $qc->condition = "Yes";
        $qc->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "hep_A";
        $field->value = "No";
        $field->label = "No";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);




        $question = new Question();
        $question->form_id = $form->id;
        $question->question = "<h5>	Have you been diagnosed with tuberculosis (TB), exposed to TB, had a positive TB skin test or chest x-ray result?</h5>";
        $question->active = true;
        $question->order = 14;
        $question->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "TB";
        $field->value = "Yes";
        $field->label = "Yes";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

        $qc = new QuestionCondition();
        $qc->field_id = $field->id;
        $qc->question_condition_type_id = QuestionConditionType::where('name', "Value Equals")->first()->id;
        $qc->question_condition_action_id = QuestionConditionAction::where('name', "Disqualify")->first()->id;
        $qc->condition = "Yes";
        $qc->save();


        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "TB";
        $field->value = "No";
        $field->label = "No";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);




        $question = new Question();
        $question->form_id = $form->id;
        $question->question = "<h5>Have you been exposed to Mad Cow Disease?</h5>";
        $question->order = 16;
        $question->active = true;
        $question->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "mad_cow";
        $field->value = "Yes";
        $field->label = "Yes";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

        $qc = new QuestionCondition();
        $qc->field_id = $field->id;
        $qc->question_condition_type_id = QuestionConditionType::where('name', "Value Equals")->first()->id;
        $qc->question_condition_action_id = QuestionConditionAction::where('name', "Disqualify")->first()->id;
        $qc->condition = "Yes";
        $qc->save();


        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "mad_cow";
        $field->value = "No";
        $field->label = "No";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);




        $question = new Question();
        $question->form_id = $form->id;
        $question->order = 17;
        $question->question = "<h5>Are you an insulin dependent diabetic?</h5>";
        $question->active = true;
        $question->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "insulin_diabetic";
        $field->value = "Yes";
        $field->label = "Yes";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

        $qc = new QuestionCondition();
        $qc->field_id = $field->id;
        $qc->question_condition_type_id = QuestionConditionType::where('name', "Value Equals")->first()->id;
        $qc->question_condition_action_id = QuestionConditionAction::where('name', "Disqualify")->first()->id;
        $qc->condition = "Yes";
        $qc->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "insulin_diabetic";
        $field->value = "No";
        $field->label = "No";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);


        $question = new Question();
        $question->form_id = $form->id;
        $question->question = "<h5>Do you have heart disease or high blood pressure?</h5>";
        $question->order = 18;
        $question->active = true;
        $question->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "heart_disease_high_blood_pressure";
        $field->value = "Yes";
        $field->label = "Yes";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

        $qc = new QuestionCondition();
        $qc->field_id = $field->id;
        $qc->question_condition_type_id = QuestionConditionType::where('name', "Value Equals")->first()->id;
        $qc->question_condition_action_id = QuestionConditionAction::where('name', "Disqualify")->first()->id;
        $qc->condition = "Yes";
        $qc->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "heart_disease_high_blood_pressure";
        $field->value = "No";
        $field->label = "No";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);


        //----------------------------------------------------------------------------------------------------

        $question = new Question();
        $question->form_id = $form->id;
        $question->order = 19;
        $question->question = "<h5>Have you ever been incarcerated in a correctional facility for 72 consecutive hours?</h5>";
        $question->active = true;
        $question->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "jail_72_hours";
        $field->value = "Yes";
        $field->label = "Yes";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

        $qc = new QuestionCondition();
        $qc->field_id = $field->id;
        $qc->question_condition_type_id = QuestionConditionType::where('name', "Value Equals")->first()->id;
        $qc->question_condition_action_id = QuestionConditionAction::where('name', "Disqualify")->first()->id;
        $qc->condition = "Yes";
        $qc->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "jail_72_hours";
        $field->value = "No";
        $field->label = "No";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);


        $question = new Question();
        $question->form_id = $form->id;
        $question->order = 20;
        $question->question = "<h5>Have you or your partner ever been involved in prostitution?</h5>";
        $question->active = true;
        $question->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "prostitution";
        $field->value = "Yes";
        $field->label = "Yes";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

        $qc = new QuestionCondition();
        $qc->field_id = $field->id;
        $qc->question_condition_type_id = QuestionConditionType::where('name', "Value Equals")->first()->id;
        $qc->question_condition_action_id = QuestionConditionAction::where('name', "Disqualify")->first()->id;
        $qc->condition = "Yes";
        $qc->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "prostitution";
        $field->value = "No";
        $field->label = "No";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);


        $question = new Question();
        $question->form_id = $form->id;
        $question->order = 21;
        $question->question = "<h5>Have you ever used intravenous drugs?</h5>";
        $question->active = true;
        $question->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "intravenous_drugs";
        $field->value = "Yes";
        $field->label = "Yes";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

        $qc = new QuestionCondition();
        $qc->field_id = $field->id;
        $qc->question_condition_type_id = QuestionConditionType::where('name', "Value Equals")->first()->id;
        $qc->question_condition_action_id = QuestionConditionAction::where('name', "Disqualify")->first()->id;
        $qc->condition = "Yes";
        $qc->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "intravenous_drugs";
        $field->value = "No";
        $field->label = "No";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);


        $question = new Question();
        $question->form_id = $form->id;
        $question->order = 22;
        $question->question = "<h5>Have/are you sexually involved with someone who abuses recreational drugs?</h5>";
        $question->active = true;
        $question->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "sexually_involved_with_drugs_partner";
        $field->value = "Yes";
        $field->label = "Yes";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

        $qc = new QuestionCondition();
        $qc->field_id = $field->id;
        $qc->question_condition_type_id = QuestionConditionType::where('name', "Value Equals")->first()->id;
        $qc->question_condition_action_id = QuestionConditionAction::where('name', "Disqualify")->first()->id;
        $qc->condition = "Yes";
        $qc->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "sexually_involved_with_drugs_partner";
        $field->value = "No";
        $field->label = "No";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);



        $question = new Question();
        $question->form_id = $form->id;
        $question->order = 23;
        $question->question = "<h5>Did you visit Europe for 3 months or longer from 1980 to 1996?</h5>";
        $question->active = true;
        $question->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "europe_visit";
        $field->value = "Yes";
        $field->label = "Yes";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

        $qc = new QuestionCondition();
        $qc->field_id = $field->id;
        $qc->question_condition_type_id = QuestionConditionType::where('name', "Value Equals")->first()->id;
        $qc->question_condition_action_id = QuestionConditionAction::where('name', "Disqualify")->first()->id;
        $qc->condition = "Yes";
        $qc->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "europe_visit";
        $field->value = "No";
        $field->label = "No";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);




        $question = new Question();
        $question->form_id = $form->id;
        $question->order = 24;
        $question->question = "<h5>Have/are you sexually involved with someone who is at risk/has HIV, HTLV, Hepatitis, or Hemophilia?</h5>";
        $question->active = true;
        $question->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "sexually_involved_with_hiv_partner";
        $field->value = "Yes";
        $field->label = "Yes";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

        $qc = new QuestionCondition();
        $qc->field_id = $field->id;
        $qc->question_condition_type_id = QuestionConditionType::where('name', "Value Equals")->first()->id;
        $qc->question_condition_action_id = QuestionConditionAction::where('name', "Disqualify")->first()->id;
        $qc->condition = "Yes";
        $qc->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "sexually_involved_with_hiv_partner";
        $field->value = "No";
        $field->label = "No";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);



        

        $question = new Question();
        $question->form_id = $form->id;
        $question->order = 24;
        $question->question = "<h5>Have you had any exposure with someone else’s blood and your mucous membranes, open cuts, or had an accidental needle stick?</h5>";
        $question->active = true;
        $question->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "exposed_blood";
        $field->value = "Yes";
        $field->label = "Yes";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

        $qc = new QuestionCondition();
        $qc->field_id = $field->id;
        $qc->question_condition_type_id = QuestionConditionType::where('name', "Value Equals")->first()->id;
        $qc->question_condition_action_id = QuestionConditionAction::where('name', "Wait 1 year")->first()->id;
        $qc->condition = "Yes";
        $qc->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "exposed_blood";
        $field->value = "No";
        $field->label = "No";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);




        $question = new Question();
        $question->form_id = $form->id;
        $question->order = 25;
        $question->question = "<h5>Do you or anyone that you are in contact with have occupational exposure to environmental pollutants?</h5>";
        $question->active = true;
        $question->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "pollutants";
        $field->value = "Yes";
        $field->label = "Yes";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

        $qc = new QuestionCondition();
        $qc->field_id = $field->id;
        $qc->question_condition_type_id = QuestionConditionType::where('name', "Value Equals")->first()->id;
        $qc->question_condition_action_id = QuestionConditionAction::where('name', "Disqualify")->first()->id;
        $qc->condition = "Yes";
        $qc->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "pollutants";
        $field->value = "No";
        $field->label = "No";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);




        $question = new Question();
        $question->form_id = $form->id;
        $question->order = 26;
        $question->question = "<h5>In the last year, have you been exposed to HIV or AIDS?</h5>";
        $question->active = true;
        $question->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "exposed_hiv";
        $field->value = "Yes";
        $field->label = "Yes";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

        $qc = new QuestionCondition();
        $qc->field_id = $field->id;
        $qc->question_condition_type_id = QuestionConditionType::where('name', "Value Equals")->first()->id;
        $qc->question_condition_action_id = QuestionConditionAction::where('name', "Wait 1 year")->first()->id;
        $qc->condition = "Yes";
        $qc->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "exposed_hiv";
        $field->value = "No";
        $field->label = "No";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);



        $question = new Question();
        $question->form_id = $form->id;
        $question->order = 27;
        $question->question = "<h5>Have you been exposed to rabies or received an injection?</h5>";
        $question->active = true;
        $question->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "rabies";
        $field->value = "Yes";
        $field->label = "Yes";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

        $qc = new QuestionCondition();
        $qc->field_id = $field->id;
        $qc->question_condition_type_id = QuestionConditionType::where('name', "Value Equals")->first()->id;
        $qc->question_condition_action_id = QuestionConditionAction::where('name', "Disqualify")->first()->id;
        $qc->condition = "Yes";
        $qc->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "rabies";
        $field->value = "No";
        $field->label = "No";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

        $question = new Question();
        $question->form_id = $form->id;
        $question->order = 28;
        $question->question = "<h5>Have you received blood, blood products (other than Rhogam), or an organ tissue transplant?</h5>";
        $question->active = true;
        $question->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "blood_transplant";
        $field->value = "Yes";
        $field->label = "Yes";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

        $qc = new QuestionCondition();
        $qc->field_id = $field->id;
        $qc->question_condition_type_id = QuestionConditionType::where('name', "Value Equals")->first()->id;
        $qc->question_condition_action_id = QuestionConditionAction::where('name', "Disqualify")->first()->id;
        $qc->condition = "Yes";
        $qc->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "blood_transplant";
        $field->value = "No";
        $field->label = "No";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

        $question = new Question();
        $question->form_id = $form->id;
        $question->order = 29;
        $question->question = "<h5>Did you receive a Blood Transfusion or Blood Products in the last year?</h5>";
        $question->active = true;
        $question->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "blood_transfusion";
        $field->value = "Yes";
        $field->label = "Yes";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

        $qc = new QuestionCondition();
        $qc->field_id = $field->id;
        $qc->question_condition_type_id = QuestionConditionType::where('name', "Value Equals")->first()->id;
        $qc->question_condition_action_id = QuestionConditionAction::where('name', "Wait 1 year")->first()->id;
        $qc->condition = "Yes";
        $qc->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "blood_transfusion";
        $field->value = "No";
        $field->label = "No";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

        $question = new Question();
        $question->form_id = $form->id;
        $question->order = 29;
        $question->question = "<h5>Have you had surgery that required a blood transfusion in the year?</h5>";
        $question->active = true;
        $question->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "surgery_blood_transfusion";
        $field->value = "Yes";
        $field->label = "Yes";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

        $qc = new QuestionCondition();
        $qc->field_id = $field->id;
        $qc->question_condition_type_id = QuestionConditionType::where('name', "Value Equals")->first()->id;
        $qc->question_condition_action_id = QuestionConditionAction::where('name', "Wait 1 year")->first()->id;
        $qc->condition = "Yes";
        $qc->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "surgery_blood_transfusion";
        $field->value = "No";
        $field->label = "No";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

        $question = new Question();
        $question->form_id = $form->id;
        $question->order = 30;
        $question->question = "<h5>Have you ever been diagnosed with cancer?</h5>";
        $question->active = true;
        $question->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "cancer";
        $field->value = "Yes";
        $field->label = "Yes";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

        $qc = new QuestionCondition();
        $qc->field_id = $field->id;
        $qc->question_condition_type_id = QuestionConditionType::where('name', "Value Equals")->first()->id;
        $qc->question_condition_action_id = QuestionConditionAction::where('name', "Wait 1 year")->first()->id;
        $qc->condition = "Yes";
        $qc->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "cancer";
        $field->value = "No";
        $field->label = "No";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);






        $question = new Question();
        $question->form_id = $form->id;
        $question->order = 31;
        $question->question = "<h5>In the last year have you received a tattoo?</h5>";
        $question->active = true;
        $question->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "tattoo";
        $field->value = "Yes";
        $field->label = "Yes";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

        $qc = new QuestionCondition();
        $qc->field_id = $field->id;
        $qc->question_condition_type_id = QuestionConditionType::where('name', "Value Equals")->first()->id;
        $qc->question_condition_action_id = QuestionConditionAction::where('name', "Wait 1 year")->first()->id;
        $qc->condition = "Yes";
        $qc->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "tattoo";
        $field->value = "No";
        $field->label = "No";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);



        $question = new Question();
        $question->form_id = $form->id;
        $question->order = 32;
        $question->question = "<h5>please list any and all medications, herbal supplements, or vitamins that you are currently taking?</h5>";
        $question->active = true;
        $question->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'textarea')->first()->id;
        $field->name = "medications";
        $field->value = "";
        $field->label = "Medications";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);





        $question = new Question();
        $question->form_id = $form->id;
        $question->order = 33;
        $question->question = "<h5>Are you a US Citizen?</h5>";
        $question->active = true;
        $question->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "us_citizen";
        $field->value = "Yes";
        $field->label = "Yes";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "us_citizen";
        $field->value = "No";
        $field->label = "No";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

        $qc = new QuestionCondition();
        $qc->field_id = $field->id;
        $qc->question_condition_type_id = QuestionConditionType::where('name', "Value Equals")->first()->id;
        $qc->question_condition_action_id = QuestionConditionAction::where('name', "Disqualify")->first()->id;
        $qc->condition = "No";
        $qc->save();




        $question = new Question();
        $question->form_id = $form->id;
        $question->order = 34;
        $question->question = "<h5>Are you vaccinations up to date?</h5>";
        $question->active = true;
        $question->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "vacs_up_to_date";
        $field->value = "Yes";
        $field->label = "Yes";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "vacs_up_to_date";
        $field->value = "No";
        $field->label = "No";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

        $qc = new QuestionCondition();
        $qc->field_id = $field->id;
        $qc->question_condition_type_id = QuestionConditionType::where('name', "Value Equals")->first()->id;
        $qc->question_condition_action_id = QuestionConditionAction::where('name', "Disqualify")->first()->id;
        $qc->condition = "No";
        $qc->save();







        $question = new Question();
        $question->form_id = $form->id;
        $question->order = 35;
        $question->question = "<h5>Are you willing to have a blood test to check for blood born viruses prior to being a qualified donor and during our acceptance of your donating?</h5>";
        $question->active = true;
        $question->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "blood_test_agreement";
        $field->value = "Yes";
        $field->label = "Yes";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'radio')->first()->id;
        $field->name = "blood_test_agreement";
        $field->value = "No";
        $field->label = "No";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

        $qc = new QuestionCondition();
        $qc->field_id = $field->id;
        $qc->question_condition_type_id = QuestionConditionType::where('name', "Value Equals")->first()->id;
        $qc->question_condition_action_id = QuestionConditionAction::where('name', "Disqualify")->first()->id;
        $qc->condition = "No";
        $qc->save();




       





      





        


       




       


      




        


       




        



        


       




       






        




      




       
       


        



      




        $form = new Form();
        $form->form_type_id = FormType::where('name', 'donor')->first()->id;
        $form->name = "Consent Form";
        $form->active = true;
        $form->save();

        $question = new Question();
        $question->form_id = $form->id;
        $question->question = "<h5>Please Download & Sign Our Consent Form</h5>";
        $question->active = true;
        $question->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'file download')->first()->id;
        $field->name = "consent_form";
        $field->label = "consent_form";
        $field->options = NULL;
        $field->download = 'form/[10-15-19] Ni-Q Consent Form.docx';
        $field->save();
        

       
        $question = new Question();
        $question->form_id = $form->id;
        $question->question = "<h5>Please upload your signed consent form</h5>";
        $question->active = true;
        $question->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'file upload')->first()->id;
        $field->name = "consent_form";
        $field->label = "consent_form";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);
        $field->validations()->attach(QuestionFieldValidation::where('name', 'file')->first()->id, ['value' => 'doc,docx']);




        $form = new Form();
        $form->form_type_id = FormType::where('name', 'donor')->first()->id;
        $form->name = "Direct Deposit Form";
        $form->active = true;
        $form->save();

        
        $question = new Question();
        $question->form_id = $form->id;
        $question->question = "<h5>What is your account number?</h5>";
        $question->active = true;
        $question->save();

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'text')->first()->id;
        $field->name = "account_number";
        $field->label = "Account Number";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);

        $field = new QuestionField();
        $field->question_id = $question->id;
        $field->question_field_type_id = QuestionFieldType::where('name', 'text')->first()->id;
        $field->name = "routing_number";
        $field->label = "Routing Number";
        $field->options = NULL;
        $field->download = NULL;
        $field->save();
        $field->validations()->attach(QuestionFieldValidation::where('name', 'required')->first()->id);


        
       
    }
}
