<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Country};
use App\Http\Resources\{CountryCityResource};

class GeneralController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	*/
    
    public function index(Request $request)
    {

        $countries = Country::where('id',$request->country_id)->with('City')->first();
        return response()->success('Get country and cities.',new CountryCityResource($countries));

    }

}
