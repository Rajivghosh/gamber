@extends('layouts.main')
@section('content')
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<span class="m-0 font-weight-bold text-primary fs16">Madden Game settings</span>
		<a href="{{ url('/admin/game/list') }}" class="btn btn-sm btn-danger pull-right">Back to List</a>
	</div>
	<div class="card-body">
		<form action="{{ url('/admin/game/settings')}}" method="post" class="m-0">
			<div class="col-md-12 p-0">
				<div class="row mb-2">
					<div class="col-md-3">
						<label>Game Skill:</label>
					</div>
					<div class="col-md-9 table-responsive">
						<div class="toggle_radio">
							@foreach (\Config::get('madden_settings.game_skill') as $each)
							<input type="radio" class="toggle_option" id="game_skill-{{ $loop->iteration }}" name="game_skill" value="{{ $each }}" @if(!empty($madden)) @if(in_array('game_skill', array_keys($madden)) and $madden['game_skill'] == $each) checked @endif @else @if($loop->iteration == 1) checked @endif @endif />
							@endforeach
							@foreach (\Config::get('madden_settings.game_skill') as $each)
							<label for="game_skill-{{ $loop->iteration }}"><p>{{ ucwords($each) }}</p></label>
							@endforeach
							<div class="toggle_option_slider">
							</div>
						</div>
					</div>
				</div>
				<div class="row mb-2 ">
					<div class="col-md-3">
						<label>Play Call:</label>
					</div>
					<div class="col-md-9 table-responsive">
						<div class="toggle_radio">
							@foreach (\Config::get('madden_settings.play_call') as $each)
							<input type="radio" class="toggle_option" id="play_call-{{ $loop->iteration }}" name="play_call" value="{{ $each }}" @if(!empty($madden)) @if(in_array('play_call', array_keys($madden)) and $madden['play_call'] == $each) checked @endif @else @if($loop->iteration == 1) checked @endif @endif />
							@endforeach
							@foreach (\Config::get('madden_settings.play_call') as $each)
							<label for="play_call-{{ $loop->iteration }}"><p>{{ ucwords($each) }}</p></label>
							@endforeach
							<div class="toggle_option_slider">
							</div>
						</div>
					</div>
				</div>
				<div class="row mb-2 ">
					<div class="col-md-3">
						<label>Game Style:</label>
					</div>
					<div class="col-md-9 table-responsive">
						<div class="toggle_radio">
							@foreach (\Config::get('madden_settings.game_style') as $each)
							<input type="radio" class="toggle_option" id="game_style-{{ $loop->iteration }}" name="game_style" value="{{ $each }}" @if(!empty($madden)) @if(in_array('game_style', array_keys($madden)) and $madden['game_style'] == $each) checked @endif @else @if($loop->iteration == 1) checked @endif @endif />
							@endforeach
							@foreach (\Config::get('madden_settings.game_style') as $each)
							<label for="game_style-{{ $loop->iteration }}"><p>{{ ucwords($each) }}</p></label>
							@endforeach
							<div class="toggle_option_slider">
							</div>
						</div>
					</div>
				</div>
				<div class="row mb-2 ">
					<div class="col-md-3">
						<label>Even Teams:</label>
					</div>
					<div class="col-md-9 table-responsive">
						<div class="toggle_radio">
							@foreach (\Config::get('madden_settings.even_teams') as $each)
							<input type="radio" class="toggle_option" id="even_teams-{{ $loop->iteration }}" name="even_teams" value="{{ $each }}" @if(!empty($madden)) @if(in_array('even_teams', array_keys($madden)) and $madden['even_teams'] == $each) checked @endif @else @if($loop->iteration == 1) checked @endif @endif />
							@endforeach
							@foreach (\Config::get('madden_settings.even_teams') as $each)
							<label for="even_teams-{{ $loop->iteration }}"><p>{{ ucwords($each) }}</p></label>
							@endforeach
							<div class="toggle_option_slider">
							</div>
						</div>
					</div>
				</div>
				<div class="row mb-2 ">
					<div class="col-md-3">
						<label>Quarter Length:</label>
					</div>
					<div class="col-md-9 table-responsive">
						<div class="toggle_radio">
							@foreach (\Config::get('madden_settings.quater_length') as $each)
							<input type="radio" class="toggle_option" id="quater_length-{{ $loop->iteration }}" name="quater_length" value="{{ $each }}" @if(!empty($madden)) @if(in_array('quater_length', array_keys($madden)) and $madden['quater_length'] == $each) checked @endif @else @if($loop->iteration == 1) checked @endif @endif />
							@endforeach
							@foreach (\Config::get('madden_settings.quater_length') as $each)
							<label for="quater_length-{{ $loop->iteration }}"><p>{{ ucwords($each) }}</p></label>
							@endforeach
							<div class="toggle_option_slider">
							</div>
						</div>
					</div>
				</div>
				<div class="row mb-2 ">
					<div class="col-md-3">
						<label>Game Speed:</label>
					</div>
					<div class="col-md-9 table-responsive">
						<div class="toggle_radio">
							@foreach (\Config::get('madden_settings.game_speed') as $each)
							<input type="radio" class="toggle_option" id="game_speed-{{ $loop->iteration }}" name="game_speed" value="{{ $each }}" @if(!empty($madden)) @if(in_array('game_speed', array_keys($madden)) and $madden['game_speed'] == $each) checked @endif @else @if($loop->iteration == 1) checked @endif @endif />
							@endforeach
							@foreach (\Config::get('madden_settings.game_speed') as $each)
							<label for="game_speed-{{ $loop->iteration }}"><p>{{ ucwords($each) }}</p></label>
							@endforeach
							<div class="toggle_option_slider">
							</div>
						</div>
					</div>
				</div>
				<div class="row mb-2 ">
					<div class="col-md-3">
						<label>Fatigue:</label>
					</div>
					<div class="col-md-9 table-responsive">
						<div class="toggle_radio">
							@foreach (\Config::get('madden_settings.fatigue') as $each)
							<input type="radio" class="toggle_option" id="fatigue-{{ $loop->iteration }}" name="fatigue" value="{{ $each }}" @if(!empty($madden)) @if(in_array('fatigue', array_keys($madden)) and $madden['fatigue'] == $each) checked @endif @else @if($loop->iteration == 1) checked @endif @endif />
							@endforeach
							@foreach (\Config::get('madden_settings.fatigue') as $each)
							<label for="fatigue-{{ $loop->iteration }}"><p>{{ ucwords($each) }}</p></label>
							@endforeach
							<div class="toggle_option_slider">
							</div>
						</div>
					</div>
				</div>
				<div class="row mb-2 ">
					<div class="col-md-3">
						<label>Injuries:</label>
					</div>
					<div class="col-md-9 table-responsive">
						<div class="toggle_radio">
							@foreach (\Config::get('madden_settings.injuries') as $each)
							<input type="radio" class="toggle_option" id="injuries-{{ $loop->iteration }}" name="injuries" value="{{ $each }}" @if(!empty($madden)) @if(in_array('injuries', array_keys($madden)) and $madden['injuries'] == $each) checked @endif @else @if($loop->iteration == 1) checked @endif @endif />
							@endforeach
							@foreach (\Config::get('madden_settings.injuries') as $each)
							<label for="injuries-{{ $loop->iteration }}"><p>{{ ucwords($each) }}</p></label>
							@endforeach
							<div class="toggle_option_slider">
							</div>
						</div>
					</div>
				</div>
				<div class="row mb-2 ">
					<div class="col-md-3">
						<label>Accel Clock:</label>
					</div>
					<div class="col-md-9 table-responsive">
						<div class="toggle_radio">
							@foreach (\Config::get('madden_settings.accel_clock') as $each)
							<input type="radio" class="toggle_option" id="accel_clock-{{ $loop->iteration }}" name="accel_clock" value="{{ $each }}" @if(!empty($madden)) @if(in_array('accel_clock', array_keys($madden)) and $madden['accel_clock'] == $each) checked @endif @else @if($loop->iteration == 1) checked @endif @endif />
							@endforeach
							@foreach (\Config::get('madden_settings.accel_clock') as $each)
							<label for="accel_clock-{{ $loop->iteration }}"><p>{{ ucwords($each) }}</p></label>
							@endforeach
							<div class="toggle_option_slider">
							</div>
						</div>
					</div>
				</div>
				<div class="row mb-2 ">
					<div class="col-md-3">
						<label>Play Clock Remaining:</label>
					</div>
					<div class="col-md-9 table-responsive">
						<div class="toggle_radio">
							@foreach (\Config::get('madden_settings.play_clock_remaining') as $each)
							<input type="radio" class="toggle_option" id="play_clock_remaining-{{ $loop->iteration }}" name="play_clock_remaining" value="{{ $each }}" @if(!empty($madden)) @if(in_array('play_clock_remaining', array_keys($madden)) and $madden['play_clock_remaining'] == $each) checked @endif @else @if($loop->iteration == 1) checked @endif @endif />
							@endforeach
							@foreach (\Config::get('madden_settings.play_clock_remaining') as $each)
							<label for="play_clock_remaining-{{ $loop->iteration }}"><p>{{ ucwords($each) }}</p></label>
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
<link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<style type="text/css">
	.toggle_radio{position:relative;background:rgb(236, 236, 236);margin:4px auto;overflow:hidden;padding:0!important;-webkit-border-radius:50px;-moz-border-radius:50px;border-radius:50px;position:relative;height:26px; float: left; display: flex;}
	.toggle_radio > *{float:left;}
	.toggle_radio input[type=radio]{display:none;}
	.toggle_radio label{color:rgba(82, 82, 82, 0.9);z-index:0;display:block;width:100px;height:20px;margin:3px 3px;-webkit-border-radius:50px;-moz-border-radius:50px;border-radius:50px;cursor:pointer;z-index:1; font-size: 14px; text-align:center;}
	.toggle_option_slider{width:100px;height:20px;position:absolute;top:3px;-webkit-border-radius:50px;-moz-border-radius:50px;border-radius:50px;-webkit-transition:all .4s ease;-moz-transition:all .4s ease;-o-transition:all .4s ease;-ms-transition:all .4s ease;transition:all .4s ease; background:rgba(0, 142, 249, 0.24);}
	.part .toggle_option:nth-child(2):checked ~ .toggle_option_slider{left:109px; width: 179px;}
	.part .toggle_radio label.stadium{width: 179px;} 
	.toggle_option:nth-child(1):checked ~ .toggle_option_slider{left:3px;}
	.toggle_option:nth-child(2):checked ~ .toggle_option_slider{left:109px;}
	.toggle_option:nth-child(3):checked ~ .toggle_option_slider{left:215px;}
	.toggle_option:nth-child(4):checked ~ .toggle_option_slider{left:321px;} 
	.toggle_option:nth-child(5):checked ~ .toggle_option_slider{left:426px;}
	.toggle_option:nth-child(6):checked ~ .toggle_option_slider{left:534px;}
	.toggle_option:nth-child(7):checked ~ .toggle_option_slider{left:638px;}
	.toggle_option:nth-child(8):checked ~ .toggle_option_slider{left:726px;} 
	.bg-custom{ background-size: cover; background-color:#0091ff !important; color: #fff !important;}
</style>