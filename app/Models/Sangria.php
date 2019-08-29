<?php

namespace App\Models;

use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Model;

class Sangria extends Model
{
    public static function today(){
        try {
            $sangria = Sangria::where('data','=', date('Y-m-d'))->get();
            if($sangria != null){
                return $sangria;
            }else return false;
        }catch(QueryException $e){
            return false;
        }
    }
}
