<option value="">Select Game level</option>
@if (!empty($data))
	@foreach($data as $each)
		<option value="{{ $each->id }}" {{ (isset($details) and $details->level->id == $each->id) ? 'selected' : '' }}>
			{{ $each->name }}
		</option>
	@endforeach
@endif