<form id="formUp" action="{{route('estoque.atributos.add')}}" method="POST">
<div class="modal fade bs-example-modal-lg" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" id="modalFormHeader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="modalFormTitle" class="modal-title">Adicionar Atributo</h4>
      </div>
      <div id="modalFormBody" class="modal-body">
       <div class="row">
<div class="col-md-6">

{{ csrf_field() }}
	<input type="hidden" name="id" id="id">
  <div class="form-group">
  <label id="label_modal" for="nome">Novo atributo</label>
  <input type="text" id="att"  name="atributo" class="form-control" placeholder="" aria-describedby="basic-addon1" required>
  <input type="hidden" id="tipo" name="tipo" required/>
  </div>

</div>
</div>
      </div>
      <div class="modal-footer">
        <button id="btnCancelForm" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button id="btnSubmitForm" type="submit" class="btn btn-primary">Salvar alterações</button>
      </div>
    </div>
  </div>
</div>
</form>