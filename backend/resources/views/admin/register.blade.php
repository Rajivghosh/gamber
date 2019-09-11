@extends('layouts.app')
@section('content')
<div class="row centered-form" style="margin-top: 20px">
    <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
    	<div class="panel panel-default">
    		<div class="panel-heading">
	    		<h3 class="panel-title">Please sign up here</h3>
	 			</div>
	 			<div class="panel-body">
	    		<form role="form" method="post" action="">
	    			<div class="row">
	    				<div class="col-xs-6 col-sm-6 col-md-6">
	    					<div class="form-group">
	                <input type="text" name="first_name" id="first_name" class="form-control input-sm" value="{{ old('first_name') }}" placeholder="First Name">
	                	<p class="text-danger">{{ $errors->first('first_name') }}</p>
	    					</div>
	    				</div>
	    				<div class="col-xs-6 col-sm-6 col-md-6">
	    					<div class="form-group">
	    						<input type="text" name="last_name" id="last_name" class="form-control input-sm" value="{{ old('last_name') }}" placeholder="Last Name">
	    						<p class="text-danger">{{ $errors->first('last_name') }}</p>
	    					</div>
	    				</div>
	    			</div>

	    			<div class="form-group">
	    				<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address" value="{{ old('email') }}" />
	    				<p class="text-danger">{{ $errors->first('email') }}</p>
	    			</div>

	    			<div class="row">
	    				<div class="col-xs-6 col-sm-6 col-md-6">
	    					<div class="form-group">
	    						<input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password" />
	    						<p class="text-danger">{{ $errors->first('password') }}</p>
	    					</div>
	    				</div>
	    				<div class="col-xs-6 col-sm-6 col-md-6">
	    					<div class="form-group">
	    						<input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-sm" placeholder="Confirm Password">
	    						<p class="text-danger">{{ $errors->first('password_confirmation') }}</p>
	    					</div>
	    				</div>
	    			</div>			    			
	    			{{ csrf_field() }}
	    			<input type="hidden" name="id" value="" />
	    			<input type="submit" value="Register" class="btn btn-info btn-block">
	    		</form>
	    	</div>
		</div>
	</div>
</div>
@endsection