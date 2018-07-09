<div class="segment ui raised secondary">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon file alternate outline"></i>
        Ensayo SIMCE
    </h4>
	<table class="table ui celled">
		<thead>
			<tr>
				<th>ID</th>
				<td>{{ $simce->ens_id }}</td>
				<th>Periodo</th>
				<td>{{ $simce->periodo->pac_ano }}</td>
			</tr>
			<tr>
				<th>Materia</th>
				<td>{{ $simce->materia->mens_nombre }}</td>
				<th>Fecha</th>
				<td>{{ $simce->ens_fecha }}</td>
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
			@foreach ($simce->matriculas()->paginate(10) as $alumno)
				<tr>
					<td>{{ $alumno->mat_numero }}</td>
					<td>{{ $alumno->alumno_rut }}</td>
					<td>{{ $alumno->alumno->nombreCompleto() }}</td>
					<td>{{ $alumno->curso->first()->nombreCurso() }}</td>
					<td>{{ $alumno->pivot->alr_resultado }}</td>
				</tr>
			@endforeach
		</tbody>
		<tfoot>
			<tr>
				<th colspan="5" class="right aligned">
					{{ $simce->matriculas()->paginate(10)->links() }}
				</th>
			</tr>
		</tfoot>
	</table>
	
</div>