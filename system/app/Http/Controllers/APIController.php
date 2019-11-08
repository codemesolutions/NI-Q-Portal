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
                    $m->donor_id = $donor->id;
                    $m->active = $mk->Active;
                    $m->din = $mk->Din;
                    $m->order_date = $mk->OrderDate;
                    $m->recieve_date = $mk->ReceiveDate;
                    $m->shipping_service = $mk->ShippingService;
                    $m->tracking_number = $mk->TrackingNumber;
                    $m->status = $mk->Status;
                    $m->update();
                }
             
            }
        }

        return redirect()->route('admin')->with('Success', 'API SUCCESSFULLY PULLED');
    }

}
