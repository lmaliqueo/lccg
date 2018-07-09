@extends('admin.template.main')

@section('title', $taller->nombreTaller())

@section('content')

	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="cut icon"></i>
					<i class="corner blue eye icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #2185D0;">
		        Ver Taller | {{ $taller->nombreTaller() }}
			</span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('talleres.admin') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>
<div class="segment ui raised">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon cut"></i>
        Taller
    </h4>
	<table class="ui table small">
		<thead>
			<tr>
				<th style="width: 20%">ID</th>
				<td style="width: 30%">{{ $taller->cu_id }}</td>
				<th style="width: 20%">Taller</th>
				<td style="width: 30%">{{ $taller->nombreTaller() }}</td>
			</tr>
			<tr>
				<th>Profesor Jefe</th>
				<td>{{ $taller->profesorJefe->persona->nombreCompleto() }}</td>
				<th>Periodo</th>
				<td>{{ $taller->periodo->pac_ano }}</td>
			</tr>
			<tr>
				<th>Aula</th>
				<td>{{ ($taller->aula_id != null) ? $taller->aula->aul_numero : '' }}</td>
				<th>Cantidad de Alumnos</th>
				<td>{{ $taller->listaAlumnos->count() }}</td>
			</tr>
			
		</thead>
	</table>
			
</div>
				


<div class="ui segment raised">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon student"></i>
        Alumnos
    </h4>

	<table class="ui table celled">
		<thead>
			<tr>
				<th class="collapsing">N° Mat.</th>
				<th>Nombre Completo</th>
				<th>RUN</th>
				<th>Sexo</th>
				<th>Comuna</th>
				<th>Estado</th>
				<th>Curso</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($taller->listaAlumnos as $alumno)
				<tr>
					<td class="center aligned">{{ $alumno->mat_id }}</td>
					<td>{{ $alumno->alumno->nombreCompleto() }}</td>
					<td>{{ $alumno->alumno_rut }}</td>
					<td>{{ $alumno->alumno->letra_sexo() }}</td>
					<td>{{ $alumno->alumno->comuna->com_nombre }}</td>
					<td class="center aligned">{{ $alumno->estado() }}</td>
					<td class="center aligned">{{ $alumno->curso->first()->nombreCurso() }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>

</div>

	

@endsection
