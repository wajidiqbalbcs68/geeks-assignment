<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function areas()
    {
        return $this->hasMany(Area::class);
    }

    public static function getCommonField($request){

        return [
            'name'          => $request->name,
            'country_id'    => $request->country_id
        ];

    }

    public static function storeData($request){

        $common_fields = self::getCommonField($request);
        $create = self::create($common_fields);
        return $create;

    }

    public static function updateData($request, $id){

        $common_fields = self::getCommonField($request);
        $update_data   = self::whereId($id)->first();
        $update_data =  $update_data->update($common_fields);
        return self::whereId($id)->first();


    }

    public static function deleteData($id){
        return  self::where('id', $id)->delete();
    }



}
