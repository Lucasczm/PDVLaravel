<select name="marca" id="mmarca" required="required" class="form-control">
	@foreach ($marcas as $marc)
	<option value="{{ $marc->marca }}">{{ $marc->marca }}</option>
	@endforeach
</select>
