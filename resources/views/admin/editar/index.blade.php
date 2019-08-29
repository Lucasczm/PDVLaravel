@extends('adminlte::page')

@section('title', 'Estoque')
@section('css')
<style>
	.form-control{
		text-transform:uppercase
	}
	.label{
	   display: none;
	 }
</style>
@stop
@section('content_header')
    <h1>Editar Atributos</h1>
    
@stop

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row">
    <div class="col-md-12">
    	<label>Abaixo você pode editar atributos sobre os produtos. </label>
    	<span> Alterações salvas serão automaticamente alteradas no estoque</span>
	</div>
</div>
<div class="col-md-4">
     <div class="box">
     	<form class="submit" method="post">
         	<div class="box-header with-border">
            	<h3 class="box-title">Categoria</h3>
            	<div class="box-tools pull-right">
                	<span class="label label-success">Salvo</span>
                	<span class="label label-danger">Erro</span>
            	</div>
          	</div>
          	
          	<div class="box-body">
          		<input type="hidden" name="tipo" value="1"/>
       
          		<div id="1" class="form-group">
                	@include('admin.estoque.categoria')
                </div> 
                <div class="form-group">
                	<label>Alteração:</label>
                	<input class="form-control" name="atributo" required type="text" placeholder="Novo valor"/>
                </div>
          	</div>
          	<div class="box-footer">
            	<button class="btn btn-primary" type="submit">Salvar</button>
          	</div>
 		</form>
	 </div>

</div>
<div class="col-md-4">
     <div class="box">
     	<form class="submit" method="post">
         	<div class="box-header with-border">
            	<h3 class="box-title">Cor</h3>
            	<div class="box-tools pull-right">
                	<span class="label label-success">Salvo</span>
                	<span class="label label-danger">Erro</span>
            	</div>
          	</div>
          	
          	<div class="box-body">
          		<input type="hidden" name="tipo" value="2"/>
          		<div id="2" class="form-group">
                	@include('admin.estoque.cor')
                </div> 
                <div class="form-group">
                	<label>Alteração:</label>
                	<input class="form-control" name="atributo" required type="text" placeholder="Novo valor"/>
                </div>
          	</div>
          	<div class="box-footer">
            	<button class="btn btn-primary" type="submit">Salvar</button>
          	</div>
 		</form>
	 </div>
</div>
<div class="col-md-4">
     <div class="box">
     	<form class="submit" method="post">
         	<div class="box-header with-border">
            	<h3 class="box-title">Tamanho</h3>
            	<div class="box-tools pull-right">
                	<span class="label label-success">Salvo</span>
                	<span class="label label-danger">Erro</span>
            	</div>
          	</div>
          	
          	<div class="box-body">
          		<input type="hidden" name="tipo" value="3"/>
          		<div id="3" class="form-group">
                	@include('admin.estoque.tamanho')
                </div> 
                <div class="form-group">
                	<label>Alteração:</label>
                	<input class="form-control" name="atributo" required type="text" placeholder="Novo valor"/>
                </div>
          	</div>
          	<div class="box-footer">
            	<button class="btn btn-primary" type="submit">Salvar</button>
          	</div>
 		</form>
	 </div>
</div>
<div class="col-md-4">
     <div class="box">
     	<form class="submit" method="post">
         	<div class="box-header with-border">
            	<h3 class="box-title">Cor</h3>
            	<div class="box-tools pull-right">
                	<span class="label label-success">Salvo</span>
                	<span class="label label-danger">Erro</span>
            	</div>
          	</div>
          	
          	<div class="box-body">
          		<input type="hidden" name="tipo" value="6"/>
          		<div id="6" class="form-group">
                	@include('admin.estoque.unidade')
                </div> 
                <div class="form-group">
                	<label>Alteração:</label>
                	<input class="form-control" name="atributo" required type="text" placeholder="Novo valor"/>
                </div>
          	</div>
          	<div class="box-footer">
            	<button class="btn btn-primary" type="submit">Salvar</button>
          	</div>
 		</form>
	 </div>
</div>
<div class="col-md-4">
     <div class="box">
     	<form class="submit" method="post">
         	<div class="box-header with-border">
            	<h3 class="box-title">Marca</h3>
            	<div class="box-tools pull-right">
                	<span class="label label-success">Salvo</span>
                	<span class="label label-danger">Erro</span>
            	</div>
          	</div>
          	
          	<div class="box-body">
          		<input type="hidden" name="tipo" value="5"/>
          		<div id="5" class="form-group">
                	@include('admin.estoque.marcas')
                </div> 
                <div class="form-group">
                	<label>Alteração:</label>
                	<input class="form-control" name="atributo" required type="text" placeholder="Novo valor"/>
                </div>
          	</div>
          	<div class="box-footer">
            	<button class="btn btn-primary" type="submit">Salvar</button>
          	</div>
 		</form>
	 </div>
</div>
<div class="col-md-4">
     <div class="box">
     	<form class="submit" method="post">
         	<div class="box-header with-border">
            	<h3 class="box-title">Fornecedor</h3>
            	<div class="box-tools pull-right">
                	<span class="label label-success">Salvo</span>
                	<span class="label label-danger">Erro</span>
            	</div>
          	</div>
          	
          	<div class="box-body">
          		<input type="hidden" name="tipo" value="7"/>
          		<div id="7" class="form-group">
                	@include('admin.estoque.fornecedor')
                </div> 
                <div class="form-group">
                	<label>Alteração:</label>
                	<input class="form-control" name="atributo" required type="text" placeholder="Novo valor"/>
                </div>
          	</div>
          	<div class="box-footer">
            	<button class="btn btn-primary" type="submit">Salvar</button>
          	</div>
 		</form>
	 </div>
</div>
@stop
@section('js')
<script>
	$(function(){
		
		$('.submit').submit(function(e) {
			var sucess = $('.label-success',this);
			var error = $('.label-danger',this);
			var body = $('#'+$('input[name="tipo"]',this).val());
	      	$.post("{{route('estoque.editar.atributos')}}", $(this).serialize(), function( data )	{
	          			if(data.success == 'true'){
		          			console.log("true");
		          			sucess.show();
		          			sucess.fadeOut(3000);
		          			body.html(data.body);
	            			
	          			}
	          			else{
	          				error.html(data.message);
	          				error.show();
	          				error.fadeOut(3000);

	          			}
				}, "json"
			);

	      	$(document).ajaxError(function() {
	      		error.show();
	      		error.fadeOut(3000);
	      	});
	      	return false;
			
	    });

		$.ajaxSetup({
			   headers: {
			       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			   }
		});
	});
</script>
@stop