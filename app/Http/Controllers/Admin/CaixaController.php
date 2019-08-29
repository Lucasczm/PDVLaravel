<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

use App\Models\Sistema;
use App\Models\Caixa;
use App\Models\Sangria;
use App\Models\Transacoes;
use App\Models\Venda;
use App\Models\Estoque;
use App\Models\Entrada_caixa;

class CaixaController extends Controller
{
    
    
    public function data(){
        return date('Y-m-d');
    }
    
    public function iniciarCaixaView(){
      $caixa = Caixa::today();
      return view('admin.caixa.abrir',['aberto' =>Caixa::checkOpen(),'caixa'=>$caixa]);
       
    }
    
    public function iniciarCaixa(Request $request){
        
        $caixa = Caixa::today();
        
        if(!Caixa::checkOpen() && $caixa == null){
            try{
            $caixa = new Caixa();
            $caixa->data = date('Y-m-d');
            $caixa->inicial = str_replace([".",","],["","."],$request->valor);
            $caixa->valor = str_replace([".",","],["","."],$request->valor);
            Sistema::setVal('caixa_aberto',true);
            $caixa->save();
            return response()->json([
                'success' => "true",
                'message' => 'Caixa foi aberto'
            ]);
                
            }catch (QueryException $e){
                return response()->json([
                    'success' => "false",
                    'message' => $e->errorInfo[2]
                ]);
            }
        }
        else {
            return view('admin.caixa.abrir',['aberto' =>Caixa::checkOpen()]);
        }
    }
    
    public function fecharCaixaView(){
        
            $transacoes =  Transacoes::today();
            $sangria = Sangria::today();
            $entradas = Entrada_caixa::today();
            foreach($sangria as $sang){
                $sang->valor = number_format($sang->valor, 2, ',', '.');
            }
            foreach($entradas as $entrada){
                $entrada->valor = number_format($entrada->valor, 2, ',', '.');
            }
            $detalhes = "";
            
            foreach ($transacoes as $key=>$value){
                $id = $value->id;
                $venda = Venda::where('transacao','=', $id)->get();
                $value->pagamento = str_replace(['DI','CR','DE'],['Dinheiro','Cartão de Crédito','Débido'],$value->pagamento);
                $value->desconto = $value->desconto . "%";
                $value->total = number_format($value->total, 2, ',', '.');
                foreach($venda as $val){
                    $codigo = $val->codigo_estoque;
                    $estoque = Estoque::where('codigo','=',$codigo)->first();
                    $detalhes = $estoque->nome. ' | '. $detalhes ;
                }
                $value->detalhes = $detalhes;
                $detalhes = "";
            }
           
            if(!Caixa::today()){
                $caixaValor = (object) ['valor' => '0,00','inicial'=>'0,00','totalCredito'=>'0,00','totalDebito'=>'0,00','totalC'=>'0,00'];
            }else{
                $caixaValor = Caixa::today();
                $caixaValor->valor = number_format($caixaValor->valor, 2, ',', '.');
                $caixaValor->inicial = number_format($caixaValor->inicial, 2, ',', '.');
                $caixaValor->totalCredito = number_format(Transacoes::totalCreditoDay(), 2, ',', '.');
                $caixaValor->totalDebito = number_format(Transacoes::totalDebitoDay(), 2, ',', '.');
                $caixaValor->totalC = number_format(Transacoes::totalDebitoDay() + Transacoes::totalCreditoDay(), 2, ',', '.');
            }
        return view('admin.caixa.fechar',['aberto'=>Caixa::checkOpen(),'caixaValor'=>$caixaValor,'transacoes'=>$transacoes,'sangria'=>$sangria,'entrada'=>$entradas]);
  
    }

    public function fecharCaixa(){
        Sistema::setVal('caixa_aberto',false);
        return response()->json([
            'success' => "true",
            'message' => 'Caixa fechado com sucesso'
        ]);
    }
    
    public function sangriaView(){
        return view('admin.caixa.sangria',['aberto'=>Caixa::checkOpen()]);
    }

    public function sangriaPost(Request $request){
        if(Caixa::checkOpen()){
            $sangria = new Sangria();
            $sangria->data = $this->data();
            $sangria->descricao = $request->descricao;
            $sangria->valor = str_replace([".",","],["","."], $request->valor);
            try{
                if($sangria->save()){
                    Caixa::getOff($sangria->valor);
                    return response()->json([
                        'success' => "true",
                        'message' => 'Retirado com sucesso, o saldo do caixa é de R$'. number_format(Caixa::today()->valor, 2, ',', '.')
                    ]);
                }
            }catch (QueryException $e){
                return $e->errorInfo[2];
            }

        }
        
    }
    
    public function addCaixaView(){
        return view('admin.caixa.adicionar',['aberto'=>Caixa::checkOpen()]);
    }
    
    public function addCaixa(Request $request){
        $caixa = Caixa::today();
        if(Caixa::checkOpen() && $caixa != null){
            try{
                $entrada = new Entrada_caixa();
                $entrada->valor = str_replace([".",","],["","."],$request->valor);
                $entrada->descricao = $request->descricao;
                $entrada->save();
                Caixa::add(str_replace([".",","],["","."],$request->valor));
                $caixa = Caixa::today();
                $valor = number_format($caixa->valor, 2, ',', '.');
                return response()->json([
                    'success' => "true",
                    'message' => 'Valor foi adicionado Caixa: R$'.$valor
                ]);
                
            }catch (QueryException $e){
                return response()->json([
                    'success' => "false",
                    'message' => $e->errorInfo[2]
                ]);
            }
        }
        else {
            return response()->json([
                'success' => "false",
                'message' => $e->errorInfo[2]
            ]);
        }
    return $request->valor;
    }
    
    public function historico(){
        
        return view('admin.transacoes.index');
        
    }
     
    public function historicoAPI($type,$date){
        if($type =='month'){
            return Transacoes::whereMonth('data','=',$date)->get();
        }
        else if($type == 'day'){
            $tr = Transacoes::whereDate('data','=',$date)->get();
            $detalhes = "";
            
            foreach ($tr as $key=>$value){
                $id = $value->id;
                $venda = Venda::where('transacao','=', $id)->get();
                $value->pagamento = str_replace(['DI','CR','DE'],['Dinheiro','Cartão de Credito','Débido'],$value->pagamento);
                $value->desconto = $value->desconto . "%";
                $value->total = number_format($value->total, 2, ',', '.');
                foreach($venda as $val){
                    $estoque = Estoque::where('codigo','=',$val->codigo_estoque)->first();
                    $detalhes = $estoque->nome. ' x'.$val->quantidade .' R$'.number_format($val->valor_venda, 2, ',', '.'). ' | '. $detalhes ;
                }
                $value->detalhes = $detalhes;
                $detalhes = "";
            }
            return $tr;
        }
        else if($type == 'range'){
            $tmp = explode(',',$date);
            $date = $tmp[0];
            $to = $tmp[1];
            $detalhes = "";
            $tr = Transacoes::whereBetween('data',[$date,$to])->get();
            foreach ($tr as $key=>$value){
                $id = $value->id;
                $venda = Venda::where('transacao','=', $id)->get();
                $value->pagamento = str_replace(['DI','CR','DE'],['Dinheiro','Cartão de Credito','Débido'],$value->pagamento);
                $value->desconto = $value->desconto . "%";
                $value->total = number_format($value->total, 2, ',', '.');
                foreach($venda as $val){
                    $estoque = Estoque::where('codigo','=',$val->codigo_estoque)->first();
                    $detalhes = $estoque->nome. ' x'.$val->quantidade .' R$'.number_format($val->valor_venda, 2, ',', '.'). ' | '. $detalhes ;
                }
                $value->detalhes = $detalhes;
                $detalhes = "";
            }
            return $tr;
        }
    }

    public function historicoPrint(Request $request){
        $data = explode(",",$request->rage);
        $data[0] = new \DateTime($data[0]);
        $data[0] = $data[0]->format("d/m/y");
        $data[1] = new \DateTime($data[1]);
        $data[1] = $data[1]->format("d/m/y");
        return view('admin.transacoes.impressao',['range'=>$request->rage, 'data'=>$data]);
    }
}
