@extends('layouts.app')

@section('title', 'Edit quote')

@section('breadcrumb')
	<ol class="breadcrumb float-sm-right">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item"><a href="{{ route('quotes.index') }}">Quotes</a></li>
		<li class="breadcrumb-item active" aria-current="page">Edit quote</li>
	</ol>
@endsection

@section('content')
	<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>

	<link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
	<link href="{{ asset('vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}" rel="stylesheet" />

	<div class="row">
		<div class="col-12">
			<div class="card">
				<form action="{{ route('quotes.update', $quote->uuid) }}" method="POST">
					<div class="card-body">
						@csrf
                        @method('PATCH')
						<div class="row">
							<div class="col-7">
								<div class="form-group">
									<label for="title" class="">Quote</label>
									<textarea name="quote" id="quote" rows="20" class="form-control w-100 @error('quote') is-invalid @enderror"
										placeholder="Quote">{!! old('quote', $quote->quote) !!}</textarea>
									@error('quote')
										<span id="title-error" class="error invalid-feedback">{{ $message }}</span>
									@enderror
								</div>
							</div>
							<div class="col-5">
								<div class="form-group">
									<label for="author" class="">UUID</label>
									<input type="password" name="uuid" id="uuid" class="form-control w-100" value="{{ old('author', $quote->uuid) }}" disabled>
								</div>

								<div class="form-group">
									<label for="author" class="">Author</label>
									<input type="text" name="author" id="author" class="form-control w-100 @error('author') is-invalid @enderror"
										placeholder="Author" value="{{ old('author', $quote->author) }}">
									@error('author')
										<span id="title-error" class="error invalid-feedback">{{ $message }}</span>
									@enderror
								</div>

								<div class="form-group">
									<label for="category" class="">Category</label>
									<select name="category_uuid" id="category"
										class="form-control select2bs4 @error('category_uuid') is-invalid @enderror">
										<option disabled selected>Select category</option>
										@foreach ($categories as $category)
											<option value="{{ $category->uuid }}"
                                                @if (old('category_uuid', $quote->category_uuid) == $category->uuid)
                                                    selected
                                                @endif
                                                >{{ $category->title }}</option>
										@endforeach
									</select>
									@error('category_uuid')
										<span id="title-error" class="error invalid-feedback">{{ $message }}</span>
									@enderror
								</div>
								<button type="submit" class="btn btn-primary">
									<i class="fa fa-save"></i>
                                    <span class="mx-1">Save changes</span>
								</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script>
	 $(document).ready(function() {
        $('#category').select2({
            theme: 'bootstrap4'
        });
	 });
	</script>
@endsection
