@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="row">
    <div class="col-sm-3">
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{$clientes->count()-1}}</h3>
                <p>Clientes Cadastrados</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-stalker"></i>
            </div>
            <a href="{{route('clientes.todos')}}" class="small-box-footer">Clientes <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{$transacoes}}</h3>
                <p>Vendas este mês</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="{{route('historico')}}" class="small-box-footer">Abrir <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{$Estoque}} </h3>
                <p>Itens em estoque</p>
            </div>
            <div class="icon">
                <i class="ion ion-cash"></i>
            </div>
            <a href="{{route('estoque.todos')}}" class="small-box-footer">Abrir estoque <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
@stop