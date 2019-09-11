@extends('layouts.main')
@section('content')
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<span class="m-0 font-weight-bold text-primary fs16">Add/Edit Competition Level</span>
		<a href="{{ url('/admin/game_type/list') }}" class="btn btn-sm btn-danger pull-right">Back to List</a>
	</div>
	<div class="card-body">
		<form method="post" action="{{ url('/admin/game_type/add')}}" enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="add">Competition Name</label>
						<input type="text" class="form-control" id="add" name="type_name" placeholder="Enter Level Name" required="required" value="{{ isset($details) ? $details->name : old('type_name') }}" />
						<p class="text-danger">{{ $errors->first('type_name') }}</p>
					</div>
				</div>
				<div class="col-md-6">
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
@endsection