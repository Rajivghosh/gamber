@extends('layouts.main')
@section('content')
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<span class="m-0 font-weight-bold text-primary fs16">Category List</span>
		<a href="{{ url('/admin/eventcategory/add') }}" class="btn btn-sm btn-primary pull-right">Add</a>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-hover table-bordered table-stripped" id="dTable" style="width:100%">
				<thead>
					<th>Sl. No.</th>
					<th>Game Screen</th>
					<th>Level</th>
					<th>Category Name</th>
					<th>Action</th>
				</thead>
				<tbody>
					@foreach($data as $each)
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td>{{ $each->screen->game_screen_name }}</td>
						<td>{{ $each->level->name }}</td>
						<td>{{ $each->name }}</td>
						<td>
							<a href="{{ url('/admin/eventcategory/edit/' . $each->id) }}" class="btn btn-sm btn-success">
								<i class="fa fa-pencil"></i>
							</a>
							<a href="{{ url('/admin/eventcategory/remove/' . $each->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
								<i class="fa fa-trash"></i>
							</a>
							<a href="javascript:void(0)" data-id="{{$each->id}}" class="btn btn-sm btn-primary subcat">
								<i class="fa fa-object-group"></i>
							</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
<div id="subcategory" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="dropdown-header bg-primary">
				<button type="button" class="close py-2" data-dismiss="modal">&times;</button>
				<h4 class="modal-title text-white">Sub Category</h4>
			</div>
			<div class="modal-body" id="result">
				
			</div>
		</div>
	</div>
</div>

@section('scripts')
<script type="text/javascript">
	$(document).ready(function() {
		$('.subcat').click(function() {
			$.ajax({
				type : "GET",
				url : "{{ url('/admin/eventcategory/sub') }}/" + $(this).data('id'),
				success : function (res) {
					$('#result').html(res);
					$("#subcategory").modal();
				}
			});
		});
	});
</script>
@endsection
@endsection