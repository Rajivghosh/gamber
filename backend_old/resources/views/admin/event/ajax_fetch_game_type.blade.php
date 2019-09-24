<option value="">Select Game Type</option>
@if (!empty($gametypedata))
	@foreach($gametypedata as $each)
		<option value="{{ $each->id }}" >
			{{ $each->name }}
		</option>
	@endforeach
@endif