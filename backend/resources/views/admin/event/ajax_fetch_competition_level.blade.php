<option value="">Select Game level</option>
@if (!empty($levedata))
	@foreach($levedata as $each)
		<option value="{{ $each->id }}" >
			{{ $each->name }}
		</option>
	@endforeach
@endif