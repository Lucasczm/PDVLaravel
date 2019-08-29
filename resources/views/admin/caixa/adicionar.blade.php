@extends('adminlte::page')

@section('title', 'Caixa')

@section('content_header')
    <h1>Entrada de caixa</h1>
@stop

@section('content')
@include('admin.modal')
    <div class="col-md-12">
    	<form id="addForm" method="post">
    	{{csrf_field()}}
    	<label>Valor da Entrada: R$</label>
    	<input name="valor" class="form-control" placeholder="Valor da Entrada"  data-mask="000.000,00" data-mask-reverse="true"
    	<?php if(!$aberto)echo 'disabled';?> 
    	required/>
    	<label>Descrição</label>
    	<input type="text" name="descricao" class="form-control" placeholder="Descrição" <?php if(!$aberto)echo 'disabled';?> required/> 
    	<br>
    	<button class="btn btn-success" type="submit" <?php if(!$aberto)echo 'disabled';?> >Adicionar</button>
    	</form>
    </div>
@stop
@section('js')
<script src="{{ asset('js/jquery.mask.min.js') }}"></script>
<script>
	$(function(){
		$('#addForm').submit(function(){
			 $("#modalBody").html('Processando, aguarde ...');
		        $("#modalHeader").html('AGUARDE');
				$('#modalAlert').modal({backdrop: 'static', keyboard: false})  
		        $('#modalAlert').modal('show');
				$("#btnSubmit").hide();
				$("#btnCancel").hide();
			$.post("{{ route('caixa.add') }}",$('#addForm').serialize(),function(data){
				if(data.success == 'true'){
        			$("#modalHeader").addClass("modal-header alert alert-success");
        			$("#modalHeader").html('Caixa aberto com sucesso!');
        			$("#modalBody").html(data.message);
        			$("#btnCancel").html("OK");
        			$("#btnSubmit").remove();
        			$("#btnCancel").show();
    	    	}
    			else{
    				$("#modalHeader").addClass("modal-header alert alert-danger");
    				$("#myModalLabel").html("ERRO!");
    				$("#btnSubmit").remove();
        			$("#modalBody").html(data.message);
        			$("#btnCancel").show();
    			}
    			$('#modalAlert').modal('show');
			}, "json"
		).fail(function(xhr, status, error){
			$("#modalHeader").addClass("modal-header alert alert-danger");
			$("#modalHeader").html("ERRO!");
			$("#btnSubmit").remove();
 			$("#modalBody").html(error);
 			$("#btnCancel").show();
		});
		 return false;
		$('#btnCancel').click(function(){
			location.reload();
		});
	});
	});
</script>
@stop