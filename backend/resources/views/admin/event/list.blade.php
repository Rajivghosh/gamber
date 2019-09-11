@extends('layouts.main')
@section('content')
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<span class="m-0 font-weight-bold text-primary fs16">Evert List</span>
		<a href="{{ url('/admin/event/add') }}" class="btn btn-sm btn-primary pull-right">Add</a>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-hover table-bordered table-stripped" id="dTable" style="width:100%">
				<thead>
					<th>Sl. No.</th>
					<th>Event</th>	
					<th>Event Start Date</th>				
					<th>Sub Category</th>					
					<th>Status</th>
					<th>Action</th>
				</thead>
				<tbody>
					@foreach($data as $each)
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td>{{ $each->gen_title }}</td>
						<td>{{ date('l jS \\of F Y h:i:s A', strtotime($each->event_start_date)) }}</td>
						<td>{{ !empty($each->category) ? $each->category->name : '' }}</td>				
						<td>
							@if ($each->event_status == 0)

							Upcoming
							
							@elseif ($each->event_status == 1)

							live 

							@else

							History

							@endif
						</td>
						<td>
							<a href="{{ url('/admin/event/edit/' . $each->id) }}" class="btn btn-sm btn-success">
								<i class="fa fa-pencil"></i>
							</a>
							<a href="{{ url('/admin/event/remove/' . $each->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
								<i class="fa fa-trash"></i>
							</a>
							<a href="{{ url('/admin/event/details/' . $each->id) }}" data-id="{{$each->id}}" class="btn btn-sm btn-primary subcat">
								<i class="fa fa-info"></i>
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