@extends('layouts.app')

@section('title', 'Quotes')

@section('breadcrumb')
	<ol class="breadcrumb float-sm-right">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Quotes</li>
	</ol>
@endsection

@section('content')
	<link rel="stylesheet" type="text/css"
		href="https://cdn.datatables.net/v/bs4/dt-1.11.4/af-2.3.7/b-2.2.2/b-html5-2.2.2/b-print-2.2.2/fc-4.0.1/r-2.2.9/sp-1.4.0/datatables.min.css" />

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<table id="table" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th class="text-center">NO</th>
								<th class="w-50">Quote</th>
								<th class="text-center">Author</th>
								<th class="text-center">Category</th>
								<th class="text-center">Date</th>
								<th class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($quotes as $quote)
								<tr>
									<td class="text-center">{{ $loop->iteration }}</td>
									<td>{{ $quote->quote }}</td>
									<td class="text-center">{{ $quote->author }}</td>
									<td class="text-center">{{ $quote->category->title }}</td>
									<td class="text-center">{{ $quote->created_at->format('d M') }}</td>
									<td class="text-center">
										<a href="{{ route('quotes.edit', $quote->uuid) }}" class="btn btn-default">
											<i class="fas fa-pen"></i>
										</a>
										<form action="{{ route('quotes.destroy', $quote->uuid) }}" method="POST" class="d-inline">
											@csrf
											@method('DELETE')
											<button type="submit" id="delete-button" class="btn btn-danger">
												<i class="fas fa-trash"></i>
											</button>
										</form>
									</td>
								</tr>
							@empty
								<tr>
									<td colspan="5" class="text-center">
										No data yet
									</td>
								</tr>
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript"
	 src="https://cdn.datatables.net/v/bs4/dt-1.11.4/af-2.3.7/b-2.2.2/b-html5-2.2.2/b-print-2.2.2/fc-4.0.1/r-2.2.9/sp-1.4.0/datatables.min.js">
	</script>
	<script>
	 $(document).ready(function() {
        $('#table').DataTable();

        $('#delete-button').on('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Do you want to delete this quote?',
                showCancelButton: true,
                confirmButtonText: 'Delete',
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = $(this).parent('form');
                    form.submit();
                }
            });
        });
	 });
	</script>
@endsection
