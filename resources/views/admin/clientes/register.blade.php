@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
<h3>Novo cliente</h3>
@stop

@section('content')
<div class="modal fade" id="modalAlert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div id="modalHeader" class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"> Title</h4>
      </div>
      <div id="modalBody"class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" id="btnModal"class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>


<div class="row">
<div class="col-md-6">
<form id="formReg" method="POST">
{{ csrf_field() }}
  <div class="form-group">
  <label for="nome">Nome completo</label>
  <input type="text"  required="required" name="nome" class="form-control" placeholder="Nome" aria-describedby="basic-addon1">
  </div>
  <div class="form-group">
  <label for="CPF">CPF</label>
  <input type="text" id="CPF"  required="required" name="CPF" class="form-control" placeholder="CPF" aria-describedby="basic-addon1">
  </div>
  <div class="row">
  <div class="col-md-6">
  <div class="form-group">
  <label for="sexo">Sexo</label>
    <select name="sexo"  required="required" class="form-control">
    <option value="I">Não especificado</option>
    <option value="F">Feminino</option>
    <option value="M">Masculino</option>
</select>
  </div>
  </div>
<div class="col-md-6">
  <div class="form-group">
  <label for="nascimento">Data de nascimento</label>
  <input type="date" name="nascimento" class="form-control" placeholder="Data de Nascimento" aria-describedby="basic-addon1" required="required" maxlength="10" name="date" pattern="[0-9]{2}\/[0-9]{2}\/[0-9]{4}$"  />
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

  <button type="submit" class="btn btn-primary">Salvar</button>
</form>
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
    
    $('#formReg').on('keyup keypress', function(e) {
  	  var keyCode = e.keyCode || e.which;
  	  if (keyCode === 13) { 
  	    e.preventDefault();
  	    return false;
  	  }
  	});
    $('#formReg').submit(function(event) {
    	var dados = $(this).serialize();
    	$.post("{{route('clientes.save')}}",dados, function( data )	{
        	console.log(data.success);
        	console.log(data.isSuccess);
        			if(data.success == 'true'){
            			$("#modalHeader").addClass("modal-header alert alert-success");
            			$("#myModalLabel").html("Cliente adicionado com sucesso!");
            			$("#modalBody").html(data.message);
            			$("#btnModal").click(function(){
                			window.location.reload(); 
            			});
        			}
        			else{
        				$("#modalHeader").addClass("modal-header alert alert-danger");
        				$("#myModalLabel").html("ERRO!");
            			$("#modalBody").html(data.message);
        			}
        			$('#modalAlert').modal('show');
			}, "json"
		);
		return false;
	});
 });
</script>
@stop
