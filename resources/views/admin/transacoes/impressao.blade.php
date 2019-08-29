<link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables.min.css') }}"/>
	<div class="row">
	<h2>{{$data[0]}} - {{$data[1] }}</h2>
	<table id="transations-table" class="table stripe order-column compact table-bordered" cellspacing="0" width="100%">
              <thead class="thead-light">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Cliente</th>
                  <th scope="col">Data</th>
                  <th scope="col">Itens Qnt Valor</th>
                  <th scope="col">Desconto</th>
                  <th scope="col">Pagamento</th>
                  <th scope="col">Parcelas</th>
                  <th scope="col">Valor parcelas</th>
                  <th scope="col">Total R$</th>
                </tr>
                </thead>
			</table>
        </div>
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/jquery.mask.min.js') }}"></script>
<script src="{{ asset('js/moment-with-locales.min.js') }}"></script>
<script src="{{ asset('js/daterangepicker.js') }}"></script>
<script src="{{ asset('vendor/datatables.min.js') }}"></script>
<script type="text/javascript">
    $(function() {
    
    	moment.locale('pt-BR');
        	
    	 var table = $('#transations-table').DataTable( {
    		 "bPaginate": false,
    	        "info":   false,
    	        "searching": false,
 	        "language": {
 	            "lengthMenu": "Exibir _MENU_ registros por página",
 	            "zeroRecords": "Nada encontrado",
 	            "info": "Exibindo _PAGE_ de _PAGES_",
 	            "infoEmpty": "Nenhum registro encontrado",
 	            "infoFiltered": "(filtrado de _MAX_ todos os registros)",
 	            "search" : "Procurar",
 	        },
 	       "ajax": {
            	"url":"{{route('historico.route')}}/range/{{$range}}", 
           		"dataSrc": ""
   	        },
   	      "columns": [
   	            { "data": "id" },
   	            { "data": "cliente" },
   	            { "data": "data" },
   	            { "data": "detalhes"},
   	            { "data": "desconto" },
   	            { "data": "pagamento"},
   	            { "data": "parcelas" },
   	            { "data": "valor_parcelas" },
   	            { "data": "total" },
   	        ],
             "initComplete": function( settings, json ) {
             window.print();
            }
   	    });
    		
    });
</script>