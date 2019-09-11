@extends('layouts.main')
@section('content')
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<span class="m-0 font-weight-bold text-primary fs16">Add/Edit Badges</span>
		<a href="{{ url('/admin/badges/list') }}" class="btn btn-sm btn-danger pull-right">Back to List</a>
	</div>
	<div class="card-body">
		<form method="post" action="{{ url('/admin/badges/add')}}" enctype="multipart/form-data">
			@if(isset($details) and $details->badges_logo !='')    
			<div class="col-md-6">
				<div class="form-group">
					<img width="300" height="200" src="{{URL::to('/')}}/badges/{{ $details->badges_logo }}" alt="{{ $details->name }}">
				</div>
			</div>
			@endif
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="add">Badges Name</label>
						<input type="text" class="form-control" id="add" name="name" placeholder="Enter Badges Name" required="required" value="{{ isset($details) ? $details->name : old('name') }}" />
						<p class="text-danger">{{ $errors->first('name') }}</p>
					</div>
				</div>				
				<div class="col-md-6">
					<div class="form-group">
						<label for="game_logo">Badges Logo</label>
						<input type="file" class="form-control" id="badges_logo" name="badges_logo" />				
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