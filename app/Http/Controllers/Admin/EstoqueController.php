<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;
use App\Models\Estoque\Categoria;
use App\Models\Estoque\Tamanho;
use App\Models\Estoque\Tecido;
use App\Models\Estoque\Cor;
use App\Models\Estoque\Marca;
use App\Models\Estoque\Unidade;
use App\Models\Estoque;
use App\Models\Estoque\Estoque_aux;
use App\Models\Estoque\Fornecedor;
use League\Flysystem\Exception;
use Illuminate\Foundation\Console\Presets\React;

class EstoqueController extends Controller
{
    public function index(){
        $categoria = Categoria::all();
        $tamanho   = Tamanho::all();
        $tecido    = Tecido::paginate();
        $cor       = Cor::all();
        $marcas    = Marca::all();
        $unidade   = Unidade::all();
        $fornecedor= Fornecedor::all();
        return view('admin.estoque.register',['categoria'=>$categoria,'tamanho'=>$tamanho,'tecido'=>$tecido,'cor'=>$cor,'marcas' =>$marcas,'unidade'=>$unidade,'fornecedor'=>$fornecedor]);
    }
   
    public function cadastrar(Request $request){
        $aux = array();
         $total = count($request->aux['cor']);
         for($i = 0; $i < $total; $i++){
             if($request->aux['quantidade'][$i] != 0){
                 $aux[$i]['cor'] = $request->aux['cor'][$i];
                 $aux[$i]['tamanho'] = $request->aux['tamanho'][$i];
                 $aux[$i]['quantidade'] = $request->aux['quantidade'][$i];
             }
         }
         if(count(Estoque::where('codigo','=',$request->codigo)->get())>0){
            $estoque        = Estoque::where('codigo','=',$request->codigo)->first();
         }else{
            $estoque        = new Estoque();
            $estoque->codigo    = $request->codigo;
         }
       
        $estoque->categoria = $request->categoria;
        $estoque->nome      = strtoupper($request->nome);
        $estoque->descricao = strtoupper($request->descricao);
        //$estoque->tecido    = $request->tecido;
        $estoque->estoque   = $request->estoque;
        $estoque->unidade   = $request->unidade;
        $estoque->marca     = $request->marca;
        $estoque->lucro     = str_replace("%","",$request->lucro);
        $estoque->fornecedor= $request->fornecedor;
        $estoque->preco_custo =  str_replace([".",","],["","."],$request->preco_custo);
        $estoque->preco     =  str_replace([".",","],["","."], $request->preco);
        
        try{
            $estoque->save();
           // return response()->json([
           //     'success' => "true",
           //     'message' => 'estoque atualizado com sucesso'
          //  ]);
            foreach($aux as $key=>$val){
                $estoque_aux = new Estoque_aux();
                $estoque_aux->codigo_estoque = $request->codigo;
                $estoque_aux->cor = $val['cor'];
                $estoque_aux->tamanho = $val['tamanho'];
                $estoque_aux->estoque = $val['quantidade'];
                $estoque_aux->save();
            }
            return response()->json([
                     'success' => "true",
                    'message' => 'estoque atualizado com sucesso'
              ]);
        }catch (QueryException  $e){
            $error_code = $e->errorInfo;
            return response()->json([
                'success' => 'false',
                'message' => 'erro no banco de dados, codigo: '.$error_code[2]
            ]);
        }
        
    }
   
    public function lista(){
        $estoque =   DB::table('estoques')
        ->leftjoin('estoque_auxes', 'estoque_auxes.codigo_estoque','=', 'estoques.codigo')
        ->addSelect('*','estoques.estoque as estoque_total')
        ->paginate(100);
        return view('admin.estoque.todos',['estoque'=>$estoque]);
    }
    
    public function viewAlterarAtributo(){
        $categoria = Categoria::all();
        $cor = Cor::all();
        $tamanho = Tamanho::all();
        $unidade = Unidade::all();
        $marca = Marca::all();
        $fornecedor = Fornecedor::all();
        
        return view('admin.editar.index',[
            'categoria'     => $categoria,
            'cor'           => $cor,
            'tamanho'       => $tamanho,
            'unidade'       => $unidade,
            'marcas'         => $marca,
            'fornecedor'    => $fornecedor
        ]);
    }
   
