@extends('adminlte::page')

@section('title', 'Estoque')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables.min.css') }}"/>
<style>
    tbody tr td{
   text-transform: uppercase;
    }
</style>
@stop
@section('content_header')
    <h1>Dashboard</h1>
    
@stop

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Modal -->
<div class="modal fade bs-example-modal-lg" id="modalAlert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" id="modalHeader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar Estoque</h4>
      </div>
      <div id="modalBody" class="modal-body">
      	<div class="row">
      		<form id="formUp" method="POST">
        		<div class="col-md-4">
      				{{ csrf_field() }}
            		<input type="hidden" name="id" id="id">
            		<input type="hidden" name="estoque_id" id="estoque_id">
              		<div class="form-group">
              			<label for="nome">Nome</label>
              			<input type="text" id="nome" required="required" name="nome" class="form-control" placeholder="Nome" aria-describedby="basic-addon1">
             		</div>
                </div>
              	<div class="col-md-4">
              		<div class="form-group">
              			<label for="cep">Descrição</label>
              			<input type="text" id="descricao" name="descricao" class="form-control" placeholder="Descrição" aria-describedby="basic-addon1">
              		</div>
                </div>
                <div class="col-md-4">
              		<div class="form-group">
              			<label for="cep">Estoque</label>
              			<input type="number" id="estoque" name="estoque" class="form-control" placeholder="Estoque" aria-describedby="basic-addon1">
              		</div>
                </div>
                 <div class="col-md-4">
              		<div class="form-group">
              			<label>Preço de custo</label>
              			<input type="text" data-mask="000.000,00" data-mask-reverse="true" id="preco_custo" name="preco_custo" class="form-control" placeholder="Preço de custo" aria-describedby="basic-addon1">
              		</div>
                </div>
                 <div class="col-md-4">
              		<div class="form-group">
              			<label>Lucro</label>
              			<input type="text"  data-mask="000%" id="lucro" name="lucro" class="form-control" placeholder="Lucro" aria-describedby="basic-addon1">
              		</div>
                </div>
                <div class="col-md-4">
              		<div class="form-group">
              			<label>Preço</label>
              			<input type="text" data-mask="000.000,00" data-mask-reverse="true" id="preco" name="preco" class="form-control" placeholder="Preço" aria-describedby="basic-addon1">
              		</div>
                </div>
           </div>
      </div>
      <div class="modal-footer">
        <button id="btnCancel" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button id="btnSubmit" type="submit" class="btn btn-primary">Salvar alterações</button>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="row">
	<div class="row">
		<div class="col-md-8">
    		<button class="btn btn-default editar">Editar<span class="glyphicon glyphicon-edit"></span></button>
    		<button class="btn btn-default excluir">Exluir<span class="glyphicon glyphicon-trash"></span></button>
    	</div>
    	<div class="col-md-4">
    		
    	</div>
		<div class="col-md-4 offset-md-4">
			<input class="form-control" placeholder="Pesquisar" type="number" id="search"/>
		</div>
	</div>
   	<table id="estoque-table"   class="table hover order-column table-striped compact table-bordered" cellspacing="0" width="100%">
      <thead class="thead-light">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Código</th>
          <th scope="col">Categoria</th>
          <th scope="col">Nome</th>
          <th scope="col">Marca</th>
          <th scope="col">Descrição</th>
          <th scope="col">Tamanho</th>
          <th scope="col">Tecido</th>
          <th scope="col">Cor</th>
          <th scope="col">Estoque</th>
          <th scope="col">Preço</th>
          <th scope="col">Lucro</th>
          <th scope="col">Custo</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
    <div class="col-md-6">
		<button class="btn btn-default editar">Editar<span class="glyphicon glyphicon-edit"></span></button>
		<button class="btn btn-default excluir">Exluir<span class="glyphicon glyphicon-trash"></span></button>
	</div>
