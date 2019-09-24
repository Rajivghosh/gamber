<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
	<div class="text-center d-none d-md-inline my-3">
		<img src="{{URL::to('/')}}/admin_img/logo.png" class="logo">
		<!-- <button class="rounded-circle border-0" id="sidebarToggle"></button> -->
	</div>

	<hr class="sidebar-divider my-0">

	<li class="nav-item {{ (Request::segment(2) == 'home') ? 'active' : '' }}">
		<a class="nav-link" href="{{ url('/admin/home') }}">
			<i class="fas fa-fw fa-tachometer-alt"></i>
			<span>Dashboard</span>
		</a>
	</li>

	<hr class="sidebar-divider">

	<li class="nav-item {{ (Request::segment(2) == 'game') ? 'active' : '' }}">
		<a class="nav-link {{ (Request::segment(2) != 'game') ? 'collapsed' : '' }}" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
			<i class="fas fa-gamepad"></i>
			<span>Game</span>
		</a>
		<div id="collapseTwo" class="collapse {{ (Request::segment(2) == 'game') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item" href="{{ url('/admin/game/list') }}"> <i class="far fa-dot-circle"></i> List</a>
			</div>
		</div>
	</li>


	<li class="nav-item {{ (Request::segment(2) == 'game_type') ? 'active' : '' }}">
		<a class="nav-link {{ (Request::segment(2) != 'game_type') ? 'collapsed' : '' }}" href="#" data-toggle="collapse" data-target="#collapseThree1" aria-expanded="true" aria-controls="collapseThree1">
			<i class="fas fa-gamepad"></i>
			<span>Game Type</span>
		</a>
		<div id="collapseThree1" class="collapse {{ (Request::segment(2) == 'game_type') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item" href="{{ url('/admin/game_type/list') }}"> <i class="far fa-dot-circle"></i> List</a>
			</div>
		</div>
	</li>

	<li class="nav-item {{ (Request::segment(2) == 'competition-level') ? 'active' : '' }}">
		<a class="nav-link {{ (Request::segment(2) != 'competition-level') ? 'collapsed' : '' }}" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
			<i class="fas fa-database"></i>
			<span>Competition Level</span>
		</a>
		<div id="collapseThree" class="collapse {{ (Request::segment(2) == 'competition-level') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item" href="{{ url('/admin/competition-level/list') }}"> <i class="far fa-dot-circle"></i> List</a>
			</div>
		</div>
	</li>

	<li class="nav-item {{ (Request::segment(2) == 'eventcategory') ? 'active' : '' }}">
		<a class="nav-link {{ (Request::segment(2) != 'eventcategory') ? 'collapsed' : '' }}" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
			<i class="fas fa-calendar-week"></i>
			<span>Category List</span>
		</a>
		<div id="collapseFour" class="collapse {{ (Request::segment(2) == 'eventcategory') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item" href="{{ url('/admin/eventcategory/list') }}"> <i class="far fa-dot-circle"></i> List</a>
			</div>
		</div>
	</li>
	<li class="nav-item {{ (Request::segment(2) == 'event') ? 'active' : '' }}">
		<a class="nav-link {{ (Request::segment(2) != 'event') ? 'collapsed' : '' }}" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
			<i class="fab fa-elementor"></i>
			<span>Event List</span>
		</a>
		<div id="collapseFive" class="collapse {{ (Request::segment(2) == 'event') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item" href="{{ url('/admin/event/list') }}"><i class="far fa-dot-circle"></i> List</a>
			</div>
		</div>
	</li>
	<li class="nav-item {{ (Request::segment(2) == 'users') ? 'active' : '' }}">
		<a class="nav-link {{ (Request::segment(2) != 'users') ? 'collapsed' : '' }}" href="#" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
			<i class="far fa-address-book"></i>
			<span>Users List</span>
		</a>
		<div id="collapseSix" class="collapse {{ (Request::segment(2) == 'users') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item" href="{{ url('/admin/users/list') }}"><i class="far fa-dot-circle"></i> List</a>
			</div>
		</div>
	</li>
	<li class="nav-item {{ (Request::segment(2) == 'badges') ? 'active' : '' }}">
		<a class="nav-link {{ (Request::segment(2) != 'badges') ? 'collapsed' : '' }}" href="#" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
			<i class="far fa-address-book"></i>
			<span>Badges List</span>
		</a>
		<div id="collapseSeven" class="collapse {{ (Request::segment(2) == 'badges') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item" href="{{ url('/admin/badges/list') }}"><i class="far fa-dot-circle"></i> List</a>
			</div>
		</div>
	</li>
	<li class="nav-item {{ (Request::segment(2) == 'venue') ? 'active' : '' }}">
		<a class="nav-link {{ (Request::segment(2) != 'badges') ? 'collapsed' : '' }}" href="#" data-toggle="collapse" data-target="#collapseEight" aria-expanded="true" aria-controls="collapseEight">
			<i class="far fa-address-book"></i>
			<span>Venue List</span>
		</a>
		<div id="collapseEight" class="collapse {{ (Request::segment(2) == 'venue') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item" href="{{ url('/admin/venue/list') }}"><i class="far fa-dot-circle"></i> List</a>
			</div>
		</div>
	</li>

</ul>
<div id="content-wrapper" class="d-flex flex-column">