
<div class="segment ui raised">
	<table class="table ui">
		<thead>
			<tr>
				<th style="width: 50%">Año</th>
				<td style="width: 50%">{{ $periodo->pac_ano }}</td>
			</tr>
			<tr>
				<th>Fecha Inicio</th>
				<td>{{ $periodo->pac_fecha_inicio }}</td>
			</tr>
			<tr>
				<th>Fecha Término</th>
				<td>{{ $periodo->pac_fecha_termino }}</td>
			</tr>
		</thead>
	</table>

</div>

<div class="ui grid two columns">
	@foreach ($periodo->semestres as $sem)
		<div class="column">
			<div class="segment ui raised secondary">
				<table class="table ui">
					<thead>
						<tr>
							<th style="width: 50%">Semestre</th>
							<td style="width: 50%">{{ $sem->sem_numero }}</td>
						</tr>
						<tr>
							<th>Fecha Inicio</th>
							<td>{{ $sem->sem_fecha_inicio }}</td>
						</tr>
						<tr>
							<th>Fecha Término</th>
							<td>{{ $sem->sem_fecha_termino }}</td>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	@endforeach
</div>

