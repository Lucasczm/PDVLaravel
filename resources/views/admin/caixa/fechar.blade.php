@extends('adminlte::page')

@section('title', 'Caixa')
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables.min.css') }}"/>
	<meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('content_header')
    <h1>Fechar Caixa</h1>
@stop

@section('content')
    <div class="modal fade" id="modalAlert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div id="modalHeader" class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h2 class="modal-title" id="myModalLabel">Fechamento do Caixa</h2>
          </div>
          <div id="modalBody"class="modal-body">
          <h4>O saldo atual do caixa é : R${{$caixaValor->valor}}</h4>
          </div>
          <div class="modal-footer">
          <button type="button" id="btnSubmit"class="btn btn-success" >Confirmar</button>
            <button type="button" id="btnModal"class="btn btn-default" data-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
	<h4>O saldo atual do caixa é : R${{$caixaValor->valor}}</h4>
	<h4>O saldo atual de vendas em crédito é : R${{$caixaValor->totalCredito}}</h4>
	<h4>O saldo atual de vendas em débito é : R${{$caixaValor->totalDebito}}</h4>
	<h4>Total de vendas Crédito/Débito : R${{$caixaValor->totalC}}</h4>
	<hr>
	<div class="row">
		<div class="col-md-12">
		<h4>Movimentações do dia</h4>
           <table id="transations-table" class="table hover order-column compact table-bordered" cellspacing="0" width="100%">
              <thead class="thead-light">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Cliente</th>
                  <th scope="col">Descrição</th>
                  <th scope="col">Desconto</th>
                  <th scope="col">Pagamento</th>
                  <th scope="col">Total R$</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                   	<td>-</td>
                   	<td>-</td>
                   	<td>Saldo Inicial</td>
                   	<td>-</td>
                   	<td>-</td>
                   	<td>+{{$caixaValor->inicial}}</td>
              	</tr>
              	  @foreach($entrada as $entradas)
                <tr class="bg-success">
                    <td>-</td>
                    <td>-</td>
                    <td>{{$entradas->descricao}}</td>
                    <td>-</td>
                    <td>-</td>
                    <td>+{{$entradas->valor}}</td>
                </tr>
                @endforeach
                @foreach($transacoes as $transations)
                <tr class="bg-success">
                    <td>{{$transations->id}}</td>
                    <td>{{$transations->cliente}}</td>
                    <td><a target="_blank" href="{{route('venda.cupom', ['id'=>$transations->id])}}">{!!nl2br($transations->detalhes)!!}</a></td>
                    <td>{{$transations->desconto}}</td>
                     <td>{{$transations->pagamento}}</td>
                    <td>+{{$transations->total}}</td>
                </tr>
                @endforeach
                 @foreach($sangria as $transations)
               <tr class="bg-danger">
                    <td>-</td>
                    <td>-</td>
                    <td>{{$transations->descricao}}</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-{{$transations->valor}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <?php if($aberto): ?>
            	<button class="btn btn-success" id="close">Fechar</button>
            <?php else: ?>
            	<button class="btn btn-success" disabled>Fechado</button>
            <?php endif; ?>
        </div>
    </div>

@stop
@section('js')
<script src="{{ asset('js/jquery.mask.min.js') }}"></script>
<script src="{{ asset('vendor/datatables.min.js') }}"></script>
<script type="text/javascript">
    $(function() {
    	$.ajaxSetup({
    		  headers: {
    		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    		  }
    		});
        $('#close').click(function(){
        	$('#modalAlert').modal('show');
        });
    	
    	 $('#transations-table').DataTable( {
    		 "bPaginate": false,
 	        "language": {
 	            "lengthMenu": "Exibir _MENU_ registros por página",
 	            "zeroRecords": "Nada encontrado",
 	            "info": "Exibindo _PAGE_ de _PAGES_",
 	            "infoEmpty": "Nenhum registro encontrado",
 	            "infoFiltered": "(filtrado de _MAX_ todos os registros)",
 	            "search" : "Procurar",
 	        },
 	       "initComplete": function( settings, json ) {
 	            $('.bg-success').css('background-color','#dff0d8');
 	           	$('.bg-danger').css('background-color','#f2dede');
 	            }
    	    });
 	    $('#btnSubmit').click(function(){
        	 $.post("{{route('caixa.fechar')}}", function( data ){
             			if(data.success == 'true'){
                 			$("#modalHeader").addClass("modal-header alert alert-success");
                 			$("#modalBody").html(data.message);
                 			$("#btnSubmit").html("OK");
                 			$("#btnCancel").remove();
                 			$("#btnSubmit").click(function(){
                     			window.location.reload(); 
                 			});
             			}
             			else{
             				$("#modalHeader").addClass("modal-header alert alert-danger");
             				$("#myModalLabel").html("ERRO!");
             				$("#btnCancel").remove();
                 			$("#modalBody").html(data.message);
             			}
             			$('#modalAlert').modal('show');
     			}, "json"
     		);
 	    });
    });
</script>
@stop