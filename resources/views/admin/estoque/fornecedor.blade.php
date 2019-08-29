<select name="fornecedor" id="mfornecedor"
required="required" class="form-control"> @foreach ($fornecedor as
$forn)
<option value="{{ $forn->fornecedor }}">{{ $forn->fornecedor }}</option>
@endforeach
</select>
