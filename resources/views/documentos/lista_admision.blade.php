<table class="table ui celled">
	<thead>
		<tr>
			<th>NUMERO</th>
			<th>NOMBRE COMPLETO</th>
			<th>CÉDULA DE IDENTIDAD</th>
			<th>TELÉFONO</th>
			<th>CONDICIÓN PRIORITARIA</th>
			<th>PROMEDIO</th>
			<th>ESCUELA</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($periodo->matriculas as $matricula)
			<tr>
				<td>{{ $matricula->alumno->nombrecompleto() }}</td>
				<td>{{ $matricula->alumno_rut }}</td>
				<td>{{ $matricula->alumno->al_contacto }}</td>
				<td></td>
				<td>{{ $matricula->mat_prom_ingreso }}</td>
				<td>{{ ($matricula->institucion_id != null) ? $matricula->institucion->inst_nomre:'' }}</td>
			</tr>
		@endforeach
	</tbody>
</table>
