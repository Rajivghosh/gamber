@extends('layouts.main')
@section('content')
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<span class="m-0 font-weight-bold text-primary fs16">Venue List</span>
		<a href="{{ url('/admin/venue/add') }}" class="btn btn-sm btn-primary pull-right">Add</a>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-hover table-bordered table-stripped" id="dTable" style="width:100%">
				<thead>
					<th>Sl. No.</th>
					<th>Game Screen</th>
					<th>Venue Name</th>					
					<th>Action</th>
				</thead>
				<tbody>
					@foreach($data as $each)
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td>{{ $each->screen['game_screen_name'] }}</td>
						<td>{{ $each->name }} </td>						
						<td>
							<a href="{{ url('/admin/venue/edit/' . $each->id) }}" class="btn btn-sm btn-success">
								<i class="fa fa-pencil"></i>
							</a>
							<a href="{{ url('/admin/venue/remove/' . $each->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
								<i class="fa fa-trash"></i>
							</a>
							
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection