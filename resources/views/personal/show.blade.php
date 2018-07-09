
<table class="table ui">
	<thead>
		<tr>
			<th>Nombre</th>
			<td>{{ $empleado->persona->nombreCompleto() }}</td>
			<th>Rut</th>
			<td>{{ $empleado->persona_rut }}</td>
		</tr>
		<tr>
			<th>Cargo</th>
			<td>{{ $empleado->cargo->ca_nombre }}</td>
			<th>Contacto</th>
			<td>{{ $empleado->persona->pe_contacto }}</td>
		</tr>
	</thead>
</table>