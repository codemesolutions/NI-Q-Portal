<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gufy\PdfToHtml\Config;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;
use App\Message;
use Illuminate\Support\Str;
use App\Conversation;

use FedEx\PickupService\Request as PRequest;
use FedEx\PickupService\ComplexType as PComplexType;
use FedEx\PickupService\SimpleType as PSimpleType;

use FedEx\TrackService\Request as TRequest;
use FedEx\TrackService\ComplexType;
use FedEx\TrackService\SimpleType;

define('FEDEX_ACCOUNT_NUMBER', '510087240');
define('FEDEX_METER_NUMBER', '118745553');
define('FEDEX_KEY', '7dXXlfnIegr0yM1k');
define('FEDEX_PASSWORD', 'RQUJyjDYYlISpefPrqPktnXc1');


class DonorController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {


        $page = $this->getPage($request);

        if(!is_array($page)){
            return redirect($page);
        }

        return view($page['template'], $page);
    }

    public function form(Request $request, $form)
    {
        $page = $this->getPage($request);
        return view($page['template'], $page);
    }

    public function forms(Request $request)
    {
        $page = $this->getPage($request);
        return view($page['template'], $page);
    }

    public function milkkitSend(Request $request)
    {
        if(!is_null($request->user()->donors()->first())){
            if(is_null(\App\Shipping::where('donor_id', $request->user()->donors()->first()->id)->where('type', 'send')->first())){
                $user = new \App\Shipping();
                $user->type = "send";
                $user->donor_id  = $request->user()->donors()->first()->id;
                $user->save();
                return redirect()->back()->with('success', "Milk Kit Request Sent");
            }

            else{
                return redirect()->back()->with('success', "There is a milk kit on its way request already active");
            }

        }

        else{
            return redirect()->back()->with('errors', "Invalid donor ID");
        }
    }

    public function milkkitPickup(Request $request)
    {
        if(!is_null($request->user()->donors()->first())){
            if(is_null(\App\Shipping::where('donor_id', $request->user()->donors()->first()->id)->where('type', 'pickup')->first())){

                $createPickupRequest = new PComplexType\CreatePickupRequest();
                // Authentication & client details.
                $createPickupRequest->WebAuthenticationDetail->UserCredential->Key = FEDEX_KEY;
                $createPickupRequest->WebAuthenticationDetail->UserCredential->Password = FEDEX_PASSWORD;
                $createPickupRequest->ClientDetail->AccountNumber = FEDEX_ACCOUNT_NUMBER;
                $createPickupRequest->ClientDetail->MeterNumber = FEDEX_METER_NUMBER;
                // Version.
                $createPickupRequest->Version->ServiceId = 'disp';
                $createPickupRequest->Version->Major = 17;
                $createPickupRequest->Version->Intermediate = 0;
                $createPickupRequest->Version->Minor = 0;
                $createPickupRequest->TransactionDetail->CustomerTransactionId = 'Ni-Q Milk Kit Pickup';
                $createPickupRequest->TransactionDetail->Localization->LanguageCode = 'EN';
                $createPickupRequest->TransactionDetail->Localization->LocaleCode = 'ES';
                // Associated account number.
                $createPickupRequest->AssociatedAccountNumber->Type = PSimpleType\AssociatedAccountNumberType::_FEDEX_EXPRESS;
                $createPickupRequest->AssociatedAccountNumber->AccountNumber = FEDEX_ACCOUNT_NUMBER;
                // Origin detail contact.
                $createPickupRequest->OriginDetail->PickupLocation->Contact->ContactId = $request->user()->id;
                $createPickupRequest->OriginDetail->PickupLocation->Contact->PersonName = $request->user()->first_name . " " . $request->user()->last_name;
                $createPickupRequest->OriginDetail->PickupLocation->Contact->Title = 'Ms.';
                $createPickupRequest->OriginDetail->PickupLocation->Contact->CompanyName = '';
                $createPickupRequest->OriginDetail->PickupLocation->Contact->PhoneNumber = $request->user()->home_phone;
                $createPickupRequest->OriginDetail->PickupLocation->Contact->EMailAddress = $request->user()->email;
                // Origin detail address.

                $createPickupRequest->OriginDetail->PickupLocation->Address->StreetLines = [$request->user()->donors()->first()->shipping_address, $request->user()->donors()->first()->shipping_address2];
                $createPickupRequest->OriginDetail->PickupLocation->Address->City = $request->user()->donors()->first()->shipping_city;
                $createPickupRequest->OriginDetail->PickupLocation->Address->StateOrProvinceCode = $request->user()->donors()->first()->shipping_state;
                $createPickupRequest->OriginDetail->PickupLocation->Address->PostalCode = $request->user()->donors()->first()->shipping_zipcode;
                $createPickupRequest->OriginDetail->PickupLocation->Address->CountryCode = 'US';
                $createPickupRequest->OriginDetail->PackageLocation = PSimpleType\PickupBuildingLocationType::_FRONT;
                $createPickupRequest->OriginDetail->BuildingPart = PSimpleType\BuildingPartCode::_DEPARTMENT;
                $createPickupRequest->OriginDetail->BuildingPartDescription = 'By the front door';


                $createPickupRequest->OriginDetail->ReadyTimestamp = date('Y-m-d') . "T19:00:00";




                $createPickupRequest->OriginDetail->CompanyCloseTime = '20:00:00';

                //dd($createPickupRequest->OriginDetail->ReadyTimestamp);

                $createPickupRequest->PackageCount = 1;
                $createPickupRequest->TotalWeight->Units = PSimpleType\WeightUnits::_LB;
                $createPickupRequest->TotalWeight->Value = 20;
                $createPickupRequest->CarrierCode = PSimpleType\CarrierCodeType::_FDXE;
                $createPickupRequest->OversizePackageCount = 0;
                $createPickupRequest->CountryRelationship = PSimpleType\CountryRelationshipType::_DOMESTIC;
                //$createPickupRequest->PickupServiceCategory = PSimpleType\PickupServiceCategoryType::_FEDEX_NEXT_DAY_EARLY_MORNING;
                $_request = new PRequest();
                $trackingID = null;

                try {

                    $createPickupReply = $_request->getCreatePickupReply($createPickupRequest, true);

                    if(is_array($createPickupReply->Notifications) && $createPickupReply->Notifications[0]->Message == "Ready Time after Cutoff Time"){

                        $createPickupRequest->OriginDetail->ReadyTimestamp = date('Y-m-d', strtotime(date('Y-m-d') . ' +1 day')) . "T10:00:00";
                        $createPickupReply = $_request->getCreatePickupReply($createPickupRequest, true);


                    }

                    elseif($createPickupReply->Notifications->Message == "Ready Time after Cutoff Time"){
                        $createPickupRequest->OriginDetail->ReadyTimestamp = date('Y-m-d', strtotime(date('Y-m-d') . ' +1 day')) . "T10:00:00";
                        $createPickupReply = $_request->getCreatePickupReply($createPickupRequest, true);

                    }



                    $trackingID = $createPickupReply->PickupConfirmationNumber;
                } catch (\Exception $e) {
                    $_request->getSoapClient()->__getLastResponse();
                }

                $trackRequest = new ComplexType\TrackRequest();
                // User Credential
                $trackRequest->WebAuthenticationDetail->UserCredential->Key = FEDEX_KEY;
                $trackRequest->WebAuthenticationDetail->UserCredential->Password = FEDEX_PASSWORD;
                // Client Detail
                $trackRequest->ClientDetail->AccountNumber = FEDEX_ACCOUNT_NUMBER;
                $trackRequest->ClientDetail->MeterNumber = FEDEX_METER_NUMBER;

                // Version
                $trackRequest->Version->ServiceId = 'trck';
                $trackRequest->Version->Major = 16;
                $trackRequest->Version->Intermediate = 0;
                $trackRequest->Version->Minor = 0;

                $trackRequest->SelectionDetails = [new ComplexType\TrackSelectionDetail()];
                $trackRequest->SelectionDetails[0]->PackageIdentifier->Value = $trackingID;
                $trackRequest->SelectionDetails[0]->PackageIdentifier->Type = SimpleType\TrackIdentifierType::_TRACKING_NUMBER_OR_DOORTAG;


                $_request = new TRequest();
                $trackReply = $_request->getTrackReply($trackRequest);

                $user = new \App\Shipping();
                $user->type = "pickup";
                $user->donor_id  = $request->user()->donors()->first()->id;
                $user->tracking_number = $trackingID;
                $user->save();

                return redirect()->back()->with('success', "Please have your package ready for pickup by 5pm.  Please leave your package by your front door so the fedEx driver can find your package.");
            }

            else{
                return redirect()->back()->with('success', "Please have your package ready for pickup by 5pm.  Please leave your package by your front door so the fedEx driver can find your package.");
            }
        }

        else{
            return redirect()->back()->with('error', "Invalid donor ID");
        }
    }

    public function bloodkit(Request $request)
    {
        $page = $this->getPage($request);
        $donorID = $request->user()->donors()->first();

        if(!is_null($donorID)){
            $donor = \App\Donor::where('id', $request->user()->donors()->first()->id)->first();
            $page['donor'] = $donor;
        }
        return view($page['template'], $page);
    }


    public function file(Request $request)
    {
        $page = $this->getPage($request);
        return view($page['template'], $page);
    }

    public function edit(Request $request)
    {
        $page = $this->getPage($request);
        return view($page['template'], $page);
    }

    public function messages(Request $request)
    {
        $page = $this->getPage($request);
        return view($page['template'], $page);

    }

    public function payments(Request $request)
    {
        $page = $this->getPage($request);
        return view($page['template'], $page);
    }

    public function account(Request $request)
    {
        $page = $this->getPage($request);
        return view($page['template'], $page);
    }

    public function message(Request $request)
    {
        $msg = Conversation::where('id', $request->query('id'))->first();

        if(!is_null($msg)){
            $page = $this->getPage($request);
            $page['message'] = $msg;
            return view($page['template'], $page);
        }

        abort(404);
    }
}
