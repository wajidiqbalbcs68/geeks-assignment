<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{City};
use App\Http\Resources\{CityResource};
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $cities = City::all();
        return response()->success('Get all cities.',CityResource::collection($cities));
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
            'name'        => 'required|string|max:100',
            'country_id'  => 'required'
        ]);
        if ($validator->fails())
        {
            return response()->failed($validator->errors());
        }
        $stored = City::storeData($request);
        if($stored){
            return response()->success('City created successfully!',new  CityResource($stored));
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
        $updated = City::updateData($request, $id);
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:100',
            'country_id'  => 'required'
        ]);
        if ($validator->fails())
        {
            return response()->failed($validator->errors());
        }
        if($updated){
            return response()->success('City updated successfully!',new  CityResource($updated));
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
        $deleted = City::deleteData($id);
        if(!empty($deleted)){
            return response()->success('City deleted successfully!');
        } else {
            return response()->failed('Oops! Somethings went wrong, please try again later.');
        }
    }
    
}
