<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $table="countries";

    protected $guarded = ['id'];

    public function City()
    {
        return $this->hasMany(City::class);
    }

    public static function getCommonField($request){

        return [
            'name'          => $request->name
        ];

    }

    public static function storeData($request){

        $common_fields = self::getCommonField($request);
        $create = Self::create($common_fields);
        return $create;

    }

    public static function updateData($request, $id){

        $common_fields = self::getCommonField($request);
        $update_data   = self::whereId($id)->first();
        $update_data   = $update_data->update($common_fields);
        return self::whereId($id)->first();

    }

    public static function deleteData($id){
        return  self::where('id', $id)->delete();
    }





}
