<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Country};
use App\Http\Resources\{CountryResource};
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $countries = Country::all();
        return response()->success('Get all countries.',CountryResource::collection($countries));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
        ]);
        if ($validator->fails())
        {
            return response()->failed($validator->errors());
        }
        $stored = Country::storeData($request);
        if($stored){
            return response()->success('Country created successfully!',new  CountryResource($stored));
        }else{
            return response()->failed('Oops! Somethings went wrong, please try again later.');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updated = Country::updateData($request, $id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
        ]);
        if ($validator->fails())
        {
            return response()->failed($validator->errors());
        }
        if($updated){
            return response()->success('Country updated successfully!',new  CountryResource($updated));
        } else {
            return response()->failed('Oops! Somethings went wrong, please try again later.');
        }
    }

 
    /**
     * Delete the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $deleted = Country::deleteData($id);
        if(!empty($deleted)){
            return response()->success('Country deleted successfully!');
        } else {
            return response()->failed('Oops! Somethings went wrong, please try again later.');
        }
    }
    
}
