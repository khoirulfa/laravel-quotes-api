@extends('layouts.app')

@section('title', 'Create a category')

@section('breadcrumb')
	<ol class="breadcrumb float-sm-right">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
		<li class="breadcrumb-item active" aria-current="page">Create new category</li>
	</ol>
@endsection

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<form action="{{ route('categories.store') }}" method="POST">
					<div class="card-body">
						@csrf

						<div class="form-group w-25">
							<label for="uuid">UUID</label>
							<div class="w-100">
								<input type="password" name="uuid" class="form-control" placeholder="Auto generate uuid" disabled>
							</div>
						</div>

						<div class="form-group w-25">
							<label for="title">Title</label>
							<div class="w-auto">
								<input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
									placeholder="Title" value="{{ old('title') }}" autofocus>
								@error('title')
									<span id="title-error" class="error invalid-feedback">{{ $message }}</span>
								@enderror
							</div>
						</div>

						<div class="form-group w-25">
							<label>Slug</label>
							<div class="w-auto">
								<input type="text" id="slug" class="form-control" placeholder="Slug" value="{{ old('slug') }}" disabled>
							</div>
						</div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-plus-square"></i>
                            <span class="mx-1">Add new category</span>
                        </button>
                    </div>
				</form>
			</div>
		</div>
	</div>
	<script>
	 $(window).ready(function() {
        $('#title').on('keyup', function() {
            var title = $(this).val();
            var slug = title.toLowerCase();
            slug = slug.replace(/[^a-zA-Z0-9 ]/g, "");
            slug = slug.replace(/\s+/g, "-");
            $('#slug').val(slug);
        });
	 })
	</script>
@endsection
