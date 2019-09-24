@extends('layouts.main')
@section('content')
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<span class="m-0 font-weight-bold text-primary fs16">UFC3 Game settings</span>
		<a href="{{ url('/admin/game/list') }}" class="btn btn-sm btn-danger pull-right">Back to List</a>
	</div>
	<div class="card-body">
		<form action="{{ url('/admin/game/settings')}}" method="post" class="m-0">
			<div class="col-md-12 p-0">
				<div class="row mb-2">
					<div class="col-md-3">
						<label>Fight Rules:</label>
					</div>
					<div class="col-md-9 table-responsive">
						<div class="toggle_radio">
							@foreach (\Config::get('ufc3_settings.fight_rules') as $each)
							<input type="radio" class="toggle_option" id="fight_rules-{{ $loop->iteration }}" name="fight_rules" value="{{ $each }}" @if(!empty($ufc3)) @if(in_array('fight_rules', array_keys($ufc3)) and $ufc3['fight_rules'] == $each) checked @endif @else @if($loop->iteration == 1) checked @endif @endif />
							@endforeach
							@foreach (\Config::get('ufc3_settings.fight_rules') as $each)
							<label for="fight_rules-{{ $loop->iteration }}"><p>{{ ucwords($each) }}</p></label>
							@endforeach
							<div class="toggle_option_slider">
							</div>
						</div>
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-md-3">
						<label>Created Fighters:</label>
					</div>
					<div class="col-md-9 table-responsive">
						<div class="toggle_radio">
							@foreach (\Config::get('ufc3_settings.created_fighters') as $each)
							<input type="radio" class="toggle_option" id="created_fighters-{{ $loop->iteration }}" name="created_fighters" value="{{ $each }}" @if(!empty($ufc3)) @if(in_array('created_fighters', array_keys($ufc3)) and $ufc3['created_fighters'] == $each) checked @endif @else @if($loop->iteration == 1) checked @endif @endif />
							@endforeach
							@foreach (\Config::get('ufc3_settings.created_fighters') as $each)
							<label for="created_fighters-{{ $loop->iteration }}"><p>{{ ucwords($each) }}</p></label>
							@endforeach
							<div class="toggle_option_slider">
							</div>
						</div>
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-md-3">
						<label>No. Rounds:</label>
					</div>
					<div class="col-md-9 table-responsive">
						<div class="toggle_radio">
							@foreach (\Config::get('ufc3_settings.no_rounds') as $each)
							<input type="radio" class="toggle_option" id="no_rounds-{{ $loop->iteration }}" name="no_rounds" value="{{ $each }}" @if(!empty($ufc3)) @if(in_array('no_rounds', array_keys($ufc3)) and $ufc3['no_rounds'] == $each) checked @endif @else @if($loop->iteration == 1) checked @endif @endif />
							@endforeach
							@foreach (\Config::get('ufc3_settings.no_rounds') as $each)
							<label for="no_rounds-{{ $loop->iteration }}"><p>{{ ucwords($each) }}</p></label>
							@endforeach
							<div class="toggle_option_slider">
							</div>
						</div>
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-md-3">
						<label>Clock Speed:</label>
					</div>
					<div class="col-md-9 table-responsive">
						<div class="toggle_radio">
							@foreach (\Config::get('ufc3_settings.clock_speed') as $each)
							<input type="radio" class="toggle_option" id="clock_speed-{{ $loop->iteration }}" name="clock_speed" value="{{ $each }}" @if(!empty($ufc3)) @if(in_array('clock_speed', array_keys($ufc3)) and $ufc3['clock_speed'] == $each) checked @endif @else @if($loop->iteration == 1) checked @endif @endif />
							@endforeach
							@foreach (\Config::get('ufc3_settings.clock_speed') as $each)
							<label for="clock_speed-{{ $loop->iteration }}"><p>{{ ucwords($each) }}</p></label>
							@endforeach
							<div class="toggle_option_slider">
							</div>
						</div>
					</div>
				</div>
				
				
			
			
				{{ csrf_field() }}
				<div class="col-md-7 text-left mt-5 mb-3 p-0"> 
				<input type="hidden" name="id" value="{{ isset($details) ? $details->id : '' }}" />
				<button type="submit" class="btn btn-md bg-custom">Save</button>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection