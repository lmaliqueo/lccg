<div class="segment ui raised secondary">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon file alternate outline"></i>
        Ensayo PSU
    </h4>
	<table class="table ui celled">
		<thead>
			<tr>
				<th>ID</th>
				<td>{{ $psu->ens_id }}</td>
				<th>Periodo</th>
				<td>{{ $psu->periodo->pac_ano }}</td>
			</tr>
			<tr>
				<th>Materia</th>
				<td>{{ $psu->materia->mens_nombre }}</td>
				<th>Fecha</th>
				<td>{{ $psu->ens_fecha }}</td>
			</tr>
		</thead>
	</table>
</div>

<div class="segment ui raised secondary">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon student"></i>
        Alumnos
    </h4>
	<table class="table ui celled">
		<thead>
			<tr>
				<th>N° Matr.</th>
				<th>RUN</th>
				<th>Nombres</th>
				<th>Curso</th>
				<th>Puntaje</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($psu->matriculas as $alumno)
				<tr>
					<td>{{ $alumno->mat_numero }}</td>
					<td>{{ $alumno->alumno_rut }}</td>
					<td>{{ $alumno->alumno->nombreCompleto() }}</td>
					<td class="center aligned">{{ ($alumno->curso != '[]') ? $alumno->curso->first()->nombreCurso():'-' }}</td>
					<td>{{ $alumno->pivot->alr_resultado }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	
</div>