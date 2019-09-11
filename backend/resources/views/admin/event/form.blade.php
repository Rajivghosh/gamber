@extends('layouts.main')
@section('content')
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<span class="m-0 font-weight-bold text-primary fs16">Add/Edit Event</span>
		<a href="{{ url('/admin/event/list') }}" class="btn btn-sm btn-danger pull-right">Back to List</a>
	</div>
	<div class="card-body">
		<form method="post" action="{{ url('/admin/event/add')}}" enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="add">Event Title</label>
						<input type="text" class="form-control" id="event_title" name="event_title" placeholder="Enter Event Title" required="required" value="{{ isset($details) ? $details->title : old('event_title') }}" />
						<p class="text-danger">{{ $errors->first('event_title') }}</p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="add">Game Name</label>
						<select id="game-screen" name="screen_id" class="form-control" required="required">
							<option value="">Select Game Screen</option>
							@if (!empty($gamescreen))
							@foreach($gamescreen as $each)
							<option value="{{ $each->id }}" {{ (old('screen_id') == $each->id) ? 'selected' : ((isset($details) and $details->category->level->screen->id == $each->id) ? 'selected' : '') }}>
								{{ $each->game_screen_name }}
							</option>
							@endforeach
							@endif
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="add">Game Type</label>
						<select name="game_type" id="game_type" class="form-control" required="required" >
							<option value="">Select Game Type</option>
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="add">Event Venue</label>
						<select name="event_venue" id="event_venue" class="form-control" required="required">
							<option value="">Select Venue</option>
						</select>	
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="add">Level Name</label>
						<select name="level_screen_id" id="level" class="form-control" required="required">
							<option value="">Select Level Name</option>
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="add">Event Category Name</label>						
						<select name="cat_name" id="category" class="form-control" required="required">
							<option value="">Select Event Category</option>
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="add">Sub Category</label>
						<select name="event_sub_cat" id="subcategory" class="form-control">
							<option value="">Select Sub Category</option>
						</select>
					</div>
				</div>
				@if(isset($details) and $details->event_banner !='')    
				<div class="col-md-6">
					<div class="form-group">
						<img width="300" height="200" src="{{URL::to('/')}}/event/{{ $details->event_banner }}" alt="{{ $details->title }}">
					</div>
				</div>
				@endif
				<div class="col-md-6">
					<div class="form-group">
						<label for="add">Event Banner</label>
						<input type="file" class="form-control" id="event_banner" name="event_banner" />
					</div>
				</div>
				<div class="col-md-6" style="display:none;">
					<div class="form-group">
						<label for="add">Event Type</label>
						<select name="event_type" id="event_type" class="form-control" >
							<option value="">Select Event Type</option>
							<option value="A">A</option>
							<option value="B">B</option>
						</select>
					</div>
				</div>
				
				<div class="col-md-6">
					<div class="form-group">
						<label for="add">Controls Type</label>
						<select name="event_control_type" id="event_control_type" class="form-control" required="required">
							<option value="controller" {{ (isset($details) and $details->control_type == 'controller') ? 'selected' : '' }}>Controller</option>
							<option value="keyboard" {{ (isset($details) and $details->control_type == 'keyboard') ? 'selected' : '' }}>Keyboard</option>							
						</select>	
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="match_length">Match Length</label>
						<input type="text" name="match_length" id="match_length" class="form-control" required="required" value="{{ isset($details) ? $details->match_length : old('event_title') }}"> 
						<p class="text-danger">{{ $errors->first('match_length') }}</p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="add">Winning Prize</label>
						<input type="text" class="form-control" id="win_prize" name="win_prize" placeholder="Enter Winning Prize" required="required" value="{{ isset($details) ? $details->win_prize : old('win_prize') }}" />
						<p class="text-danger">{{ $errors->first('win_prize') }}</p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="add">Entry Fee</label>
						<input type="text" class="form-control" id="entry_fees" name="entry_fees" placeholder="Enter Event Fees" required="required" value="{{ isset($details) ? $details->entry_fees : old('entry_fees') }}" />
						<p class="text-danger">{{ $errors->first('entry_fees') }}</p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="add">Event Start Date</label>
						<div class="input-group date">
							<input type="text" class="form-control datepicker" name="event_start_date" value="{{ isset($details) ? $details->event_start_date : old('event_title') }}">
							<div class="input-group-addon">
								<span class="glyphicon glyphicon-th"></span>
							</div>
						</div>					
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="add">Event End Date</label>
						<div class="input-group date">
							<input type="text" class="form-control datepicker" id="event_end_date" name="event_end_date" value="{{ isset($details) ? $details->event_end_date : old('event_title') }}">
							<div class="input-group-addon">
								<span class="glyphicon glyphicon-th"></span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="add">Event Duration(in minute)</label>
						<input type="number" name="event_duration" id="event_duration" class="form-control" required="required" value="{{ isset($details) ? $details->event_duration : old('event_title') }}"> 
						<p class="text-danger">{{ $errors->first('event_duration') }}</p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="add">Event Sponsor</label>
						<input type="text" name="event_sponsor" id="event_sponsor" class="form-control" required="required"  value="{{ isset($details) ? $details->event_sponson : old('event_title') }}"> 
						<p class="text-danger">{{ $errors->first('event_sponsor') }}</p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="add">Additional Rules & Information</label>
						<textarea name="event_rules" id="event_rules" class="form-control" required="required">{{ isset($details) ? $details->event_rule : old('event_title') }}</textarea>	
						<p class="text-danger">{{ $errors->first('event_rules') }}</p>	
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					{{ csrf_field() }}
					<input type="hidden" name="id" value="{{ isset($details) ? $details->id : '' }}" />
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</div>
		</form>
	</div>
