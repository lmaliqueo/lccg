	<table class="ui table celled selected">
		<thead>
			<tr>
				<th></th>
				<th>ID</th>
				<th>Asignatura</th>
				<th>Nombre Corto</th>
				<th class="collapsing">Cat. Horas</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($asignaturas as $count => $asignatura)
				<tr>
					<td  class="collapsing">
						<div class="ui toggle checkbox">
							<input type="checkbox" name="plan_organiza[{{ $count }}][asignatura_id]" value="{{ $asignatura->asig_id }}" valueicon="{{ $count }}" class="checkbox_alu" estado="0">
							<label></label>
						</div>
					</td>
					<td>{{ $asignatura->asig_id }}</td>
					<td>{{ $asignatura->asig_nombre }}</td>
					<td>{{ $asignatura->asig_nombre_corto }}</td>
					<td>{{ $asignatura->pivot->porg_cant_horas }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
