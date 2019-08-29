
@extends('adminlte::page') @section('title', 'Estoque')
@section('css')
	<style>
	.form-control{
		text-transform:uppercase
	}
    </style>
    <link rel="stylesheet" href="{{ asset('vendor/EasyAutocomplete-1.3.5/easy-autocomplete.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css')}}">
@stop
@section('content_header')
@include('admin.estoque.botoes')

<h3>Novo Item</h3>
@stop
@section('content')
@include('admin.modal')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div id="modal_content"></div>
<form id="cadastro" action="{{route('estoque.save')}}" method="POST">
    <div class="row">
    	<div class="col-md-6">
    		<div id="fornecedor">
    			<label>Fornecedor:</label>
				@include('admin.estoque.fornecedor')
			</div>
    			{{ csrf_field() }}
    			<div class="form-group">
    				<label for="codigo">Código</label> <input id="codigo" type="text"
    					required="required" name="codigo" class="form-control"
    					placeholder="Código" aria-describedby="basic-addon1">
    			</div>
    			<div class="form-group">
    				<label for="nome">Nome do produto</label> <input type="text"
    					id='nome' required="required" name="nome" class="form-control"
    					placeholder="Nome do produto" aria-describedby="basic-addon1">
    			</div>
    
    			<div class="form-group">
    				<label for="descricao">Descrição</label> <input type="text"
    					 name="descricao" class="form-control"
    					placeholder="Descrição" aria-describedby="basic-addon1">
    			</div>
    			<div class="col-md-6">
        			<div class="form-group">
        				<label for="estoque">Estoque</label> <input name="estoque"
        					id='estoque' class="form-control" placeholder="Quantidade no estoque"
        					aria-describedby="basic-addon1" type="number" required="required" />
        			</div>
        		</div>
        		<div class="col-md-6">
    				<div class="form-group">
            			<label for="unidade">Unidade</label>
            			<div class="row">
            				<div class="col-md-8">
            					<div id="unidade">
            						@include('admin.estoque.unidade')
            					</div>
                			</div>
            				<div class="col-md-1">
            					<button type="button" val="6" class="add_prop btn btn-success">
            						<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            					</button>
            				</div>
            			</div>
            		</div>
        		</div>
    			<div class="col-md-4">
        			<div class="form-group">
        				<label for="preco_custo">Preço de compra</label> <input id="preco_custo" required="required"
        					name="preco_custo" onClick="this.select();"  data-mask="000.000,00" data-mask-reverse="true" class="form-control" placeholder="Valor unitário"
        					aria-describedby="basic-addon1" />
        			</div>
    			</div>
    			<div class="col-md-4">
        			<div class="form-group">
        				<label for="lucro">Lucro (%) </label> <input id="lucro" required="required"
        					name="lucro" onClick="this.select();" data-mask="000%" class="form-control" placeholder="Valor unitário"
        					aria-describedby="basic-addon1" />
        			</div>
    			</div>
    			<div class="col-md-4">
        			<div class="form-group">
        				<label for="preco">Preço de Venda</label> <input id="preco" required="required"
        					name="preco" onClick="this.select();"  data-mask="000.000,00" data-mask-reverse="true" class="form-control" placeholder="Valor unitário"
        					aria-describedby="basic-addon1" />
        			</div>
    			</div>
    	</div>
    	<div class="col-md-6">
    		<div class="col-md-6">
    			<div class="form-group">
        			<label for="categoria">Categoria</label>
    				<div id="categoria">
    					@include('admin.estoque.categoria')
    				</div>
    			</div>
    		</div>
    		<div class="col-md-6">
    			<div class="form-group">
        			<label for="marcas">Marca</label>
        			<div id="marcas">
        				@include('admin.estoque.marcas')
        			</div>
            	</div>
            </div>
            	<div id="tocopy">
        			<div class="col-md-4">
            			<div class="form-group">
            				<label for="cor">Cor</label>
            				<div id="cor">
             					@include('admin.estoque.cor')
             				</div>
            			</div>
            		</div>
        			<div class="col-md-4">
        				<div class="form-group">
        					<label for="tamanho">Tamanho</label>
            				<div id="tamanho">
            					@include('admin.estoque.tamanho')
            				</div>
            			</div>
        			</div>
        			<div class="col-md-4">
            			<div class="form-group">
            				<label for="quantidade">Quantidade</label>
            				<div id="quantidade">
            					<input type="number" name="aux[quantidade][]" value="0" class="form-control"/> 
            				</div>
                		</div>
            		</div>
				</div>
        		<div id="topaste"></div>
        		<div class="col-md-1">
        			<button type="button" id="add-items" class="btn btn-success">
        				<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        			</button>
				</div>
    	</div>
     </div>
         <div class="col-md-5"><button type="submit" class="btn btn-primary">Registrar</button></div>
