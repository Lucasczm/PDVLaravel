@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Modal -->
<div class="modal fade bs-example-modal-lg" id="modalAlert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalHeader">Alterar Cliente</h4>
      </div>
      <div id="modalBody" class="modal-body">
          <div class="row">
            <div class="col-md-6">
            <form id="formUp" method="POST">
            {{ csrf_field() }}
            	<input type="hidden" name="id" id="id">
              <div class="form-group">
              <label for="nome">Nome completo</label>
              <input type="text" id="nome" required="required" name="nome" class="form-control" placeholder="Nome" aria-describedby="basic-addon1">
              </div>
              <div class="form-group">
              <label for="CPF">CPF</label>
              <input type="text" id="CPF"  required="required" name="CPF" class="form-control" placeholder="CPF" aria-describedby="basic-addon1">
              </div>
              <div class="row">
              <div class="col-md-6">
              <div class="form-group">
              <label for="sexo">Sexo</label>
                <select id="sexo" name="sexo"  required="required" class="form-control">
                <option value="I">Não especificado</option>
                <option value="F">Feminino</option>
                <option value="M">Masculino</option>
            </select>
              </div>
              </div>
            <div class="col-md-6">
              <div class="form-group">
              <label for="nascimento">Data de nascimento</label>
              <input type="date" id="nascimento" name="nascimento" class="form-control" placeholder="Data de Nascimento" aria-describedby="basic-addon1" required="required" maxlength="10" name="date" pattern="[0-9]{2}\/[0-9]{2}\/[0-9]{4}$"  />
              </div>
            </div>
            </div>
              <div class="form-group">
              <label for="telefone">Telefone</label>
              <input type="tel" id="tel1" required="required" name="telefone" class="form-control" placeholder="Telefone" aria-describedby="basic-addon1" />
              </div>
              </div>
              <div class="col-md-6">
              <div class="form-group">
              <label for="cep">CEP</label>
              <input type="text" id="cep" name="cep" class="form-control" placeholder="CEP" aria-describedby="basic-addon1">
              </div>
            
              <div class="form-group">
              <label for="endereco">Endereço</label>
              <input type="text" id="endereco" name="endereco" class="form-control" placeholder="Ex. Rua Brasil 999" aria-describedby="basic-addon1">
              </div>
            
              <div class="form-group">
              <label for="bairro">Bairro</label>
              <input type="text" id="bairro"name="bairro" class="form-control" placeholder="Bairro" aria-describedby="basic-addon1">
              </div>
            
              <div class="form-group">
              <label for="cidade">Cidade</label>
              <input type="text" id="cidade" name="cidade" class="form-control" placeholder="Cidade" aria-describedby="basic-addon1">
              </div>
            
              <div class="form-group">
              <label for="estado">Estado</label>  
              <select name="estado" id="uf" class="form-control">
            	<option value="AC">Acre</option>
            	<option value="AL">Alagoas</option>
            	<option value="AP">Amapá</option>
            	<option value="AM">Amazonas</option>
            	<option value="BA">Bahia</option>
            	<option value="CE">Ceará</option>
            	<option value="DF">Distrito Federal</option>
            	<option value="ES">Espírito Santo</option>
            	<option value="GO">Goiás</option>
            	<option value="MA">Maranhão</option>
            	<option value="MT">Mato Grosso</option>
            	<option value="MS">Mato Grosso do Sul</option>
            	<option value="MG">Minas Gerais</option>
            	<option value="PA">Pará</option>
            	<option value="PB">Paraíba</option>
            	<option value="PR">Paraná</option>
            	<option value="PE">Pernambuco</option>
            	<option value="PI">Piauí</option>
            	<option value="RJ">Rio de Janeiro</option>
            	<option value="RN">Rio Grande do Norte</option>
            	<option value="RS" selected="selected">Rio Grande do Sul</option>
            	<option value="RO">Rondônia</option>
            	<option value="RR">Roraima</option>
            	<option value="SC">Santa Catarina</option>
            	<option value="SP">São Paulo</option>
            	<option value="SE">Sergipe</option>
            	<option value="TO">Tocantins</option>
            </select>
              </div>
            </form>
            </div>
            </div>
      </div>
      <div class="modal-footer">
        <button id="btnCancel" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button id="btnSubmit" type="button" class="btn btn-primary">Salvar alterações</button>
      </div>
    </div>
  </div>
</div>

<h4>Total de cadastros: {{$clientes->count() -1 }} </h4>
<div class="panel panel-default">
  <div class="panel-body">
        <div class="row">
            <div class="col-md-3">
                <div class="panel-heading">CPF</div>
            </div>
            <div class="col-md-3">
                <div class="panel-heading">Nome</div>
            </div>
        </div>
        @foreach ($clientes as $cli) 
            <div class="row">
                <div class="col-md-3">
                <a id="{{ $cli->id }}" class="btnEditar" href="#" > Editar</a>
                    <span>{{ $cli->CPF }}</span>
                </div>
                <div class="col-md-3">
                    <span>{{ $cli->nome }}</span>
                </div>
            </div>
        @endforeach
    </div>
</div>
@stop
@section('js')
<script src="{{ asset('js/jquery.mask.min.js') }}"></script>
<script src="{{ asset('js/jquery.correios.min.js') }}"></script>
<script type="text/javascript">
$(function() {

	
	$('#CPF').mask('000.000.000-00', {reverse: true});
	$('#tel1').mask('(00) 00000-0000');
	$('#cep').mask('00000-000');
	correios.init( 'ZtN8DSZnK7dJTGnusq2McsOmAZlNFkFR', 'Z7M3u2XQeUeFrdnitKMOkprujG9yLJmWnDBmCbUsyj9T4joS' );
    $('#cep').correios( '#endereco', '#bairro', '#cidade', '#uf', false);
    $('.btnEditar').click(function() {
        $("#formUp")[0].reset();
     	console.log($(this).attr('id'));
    	editar($(this).attr('id'));
    });
   	function editar(index){
    	$.post("{{route('clientes.editar')}}", { id: index, _token: $('meta[name="csrf-token"]').attr('content')}, function( data )	{
            	console.log(data.nome);
            	$("#id").val(data.id);
        		$("#nome").val(data.nome);
        		$("#CPF").val(data.CPF);
        		$("#sexo").val(data.sexo);
        		$("#nascimento").val(data.nascimento);
        		$("#tel1").val(data.telefone);
        		$("#cep").val(data.cep);
        		$("#endereco").val(data.endereco);
        		$("#bairro").val(data.bairro);
        		$("#cidade").val(data.cidade);
        		$("#uf").val(data.estado);
			}, "json"
		);
		$('#modalAlert').modal('show');
	};
	$('#btnSubmit').click(function() {
    	var dados = $("#formUp").serialize();
    	console.log(dados);
    	$.post("{{route('clientes.saveEdit')}}",dados, function( data )	{
        	console.log(data.success);
        	console.log(data.isSuccess);
        			if(data.success == 'true'){
            			$("#modalHeader").addClass("modal-header alert alert-success");
            			$("#myModalLabel").html("Cliente editado com sucesso!");
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
});</script>
@stop