@extends('adminlte::page')

@section('title', 'Caixa')
@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/EasyAutocomplete-1.3.5/easy-autocomplete.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css')}}">
    <style>
        select[readonly] {
            background: #eee; 
            pointer-events: none;
            touch-action: none;
        }
    </style> 
@stop
@section('content_header')
    <h1>Vender</h1>
@stop

@section('content')
@include('admin.modal')
<meta name="csrf-token" content="{{ csrf_token() }}">
	<div id="cupom"></div>
	<div id="tocopy" style="display:none;">
		<div>
		<div  class="row">
    		<div class="col-md-3">	
    		  	 <label>Codigo: </label>
    			 <input id="estoq" class="find form-control"/>
    			 <input type="hidden" name="venda[codigo][]"/>
    			 <input type="hidden" name="venda[codigo_aux][]"/>
    		</div>
    		<div class="col-md-1">
    			<label>Tamanho:</label>
    			<input id="tam" name="venda[tamanho][]" class="form-control" readonly  />
    		</div>
    		<div class="col-md-2">
    			<label>Cor:</label>
    			<input id="cor" name="venda[cor][]" class="form-control" readonly />
    		</div>
    		<div class="col-md-2">
    			<label>Preço:</label>
    			<input id="real_preco" name="venda[real][]" class="form-control" readonly />
    		</div>
    		<div class="col-md-2">
    			<label>Quantidade:</label>
    			<input id="quan" name="venda[quantidade][]" oninput="$(this).trigger('change');" type="number" class="form-control" />
    		</div>
    		<div class="col-md-2">
    			<label>Total R$:</label>
    			<input id="preco" data-mask="000.000,00" data-mask-reverse="true" name="venda[total][]" class="form-control"  />
    		</div>
    	</div>
    	<div class="row" style="border-bottom: solid 1px;padding:5px;margin-bottom:15px"><div class="col-md-12"><span class="p_name"></span></div></div>
    	</div>
	</div>
	<div class="md-col-12">
    	<form id="vendaForm" method="post">
    		{{csrf_field()}}
        	<div class="row">
        		<div class="col-md-3">
            		<label>Cliente</label>
            		<input onClick="this.select();" id="cliente" name="cliente" value="000.000.000-00"/>
        		</div>
    		</div>
    		<div id="topaste"></div>
    		<div class="row">
        		<div class="col-md-2">
        			<label>Adicionar item</label>
            		<button type="button" id="add-items" class="btn btn-success">
                    	<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </button>
                </div>
                <div class="col-md-2 col-md-offset-6">
                    <label>Total de itens:</label>
                    <input id="item_total" class="form-control"/>
                </div>
                <div class="col-md-2 ">
                    <label>Total:</label>
                    <input id="total"  data-mask="000.000,00" data-mask-reverse="true" class="form-control"/>
                </div>
                <div class="col-md-2 col-md-offset-2">
                    <label>Desconto:</label>
                    <input id="desconto" oninput="$(this).trigger('change');" data-mask="000%" data-mask-reverse="true" name="desconto" class="form-control"/>
                </div>
            	<div class="col-md-2 ">
            		<label>Pagamento:</label>
                    <select id="pagamento" name="pagamento" class="form-control">
                    	<option value="DI">Dinheiro</option>
                    	<option value="CR">Crédito</option>
                    	<option value="DE">Débito</option>
                    </select>
                </div>
                <div class="col-md-2">
                	<label>Parcelas:</label>
                   <select id="parcelas" name="parcelas" class="form-control"readonly="readonly">
                    	<option value="1">1x</option>
                    	<option value="2">2x</option>
                    	<option value="3">3x</option>
                    	<option value="4">4x</option>
                    	<option value="5">5x</option>
                    	<option value="6">6x</option>
                    	<option value="7">7x</option>
                    	<option value="8">8x</option>
                    	<option value="9">9x</option>
                    	<option value="10">10x</option>
                    	<option value="11">11x</option>
                    	<option value="12">12x</option>
                    	
                    </select>
                 </div>
                 <div class="col-md-2">
                 	<label>Valor da parcela:</label>
                	<input id="valor_parcelas" name="valor_parcelas"  data-mask="000.000,00" data-mask-reverse="true" class="form-control"/>
                </div>
                <div class="col-md-2">
                 	<label>Total a pagar:</label>
                	<input id="total_pagar" data-mask="000.000,00" data-mask-reverse="true" name="total" class="form-control"/>
                </div> 
                <div class="col-md-2 col-md-offset-2">
					<label>Pg. em dinheiro e crédito:</label><br>
                	<input id="dividir" value="true" oninput="$(this).trigger('change');"  name="dividir" type="checkbox"/>
                </div>
                <div class="col-md-2 ">
					<label>Dinheiro:</label>
                	<input id="dinheiro" name="dinheiro" data-mask="000.000,00"  oninput="$(this).trigger('change');" data-mask-reverse="true"class="form-control" readonly/>
                </div>
                <div class="col-md-2 col-md-offset-2">
                 	<label>Valor recebido:</label>
                	<input id="val_recebido" data-mask="000.000,00" data-mask-reverse="true" name="valor_dinheiro" class="form-control"/>
                </div>
                <div class="col-md-2">
                 	<label>Troco:</label>
                	<input id="troco" data-mask="000.000,00" data-mask-reverse="true" name="troco" class="form-control" readonly/>
                </div>
            </div>
            <button class="btn btn-success" type="submit"<?php if(!$aberto)echo 'disabled';?>>Enviar</button>
    	</form>
	</div>
@stop
@section('js')
<script src="{{ asset('js/jquery.mask.min.js') }}"></script>
<script src="{{ asset('vendor/EasyAutocomplete-1.3.5/jquery.easy-autocomplete.min.js')}}"></script> 
<script src="{{ asset('js/jquery-ui.min.js')}}"></script>
<script>
$(function(){
	var mEstoqueR = "#topaste > .row > .col-md-3 > .easy-autocomplete > #estoq";
	var mEstoque = "#topaste > .row > .col-md-3 > #estoq";
	var mCodigo = "#topaste > .row > .col-md-3 > #codigo";
	var mCodigo_aux = "#topaste > .row > .col-md-3 > #codigo_aux";
	var mQuant = "#topaste > .row > .col-md-2 > #quan";
	var mTamanho = "#topaste > .row > .col-md-1 > #tam";
	var mCor = "#topaste > .row > .col-md-2 > #cor";
	var mReal = "#topaste > .row > .col-md-2 > #real_preco";
	var mPreco = "#topaste > .row > .col-md-2 > #preco";
	var mTotal = "#total";
	var mPagamento = "#pagamento";
	var mParcelas = "#parcelas";
	var mValor_parcelas = "#valor_parcelas";
	var mDesconto = "#desconto";
	var mTotal_pagar = "#total_pagar";
	var mValor_pago = "#val_recebido";
	var mTroco = "#troco";
	var cliente = {
			url: "{{route('cliente.api.listar')}}",
			getValue: "CPF",
			list: {
				match: {
					enabled: true
				}
			},
			 template: {
			        type: "description",
			        fields: {
			            description: "nome"
			        }
			    },
	};
	$("#cliente").easyAutocomplete(cliente);
	
	function moneyParse(money){
		return parseFloat(money.replace(".","").replace(",","."),-2).toFixed(2);
	}
	function moneyMask(val){
		return $(mTotal_pagar).masked(val);
	}
	function calcular(){
		var total = 0
		var total_compras = moneyParse($(mTotal).val());
		var desconto = Number($(mDesconto).val().replace('%',''));
		var parcelas = Number($(mParcelas).val());
		if($("#dividir").is(":checked")){
    		var dinheiro = moneyParse($("#dinheiro").val());
    		if(dinheiro != "NaN"){
        		total = total_compras - dinheiro;
        		var per = (dinheiro/total_compras)*100 ;
        		total = parseFloat(total,-2).toFixed(2);
        		$(mDesconto).val(parseFloat(per).toFixed(0) + "%");
    		}
    	}else{
			total = total_compras - (desconto/100 * total_compras);
			total = parseFloat(total,-2).toFixed(2);
		}
		$(mTotal_pagar).val(moneyMask(total));
		$(mValor_parcelas).val(moneyMask(parseFloat(total/$(mParcelas).val(),-2).toFixed(2)));
	}
	$(mPagamento).change(function(){
		if($(this).val() == "CR" ){
			$(mParcelas).removeAttr('readonly').trigger("change");
		}
		else{
			$(mParcelas).val(1);
			$(mParcelas).attr('readonly',"true").trigger("change");
		}
	});
	
	$(mTotal).change(function(){
		calcular();
	});
	$(mParcelas).change(function(){
		calcular();
	});
	$(mDesconto).change(function(){
		calcular();
	});
	$("#dinheiro").change(function(){
		calcular();
	});
	$("#dinheiro").keyup(function(){
		$(this).trigger('change');
	});
	$("#dividir").change(function(){
		if($(this).is(":checked")){
			$(mPagamento).val("CR");
			$(mDesconto).attr('readonly',true);
			$(mDesconto).val("").trigger("change");
			$("#dinheiro").val("0").trigger("change");
			$("#dinheiro").attr('readonly',false);
		}else{
			$(mDesconto).attr('readonly',false);
			$(mDesconto).val("").trigger("change");
			$("#dinheiro").val("").trigger("change");
			$("#dinheiro").attr('readonly',true);
		}
	});
	$(mValor_pago).keyup(function(){
		var pago = $(mValor_pago).val();
		var total = $(mTotal_pagar).val();
		if(parseFloat(moneyParse(pago)) >= parseFloat(moneyParse(total))){
			$(mTroco).val(moneyMask(parseFloat(moneyParse(pago) - moneyParse(total)).toFixed(2)));
		}else {
			$(mTroco).val(moneyMask(0.00));
		}
	});
	
	$('#add-items').click(function (){
		$(mEstoqueR).prop('readonly',true);
		$(mEstoqueR).removeAttr('id');
		$(mCodigo).removeAttr('id');
		$(mCodigo_aux).removeAttr('id');
		$(mTamanho).removeAttr('id');
		$(mCor).removeAttr('id');
		$(mReal).removeAttr('id');
		$(mQuant).removeAttr('id');
		$(mPreco).removeAttr('id');
		var bt = $('#tocopy').html();
		var paste = $('#topaste').append(bt);
		appendAutocomplete();
		$(mPreco).mask('000.000,00', {reverse: true});
		$("input[name='venda[quantidade][]']").change(function(){
			var preco = parseFloat(moneyParse($(this).val()) * moneyParse(	$(this).parent().parent().find("input[name='venda[real][]']").val()),-2).toFixed(2);
			var total = 0;
			$(this).parent().parent().find("input[name='venda[total][]']").val(moneyMask( preco)).trigger("change");
			$("input[name='venda[total][]']").each(function() {
				if($(this).val() != 0){					 
					total = parseFloat(parseFloat(total) + parseFloat(moneyParse($(this).val()))).toFixed(2);
				}	
			});
			
		 	$(mTotal).val(moneyMask(total)).trigger("change");
		 	total = 0;
		 	$("input[name='venda[quantidade][]']").each(function() {
				total += Number($(this).val());
			});
		 	$('#item_total').val(total).trigger("change");
		});
		
	});
	function closePrint () {
		  document.body.removeChild(this.__container__);
	}
	function setPrint () {
		  this.contentWindow.__container__ = this;
		  this.contentWindow.onbeforeunload = closePrint;
		  this.contentWindow.onafterprint = closePrint;
		  this.contentWindow.focus(); // Required for IE
		  this.contentWindow.print();
		}

	function printPage (sURL) {
	  var oHiddFrame = document.createElement("iframe");
	  oHiddFrame.onload = setPrint;
	  oHiddFrame.style.visibility = "hidden";
	  oHiddFrame.style.position = "fixed";
	  oHiddFrame.style.right = "0";
	  oHiddFrame.style.bottom = "0";
	  oHiddFrame.src = sURL;
	  document.body.appendChild(oHiddFrame);
	}
	$('#vendaForm').on('keyup keypress', function(e) {
	  var keyCode = e.keyCode || e.which;
	  if (keyCode === 13) { 
	    e.preventDefault();
	    return false;
	  }
	});
    $('#vendaForm').submit(function(){
        var NT;
        $("#modalBody").html('Processando, aguarde ...');
        $("#modalHeader").html('AGUARDE');
		$('#modalAlert').modal({backdrop: 'static', keyboard: false})  
        $('#modalAlert').modal('show');
		$("#btnSubmit").hide();
		$("#btnCancel").hide();
    	 $.post("{{route('venda.registrar')}}",$('#vendaForm').serialize(), function( data ){
    		 if(data.success == 'true'){
    			$("#btnSubmit").show();
    			$("#btnCancel").show();
     			$("#modalHeader").addClass("modal-header alert alert-success");
     			$("#modalHeader").html('Venda realizada com sucesso!');
     			$("#btnCancel").html("OK");
     			$("#btnSubmit").html("Gerar Comprovante");
     			NT = data.NT;
     			$("#modalBody").html(data.message + ' NT: 00'+NT);
     			$("#btnSubmit").click(function(){
     				printPage('{{route('venda.cupom.route')}}/'+NT);
     			});
 	    	}
 			else{
 				$("#modalHeader").addClass("modal-header alert alert-danger");
 				$("#myModalLabel").html("ERRO!");
 				$("#btnSubmit").remove();
     			$("#modalBody").html(data.message);
     			$("#btnCancel").show();
     			
 			}
 			
			}, "json"
		).fail(function(xhr, status, error){
			$("#modalHeader").addClass("modal-header alert alert-danger");
			$("#modalHeader").html("ERRO!");
			$("#btnSubmit").remove();
 			$("#modalBody").html(error);
 			$("#btnCancel").show();
		});
		return false;
	});
	$('#btnCancel').click(function(){
		location.reload();
	});
	function appendAutocomplete(){
    	$(".find").autocomplete({
        	source: function (request, response) {
                $.post("{{route('estoque.api.disponivel')}}",{search:request.term}, function (data) {
                    response($.map(data, function (value, key) {
                        return {
                            label: value.codigo + " | " + value.cor + " | " + value.tamanho ,
                            value: value.codigo,
                            codigo: value.codigo,
                            codigo_aux: value.id,
                            nome: value.nome,
                            tamanho: value.tamanho,
                            cor: value.cor,
                            real_preco: value.preco,
    
                        };
                    }));
                },"json"
    			);
              },
              minLength: 4,
              select: function( event, ui ) {
            		$(this).siblings("input[name='venda[codigo][]']").val(ui.item.value);
            		$(this).siblings("input[name='venda[codigo_aux][]']").val(ui.item.codigo_aux);
            		$(this).parent().parent().parent().find(".p_name").text(ui.item.nome);
            		$(this).parent().parent().find("input[name='venda[tamanho][]']").val(ui.item.tamanho);
            		$(this).parent().parent().find("input[name='venda[cor][]']").val(ui.item.cor);
            		$(this).parent().parent().find("input[name='venda[real][]']").val(moneyMask(ui.item.real_preco)).trigger("change");
            		$(this).parent().parent().find("input[name='venda[quantidade][]']").trigger("change");
              }
            });
    
	}
	$.ajaxSetup({
		   headers: {
		       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		   }
	});
} );
</script>
@stop