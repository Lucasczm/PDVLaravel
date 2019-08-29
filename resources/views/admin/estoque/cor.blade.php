<select name="aux[cor][]" required="required" class="form-control"> 
@foreach ($cor as $cr)
	<option value="{{ $cr->cor }}">{{ $cr->cor }}</option>
@endforeach
</select>
