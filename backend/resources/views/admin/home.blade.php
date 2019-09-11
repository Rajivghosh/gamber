@extends('layouts.main')
@section('content')
<div class="row list_box">	
	@if($data->count() > 0)
	@foreach($data as $each)
	<div class=" col-md-4 col-lg-3  py-4 " >
		<div class="shadow_box py-4">
			<div class="img-box rounded-circle bg-dark "> 
				<img src="{{URL::to('/')}}/game_logo/{{ $each->game_logo }}" alt="{{ $each->game_screen_name }}">
			</div>
			<span>{{ $each->game_screen_name }}</span>
		</div>
	</div>
	@endforeach
	@endif
</div>
@endsection