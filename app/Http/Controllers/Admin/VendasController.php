<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Caixa;
use App\Models\Cliente;
use App\Models\Estoque;
use App\Models\Transacoes;
use App\Models\Venda;
use App\Models\Estoque\Estoque_aux;
use App\Models\Entrada_caixa;

class VendasController extends Controller
{
    public function vendasView(){
            return view('admin.vendas.index',['aberto'=>Caixa::checkOpen()]);
    }
    
    public function moneyParse($val){
        return str_replace([".",","],["","."],$val);
    }
    
    public function percentParse($val){
        return str_replace("%","",$val);
    }
    
    public function Registrar(Request $request){
        try{
            $itens = array();
            $total = count($request->venda['codigo']);
            $transacao = new Transacoes();
            $transacao->cliente         = $request->cliente;
            $transacao->data            = date('Y-m-d');
            $transacao->pagamento       = $request->pagamento;
            $transacao->parcelas        = $request->parcelas;
            $transacao->valor_parcelas  = $this->moneyParse($request->valor_parcelas);
            $transacao->total           = $this->moneyParse($request->total);
            if($this->percentParse($request->desconto) == ''){
                $transacao->desconto    = 0;
            }else {
                $transacao->desconto    = $this->percentParse($request->desconto);
            }
            
            $transacao->save();
            
            if($request->dividir == true){
                $entrada = new Entrada_caixa();
                $entrada->valor = str_replace([".",","],["","."],$request->dinheiro);
                $entrada->descricao = "Referente pg com dinheiro e cartão NT: " . $transacao->id;
                $entrada->save();
                Caixa::add($entrada->valor);
            }
           
            if($transacao->pagamento ==  "DI"){
                Caixa::add($transacao->total);
            }
            for($i = 0; $i < $total; $i++){
                $itens[$i]['transacao']          = $transacao->id;
                $itens[$i]['codigo_estoque']     = $request->venda['codigo'][$i];
                $itens[$i]['codigo_estoque_aux'] = $request->venda['codigo_aux'][$i];
                $itens[$i]['quantidade']         = $request->venda['quantidade'][$i];
                $itens[$i]['valor']              = $this->moneyParse($request->venda['total'][$i]);
            }
            
            foreach($itens as $key=>$val){
                if($val['codigo_estoque'] != null && $val['quantidade'] != 0 || null){
                    $vendas = new Venda();
                    $vendas->transacao          = $val['transacao'];
                    $vendas->codigo_estoque     = $val['codigo_estoque'];
                    $vendas->codigo_estoque_aux = $val['codigo_estoque_aux'];
                    $vendas->quantidade         = $val['quantidade'];
                    $vendas->valor_venda        = $val['valor'];
                    $vendas->save();
                    Estoque_aux::getOff($vendas->codigo_estoque_aux, $vendas->quantidade);
                }

            }
            return response()->json([
                'success' => "true",
                'NT' => $transacao->id,
                'message' => 'Venda realizada com sucesso'
            ]);
            
        }catch (QueryException  $e){
            $error_code = $e->errorInfo;
            return response()->json([
                'success' => 'false',
                'message' => 'erro no banco de dados, codigo: '.$error_code[2]
            ]);
        }
    }
    
    public function TransacoesAPIToday(){
        return Transacoes::today();
    } 
    
    public function GerarCupom($id){
        $detalhes = "";
        $transacao = Transacoes::where('id','=',$id)->first();
        $transacao->cliente = Cliente::where('CPF','=',$transacao->cliente)->first();
        $transacao->pagamento = str_replace(['DI','CR','DE'],['Dinheiro','Cartão de Crédito','Débido'],$transacao->pagamento);
        $transacao->desconto = $transacao->desconto . "%";
        $transacao->total = number_format($transacao->total, 2, ',', '.');
        $transacao->data = date('d/m/Y',strtotime($transacao->data));
        $transacao->emissao = date('d/m/Y h:i A');
        $vendas = Venda::where('transacao','=', $id)->get();
        $itens = array();
        $transacao->subtotal = 0;
        foreach($vendas as $key=>$val){
            $itens[$key] = (object) array_merge(
                Estoque::where('codigo','=',$val->codigo_estoque)->first()->toArray(),
                Estoque_aux::where('id','=',$val->codigo_estoque_aux)->first()->toArray());
            $itens[$key]->preco = ($val->valor_venda/$val->quantidade);
            $transacao->subtotal += ($itens[$key]->preco * $val->quantidade);
            $itens[$key]->descricao = $itens[$key]->cor .' - '. $itens[$key]->tamanho;
            $itens[$key]->total = number_format($itens[$key]->preco * $val->quantidade, 2, ',', '.');
            $itens[$key]->preco =number_format($itens[$key]->preco , 2, ',', '.');
            $itens[$key]->quantidade = $val->quantidade;
        }
        $transacao->subtotal = number_format($transacao->subtotal , 2, ',', '.');
        $transacao->vendas = $itens;
        if($id < 10000){
            $transacao->NT = '0000' . $transacao->id;
        }
        else   $transacao->NT = $transacao->id;
        
        return view('admin.vendas.cupom',['transacao'=>$transacao]);
    }

    public function CancelarVenda(Request $request){
        try{
            $id = $request->id;
            $transacao = Transacoes::where('id','=',$id)->first();
            $vendas = Venda::where('transacao','=',$transacao->id)->get();
            foreach($vendas as $venda){
                if($request->return_estoque){
                    Estoque_aux::getAdd($venda->codigo_estoque_aux, $venda->quantidade);
                }
                $venda->delete();
            }
            if($request->return_caixa){
                if($transacao->pagamento == 'DI'){
                    if($request->return_fechamento){
                        $request->descricao = "Cancelamento de venda - " . $transacao->data;
                        $request->valor = number_format($transacao->total, 2, ',', '.');
                        $caixaController = new CaixaController();
                        $caixaController->sangriaPost($request);
                    }else{
                        Caixa::getOff($transacao->total);
                    }
                }
            }
            $transacao->delete();
            return response()->json([
                'success' => "true",
                'message' => "Venda cancelada com sucesso"
            ]);
        }catch (QueryException  $e){
            $error_code = $e->errorInfo;
            return response()->json([
                'success' => 'false',
                'message' => 'Algum erro ocorreu:  '.$error_code[2]
            ]);
        }
    }
}
