@extends('layouts.main')
@section('content')
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<span class="m-0 font-weight-bold text-primary fs16">Badges List</span>
		<a href="{{ url('/admin/badges/add') }}" class="btn btn-sm btn-primary pull-right">Add</a>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-hover table-bordered table-stripped" id="dTable" style="width:100%">
				<thead>
					<th>Sl. No.</th>
					<th>Badges Name</th>
					<th>Logo</th>
					<th>Action</th>
				</thead>
				<tbody>
					@foreach($data as $each)
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td>{{ $each->name }} </td>
						<td>
							@if(isset($each) and $each->badges_logo !='')  
							<img width="100" height="100" src="{{URL::to('/')}}/badges/{{ $each->badges_logo }}" alt="{{ $each->name }}">
							@endif
						 </td>
						<td>
							<a href="{{ url('/admin/badges/edit/' . $each->id) }}" class="btn btn-sm btn-success">
								<i class="fa fa-pencil"></i>
							</a>
							<a href="{{ url('/admin/badges/remove/' . $each->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
								<i class="fa fa-trash"></i>
							</a>
							<a href="javascript:void(0)" class="btn btn-sm btn-primary">
								<i class="fa fa-info-circle"></i>
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