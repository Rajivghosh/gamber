<option value="">Select Event Category</option>
@if ($catdata->count() > 0)
	@foreach($catdata as $each)
		<option value="{{ $each->id }}">
			{{ $each->name }}
		</option>
	@endforeach
@endif