    public function saveAlterarAtributos(Request $request){
        try{
            $tipo = $request->tipo;
            switch($tipo){
                case 1:
                    $categoria = Categoria::where('categoria','=',$request->categoria)->first();
                    $categoria->categoria = strtoupper($request->atributo);
                    $categoria->save();
                    break;
                case 2:
                    $cor = Cor::where('cor','=',$request->aux['cor'][0])->first();
                    $cor->cor = strtoupper($request->atributo);
                    $cor->save();
                    break;
                case 3:
                    $tamanho = Tamanho::where('tamanho','=',$request->aux['tamanho'][0])->first();
                    $tamanho->tamanho = strtoupper($request->atributo);
                    $tamanho->save();
                    break;
                case 4:
                    $tecido = Tecido::where('tecido','=',$request->aux['tecido'][0])->first();
                    $tecido->tecido = strtoupper($request->atributo);
                    $tecido->save();
                    break;
                case 5:
                    $marca = Marca::where('marca','=',$request->marca)->first();
                    $marca->marca = strtoupper($request->atributo);
                    $marca->save();
                    break;
                case 6:
                    $unidade = Unidade::where('unidade','=',$request->unidade)->first();
                    $unidade->unidade = strtoupper($request->atributo);
                    $unidade->save();
                    break;
                case 7:
                    $fornecedor = Fornecedor::where('fornecedor','=',$request->fornecedor)->first();
                    $fornecedor->fornecedor = strtoupper($request->atributo);
                    $fornecedor->save();
                    break;
            }
            
            $request->id = $tipo;
            return response()->json([
                'success' => "true",
                'message' => 'alterado com sucesso',
                'body' => $this->viewAtributos($request)->render()
            ]);
        }catch (QueryException  $e){
            return response()->json([
                'success' => 'false',
                'message' => 'erro no cadastro: '.$e->errorInfo[1] .' '. $e->errorInfo[2]
            ]);
        }
    }
    
    public function addAtributo(Request $request){
        try{
        $tipo = $request->tipo;
        switch($tipo){
            case 1:
                $categoria = new Categoria();
                $categoria->categoria = strtoupper($request->atributo);
                $categoria->save();
                break;
            case 2:
                if(count(Cor::where('cor','=',$request->atributo)->get()) <= 0){
                    $cor = new Cor();
                    $cor->cor = strtoupper ($request->atributo);
                    $cor->save();
                }else{
                    throw new QueryException('', array(),new Exception("Ja possui essa cor"));
                }
                break;
            case 3:
                if(count(Tamanho::where('tamanho','=',$request->atributo)->get()) <= 0){
                    $tamanho = new Tamanho();
                    $tamanho->tamanho = strtoupper($request->atributo);
                    $tamanho->save();
                }else{
                    throw new QueryException('', array(),new Exception("Ja possui esse tamanho"));
                }
                break;
            case 4:
                $tecido = new Tecido();
                $tecido->tecido = strtoupper($request->atributo);
                $tecido->save();
                break;
            case 5:
                if(count(Marca::where('marca','=',$request->atributo)->get()) <= 0){
                    $marca = new Marca();
                    $marca->marca = strtoupper($request->atributo);
                    $marca->save();
                }else{
                    throw new QueryException('', array(),new Exception("Ja possui essa marca"));
                }
                break;
            case 6:
                if(count(Unidade::where('unidade','=',$request->atributo)->get()) <= 0){
                    $unidade = new Unidade();
                    $unidade->unidade = strtoupper($request->atributo);
                    $unidade->save();
                }else{
                    throw new QueryException('', array(),new Exception("Ja possui essa unidade"));
                }
                break;
            case 7:
                if(count(Fornecedor::where('fornecedor','=',$request->atributo)->get()) <= 0){
                    $fornecedor = new Fornecedor();
                    $fornecedor->fornecedor = strtoupper($request->atributo);
                    $fornecedor->save();
                }else{
                    throw new QueryException('', array(),new Exception("Ja possui esse fornecedor"));
                }
                break;
        }
      
          
            return response()->json([
                'success' => "true",
                'message' => 'cadastrado com sucesso'
            ]);
        }catch (QueryException  $e){
                return response()->json([
                    'success' => 'false',
                    'message' => 'erro no cadastro: '. str_replace(' (SQL: )','', $e->getMessage())
                ]);
            }
        }


