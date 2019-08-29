<select name="aux[tamanho][]" required="required" class="form-control">
	@foreach ($tamanho as $tam)
	<option value="{{ $tam->tamanho }}">{{ $tam->tamanho }}</option>
	@endforeach
</select>
