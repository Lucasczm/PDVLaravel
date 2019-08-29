<select name="tecido" required="required" class="form-control">
	@foreach ($tecido as $teci)
	<option value="{{ $teci->tecido }}">{{ $teci->tecido }}</option>
	@endforeach
</select>
