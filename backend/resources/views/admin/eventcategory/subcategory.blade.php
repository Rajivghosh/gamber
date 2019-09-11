<div class="row">
	<div class="col-md-7">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<span class="m-0 font-weight-bold text-primary fs16">Sub Category List</span>
			</div>
			<div class="card-body">
				<div class="table-responsive modal-table-height">
					<table class="table table-hover table-bordered table-stripped" id="dTable" style="width:100%">
						<thead>
							<th>Sl. No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</thead>
						<tbody id="listing">
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-5">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<span class="m-0 font-weight-bold text-primary fs16">Add/Edit Sub Category</span>
			</div>
			<div class="card-body">
				<div class="form-group">
					<label for="name">Game Name</label>
					<input type="text" class="form-control" id="name" placeholder="Enter Subcategory Name" value="" autocomplete="off" />
					<p class="text-danger" id="name-err"></p>
				</div>
				<input type="hidden" id="id" value="" />
				<input type="hidden" id="parent" value="{{ $parent }}" />
				<button type="button" class="btn btn-primary" id="savesubcat">Save</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$.fn.fetchdata = function () {
		$.ajax({
			type : "GET",
			url : "{{ url('/admin/eventcategory/sub/'.$parent.'/data') }}",
			dataType: "json",
			success : function (res) {
				var list = '';
				if (res.length > 0) {
					var i=1;
					for(var each in res) {						
						list += `
							<tr>
								<td>`+i+`</td>
								<td>` + res[each].name + `</td>
								<td>
									<a href="javascript:void(0)" class="btn btn-sm btn-success editsubcat" data-name="` + res[each].name + `" data-id="` + res[each].id + `">
										<i class="fa fa-pencil"></i>
									</a>
									<a href="javascript:void(0)" class="btn btn-sm btn-danger deletesubcat" data-id="` + res[each].id + `">
										<i class="fa fa-trash"></i>
									</a>
								</td>
							</tr>
						`;
						i++;
					}
					$('#listing').html(list);
				}
			}
		});
	}

	$(document).ready(function() {
		$.fn.fetchdata();
		
		$("#savesubcat").click(function() {
			$('#name-err').html("");
			if ($('#name').val() == "" || $('#name').val() != $('#name').val().trim()) {
				$('#name-err').html("Please add name");
				return false;
			}
			$.ajax({
				type : "POST",
				url : "{{ url('/admin/eventcategory/sub/save') }}",
				data : {
					parent : $('#parent').val(),
					name : $('#name').val(),
					id : $('#id').val(),
					_token : "{{ csrf_token() }}"
				},
				success : function (res) {
					$('#name').val("");
					$('#id').val("");
					$.fn.fetchdata();
				},
				error : function (err) {
					$('#name-err').html(err.responseJSON.errors.name[0]);
				}
			});
		});

		$(document).on('click', '.editsubcat', function() {
			$('#name').val($(this).data('name'));
			$('#id').val($(this).data('id'));
		});

		$(document).on('click', '.deletesubcat', function() {
			var conf = confirm('Are you sure?');
			if (conf) {
				$.ajax({
					type : "GET",
					url : "{{ url('/admin/eventcategory/sub/remove') }}/" + $(this).data('id'),
					success : function (res) {
						$.fn.fetchdata();
					}
				})
			}
		});
	});
</script>