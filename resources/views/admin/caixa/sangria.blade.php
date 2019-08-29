@extends('adminlte::page')

@section('title', 'Caixa')

@section('content_header')
    <h1>Retirada</h1>
@stop

@section('content')
@include('admin.modal')
    <div class="col-md-12">
    	<form id="sangriaForm" method="post">
    	{{csrf_field()}}
    	<label>Valor da Retirada: R$</label>
    	<input name="valor" class="form-control" placeholder="Valor da Retirada"  data-mask="000.000,00" data-mask-reverse="true"
    	<?php if(!$aberto)echo 'disabled';?> 
    	required/>
    	<label>Descrição</label>
    	<input type="text" name="descricao" class="form-control" placeholder="Descrição" 	<?php if(!$aberto)echo 'disabled';?> required/> 
    	<br>
    	<button class="btn btn-success" type="submit" 	<?php if(!$aberto)echo 'disabled';?> >Retirar</button>
    	</form>
    </div>
@stop
@section('js')
<script src="{{ asset('js/jquery.mask.min.js') }}"></script>
<script>
	$(function(){
		$('#sangriaForm').submit(function(){
			$.post("{{ route('sangria') }}",$('#sangriaForm').serialize(),function(data){
				if(data.success == 'true'){
        			$("#modalHeader").addClass("modal-header alert alert-success");
        			$("#modalHeader").html('Retirada com sucesso!');
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