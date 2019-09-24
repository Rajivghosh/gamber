<option value="">Select Venue</option>
@if (!empty($venuedata))
	@foreach($venuedata as $each)
		<option value="{{ $each->id }}" >
			{{ $each->name }}
		</option>
	@endforeach
@endif