<?php

namespace App\Models;

use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sistema;
class Caixa extends Model
{
    public static function checkOpen(){
        if(Caixa::today() != false && Sistema::getVal('caixa_aberto')){
            return true;
        }
        else return false;
    }
    
    public static function today(){
        try {
             $caixa = Caixa::where('data','=', date('Y-m-d'))->first();
             if($caixa != null){
                 return $caixa;
             }else return false;
        }catch(QueryException $e){
            return false;
        }
    }
    
    public static function add($int){
        if(Caixa::checkOpen()){
            $caixa = Caixa::where('data','=', date('Y-m-d'))->first();
            $caixa->valor = $caixa->valor + $int;
            $caixa->save();
        }else return false;
    }
    
    public static function getOff($int){
        if(Caixa::checkOpen()){
            $caixa = Caixa::where('data','=', date('Y-m-d'))->first();
            $caixa->valor = $caixa->valor - $int;
            $caixa->save();
        }else return false;
    }
}
