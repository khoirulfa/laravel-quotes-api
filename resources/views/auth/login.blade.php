@extends('layouts.auth')

@section('content')
	<form method="POST" action="{{ route('login') }}" class="form-auth-small">
		@csrf
		<div class="input-group mb-3">
			<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
				value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
			<div class="input-group-append">
				<div class="input-group-text">
					<span class="fas fa-envelope"></span>
				</div>
			</div>

			@error('email')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror
		</div>

		<div class="input-group mb-3">
			<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"
				required autocomplete="current-password" placeholder="Password">

			<div class="input-group-append">
				<div class="input-group-text">
					<span class="fas fa-lock"></span>
				</div>
			</div>

			@error('password')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror
		</div>

		<div class="row flex align-items-center">
			<div class="col-8">
				<div class="form-check clearfix">
					<label class="form-check-label element-left" for="remember">
						<input class="form-check-input" type="checkbox" name="remember" id="remember"
							{{ old('remember') ? 'checked' : '' }}>
						{{ __('Remember Me') }}
					</label>
				</div>
			</div>
			<!-- /.col -->
			<div class="col-4">
				<button type="submit" class="btn btn-primary btn-block">
					{{ __('Login') }}
				</button>
			</div>
			<!-- /.col -->
		</div>

		@if (Route::has('password.request'))
			<p class="mb-1">
				<a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
			</p>
		@endif
	</form>
@endsection
