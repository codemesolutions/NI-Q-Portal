<?php

use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/users/find', function (Request $request) {
    if($request->has('search')){
        $term = $request->input('search');

        if ($term == trim($term) && strpos($term, ' ') !== false){
            $termWords = explode(' ', $term);

            $results = \App\User::with('permissions')
                ->where('first_name', 'LIKE', "%". $termWords[0] ."%")
                ->where('last_name', 'LIKE', "%". $termWords[1] ."%")->get();
        }

        else{
            $results = \App\User::with('permissions')->where('first_name', 'LIKE', "%". $request->input('search') ."%")->orWhere('last_name', 'LIKE', "%". $request->input('search') ."%")->get();
        }

        if($results->count() === 0){
            $donor = \App\Donor::where('donor_number', $term)->first();

            if(!is_null($donor)){
                $results = \App\User::with('permissions')->where('id', $donor->user_id->id)->get();
            }


            if(is_null($results)){
                return response()->json([]);
            }

        }

        return response()->json($results);
    }

    return response()->json([]);
});


Route::get('/users/get/{id}', function (Request $request, $id) {

        $results = \App\User::with('permissions')->where('id',$id)->first();

        if(!is_null($results)){
            return response()->json($results);
        }

        return response()->json([]);



});