</form>

@stop
@section('js')

<script src="{{ asset('js/jquery.mask.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js')}}"></script>
<script type="text/javascript">
$(function() {
	var preco = $('#preco');
	var lucro = $('#lucro');
	var custo = $('#preco_custo');

	var mFornecedor = $('#mfornecedor');
	var mNome = $('#nome');
	var mEstoque = $('#estoque');
	var mUnidade = $('#munidade');
	var mCategoria = $('#mcategoria');
	var mMarcas = $('#mmarca');
	
	lucro.mask('000%', {reverse: true});
	
	$('#lucro').on('keyup',{val:1},calculo);
	$('#preco').on('keyup',{val:2},calculo);
	function calculo(vars){
		mCusto = custo.val().replace(".","");
		mCusto = mCusto.replace(",",".");
		mCusto = Number(mCusto);
		mLucro = lucro.cleanVal();
		mLucro = (Number(mLucro)/100) * mCusto;
		mPreco = preco.val().replace(".","").replace(",",".");
		var final_preco = parseFloat(mCusto + mLucro,-2).toFixed(2);
		if(vars.data.val == 1){
			preco.val(preco.masked(final_preco));
		}else if(vars.data.val == 2){
			mLucro = lucro.cleanVal();
			lucro.val(lucro.masked(parseFloat(((mPreco-mCusto)/mCusto)*100).toFixed(0)));
		}
		custo.keyup();
	}

	$('#cadastro').on('keyup keypress', function(e) {
	  	  var keyCode = e.keyCode || e.which;
	  	  if (keyCode === 13) { 
	  	    e.preventDefault();
	  	    return false;
	  	  }
	  	});
  	
     $('#cadastro').submit(function(e) {
      	$.post("{{route('estoque.save')}}", $("#cadastro").serialize(), function( data )	{
          			if(data.success == 'true'){
          				$("#modalHeader").addClass("modal-header alert alert-success");
             			$("#modalHeader").html('Estoque atualizado com sucesso!');
             			$("#modalBody").html(data.message);
            			$("#btnCancel").html("OK");
            			$("#btnSubmit").remove();
            			$('#btnCancel').click(function(){
            				location.reload();
            			});
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
    
	
	var url_load = "";
	var resultDiv = "";
	var i;
	$('.add_prop').click(function (){
		i =  Number($(this).attr('val'));
		
		$("#modal_content").load("{{route('estoque.atributos.modal')}}",function(){
			var titulo = $('#modalHeader');
			var label = $('#label_modal');
			var formModal = $('#att');
			var tipo = $('#tipo');
		
		   switch(i){
		   case 1:
			   label.text("Nova Categoria");
			   formModal.attr('placeholder','Ex. calças, roupas..');
			   $('#modalForm').modal('show');
			   tipo.val('1');
			   url_load = "{{route('estoque.atributos', 1)}}"
			   resultDiv = $('#categoria');
			   break;
		   case 2:
			   label.text("Nova Cor");
			   formModal.attr('placeholder','Ex. Rosa, branco e preto');
			   $('#modalForm').modal('show');
			   url_load = "{{route('estoque.atributos',2)}}"
			   tipo.val('2');
			   resultDiv = $('#cor');
			   break;
		   case 3:
			   label.text("Novo Tamanho");
			   formModal.attr('placeholder','Ex. M, GG, P..');
			   $('#modalForm').modal('show');
				url_load = "{{route('estoque.atributos',3)}} "
			   tipo.val('3');
				resultDiv = $('#tamanho');
			   break;
		   case 4:
			   label.text("Novo Tecido");
			   formModal.attr('placeholder','Ex. Algodão...');
			   $('#modalForm').modal('show');
			   url_load = "{{route('estoque.atributos',4)}}"
			   tipo.val('4');
			   resultDiv = $('#tecido');
			   break;
		   case 5:
			   label.text("Nova Marca");
			   formModal.attr('placeholder','Marca');
			   $('#modalForm').modal('show');
			   url_load = "{{route('estoque.atributos',5)}}"
			   tipo.val('5');
			   resultDiv = $('#marcas');
			   break;
		   case 6:
			   label.text("Nova Unidade");
			   formModal.attr('placeholder','Ex: PÇ, PC');
			   $('#modalForm').modal('show');
			   url_load = "{{route('estoque.atributos',6)}}"
			   tipo.val('6');
			   resultDiv = $('#unidade');
			   break;
		   case 7:
			   label.text("Novo Fornecedor");
			   formModal.attr('placeholder','Fornecedor');
			   $('#modalForm').modal('show');
			   url_load = "{{route('estoque.atributos',7)}}"
			   tipo.val('7');
			   resultDiv = $('#fornecedor');
			   break;	
		   }
		$('#formUp').submit(function(e) {
	    	$.post("{{route('estoque.atributos.add')}}", $("#formUp").serialize(), function( data )	{
	        	
	        			if(data.success == 'true'){
	            			$("#modalFormHeader").addClass("modal-header alert alert-success");
	            			$("#modalFormTitle").html("Atributo adicionado com sucesso!");
	            			$("#modalFormBody").html(data.message);
	            			$("#btnCancelForm").html("OK");
	            			$("#btnSubmitForm").remove();
	            			$( resultDiv ).load(url_load);
	        			}
	        			else{
	        				$("#modalFormHeader").addClass("modal-header alert alert-danger");
	        				$("#myModalLabel").html("ERRO!");
	        				$("#btnSubmitForm").remove();
	            			$("#modalFormBody").html(data.message);
	            			
	        			}
	        			$('#modalForm').modal('show');
				}, "json"
			);
			return false;
		});
			
		
	});
		
   });
	$('#add-items').click(function (){
		console.log("o");
		var bt = $('#tocopy').html();
		console.log(bt);
		$('#topaste').append(bt);
	});
	$("#codigo").autocomplete({
    	source: function (request, response) {
            $.post("{{route('estoque.api.estoqueID')}}",{search:request.term}, function (data) {
                response($.map(data, function (value, key) {
                    console.log(value);
                    return {
                        label: value.codigo,
                        value: value.codigo,
                        nome: value.nome,
                        fornecedor: value.fornecedor,
                        estoque_total: value.estoque,
                        unidade: value.unidade,
                        categoria: value.categoria,
                        marca: value.marca,
                        preco_custo: value.preco_custo,
                        preco: value.preco,
                        lucro: value.lucro

                    };
                }));
            },"json"
			);
          },
          minLength: 4,
          select: function( event, ui ) {
        	 mNome.val(ui.item.nome);
    	     mFornecedor.val(ui.item.fornecedor);
    	 	 mEstoque.val(ui.item.estoque_total);
			 mUnidade.val(ui.item.unidade);
			 mCategoria.val(ui.item.categoria);
			 mMarcas.val(ui.item.marca);
			 custo.val(custo.masked(ui.item.preco_custo));
			 preco.val(preco.masked(ui.item.preco));
			 lucro.val(lucro.masked(parseFloat(ui.item.lucro).toFixed(0)));
          }
        });

	$.ajaxSetup({
		   headers: {
		       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		   }
	});
});
</script>
@stop
