<option value="">Select State</option>
@if (!empty($statedata))
	@foreach($statedata as $each)
		<option value="{{ $each->id }}" >
			{{ $each->state_name }}
		</option>
	@endforeach
@endif