</div>
@section('scripts')
<script type="text/javascript">
	$(document).ready(function() {
		$.fn.fetchLevel = function (val) {
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
				},
				type: 'post',
				url: "{{ url('/admin/event/listlevelID') }}",
				data: {
					'screen_id': val
				},
				success: function(data) {
					$("#level").html(data);
					setTimeout(() => {
						@if (!empty(old('level_screen_id')))
						$('#level option[value="{{old('level_screen_id')}}"]').attr('selected', true);
						@endif

						@if (isset($details))
						$('#level option[value="{{$details->category->level->id}}"]').attr('selected', true);
						$.fn.fetchCategory("{{$details->category->level->id}}");
						@endif
					}, 100);
				}
			});
		}

		$.fn.fetchCategory = function (val) {
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
				},
				type: 'post',
				url: "{{ url('/admin/event/listcatID') }}",
				data: {
					'level_screen_id': val
				},
				success: function(data) {
					$("#category").html(data);
					setTimeout(() => {
						@if (!empty(old('level_screen_id')))
						$('#category option[value="{{old('level_screen_id')}}"]').attr('selected', true);
						@endif

						@if (isset($details))
						$('#category option[value="{{$details->category->parent->id}}"]').attr('selected', true);
						$.fn.fetchSubCategory("{{$details->category->parent->id}}");
						@endif
					}, 200);
				}
			});
		}

		$.fn.fetchSubCategory = function (val) {
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
				},
				type: 'post',
				url: "{{ url('/admin/event/listsubcatID') }}",
				data: {
					'cat_id': val
				},
				success: function(data) {
					$("#subcategory").html(data);
					setTimeout(() => {
						@if (!empty(old('level_screen_id')))
						$('#subcategory option[value="{{old('level_screen_id')}}"]').attr('selected', true);
						@endif

						@if (isset($details))
						$('#subcategory option[value="{{$details->cat_id}}"]').attr('selected', true);
						@endif
					}, 300);
				}
			});
		}

		$.fn.gameType = function (val) {
			var token = $('meta[name="csrf-token"]').attr('content');
			var link  = "{{ url('/admin/event/listgametypeID') }}";

			$.ajax({
				url : link,
				type : "post",
				data : {
				    'id' : val,
				    '_token' : token
				},
				success: function(data) {
					$("#game_type").html(data);
					setTimeout(() => {
						@if (!empty(old('level_screen_id')))
						$('#game_type option[value="{{old('level_screen_id')}}"]').attr('selected', true);
						@endif
						@if (isset($details))
						$('#game_type option[value="{{$details->game_type}}"]').attr('selected', true);
						@endif
					}, 100);
				}
			});
		}



		$.fn.gameVenue = function (val) {

			var token = $('meta[name="csrf-token"]').attr('content');
			var link  = "{{ url('/admin/event/listvenueID') }}";

			$.ajax({
					url     : link,
					type    : "post",
					data    : {
							    'id' : val,
							    '_token' : token
							  },
					success: function(data) {
						$("#event_venue").html(data);
						setTimeout(() => {
							@if (!empty(old('level_screen_id')))
							$('#event_venue option[value="{{old('level_screen_id')}}"]').attr('selected', true);
							@endif

							@if (isset($details))
							$('#event_venue option[value="{{$details->venue}}"]').attr('selected', true);
							@endif
						}, 100);
					}
				});
		}


	
	

		$("#game-screen").on('change',function() {
			$.fn.fetchLevel($(this).val());
			$.fn.gameType($(this).val());	
			$.fn.gameVenue($(this).val());	
		});

		$("#level").on('change',function() {
			$.fn.fetchCategory($(this).val());			
		});

		$("#category").on('change',function() {
			$.fn.fetchSubCategory($(this).val());			
		});
		
		@if (!empty(old('screen_id')))
		$.fn.fetchLevel("{{old('screen_id')}}");
		@endif

		@if (!empty(old('level_screen_id')))
		$.fn.fetchCategory("{{old('level_screen_id')}}");
		@endif

		@if (!empty(old('cat_name')))
		$.fn.fetchSubCategory("{{old('cat_name')}}");
		@endif

		@if (!empty(old('game_type')))
		game_type("{{old('game_type')}}");
		@endif

		@if (!empty(old('event_venue')))
		gameVenue("{{old('event_venue')}}");
		@endif

		@if (!empty(old('screen_id')))
		$.fn.fetchLevel("{{old('screen_id')}}");
		@endif

		@if (isset($details))
		$.fn.fetchLevel("{{$details->category->level->screen->id}}");
		$.fn.gameType("{{$details->category->level->screen->id}}");
		$.fn.gameVenue("{{$details->category->level->screen->id}}");
		@endif
	});
</script>
@endsection
@endsection