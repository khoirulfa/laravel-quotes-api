<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Fonts -->
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

	<!-- Styles -->
	<link href="{{ asset('css/adminlte.min.css') }}" rel="stylesheet">
	<link href="{{ asset('vendor/font-awesome/css/all.min.css') }}" rel="stylesheet">

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"
	 integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
	<div class="wrapper">
		@include('layouts.partials.navbar')
		@include('layouts.partials.sidebar')

		<!-- MAIN CONTENT -->
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="content-header">
					<div class="container-fluid">
						<div class="row mb-2">
							<div class="col-sm-6 d-flex">
								<h1 class="m-0">@yield('title')</h1>
                                @if (request()->routeIs('categories.index'))
                                    <a href="{{ route('categories.create') }}" class="btn btn-primary mx-3">
                                        <i class="fas fa-plus-circle"></i>
                                        <span class="ml-2">New category</span>
                                    </a>
                                @endif
                                @if (request()->routeIs('quotes.index'))
                                    <a href="{{ route('quotes.create') }}" class="btn btn-primary mx-3">
                                        <i class="fas fa-plus-circle"></i>
                                        <span class="ml-2">New quote</span>
                                    </a>
                                @endif
							</div>
							<div class="col-sm-6">
								@yield('breadcrumb')
							</div>
						</div>
					</div>
				</div>

				<section class="content">
					<div class="container-fluid">
						@yield('content')
					</div>
				</section>
				<!-- END OVERVIEW -->
			</div>
		</div>
		<!-- END MAIN CONTENT -->

		@include('layouts.partials.footer')
		@include('sweetalert::alert')

		<script src="{{ asset('js/app.js') }}"></script>
		<script src="{{ asset('js/adminlte.min.js') }}"></script>
		<script src="{{ asset('js/pages/dashboard.js') }}"></script>
	</div>
</body>

</html>
