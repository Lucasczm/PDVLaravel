<?php

namespace App\Models;

use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Model;

class Entrada_caixa extends Model
{
    public static function today(){
        try {
            $entrada = Entrada_caixa::whereDate('created_at','=', date('Y-m-d'))->get();
            if($entrada != null){
                return $entrada;
            }else return false;
        }catch(QueryException $e){
            return false;
        }
    }
}
