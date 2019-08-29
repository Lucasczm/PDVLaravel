<select name="categoria" id="mcategoria" required="required" class="form-control">
	@foreach ($categoria as $cat)
	<option value="{{ $cat->categoria }}">{{ $cat->categoria }}</option>
	@endforeach
</select>
