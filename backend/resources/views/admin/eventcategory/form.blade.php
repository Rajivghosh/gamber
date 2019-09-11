@extends('layouts.main')
@section('content')
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<span class="m-0 font-weight-bold text-primary fs16">Add/Edit Category Level</span>
		<a href="{{ url('/admin/eventcategory/list') }}" class="btn btn-sm btn-danger pull-right">Back to List</a>
	</div>
	<div class="card-body">
		<form method="post" action="{{ url('/admin/eventcategory/add')}}" enctype="multipart/form-data">
			<div class="row">				
				<div class="col-md-6">
					<div class="form-group">
						<label for="add">Game Name</label>
						<select id="screen_id" name="screen_id" class="form-control" required="required">
							<option value="">Select Game Screen</option>
							@if (!empty($gamescreen))
							@foreach($gamescreen as $each)
							<option value="{{ $each->id }}" {{ (old('screen_id') == $each->id) ? 'selected' : ((isset($details) and $details->screen->id == $each->id) ? 'selected' : '') }}>{{ $each->game_screen_name }}</option>
							@endforeach
							@endif
							
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="add">Level Name</label>
						<select name="level_screen_id" id="level_screen_id" class="form-control" required="required"></select>
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<label for="add">Event Category Name</label>
						<input type="text" class="form-control" id="add" name="cat_name" placeholder="Enter Level Name" required="required" value="{{ isset($details) ? $details->name : old('cat_name') }}" />
						<p class="text-danger">{{ $errors->first('cat_name') }}</p>
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<label for="add">Event Category Code</label>
						<input type="text" class="form-control" id="add" name="cat_code" placeholder="Enter Level Code" required="required" value="{{ isset($details) ? $details->code : old('cat_code') }}" />
						<p class="text-danger">{{ $errors->first('cat_code') }}</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="add">Category Details</label>
						<input type="text" class="form-control" id="cat_details" name="cat_details" placeholder="Category details" required="required" value="{{ isset($details) ? $details->details : old('cat_details') }}" />
						<p class="text-danger">{{ $errors->first('type_name') }}</p>
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
				url: "{{ url('/admin/eventcategory/listlevelID') }}",
				data: {
					'screen_id': val
				},
				success: function(data) {
					$("#level_screen_id").html(data);
					setTimeout(() => {
						@if (!empty(old('level_screen_id')))
							$('#level_screen_id option[value="{{old('level_screen_id')}}"]').attr('selected', true);
						@endif

						@if (isset($details))
							$('#level_screen_id option[value="{{$details->level_id}}"]').attr('selected', true);
						@endif
					}, 100);
				}
			});
		}

		$("#screen_id").on('change',function() {
			$.fn.fetchLevel($(this).val());			
		});
		
		@if (!empty(old('screen_id')))
			$.fn.fetchLevel("{{old('screen_id')}}");
		@endif

		@if (isset($details))
			$.fn.fetchLevel("{{$details->screen_id}}");
		@endif
	});
</script>
@endsection
@endsection