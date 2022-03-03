{{-- <aside id="sidebar-nav" class="sidebar">
	<div class="sidebar-scroll">
        <ul class="nav flex flex-col">
            <li class="my-3">
                <a
                    href="{{ route('home') }}"
                    class="text-decoration-none @if (request()->routeIs('home')) active @endif"
                >
                    <i class="lnr lnr-home"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="my-3">
                <a
                    href="{{ route('categories.index') }}"
                    class="text-decoration-none @if (request()->routeIs('categories.index')) active @endif"
                >
                    <i class="lnr lnr-database"></i> <span>Categories</span>
                </a>
            </li>
            <li class="my-3">
                <a
                    href="{{ route('quotes.index') }}"
                    class="text-decoration-none @if (request()->routeIs('quotes.index')) active @endif"
                >
                    <i class="lnr lnr-bubble"></i> <span>Quotes</span>
                </a>
            </li>
        </ul>
	</div>
</aside> --}}

<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="index3.html" class="brand-link">
		<img src="{{ asset('img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
			style="opacity: .8">
		<span class="brand-text font-weight-light">{{ config('app.name') }}</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar Menu -->
		<nav class="mt-3">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<li class="nav-item">
					<a href="{{ route('home') }}" class="nav-link @if (request()->routeIs('home')) active @endif">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Dashboard
						</p>
					</a>
				</li>

				<li class="nav-header">COLLECTIONS</li>

				<li class="nav-item">
					<a href="{{ route('categories.index') }}" class="nav-link @if (request()->routeIs('categories.*')) active @endif">
						<i class="nav-icon fas fa-layer-group"></i>
						<p>
							Categories
						</p>
					</a>
				</li>

				<li class="nav-item">
					<a href="{{ route('quotes.index') }}" class="nav-link @if (request()->routeIs('quotes.*')) active @endif">
						<i class="nav-icon fas fa-quote-left"></i>
						<p>
							Quotes
						</p>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>
