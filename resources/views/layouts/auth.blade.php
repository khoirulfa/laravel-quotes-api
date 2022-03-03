<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
	<title>Login</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

	<!-- Styles -->
	<link href="{{ asset('css/adminlte.min.css') }}" rel="stylesheet">
	<link href="{{ asset('vendor/font-awesome/css/all.min.css') }}" rel="stylesheet">

	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">

	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}">
	<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('img/favicon.png') }}">
</head>

<body class="hold-transition login-page">
	<!-- WRAPPER -->
	<div class="login-box">
		<div class="card card-outline card-primary">
			<div class="card-header text-center">
				<a class="h1"><b>Admin</b>LTE</a>
			</div>
			<div class="card-body">
				<p class="login-box-msg">Sign in to start your session</p>

				@yield('content')
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>

</html>
