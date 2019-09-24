<option value="">Select City</option>
@if($citydata->count() > 0)
	@foreach($citydata as $each)
		<option value="{{ $each->id }}" >
			{{ $each->city_name }}
		</option>
	@endforeach
@endif