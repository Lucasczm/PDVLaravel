@extends('adminlte::page')

@section('title', 'Relatório de Vendas')

@section('content_header')
    <h1>Relatório de Vendas</h1>
@stop

@section('content')
    <div class="row">
        <div class= "col-md-12">
            <li class="btn dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Ano {{$faturamentoCard->anoAtual}} <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    @foreach ($faturamentoCard->ano as $ano)
                    <li><a href="{{ route('relatorio.ano',$ano) }}">{{ $ano}}</a></li>
                    @endforeach
                </ul>
            </li>
        </div> 
    </div>
    <div class= "row">
        <div class="col-md-6"> 
            <div class="info-box bg-{{$faturamentoCard->color}}">
                <span class="info-box-icon"><i class="ion ion-cash"></i></span>
                <div class="info-box-content">
                <span class="info-box-text">Faturamento Anual</span>
                <span class="info-box-number">R${{$faturamentoCard->faturamento}}</span>
                <!-- The progress section is optional -->
                <div class="progress">
                    <div class="progress-bar" style="width: {{$faturamentoCard->percentual}}%"></div>
                </div>
                <span class="progress-description">
                {{$faturamentoCard->percentual}}% de {{$faturamentoCard->limite}}
                </span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="box">
            <div class="box-header with-border">
                    <h3 class="box-title">Venda anual</h3>
                </div>
                <canvas id="vendasChart"></canvas>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Vendas por marcas</h3>
                </div>
                <canvas id="marcasVendas"></canvas>
            </div>
        </div>
    </div>
@stop
@section('js')
<script src="{{ asset('vendor/Chart.js') }}"></script>
<script>
    var data  =JSON.parse(<?php echo "'". $datasets ."'" ?>);
    var datamarcas  =JSON.parse(<?php echo "'". $marcas ."'" ?>);
    
    var ctx = document.getElementById("vendasChart");
    var marc = document.getElementById("marcasVendas");
  
    var myChart = new Chart(ctx, {
        type: 'line',
        data :  data,
        options: {
            legend: {
                display: false
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var label = data.datasets[tooltipItem.datasetIndex].label || '';

                        if (label) {
                            label += ': ';
                        }
                        label += "R$ "+ (tooltipItem.yLabel).toLocaleString('pt-BR');
                        return label;
                    }
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true,
                        callback: function(value, index, values) {
                            return 'R$' + value;
                         }
                    }
                }]
            }
        }
    });

    var marcasChart = new Chart(marc, {
        "type":"doughnut",
        "data":datamarcas,
        options: {
            legend: {
                display: false
            },
            scales: {  
                pointLabels : {display : false},
                 ticks: { 
                     display : false
                }
            }
        }
    });
    
    
</script>
@stop