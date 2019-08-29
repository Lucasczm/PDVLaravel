<select name="unidade" id="munidade" required="required" class="form-control">
	@foreach ($unidade as $un)
	<option value="{{ $un->unidade }}">{{ $un->unidade }}</option>
	@endforeach
</select>
