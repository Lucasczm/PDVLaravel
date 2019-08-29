<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transacoes;
use App\Models\Venda;
use App\Models\Estoque;
use App\Models\Estoque\Marca;

class RelatorioController extends Controller
{
 
    public function index($year = null  ){
        if($year == null)
            $year = date('Y');
        $vendas = $this->GetRelatorioVendas($year);
        $marcas = $this->GetMarcaVendas();
        $FaturamentoCard = $this->GetCardFaturamento($year);
        return view('admin.relatorio.index',['datasets'=>$vendas, 'marcas' =>$marcas, 'faturamentoCard'=>$FaturamentoCard]);
    }
    function GetRelatorioVendas($year){
        $date = strtotime('01/01/'.$year);
        $transacoes = Transacoes::whereYear('data','=', date('Y',$date))->get(['id','created_at']);
        $month = array();
        foreach($transacoes as $tr){
            $time = strtotime($tr->created_at);
            $newformat = date("M",$time);
            if(!in_array($newformat,$month)){
                array_push($month, $newformat);
            }
        }
         
        $monthRelatorio = array();
        foreach($month as $m){
            $date = strtotime('01 '. $m.' '.$year);
            $newformat = date('m-Y',$date);
            $totalMonth = Transacoes::whereMonth('data','=',  date('m',$date))->
            whereYear('data','=',  date('Y',$date))->sum('total');
           
            $vendas = number_format($totalMonth,2,',','.');
            array_push($monthRelatorio,(float)$totalMonth);
        }
        $dataset = new \StdClass;
        $relatorioAno = new \StdClass;
        $dataset->labels = $month;
        $relatorioAno->label = "Vendas";
        $relatorioAno->backgroundColor = 'rgba(255, 99, 132, 0.2)';
        $relatorioAno->borderColor= 'rgba(255,99,132,1)';
        $relatorioAno->borderWidth =  1;
        $relatorioAno->data = $monthRelatorio;
        $dataset->datasets = array($relatorioAno);
        return JSON_ENCODE((array)$dataset);
    }
    function GetAvailableYear(){
        $y = array();
        $transacoes = Transacoes::get(['id','created_at']);
        foreach($transacoes as $tr){
            $time = strtotime($tr->created_at);
            $newformat = date("Y",$time);
            if(!in_array($newformat,$y)){
                array_push($y, $newformat);
            }
        }
        return $y;
    }
    function GetMarcaVendas(){
        $vendas = Venda::get(['codigo_estoque','quantidade']);
        $marca = Marca::get(['marca']);
        $marca->vendas = new \StdClass;
        foreach($vendas as $v){
            $estoque = Estoque::where('codigo','=',$v->codigo_estoque)->first();
            foreach($marca as $m){
                if($m->marca == $estoque->marca)
                    $m->vendas += $v->quantidade;
            }
        }
        $marcas = array();
        $vendasm = array();
        foreach($marca as $ms) {
            array_push($marcas, $ms->marca);
            array_push($vendasm ,$ms->vendas);
        }
        return $this->ContructDataset('Marcas',$marcas,$vendasm);
    }
    function ContructDataset($titulo, $campos,$valores){
        $dataset = new \StdClass;
        $data = new \StdClass;
        $dataset->labels = $campos;
        $data->label = $titulo;
        $backgroundColos = array();
        foreach($campos as $c){
                array_push($backgroundColos,'rgba('. rand(0,255).', '. rand(0,255).', '. rand(0,255).', .65)');
        }
        $data->backgroundColor = $backgroundColos;
        $data->borderWidth =  1;
        $data->data = $valores;
        $dataset->datasets = array($data);
        $json = JSON_ENCODE((array)$dataset);
        return str_replace("'"," ",$json);
    }
    function GetCardFaturamento($year){
        $limite = 81000;
        $Faturamento = Transacoes::Faturamento($year);
        $percent = number_format(($Faturamento / $limite) * 100,2);
        $faturamento = number_format($Faturamento,2,',','.');
        $color = 'blue';
        if($percent > 30 ) $color = 'green';
        if($percent > 60) $color = 'yellow';
        if($percent > 70) $color = 'red';
        return (object) array(
            'faturamento' =>$faturamento,
            'percentual' => $percent,
            'color' => $color,
            'limite' => number_format($limite,2,',','.'),
            'anoAtual' => $year,
            'ano' => $this->GetAvailableYear(),

        );
    }

    public function BackupIndex(){
        return view('admin.relatorio.sistema',['mysql'=>$this->MakeTmpBackup()]);
    }

    function MakeTmpBackup(){
        $ds = DIRECTORY_SEPARATOR;
        $path = database_path() . $ds . 'backups' . $ds . date('Y') . $ds . date('m') . $ds;
        $file = date('Y-m-d-H-i-s') . '_mysqldump.sql';
        $fullfile = "\"" . $path . $file . "\"";
        $command = "mysqldump --user=".getenv('DB_USERNAME')." --password=".getenv('DB_PASSWORD')." --host=".getenv('DB_HOST'). " " . getenv('DB_DATABASE')." --add-drop-database -r {$fullfile}";

        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }
        exec($command, $output);
        $data = file_get_contents($path . $file);

        unlink($path . $file);
        return (object)array(
            'filename'=> $file,
            'file' => base64_encode($data)
         );
    }

    function ImportBackup(Request $request){
        if($request->hasFile('file-sql')){
            $file = $request->file('file-sql')->store('temp');
            $sqlfile = storage_path('app/') . $file;
            $this->RestoreDatabase($sqlfile);
            $import = "Arquivo importado!";
        }else{
            $import = "Nenhum arquivo!";
        }
    
        return view('admin.relatorio.sistema',['import'=> $import,'mysql'=>$this->MakeTmpBackup()]);
    }
    function RestoreDatabase($sqlfile){
        $command = "mysql --user=".getenv('DB_USERNAME')." --password=".getenv('DB_PASSWORD')." --host=".getenv('DB_HOST'). " " . getenv('DB_DATABASE')." < {$sqlfile}";
        exec($command, $output);
        unlink($sqlfile);
    }

}
