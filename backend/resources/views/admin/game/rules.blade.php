@extends('layouts.main')
@section('content')
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<span class="m-0 font-weight-bold text-primary fs16">Game rules</span>
		<a href="{{ url('/admin/game/list') }}" class="btn btn-sm btn-danger pull-right">Back to List</a>
	</div>
	<div class="card-body">
		<form action="{{ url('/admin/game/rules')}}" method="post" class="m-0">
			<div class="col-md-12 p-0">
				<div class="form-group">
					<label for="game_rule">Add rules</label>
					<textarea class="form-control ckeditor" id="game_rule" name="game_rule" rows="25">{{ (!empty($rules))? $rules->game_rule : old('game_rule') }}</textarea>
					<p class="text-danger">{{ $errors->first('game_rule') }}</p>
				</div>
			</div>
			{{ csrf_field() }}
			<div class="col-md-7 text-left mt-5 mb-3 p-0"> 
				<input type="hidden" name="screen_id" value="{{ isset($details) ? $details->id : '' }}" />
				<input type="hidden" name="id" value="{{ isset($rules) ? $rules->id : '' }}" />
				<button type="submit" class="btn btn-md bg-custom">Save</button>
			</div>
		</form>
	</div>
</div>
@endsection