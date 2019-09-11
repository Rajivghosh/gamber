@extends('layouts.main')
@section('content')
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<span class="m-0 font-weight-bold text-primary fs16">NBA2K Game settings</span>
		<a href="{{ url('/admin/game/list') }}" class="btn btn-sm btn-danger pull-right">Back to List</a>
	</div>
	<div class="card-body">
		<form action="{{ url('/admin/game/settings')}}" method="post" class="m-0">
			<div class="col-md-12 p-0">
				<div class="row mb-2">
					<div class="col-md-3">
						<label>Game Difficulty:</label>
					</div>
					<div class="col-md-9 table-responsive">
						<div class="toggle_radio">
							@foreach (\Config::get('nba2k_settings.game_difficulty') as $each)
							<input type="radio" class="toggle_option" id="game_difficulty-{{ $loop->iteration }}" name="game_difficulty" value="{{ $each }}" @if(!empty($nba2k)) @if(in_array('game_difficulty', array_keys($nba2k)) and $nba2k['game_difficulty'] == $each) checked @endif @else @if($loop->iteration == 1) checked @endif @endif />
							@endforeach
							@foreach (\Config::get('nba2k_settings.game_difficulty') as $each)
							<label for="game_difficulty-{{ $loop->iteration }}"><p>{{ ucwords($each) }}</p></label>
							@endforeach
							<div class="toggle_option_slider">
							</div>
						</div>
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-md-3">
						<label>Quarter Length:</label>
					</div>
					<div class="col-md-9 table-responsive">
						<div class="toggle_radio">
							@foreach (\Config::get('nba2k_settings.quater_length') as $each)
							<input type="radio" class="toggle_option" id="quater_length-{{ $loop->iteration }}" name="quater_length" value="{{ $each }}" @if(!empty($nba2k)) @if(in_array('quater_length', array_keys($nba2k)) and $nba2k['quater_length'] == $each) checked @endif @else @if($loop->iteration == 1) checked @endif @endif />
							@endforeach
							@foreach (\Config::get('nba2k_settings.quater_length') as $each)
							<label for="quater_length-{{ $loop->iteration }}"><p>{{ ucwords($each) }}</p></label>
							@endforeach
							<div class="toggle_option_slider">
							</div>
						</div>
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-md-3">
						<label>Fatigue:</label>
					</div>
					<div class="col-md-9 table-responsive">
						<div class="toggle_radio">
							@foreach (\Config::get('nba2k_settings.fatigue') as $each)
							<input type="radio" class="toggle_option" id="fatigue-{{ $loop->iteration }}" name="fatigue" value="{{ $each }}" @if(!empty($nba2k)) @if(in_array('fatigue', array_keys($nba2k)) and $nba2k['fatigue'] == $each) checked @endif @else @if($loop->iteration == 1) checked @endif @endif />
							@endforeach
							@foreach (\Config::get('nba2k_settings.fatigue') as $each)
							<label for="fatigue-{{ $loop->iteration }}"><p>{{ ucwords($each) }}</p></label>
							@endforeach
							<div class="toggle_option_slider">
							</div>
						</div>
					</div>
				</div>

				<div class="row mb-2">
					<div class="col-md-3">
						<label>Injuries:</label>
					</div>
					<div class="col-md-9 table-responsive">
						<div class="toggle_radio">
							@foreach (\Config::get('nba2k_settings.injuries') as $each)
							<input type="radio" class="toggle_option" id="injuries-{{ $loop->iteration }}" name="injuries" value="{{ $each }}" @if(!empty($nba2k)) @if(in_array('injuries', array_keys($nba2k)) and $nba2k['injuries'] == $each) checked @endif @else @if($loop->iteration == 1) checked @endif @endif />
							@endforeach
							@foreach (\Config::get('nba2k_settings.injuries') as $each)
							<label for="injuries-{{ $loop->iteration }}"><p>{{ ucwords($each) }}</p></label>
							@endforeach
							<div class="toggle_option_slider">
							</div>
						</div>
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-md-3">
						<label>Game Speed:</label>
					</div>
					<div class="col-md-9 table-responsive">
						<div class="toggle_radio">
							@foreach (\Config::get('nba2k_settings.game_speed') as $each)
							<input type="radio" class="toggle_option" id="game_speed-{{ $loop->iteration }}" name="game_speed" value="{{ $each }}" @if(!empty($nba2k)) @if(in_array('game_speed', array_keys($nba2k)) and $nba2k['game_speed'] == $each) checked @endif @else @if($loop->iteration == 1) checked @endif @endif />
							@endforeach
							@foreach (\Config::get('nba2k_settings.game_speed') as $each)
							<label for="game_speed-{{ $loop->iteration }}"><p>{{ ucwords($each) }}</p></label>
							@endforeach
							<div class="toggle_option_slider">
							</div>
						</div>
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-md-3">
						<label>Free Throw Difficulty:</label>
					</div>
					<div class="col-md-9 table-responsive">
						<div class="toggle_radio">
							@foreach (\Config::get('nba2k_settings.free_throw_difficulty') as $each)
							<input type="radio" class="toggle_option" id="free_throw_difficulty-{{ $loop->iteration }}" name="free_throw_difficulty" value="{{ $each }}" @if(!empty($nba2k)) @if(in_array('free_throw_difficulty', array_keys($nba2k)) and $nba2k['free_throw_difficulty'] == $each) checked @endif @else @if($loop->iteration == 1) checked @endif @endif />
							@endforeach
							@foreach (\Config::get('nba2k_settings.free_throw_difficulty') as $each)
							<label for="free_throw_difficulty-{{ $loop->iteration }}"><p>{{ ucwords($each) }}</p></label>
							@endforeach
							<div class="toggle_option_slider">
							</div>
						</div>
					</div>
				</div>

				<div class="row mb-2">
					<div class="col-md-3">
						<label>Foul Out:</label>
					</div>
					<div class="col-md-9 table-responsive">
						<div class="toggle_radio">
							@foreach (\Config::get('nba2k_settings.foul_out') as $each)
							<input type="radio" class="toggle_option" id="foul_out-{{ $loop->iteration }}" name="foul_out" value="{{ $each }}" @if(!empty($nba2k)) @if(in_array('foul_out', array_keys($nba2k)) and $nba2k['foul_out'] == $each) checked @endif @else @if($loop->iteration == 1) checked @endif @endif />
							@endforeach
							@foreach (\Config::get('nba2k_settings.foul_out') as $each)
							<label for="foul_out-{{ $loop->iteration }}"><p>{{ ucwords($each) }}</p></label>
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