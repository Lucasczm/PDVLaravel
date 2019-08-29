<html>
<head>

<link rel="stylesheet" href="{{asset('css/cupom.css')}}" />
<!--script src="{{asset('js/less.min.js')}}"></script>-->
</head>
<body>

<table class="printer-ticket">
 	<thead>
		<tr>
			<th class="title" colspan="3">{{env('APP_NAME')}}</th>
		</tr>
		<tr>	
			<td>{{$transacao->cliente->nome}}</td>
			<td></td>
			<td align="right">Data: {{$transacao->data}}</td>	
		</tr>
		<tr>
			<td>{{$transacao->cliente->CPF}}</td>
			<td></td>
			<td>Emissão:  {{$transacao->emissao}} </td>
		</tr>
		<tr>
			<th class="ttu header" colspan="3">
				<b>Cupom não fiscal</b>
			</th>
		</tr>
	</thead>
	<tbody>
	@foreach($transacao->vendas as $venda)
		<tr class="top ttu" >
			<td colspan="3">{{$venda->nome}} - {{$venda->descricao}}</td>
		</tr>
		<tr>
			<td>R${{$venda->preco}}</td>
			<td>{{$venda->quantidade}} {{$venda->unidade}}</td>
			<td>R${{$venda->total}}</td>
		</tr>
		@endforeach
	</tbody>
	<tfoot>
		<tr class="sup ttu p--0">
			<td colspan="3">
				<b>Totais</b>
			</td>
		</tr>
		<tr class="ttu">
			<td colspan="2">Sub-total</td>
			<td align="right">R${{$transacao->subtotal}}</td>
		</tr>
		<tr class="ttu">
			<td colspan="2">Desconto</td>
			<td align="right">{{$transacao->desconto}}</td>
		</tr>
		<tr class="ttu">
			<td colspan="2">Total</td>
			<td align="right">R${{$transacao->total}}</td>
		</tr>
		<tr class="sup ttu p--0">
			<td colspan="3">
				<b>Pagamentos</b>
			</td>
		</tr>
		<tr class="ttu">
			<td colspan="2">Pagamento</td>
			<td align="right">{{$transacao->pagamento}}</td>
		</tr>
		<tr class="ttu">
			<td colspan="2">Parcelas</td>
			<td align="right">{{$transacao->parcelas}}x R${{$transacao->valor_parcelas}}</td>
		</tr>
		<tr class="ttu">
			<td colspan="2">Total pago</td>
			<td align="right">R${{$transacao->total}}</td>
		</tr>
		<tr class="sup">
			<td colspan="3" align="center">
				<b>NT:{{$transacao->NT}}</b>
			</td>
		</tr>
		<tr class="sup">
			<td colspan="3" align="center">
				Agradecemo-lhes pela preferência!
			</td>
		</tr>
	</tfoot>
</table>
<script src="{{asset('vendor/adminlte/vendor/jquery/dist/jquery.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function () {
    window.print();	
});
</script>
</body>
</html>