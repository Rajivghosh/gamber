@extends('layouts.main')
@section('content')
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<span class="m-0 font-weight-bold text-primary fs16">FIFA Game settings</span>
		<a href="{{ url('/admin/game/list') }}" class="btn btn-sm btn-danger pull-right">Back to List</a>
	</div>
	<div class="card-body">
		<form action="{{ url('/admin/game/settings')}}" method="post" class="m-0">
			<div class="col-md-12 p-0">
				<div class="row mb-2">
					<div class="col-md-3">
						<label>Match - Half Length:</label>
					</div>
					<div class="col-md-9 table-responsive">
						<div class="toggle_radio">
							@foreach (\Config::get('fifa_settings.length') as $each)
							<input type="radio" class="toggle_option" id="length-{{ $loop->iteration }}" name="length" value="{{ $each }}" @if(!empty($fifa)) @if(in_array('length', array_keys($fifa)) and $fifa['length'] == $each) checked @endif @else @if($loop->iteration == 1) checked @endif @endif />
							@endforeach
							@foreach (\Config::get('fifa_settings.length') as $each)
							<label for="length-{{ $loop->iteration }}"><p>{{ ucwords($each) }}</p></label>
							@endforeach
							<div class="toggle_option_slider">
							</div>
						</div>
					</div>
				</div>
				<div class="row mb-2 ">
					<div class="col-md-3">
						<label>Match - Difficulty Level:</label>
					</div>
					<div class="col-md-9 table-responsive">
						<div class="toggle_radio">
							@foreach (\Config::get('fifa_settings.difficulty') as $each)
							<input type="radio" class="toggle_option" id="difficulty-{{ $loop->iteration }}" name="difficulty" value="{{ $each }}" @if(!empty($fifa)) @if(in_array('difficulty', array_keys($fifa)) and $fifa['difficulty'] == $each) checked @endif @else @if($loop->iteration == 1) checked @endif @endif />
							@endforeach
							@foreach (\Config::get('fifa_settings.difficulty') as $each)
							<label for="difficulty-{{ $loop->iteration }}"><p>{{ ucwords($each) }}</p></label>
							@endforeach
							<div class="toggle_option_slider">
							</div>
						</div>
					</div>
				</div>
				<div class="row mb-2 part">
					<div class="col-md-3">
						<label>Match - Stadium:</label>
					</div>
					<div class="col-md-9 table-responsive">
						<div class="toggle_radio">
							@foreach (\Config::get('fifa_settings.stadium') as $each)
							<input type="radio" class="toggle_option" id="stadium-{{ $loop->iteration }}" name="stadium" value="{{ $each }}" @if(!empty($fifa)) @if(in_array('stadium', array_keys($fifa)) and $fifa['stadium'] == $each) checked @endif @else @if($loop->iteration == 1) checked @endif @endif />
							@endforeach
							@foreach (\Config::get('fifa_settings.stadium') as $each)
							<label for="stadium-{{ $loop->iteration }}"><p>{{ ucwords($each) }}</p></label>
							@endforeach
							<div class="toggle_option_slider">
							</div>
						</div>
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-md-3">
						<label>Match - Quick Substitutes:</label>
					</div>
					<div class="col-md-9 table-responsive">
						<div class="toggle_radio">
							@foreach (\Config::get('fifa_settings.substitutes') as $each)
							<input type="radio" class="toggle_option" id="substitutes-{{ $loop->iteration }}" name="substitutes" value="{{ $each }}" @if(!empty($fifa)) @if(in_array('substitutes', array_keys($fifa)) and $fifa['substitutes'] == $each) checked @endif @else @if($loop->iteration == 1) checked @endif @endif />
							@endforeach
							@foreach (\Config::get('fifa_settings.substitutes') as $each)
							<label for="substitutes-{{ $loop->iteration }}"><p>{{ ucwords($each) }}</p></label>
							@endforeach
							<div class="toggle_option_slider">
							</div>
						</div>
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-md-3">
						<label>Match - Game Speed:</label>
					</div>
					<div class="col-md-9 table-responsive">
						<div class="toggle_radio">
							@foreach (\Config::get('fifa_settings.speed') as $each)
							<input type="radio" class="toggle_option" id="speed-{{ $loop->iteration }}" name="speed" value="{{ $each }}" @if(!empty($fifa)) @if(in_array('speed', array_keys($fifa)) and $fifa['speed'] == $each) checked @endif @else @if($loop->iteration == 1) checked @endif @endif />
							@endforeach
							@foreach (\Config::get('fifa_settings.speed') as $each)
							<label for="speed-{{ $loop->iteration }}"><p>{{ ucwords($each) }}</p></label>
							@endforeach
							<div class="toggle_option_slider">
							</div>
						</div>
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-md-3">
						<label>Rules - Injuries:</label>
					</div>
					<div class="col-md-9 table-responsive">
						<div class="toggle_radio">
							@foreach (\Config::get('fifa_settings.injuries') as $each)
							<input type="radio" class="toggle_option" id="injuries-{{ $loop->iteration }}" name="injuries" value="{{ $each }}" @if(!empty($fifa)) @if(in_array('injuries', array_keys($fifa)) and $fifa['injuries'] == $each) checked @endif @else @if($loop->iteration == 1) checked @endif @endif />
							@endforeach
							@foreach (\Config::get('fifa_settings.injuries') as $each)
							<label for="injuries-{{ $loop->iteration }}"><p>{{ ucwords($each) }}</p></label>
							@endforeach
							<div class="toggle_option_slider">
							</div>
						</div>
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-md-3">
						<label>Rules - Offsides:</label>
					</div>
					<div class="col-md-9 table-responsive">
						<div class="toggle_radio">
							@foreach (\Config::get('fifa_settings.offside') as $each)
							<input type="radio" class="toggle_option" id="offside-{{ $loop->iteration }}" name="offside" value="{{ $each }}" @if(!empty($fifa)) @if(in_array('offside', array_keys($fifa)) and $fifa['offside'] == $each) checked @endif @else @if($loop->iteration == 1) checked @endif @endif />
							@endforeach
							@foreach (\Config::get('fifa_settings.offside') as $each)
							<label for="offside-{{ $loop->iteration }}"><p>{{ ucwords($each) }}</p></label>
							@endforeach
							<div class="toggle_option_slider">
							</div>
						</div>
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-md-3">
						<label>Rules - Bookings: </label>
					</div>
					<div class="col-md-9 table-responsive">
						<div class="toggle_radio">
							@foreach (\Config::get('fifa_settings.bookings') as $each)
							<input type="radio" class="toggle_option" id="bookings-{{ $loop->iteration }}" name="bookings" value="{{ $each }}" @if(!empty($fifa)) @if(in_array('bookings', array_keys($fifa)) and $fifa['bookings'] == $each) checked @endif @else @if($loop->iteration == 1) checked @endif @endif />
							@endforeach
							@foreach (\Config::get('fifa_settings.bookings') as $each)
							<label for="bookings-{{ $loop->iteration }}"><p>{{ ucwords($each) }}</p></label>
							@endforeach
							<div class="toggle_option_slider">
							</div>
						</div>
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-md-3">
						<label>Rules - Handball: </label>
					</div>
					<div class="col-md-9 table-responsive">
						<div class="toggle_radio">
							@foreach (\Config::get('fifa_settings.handball') as $each)
							<input type="radio" class="toggle_option" id="handball-{{ $loop->iteration }}" name="handball" value="{{ $each }}" @if(!empty($fifa)) @if(in_array('handball', array_keys($fifa)) and $fifa['handball'] == $each) checked @endif @else @if($loop->iteration == 1) checked @endif @endif />
							@endforeach
							@foreach (\Config::get('fifa_settings.handball') as $each)
							<label for="handball-{{ $loop->iteration }}"><p>{{ ucwords($each) }}</p></label>
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