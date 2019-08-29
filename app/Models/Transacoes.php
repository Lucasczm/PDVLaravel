<?php

namespace App\Models;

use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Model;

class Transacoes extends Model
{
    public static function today(){
        try {
            $transacoes = Transacoes::where('data','=', date('Y-m-d'))->get();
            if($transacoes != null){
                return $transacoes;
            }else return false;
        }catch(QueryException $e){
            return false;
        }
    }
    
    public static function month(){
        try {
            $transacoes = Transacoes::whereMonth('data','=', date('m'))->get();
            if($transacoes != null){
                return $transacoes;
            }else return false;
        }catch(QueryException $e){
            return false;
        }
    }

    public static function year(){
        try {
            $transacoes = Transacoes::whereYear('data','=', date('Y'))->get();
            if($transacoes != null){
                return $transacoes;
            }else return false;
        }catch(QueryException $e){
            return false;
        }
    }
    
    public static function Faturamento($year){
        try {
            $date = strtotime('01/01/'.$year);
            $transacoes = Transacoes::whereYear('data','=',date('Y',$date))->sum('total');
            if($transacoes != null){
                return $transacoes;
            }else return false;
        }catch(QueryException $e){
            return false;
        }
    }
    
    public static function totalCreditoDay(){
        try {
            $total = 0;
            $transacoes = Transacoes::where('data','=', date('Y-m-d'))->
            where('pagamento','=','CR')->get();
            if($transacoes != null){
                foreach ($transacoes as $val){
                    $total += $val->total;
                }
                return $total;
            }else return false;
        }catch(QueryException $e){
            return false;
        }
    }
    
    public static function totalDebitoDay(){
        try {
            $total = 0;
            $transacoes = Transacoes::where('data','=', date('Y-m-d'))->
            where('pagamento','=','DE')->get();
            if($transacoes != null){
                foreach ($transacoes as $val){
                    $total += $val->total;
                }
                return $total;
            }else return false;
        }catch(QueryException $e){
            return false;
        }
    }
}
