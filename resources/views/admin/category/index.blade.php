@extends('layouts.app')

@section('title', 'Categories')

@section('breadcrumb')
	<ol class="breadcrumb float-sm-right">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item active">Categories</li>
	</ol>
@endsection

@section('content')
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">

	<div class="row">
		<div class="col-12">
			<div class="card p-3">
				<table id="table" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th class="text-center">UUID</th>
							<th>Title</th>
							<th>Slug</th>
                            <th>Created at</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						@forelse ($categories as $category)
							<tr class="align-baseline py-3">
								<td>{{ $category->uuid }}</td>
								<td>{{ $category->title }}</td>
								<td>{{ $category->slug }}</td>
								<td>{{ $category->created_at->format('D, d-M-Y') }}</td>
								<td class="text-center">
									<a href="{{ route('categories.edit', $category->uuid) }}" class="btn btn-default">
                                        <i class="fas fa-pen"></i>
                                    </a>
									<form action="{{ route('categories.destroy', $category->uuid) }}" method="POST" class="d-inline">
										@csrf
										@method('DELETE')
										<button type="submit" id="delete-button" class="btn btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
									</form>
								</td>
							</tr>
						@empty
							<tr></tr>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
	</div>


	<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
	<script>
	 $(document).ready(function() {
        $('#table').DataTable();

        $('#delete-button').on('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Do you want to delete this category?',
            showCancelButton: true,
            confirmButtonText: 'Delete',
        }).then((result) => {
            if (result.isConfirmed) {
                const form = $(this).parent('form');
                form.submit();
            }
        })
        })
	 });
	</script>
@endsection
