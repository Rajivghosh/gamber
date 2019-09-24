@extends('layouts.app')
@section('content')
<div class="login-form">
    <form action="{{ url('/admin') }}" method="post">
        <img src="{{URL::to('/')}}/admin_img/login-logo.png" class="logo-login">
        <h2 class="text-center"><i class="fas fa-key"></i> Log in</h2>       
        <div class="form-group">
            <input type="text" class="form-control" name="username" placeholder="Username" />
            <p class="text-danger">{{ $errors->first('username') }}</p>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" />
            <p class="text-danger">{{ $errors->first('password') }}</p>
        </div>
        <div class="form-group">
        	{{ csrf_field() }}
            <button type="submit" class="btn btn-primary btn-block">Log in</button>
        </div>
        <div class="clearfix">
            <label class="pull-left checkbox-inline text-white"><input type="checkbox"> Remember me</label>
            <a href="#" class="pull-right forgot">Forgot Password?</a>
        </div>        
    </form>
  <!--   <p class="text-center"><a href="{{ url('admin/register') }}">Create an Account</a></p>  -->   
</div>
@section('scripts')
<script type="text/javascript">
	console.log("sdff");
</script>
<style>
    .login-form{ text-align: center; padding: 90px 0 0 0;  }
.login-form .logo-login{ width:129px; margin-top: -105px;}
.login-form .btn{background: #0091ff; border-color: #0091ff; padding: 11px 15px;}
.login-form .btn:hover{ background: #005ca0; }
.login-form h2 {margin: 41px 0 25px; color: #f3f3f3;}
.login-form { width: 389px;}
.login-form form{ border-radius: 25px; background-image: linear-gradient(to bottom, #005ca0, #0069b7, #0076cf, #0083e7, #0091ff);}
.login-form .form-control{ height: 46px; box-shadow: none; border-radius: 25px; }
.login-form .forgot{ color: #ccc; }
.login-form .forgot:hover{color: #ffe500;}
.login-form button.btn{box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1803921568627451); border-radius: 25px;}
.login-form .text-white{ color: #fff;}
</style>

@endsection
@endsection