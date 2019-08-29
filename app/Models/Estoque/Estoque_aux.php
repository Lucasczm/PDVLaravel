<?php

namespace App\Models\Estoque;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use App\Models\Estoque;
class Estoque_aux extends Model
{
    public $timestamps = false;
    
    public static function getOff($codigo,$quantidade){
        try{
            $aux = Estoque_aux::where('id','=',$codigo)->first();
            $aux->estoque -= $quantidade;      
            $aux->save();
            Estoque::getOff($aux->codigo_estoque, $quantidade);
            return true;
        }catch (QueryException $e){
            return $e->errorInfo[2];
        }
    }
    public static function getAdd($codigo,$quantidade){
        try{
            $aux = Estoque_aux::where('id','=',$codigo)->first();
            $aux->estoque += $quantidade;
            $aux->save();
            Estoque::getAdd($aux->codigo_estoque, $quantidade);
            return true;
        }catch (QueryException $e){
            return $e->errorInfo[2];
        }
    }
    
    public static function Total(){
        return Estoque_aux::all()->sum('estoque');
    }
}
