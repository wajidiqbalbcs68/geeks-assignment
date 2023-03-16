<?php

use Illuminate\Support\Str;

/**
 * @return string
 * @description returns hash_id
 */

function generateHashId()
{

    $get_time_with_mille = new DateTime();
    $str_time = strtotime($get_time_with_mille->format("Y-m-d H:i:s.v"));
    return Str::random(25).''.$str_time;
    
}