</div>
@stop
@section('js')
<script src="{{ asset('js/jquery.mask.min.js') }}"></script>
<script src="{{ asset('vendor/datatables.min.js') }}"></script>
<script type="text/javascript">
    $(function() {
    	var preco = $('#preco');
    	var lucro = $('#lucro');
    	var custo = $('#preco_custo');
    	
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
    			lucro.val(lucro.masked(parseFloat(((mPreco-mCusto)/mCusto)*100).toFixed(0)	));
    		}
    		custo.keyup();
    	}
    	
	 	var table = $('#estoque-table').DataTable( {
    		 	"bPaginate": false, 
    		 	"searching": false,
    		    "sDom": '<"#top_table"f>rt<"#bt_table"flp>',
    	        "language": {
    	            "lengthMenu": "Exibir _MENU_ registros por página",
    	            "zeroRecords": "Nada encontrado",
    	            "info": "Exibindo _PAGE_ de _PAGES_",
    	            "infoEmpty": "Nenhum registro encontrado",
    	            "infoFiltered": "(filtrado de _MAX_ todos os registros)"
    	        },
    		 "ajax": {
             	"url":"{{route('estoque.api.listar')}}", 
    	        },
    	      "columns": [
    	            { "data": "id" },
    	            { "data": "codigo" },
    	            { "data": "categoria" },
    	            { "data": "nome" },
    	            { "data": "marca"},
    	            { "data": "descricao" },
    	            { "data": "tamanho" },
    	            { "data": "tecido" },
    	            { "data": "cor" },
    	            { "data": "estoque" },
    	            { "data": "preco" },
    	            { "data": "lucro" },
    	            { "data": "preco_custo" },
    	        ],
    	        "columnDefs": [
    	            {
    	                "targets": [11,12],
    	                "visible": false,
    	                "searchable": false
    	            }],
                "initComplete": function( settings, json ) {
                	loadtable(json);
                   }
    	    });

    	htmlPag='<span id="pg_n"></span><button class="pull-right btn btn-default next">Proximo ></button><button class="btn btn-default prev pull-right">< Anterior</button>';
	    $('#top_table').html( htmlPag);
	    $('#bt_table').html(htmlPag);
    	$('.next').click(function(){navigate(1)}); 
    	$('.prev').click(function(){navigate(-1)}); 
    	
    	 function navigate(m){
        	 var nextp = table.ajax.json().next_page_url;
        	 var prevp = table.ajax.json().prev_page_url;
        	 if(m >0){
        	 	table.ajax.url(nextp).load(loadtable,true);
        	 }else  table.ajax.url(prevp).load(loadtable,true);
        	 
    	 }
    	 function loadtable(data){
        	 $('#pg_n').text("Página " + data.current_page + " de "+ data.last_page);
    		if(data.next_page_url != null){ 
    		 	$('.next').prop("disabled",false);
    		}else{
    			$('.next').prop("disabled",true);
    		}
    		if(data.prev_page_url != null){ 
    		 	$('.prev').prop("disabled",false);
    		}else{
    			$('.prev').prop("disabled",true);
    		}
    	 }
    	 $('#estoque-table tbody').on( 'click', 'tr', function () {
 	        if ( $(this).hasClass('selected') ) {
 	            $(this).removeClass('selected');
 	        }
 	        else {
 	            table.$('tr.selected').removeClass('selected');
 	            $(this).addClass('selected');
 	        }
 	    });
  	    $('#search').keyup(function(){
			if($(this).val().length > 3){
				var link = "{{route('estoque.api.listar')}}/" + $(this).val();
			 	table.ajax.url(link).load(loadtable,true);
			}else if($(this).val().length <= 0){
				table.ajax.url('{{route('estoque.api.listar')}}').load(loadtable,true);
			}  	    
  	  	});
	 	function editar(data){
	 		$("#id").val(data['id']);
	 		$("#estoque_id").val(data['codigo']);
    		$("#nome").val(data['nome']);
    		$("#descricao").val(data['descricao']);
    		$("#estoque").val(data['estoque']);
    		$("#preco_custo").val(preco.masked(data['preco_custo']));
    		$("#lucro").val(data['lucro']);
    		$("#preco").val(preco.masked(data['preco']));
	 	}
	 	
	 	function apagar(data){
		 	if(confirm("Deseja apagar esse registro")){
    		 	$.post("{{route('estoque.api.delete')}}",{id:data['id']},function(data){
    		 		if(data.success == true){
        		 		alert("Registro apagado com sucesso");
    		 			location.reload();
    		 		}else if(data.error == 1451){
    		 			alert("Não pode ser apagado! Já existe registro nas vendas");
    		 		}else{
    		 			alert("Ocorreu um erro ao tentar apagar");	
    		 		}
    		 		
    		 	},"json");
		 	}
	 	}
 	    $('.editar').click( function () {
 	   		editar(table.row('.selected').data());
 	    	$('#modalAlert').modal('show');
 	    } );
 	   $('.excluir').click( function () {
	   		apagar(table.row('.selected').data());
	    } );

 	   $('#formUp').submit(function(e) {
	    	$.post("{{route('estoque.api.save')}}", $("#formUp").serialize(), function( data )	{
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
	            			$('#btnCancel').click(function(){
	            				location.reload();
	            			});
	        			}
	        			$('#modalAlert').modal('show');
				}, "json"
			);
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