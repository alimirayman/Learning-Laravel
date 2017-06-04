<nav class="navbar sticky-top navbar-light bg-faded">
	<div class="container">
	  <a href=" {{ route('index') }} " class="navbar-brand mb-0">Learning Laravel</a>
		<div class="navbar-text pull-right">
			@if(Auth::check())
				<a class="btn btn-danger btn-sm" href=" {{ route('admin_dashboard') }} "> Dashboard </a>
				<a class="btn btn-danger btn-sm" href=" {{ route('admin_logout') }} "> Logout </a>
			@else
				<a class="btn btn-danger btn-sm" href=" {{ route('admin_login') }} "> Login </a>
			@endif
		</div>
	</div>
</nav>