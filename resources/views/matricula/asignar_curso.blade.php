@extends('admin.template.main')

@section('title', 'Asginar Cursos')

@section('content')


	<table class="ui table celled selected">
				<thead>
					<tr>
						<th>N° Matricula</th>
						<th>RUT</th>
						<th>Apellido Paterno</th>
						<th>Apellido Materno</th>
						<th>Nombres</th>
						<th>Grado</th>
						<th>Estado</th>
						<th>Promedio Anterior</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($alumnos as $alumno)
						<td>{{ $alumno->mat_numero }}</td>
						<td>{{ $alumno->alumno_rut }}</td>
						<td>{{ $alumno->alumno->al_apellido_pat }}</td>
						<td>{{ $alumno->alumno->al_apellido_mat }}</td>
						<td>{{ $alumno->alumno->al_nombres }}</td>
						<td>{{ $alumno->mat_grado_curso }}</td>
						<td>{{ $alumno->mat_estado }}</td>
						<td>{{ $alumno->mat_prom_ingreso }}</td>
					@endforeach
				</tbody>
		
	</table>


@endsection