    public function viewAtributos(Request $request){
        $params = $request->id;
        switch($params){
            case 1:
                $categoria = Categoria::all();
                return view('admin.estoque.categoria',['categoria'=>$categoria]);
                break;
            case 2:
                $cor = Cor::all();
                return view('admin.estoque.cor',['cor'=>$cor]);
                break;
            case 3:
                $tamanho = Tamanho::all();
                return view('admin.estoque.tamanho',['tamanho'=>$tamanho]);
                break;
            case 4: 
                $tecido = Tecido::all();
                return view('admin.estoque.tecido',['tecido'=>$tecido]);
                break;
            case 5:
                $marca = Marca::all();
                return view('admin.estoque.marcas',['marcas'=>$marca]);
                break;
            case 6:
                $unidade = Unidade::all();
                return view('admin.estoque.unidade',['unidade'=>$unidade]);
                break;
            case 7:
                $fornecedor = Fornecedor::all();
                return view('admin.estoque.fornecedor',['fornecedor'=>$fornecedor]);
                break;
        }
    }

    public function viewModal(){
        return view('admin.estoque.modal');
    }
    
    public function APIListar(){
        
       // SELECT * from estoques LEFT JOIN estoque_auxes on estoque_auxes.codigo_estoque = estoques.codigo
        return  DB::table('estoques')
            ->leftjoin('estoque_auxes', 'estoque_auxes.codigo_estoque','=', 'estoques.codigo')
            ->addSelect('*','estoques.estoque as estoque_total')
            ->orderBy('estoque_auxes.id')
            ->paginate(100);
        
    }
   
    public function APIDisponivel(Request $request){
        return  DB::table('estoques')
        ->leftjoin('estoque_auxes', 'estoque_auxes.codigo_estoque','=', 'estoques.codigo')
        ->where('estoque_auxes.estoque','>',0)
        ->where('codigo','LIKE', '%'.$request->search.'%')
        ->get();
    }
   
    public function APIFind($params){
        return DB::table('estoques')
        ->leftjoin('estoque_auxes', 'estoque_auxes.codigo_estoque','=', 'estoques.codigo')
        ->addSelect('*','estoques.estoque as estoque_total')->where('nome','LIKE','%'.$params.'%')
        ->orWhere('codigo','LIKE','%'.$params.'%')
        ->orWhere('descricao','LIKE','%'.$params.'%')
        ->paginate(100);
    }
    
    public function APIprocurarEstoqueID(Request $request){
        return  Estoque::where('codigo','LIKE','%'.$request->search.'%')->get();
    }
   
    public function saveEditar(Request $request){
        if($request->id != null){
            try{
                $estoque_aux = Estoque_aux::where('id','=',$request->id)->first();
                $estoque_aux->estoque = $request->estoque;
                
                $estoque = Estoque::where('codigo','=',$request->estoque_id)->first();
                $estoque->nome = $request->nome;
                $estoque->descricao = $request->descricao;
                $estoque->lucro     = str_replace("%","",$request->lucro);
                $estoque->preco_custo =  str_replace([".",","],["","."],$request->preco_custo);
                $estoque->preco     =  str_replace([".",","],["","."], $request->preco);
          
                $estoque->save();
                $estoque_aux->save();
                
                return response()->json([
                    'success' => 'true',
                    'message' => 'Estoque alterado com sucesso'
                ]);
            }catch(QueryException $e){
                return response()->json([
                    'success' => 'false',
                    'message' => 'Erro '. $e->errorInfo[2]
                ]);
            }
        }
        else{
            return response()->json([
                'success' => 'false',
                'message' => 'sem indice na busca!'
            ]);
        };
    }

    public function APIapagar(Request $request){
        try{
            $aux = Estoque_aux::where("id",'=',$request->id)->first();
            $aux->delete();
            return array("success"=>true);
        }catch (QueryException $e){
            return array("success"=>false, "message"=> $e->getMessage(),"error"=>$e->errorInfo[1]);
        }
    }

}
