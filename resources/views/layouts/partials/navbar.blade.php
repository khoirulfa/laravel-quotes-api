<nav class="main-header navbar navbar-expand navbar-white navbar-light">
	<!-- Left navbar links -->
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
		</li>
		<li class="nav-item d-none d-sm-inline-block">
			<a href="{{ route('home') }}" class="nav-link">Home</a>
		</li>
	</ul>

	<!-- Right navbar links -->
	<ul class="navbar-nav ml-auto">
		<li class="nav-item">
			<a class="nav-link" data-widget="fullscreen" href="#" role="button">
				<i class="fas fa-expand-arrows-alt"></i>
			</a>
		</li>
	</ul>
	<div id="navbar-menu">
		<ul class="nav navbar-nav navbar-right">
			<!-- Authentication Links -->
			@guest
				@if (Route::has('login'))
					<li class="nav-item dropdown">
						<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
					</li>
				@endif

				@if (Route::has('register'))
					<li class="nav-item dropdown">
						<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
					</li>
				@endif
			@else
				<li class="nav-item dropdown">
					<button id="dropdownMenuButton" class="nav-link btn dropdown-toggle" href="#" role="button" data-toggle="dropdown"
						aria-haspopup="true" aria-expanded="false" v-pre>
						{{ Auth::user()->name }}
					</button>

					<div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
						<a class="dropdown-item py-2" href="{{ route('logout') }}"
							onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
							<i class="lnr lnr-exit m-2"></i>
							{{ __('Logout') }}
						</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
							@csrf
						</form>
					</div>
				</li>
			@endguest
		</ul>
	</div>
</nav>
