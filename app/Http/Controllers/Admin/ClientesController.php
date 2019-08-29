<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Mockery\Exception;

class ClientesController extends Controller
{
   public function index(){
        return view('admin.clientes.register');
   }

   public function cadastrar(Request $request)
   {

        $cliente = new Cliente;
        $cliente->nome          = $request->nome;
        $cliente->CPF           = $request->CPF;
        $cliente->sexo          = $request->sexo;
        $cliente->nascimento    = $request->nascimento;
        $cliente->telefone      = $request->telefone;
        $cliente->cep           = $request->cep;
        $cliente->endereco      = $request->endereco;
        $cliente->bairro        = $request->bairro;
        $cliente->cidade        = $request->cidade;
        $cliente->estado        = $request->estado;
        
        try{
            $cliente->save();
            return response()->json([
                'success' => "true",               
                'message' => 'Cliente cadastrado com sucesso'
            ]);
        }catch (QueryException  $e){
            $error_code = $e->errorInfo[1];
            if($error_code == 1062){
               return response()->json([
                    'success' => 'false',
                    'message' => 'CPF já cadastrado no sistema!'
                ]);
            }
        }
   }

   public function lista(){
        $cliente = Cliente::paginate(15);
        return view('admin.clientes.todos',['clientes'=>$cliente]);
   }
   
   public function debug()
   {
       return view('admin.debug');
   }
   
   
   public function editar(Request $request){
       if($request->id != null){
           $cliente = Cliente::where('id', $request->id);
           return $cliente->first();
       }
       else{
           return response()->json([
               'success' => 'false',
               'message' => 'sem indice na busca!'
           ]);
       }
   }
   
   public function saveEditar(Request $request){
       try{
           
       $cliente = Cliente::find($request->id);

    
       $cliente->nome          =  $request->nome;
       $cliente->CPF           = $request->CPF;
       $cliente->sexo          = $request->sexo;
       $cliente->nascimento    = $request->nascimento;
       $cliente->telefone      = $request->telefone;
       $cliente->cep           = $request->cep;
       $cliente->endereco      = $request->endereco;
       $cliente->bairro        = $request->bairro;
       $cliente->cidade        = $request->cidade;
       $cliente->estado        = $request->estado;
        
       if($cliente->save()){
           return response()->json([
              'success' => 'true',
               'message' => 'Alterado com sucesso!'
            ]);
       }
       else{
           return response()->json([
               'success' => 'false',
               'message' => 'Algum erro ocorreu no sistema!'
           ]);
       }
       
       }catch(QueryException $e){
           return response()->json([
               'success' => 'false',
               'message' => $e->errorInfo[2]
           ]);
       }
        
    }
   
   public function APIListar(){
       return  Cliente::all();
        
    }
    
    public function APIFind($params){
        return  Cliente::where('nome','LIKE','%'.$params.'%')
        ->orWhere('CPF','LIKE','%'.$params.'%')
        ->get();
    }
}
