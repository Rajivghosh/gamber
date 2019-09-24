@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('theme/vendor/fontawesome-free/css/all.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('theme/css/fonts.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('theme/css/sb-admin-2.min.css')}}" />
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/1.1.1/jquery.datetimepicker.css" />
<link rel="stylesheet" type="text/css" href="{{asset('theme/css/extended.css')}}"/>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="{{asset('theme/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('theme/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('theme/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<script src="{{asset('theme/js/sb-admin-2.min.js')}}"></script>
<script type="text/javascript" src=" https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/1.1.1/jquery.datetimepicker.min.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="{{asset('ckeditor/ckeditor.js')}}"></script>

<script type="text/javascript">
         CKEDITOR.replace( 'messageArea',
         {
          customConfig : 'config.js',
          toolbar : 'simple'
          })
</script> 
<script type="text/javascript">
	$(document).ready(function() {
		$('#dTable').DataTable();

		if ($('.alert')) {
			setTimeout(() => {
				$('.alert').fadeOut();
			}, 3000);
		}    	
		$('.datepicker').datetimepicker();
		$('#dob').datepicker();
	});

	$(function() {
		$('.status').change(function() {
			var status = $(this).attr('value');
			var token  = $("meta[name='csrf-token']").attr("content");
			var link   = "{{route('user.status')}}";

			$.ajax({
					url     : link,
					method  : "post",
					data    : {
							'userid'    : status,
							'_token'    : token
							},
					success : function(result){
						
						alert('Status Changed Successfully');
					}
				});

			
		
		});
	});

	
</script>
@endpush