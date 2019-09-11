@include('admin.common.header')
@include('admin.common.sidebar')
	<div id="content">
		@include('admin.common.topbar')
		@if(!empty(session('success')))
            <div class="alert alert-success col-md-11 mx-4">
                <strong>{{ session('success') }}</strong>
            </div>
        @endif
		<div class="container-fluid">
			@yield('content')
		</div>
	</div>
@include('admin.common.footer')
@stack('scripts')
@section('scripts')
@show
</body>
</html>