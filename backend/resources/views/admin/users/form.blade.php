@extends('layouts.main')
@section('content')
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<span class="m-0 font-weight-bold text-primary fs16">Add/Edit User</span>
		<a href="{{ url('/admin/users/list') }}" class="btn btn-sm btn-danger pull-right">Back to List</a>
	</div>
	<div class="card-body">
		<form method="post" action="{{ url('/admin/users/add')}}" enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" required="required" value="{{ isset($details) ? $details->username : old('username') }}" />
						<p class="text-danger">{{ $errors->first('username') }}</p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required="required" value="{{ isset($details) ? $details->email : old('email') }}" />
						<p class="text-danger">{{ $errors->first('email') }}</p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="first_name">First Name</label>
						<input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" required="required" value="{{ isset($details) ? $details->info->first_name : old('first_name') }}" />
						<p class="text-danger">{{ $errors->first('first_name') }}</p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="last_name">Last Name</label>
						<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter last Name" required="required" value="{{ isset($details) ? $details->info->last_name : old('last_name') }}" />
						<p class="text-danger">{{ $errors->first('last_name') }}</p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" class="form-control" id="password" name="password" placeholder="Enter password" @if(!isset($details)) required="required" @endif value="" />
						<p class="text-danger">{{ $errors->first('password') }}</p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="password_confirmation">Password Confirmation</label>
						<input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter confirm password" 
						 @if(!isset($details)) required="required" @endif value="" />
						<p class="text-danger">{{ $errors->first('password_confirmation') }}</p>
					</div>
				</div>				
				<div class="col-md-6">
					<div class="form-group">
						<label for="address">Address</label>
						<input type="text" class="form-control" id="address" name="address" placeholder="Enter address" required="required" value="{{ isset($details) ? $details->info->address : old('address') }}" />
						<p class="text-danger">{{ $errors->first('name') }}</p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="country">Country</label>
						<select id="country" name="country" class="form-control" required="required">
							<option value="">Select Country</option>
							@if(!empty($country))
							@foreach($country as $val)
							<option value="{{$val->id}}" {{ (old('country') == $val->id) ? 'selected' : (isset($details) and $details->info->country == $val->id) ? 'selected' : '' }}>{{$val->country_name}}</option>
							@endforeach
							@endif
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="state">State</label>
						<!-- <input type="text" class="form-control" id="state" name="state" placeholder="Enter state" required="required" value="{{ isset($details) ? $details->info->state : old('state') }}" />
						<p class="text-danger">{{ $errors->first('state') }}</p> -->
						<select name="state" id="state" class="form-control" required="required" >
							<option value="">Select State</option>
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="city">City</label>
						<!-- <input type="text" class="form-control" id="city" name="city" placeholder="Enter city" required="required" value="{{ isset($details) ? $details->info->city : old('name') }}" />
						<p class="text-danger">{{ $errors->first('city') }}</p> -->
						<select name="city" id="city" class="form-control" required="required" >
							<option value="">Select City</option>
						</select>
					</div>
				</div>
				
				<div class="col-md-6">
					<div class="form-group">
						<label for="zipcode">Zip code</label>
						<input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Enter zipcode" required="required" value="{{ isset($details) ? $details->info->zipcode : old('name') }}" />
						<p class="text-danger">{{ $errors->first('zipcode') }}</p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="contact_no">Phone Number</label>
						<input type="text" class="form-control" id="contact_no" name="contact_no" placeholder="Enter phone number" required="required" value="{{ isset($details) ? $details->info->contact_no : old('contact_no') }}" />
						<p class="text-danger">{{ $errors->first('contact_no') }}</p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="dob">Date of Birth</label>
						<div class="input-group date">
						    <input type="text" class="form-control" id="dob" name="dob" value="{{ isset($details) ? $details->info->dob : old('dob') }}">
						    <div class="input-group-addon">
						        <span class="glyphicon glyphicon-th"></span>
						    </div>
						</div>			
					</div>
				</div>
			</div>
			{{ csrf_field() }}
			<div class="row">
				<div class="col-md-12">
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
		$.fn.fetchCountry = function (val) {
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
				},
				type: 'post',
				url: "{{ url('/admin/users/liststateID') }}",
				data: {
					'country_id': val
				},
				success: function(data) {

					$("#state").html(data);
					setTimeout(() => {
						@if (!empty(old('country')))
						$('#state option[value="{{old('country')}}"]').attr('selected', true);
						@endif

						@if (isset($details))
						$('#state option[value="{{$details->info->state}}"]').attr('selected', true);
						$.fn.fetchState("{{$details->info->state}}");
						@endif
					}, 100);
				}
			});
		}

		$.fn.fetchState = function (value) {
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
				},
				type: 'post',
				url: "{{ url('/admin/users/listcityID') }}",
				data: {
					'id': value
				},
				success: function(data) {
					$("#city").html(data);
					setTimeout(() => {
						@if (!empty(old('state')))
						$('#city option[value="{{old('state')}}"]').attr('selected', true);
						@endif

						@if (isset($details))
						$('#city option[value="{{$details->info->city}}"]').attr('selected', true);
						@endif
					}, 200);
				}
			});
		}

		$("#country").on('change',function() {
			$.fn.fetchCountry($(this).val());
		});

		$("#state").on('change',function() {
			$.fn.fetchState($(this).val());			
		});

		
		@if (!empty(old('country')))
		$.fn.fetchCountry("{{old('country')}}");
		@endif

		@if (!empty(old('state')))
		$.fn.fetchState("{{old('state')}}");
		@endif


		@if (isset($details))
		$.fn.fetchCountry("{{$details->info->country}}");
		@endif
	});
</script>
@endsection
@endsection