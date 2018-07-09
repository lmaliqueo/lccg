@extends('admin.template.main')

@section('title', 'Clases')

@section('content')


	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="copy outline icon"></i>
					<i class="corner yellow settings icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
		        Administrar Clases
			</span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('cursos.index') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>

<div class="segment ui raised secondary">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon copy"></i>
        Clases
    </h4>
	<table class="ui selectable structured celled table">
		<thead>
			<tr>
				<th rowspan="2">ID</th>
				<th rowspan="2">Curso</th>
				<th rowspan="2">Asignatura</th>
				<th colspan="2" class="center aligned">Promedios</th>
				<th rowspan="2">Cant. Alumnos</th>
			</tr>
			</tr>
				<th class="center aligned">Notas</th>
				<th class="center aligned">Asistencias</th>
			<tr>
		</thead>
		<tbody>
			@foreach ($clases as $clase)
				<td>{{ $clase->cla_id }}</td>
				<td>{{ $clase->curso->nombreCurso() }}</td>
				<td>{{ $clase->asignatura->asig_nombre }}</td>
				<td>{{ $clase->prom_clases() }}</td>
				<td></td>
				<td>{{ $clase->curso->listaAlumnos->count() }}</td>
			@endforeach
		</tbody>
	</table>
	
</div>



@endsection
