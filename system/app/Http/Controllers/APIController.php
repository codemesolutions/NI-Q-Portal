<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\DonorAPI;

class APIController extends Controller
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
    public function sync(Request $request)
    {
        $api = new \App\Library\DonorAPI('https://donortrack.ni-q.com:443/', 'api1', 'Api1Rand0M');
        $milkKits = $api->get('api/MilkKit');

        foreach($milkKits as $mk){
            $donor = \App\Donor::where('donor_number', $mk->DonorId)->first();

            if(!is_null($donor)){
                $m = \App\MilkKit::where('donor_id', $donor->id)->where('barcode', $mk->Barcode)->first();

                if(is_null($m)){
                    $m = new \App\MilkKit();
                    $m->donor_id= $donor->id;
                    $m->active = $mk->Active;
                    $m->barcode = $mk->Barcode;
                    $m->volume = $mk->Volume;
                    $m->genetic_test_results = is_bool($mk->GeneticTestResult) ? $mk->GeneticTestResult:false;
                    $m->microbial_test_results = is_bool($mk->MicrobialTestResult) ? $mk->MicrobialTestResult:false;
                    $m->toxicology_test_result = is_bool($mk->ToxicologyTestResult) ? $mk->ToxicologyTestResult:false;
                    $m->finalized_date = $mk->Finalized;
                    $m->paid_date = $mk->PaidDate;
                    $m->quarantine_date = $mk->QuarantineDate;
                    $m->received_date = $mk->ReceiveDate;
                    $m->pallet = $mk->Pallet;
                    $m->shipping_service = $mk->ShippingService;
                    $m->tracking_number = $mk->TrackingNumber;
                    $m->lot_barcode = $mk->Lot->Barcode;
                    $m->best_by_date = $mk->Lot->BestByDate;
                    $m->closed = $mk->Lot->Closed;
                    $m->transferred = $mk->Lot->Transferred;
                    $m->total_cases = is_null($mk->Lot->TotalCases) ? 0 : $mk->Lot->TotalCases;
                    $m->cases_remaining = is_null($mk->Lot->CasesRemaining) ? 0 : $mk->Lot->CasesRemaining;
                    $m->sample_pouches = is_null($mk->Lot->SamplePouches) ? 0 : $mk->Lot->SamplePouches;
                    $m->save();


                }

                else{
                    $m->donor_id = $donor->id;
                    $m->active = $mk->Active;
                    $m->barcode = $mk->Barcode;
                    $m->volume = $mk->Volume;
                    $m->genetic_test_results = is_bool($mk->GeneticTestResult) ? $mk->GeneticTestResult:false;
                    $m->microbial_test_results = is_bool($mk->MicrobialTestResult) ? $mk->MicrobialTestResult:false;
                    $m->toxicology_test_result = is_bool($mk->ToxicologyTestResult) ? $mk->ToxicologyTestResult:false;
                    $m->finalized_date = $mk->Finalized;
                    $m->paid_date = $mk->PaidDate;
                    $m->quarantine_date = $mk->QuarantineDate;
                    $m->received_date = $mk->ReceiveDate;
                    $m->pallet = $mk->Pallet;
                    $m->shipping_service = $mk->ShippingService;
                    $m->tracking_number = $mk->TrackingNumber;
                    $m->lot_barcode = $mk->Lot->Barcode;
                    $m->best_by_date = $mk->Lot->BestByDate;
                    $m->closed = $mk->Lot->Closed;
                    $m->transferred = $mk->Lot->Transferred;
                    $m->total_cases = is_null($mk->Lot->TotalCases) ? 0 : $mk->Lot->TotalCases;
                    $m->cases_remaining = is_null($mk->Lot->CasesRemaining) ? 0 : $mk->Lot->CasesRemaining;
                    $m->sample_pouches = is_null($mk->Lot->SamplePouches) ? 0 : $mk->Lot->SamplePouches;
                    $m->update();
                }

            }
        }


        $milkKits = $api->get('api/BloodKit');
        foreach($milkKits as $mk){
            $donor = \App\Donor::where('donor_number', $mk->DonorId)->first();

            if(!is_null($donor)){
                $m = \App\BloodKit::where('donor_id', $donor->id)->where("din", $mk->Din)->first();

                if(is_null($m)){

                    if(is_null($m) && !is_null($mk->ReceiveDate)){
                        mail(
                            $donor->user_id->email,
                            'NI-Q - We have received your result.  You can now request a milk kit.',
                            "Ni-Q has received your results on the blood work and is excited to have you part of the team! Information about donating is on your menu bar in the portal. Please read the General Guidelines, Things to remember as a donor, and the milk kit packing and instructions. Once you have read through those. Feel free to “Request a Milk Kit. Ni-Q will be ship out milk kits every Wednesday. <br /> <a href='https://portal.ni-q.com'>Click here to login into your donor account!</a>",
                            'From: erica@ni-q.com' . "\r\n" .
                            'Reply-To: erica@ni-q.com' . "\r\n" .
                            'X-Mailer: PHP/' . phpversion()."\r\n".
                            'MIME-Version: 1.0' . "\r\n".
                            'Content-type: text/html; charset=iso-8859-1' . "\r\n"
                        );
                    }

                    $m = new \App\BloodKit();
                    $m->donor_id = $donor->id;
                    $m->active = $mk->Active;
                    $m->din = $mk->Din;
                    $m->order_date = $mk->OrderDate;
                    $m->recieve_date = $mk->ReceiveDate;
                    $m->shipping_service = $mk->ShippingService;
                    $m->tracking_number = $mk->TrackingNumber;
                    $m->status = is_null($mk->Status) ? false:true;
                    $m->save();



                }

                else{

                    if(is_null($m->recieve_date) && !is_null($mk->ReceiveDate)){
                        mail(
                            $donor->user_id->email,
                            'NI-Q - We have received your result.  You can now request a milk kit.',
                            "Ni-Q has received your results on the blood work and is excited to have you part of the team! Information about donating is on your menu bar in the portal. Please read the General Guidelines, Things to remember as a donor, and the milk kit packing and instructions. Once you have read through those. Feel free to “Request a Milk Kit. Ni-Q will be ship out milk kits every Wednesday. <br /> <a href='https://portal.ni-q.com'>Click here to login into your donor account!</a>",
                            'From: erica@ni-q.com' . "\r\n" .
                            'Reply-To: erica@ni-q.com' . "\r\n" .
                            'X-Mailer: PHP/' . phpversion()."\r\n".
                            'MIME-Version: 1.0' . "\r\n".
                            'Content-type: text/html; charset=iso-8859-1' . "\r\n"
                        );
                    }

                    $m->donor_id = $donor->id;
                    $m->active = $mk->Active;
                    $m->din = $mk->Din;
                    $m->order_date = $mk->OrderDate;
                    $m->recieve_date = $mk->ReceiveDate;
                    $m->shipping_service = $mk->ShippingService;
                    $m->tracking_number = $mk->TrackingNumber;
                    $m->status = is_null($mk->Status) ? false:true;
                    $m->update();
                }

            }
        }

        return redirect()->route('admin')->with('Success', 'API SUCCESSFULLY PULLED');
    }

}
