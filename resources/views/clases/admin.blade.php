@extends('admin.template.main')

@section('title', 'Clases')

@section('content')

	<table class="table">
		<thead>
			<tr>
				<th></th>
				<th></th>
			</tr>
		</thead>
		@foreach ($clases as $clase)
			{{-- expr --}}
		@endforeach
	</table>

@endsection
