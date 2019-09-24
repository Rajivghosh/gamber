@extends('layouts.main')
@section('content')
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<span class="m-0 font-weight-bold text-primary fs16">Add/Edit Venue</span>
		<a href="{{ url('/admin/venue/list') }}" class="btn btn-sm btn-danger pull-right">Back to List</a>
	</div>
	<div class="card-body">
		<form method="post" action="{{ url('/admin/venue/add')}}" enctype="multipart/form-data">
			@if(isset($details) and $details->badges_logo !='')    
			<div class="col-md-6">
				<div class="form-group">
					<img width="300" height="200" src="{{URL::to('/')}}/venue/{{ $details->badges_logo }}" alt="{{ $details->name }}">
				</div>
			</div>
			@endif
			<div class="row">
				

				<div class="col-md-4">
					<div class="form-group">
						<label for="add">Venue Name</label>
						<input type="text" class="form-control" id="add" name="name" placeholder="Enter venue Name" required="required" value="{{ isset($details) ? $details->name : old('name') }}" />
						<p class="text-danger">{{ $errors->first('name') }}</p>
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<label for="add">Venue Code</label>
						<input type="text" class="form-control" id="add" name="code" placeholder="Enter venue Code" required="required" value="{{ isset($details) ? $details->code : old('code') }}" />
						<p class="text-danger">{{ $errors->first('code') }}</p>
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<label for="add">Game Name</label>
						<select name="screen_id" class="form-control" required="required">
							<option value="">Select Game Screen</option>
							@if (!empty($gamescreen))
								@foreach($gamescreen as $each)
									<option value="{{ $each->id }}" {{ (old('screen_id') == $each->id) ? 'selected' : ((isset($details) and $details->screen->id == $each->id) ? 'selected' : '') }}>{{ $each->game_screen_name }}</option>
								@endforeach
							@endif
						</select>
					</div>
				</div>				
				
			</div>

			{{ csrf_field() }}
			<input type="hidden" name="id" value="{{ isset($details) ? $details->id : '' }}" />
			<button type="submit" class="btn btn-primary">Save</button>
		</form>
	</div>
</div>
@endsection