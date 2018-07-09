@extends('admin.template.main')

@section('title', 'Periodos Academico')

@section('content')


<div class="x_panel">
	<div class="x_title">
		<h2>Prueba box</h2>
		<div class="panel_toolbox">
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<div class="row">
			<div class="col-md-9">
				<table class="table table-striped jambo_table bulk_action">
					<thead>
						<tr>
							<th>ID</th>
							<th>Año</th>
							<th>Fecha Inicio</th>
							<th>Fecha Termino</th>
							<th>Estado</th>
						</tr>
					</thead>
					<tbody>
					@foreach ($periodos as $periodo)
						<tr>
							<td>{{ $periodo->pac_id }}</td>
							<td>{{ $periodo->pac_ano }}</td>
							<td>{{ $periodo->pac_fecha_inicio }}</td>
							<td>{{ $periodo->pac_fecha_termino }}</td>
							<td>{{ $periodo->pac_estado }}</td>
						</tr>
					@endforeach
					</tbody>
				</table>
				
			</div>
		</div>
	</div>
</div>
	


@endsection
