@extends('layouts.main')
@section('content')
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<span class="m-0 font-weight-bold text-primary fs16">Users List</span>
		<a href="{{ url('/admin/users/add') }}" class="btn btn-sm btn-primary pull-right">Add</a>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-hover table-bordered table-stripped" id="dTable" style="width:100%">
				<thead>
					<th>Sl. No.</th>
					<th>Full Name</th>
					<th>User name</th>
					<th>Users Email</th>
					<th>Address</th>
					<th>Zip Code</th>
					<th>Status</th>
					<th>Action</th>
				</thead>
				<tbody>
					@if ($data->count() > 0)
						@foreach($data as $each)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>
								@if($each->info->first_name != NULL)
									{{ $each->info->first_name }} {{ $each->info->last_name }}
								@else
									N/A
								@endif
							</td>
							<td>{{ $each->username }}</td>
							<td>{{ $each->email }} </td>
							<td>
								@if($each->info->address != NULL)
									{{ $each->info->address }} 
								@else
									N/A
								@endif
							</td>
							<td>
								@if($each->info->zipcode != NULL)
									{{ $each->info->zipcode }}
								@else
									N/A
								@endif
							</td>
							<td>
								<!-- <input type="hidden" class="user_id" id="user_id" value="{{$each->id}}"> -->
								@if($each->status == 1)
									<input checked data-toggle="toggle" type="checkbox" class="status" value="{{$each->id}}">
								@else
									<input data-toggle="toggle" type="checkbox" class="status" value="{{$each->id}}">
								@endif

							</td>
							<td>
								<a href="{{ url('/admin/users/edit/' . $each->id) }}" class="btn btn-sm btn-success">
									<i class="fa fa-pencil"></i>
								</a>
								<a href="{{ url('/admin/users/remove/' . $each->id) }}" class="btn btn-sm btn-danger" style="display: none;" onclick="return confirm('Are you sure?')">
									<i class="fa fa-trash"></i>
								</a>
								<a href="{{ url('/admin/users/details/' . $each->id) }}" class="btn btn-sm btn-primary">
									<i class="fa fa-info-circle"></i>
								</a>
							</td>
						</tr>
						@endforeach
					@endif
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
