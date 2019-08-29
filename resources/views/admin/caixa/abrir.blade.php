@extends('adminlte::page')

@section('title', 'Caixa')

@section('content_header')
    <h1>Abrir Caixa</h1>
@stop

@section('content')
@include('admin.modal')

	<?php if($aberto && $caixa != null): ?>
		<div class="alert alert-danger" role="alert">Ops! Caixa já esta aberto!</div>
	<?php elseif(!$aberto && $caixa != null):?>
		<div class="alert alert-danger" role="alert">Ops! Caixa já foi aberto hoje!</div>
	<?php else:?>
	<form id="abrirForm" method="post">
	{{csrf_field()}}
	<input name="valor" class="form-control" placeholder="Valor em caixa"  data-mask="000.000,00" data-mask-reverse="true" required/> 
	<button type="submit" >Abrir Caixa</button>
	</form>
	<?php endif;?>
@stop
@section('js')
<script src="{{ asset('js/jquery.mask.min.js') }}"></script>
<script>
	$(function(){
		$('#abrirForm').submit(function(){
			$.post("{{ route('caixa.abrir') }}",$('#abrirForm').serialize(),function(data){
				if(data.success == 'true'){
        			$("#modalHeader").addClass("modal-header alert alert-success");
        			$("#modalHeader").html('Caixa aberto com sucesso!');
        			$("#modalBody").html(data.message);
        			$("#btnCancel").html("OK");
        			$("#btnSubmit").remove();
    	    	}
    			else{
    				$("#modalHeader").addClass("modal-header alert alert-danger");
    				$("#myModalLabel").html("ERRO!");
    				$("#btnSubmit").remove();
        			$("#modalBody").html(data.message);
        			
    			}
    			$('#modalAlert').modal('show');
			}, "json"
		);
		return false;
		});
		$('#btnCancel').click(function(){
			location.reload();
		});
	});
</script>
@stop