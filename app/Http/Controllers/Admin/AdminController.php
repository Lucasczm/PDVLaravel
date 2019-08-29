<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cliente;
use App\Models\Estoque;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transacoes;
use App\Models\Estoque\Estoque_aux;

class AdminController extends Controller
{
    public function index(){
        $cliente = Cliente::all();
        $transacoes = count(Transacoes::month());
        $Estoque = Estoque_aux::Total();
       
        return view('admin.home.index',['clientes'=>$cliente,'Estoque'=>$Estoque,'transacoes'=>$transacoes]);
    }
}
