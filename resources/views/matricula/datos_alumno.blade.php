

<div class="ui styled fluid accordion yellow">
  <div class="title">
	<h4 class="ui horizontal divider header text-navy2">
		<i class="icon table"></i>
		Notas
	</h4>
  </div>
  <div class="content">
	<table class="ui table table celled">
		<thead>
			<tr>
				<th rowspan="2" class="center aligned">Asignaturas</th>
				<th colspan="13" class="center aligned">Notas</th>
			</tr>
			<tr>
				@for ($i = 1; $i <= 12; $i++)
					<th>N{{ $i }}</th>
				@endfor
				<th>Promedio</th>
			</tr>
		</thead>
		<tbody>
		@foreach ($alumno->notas as $notas)
			{{-- expr --}}
			<tr>
				<td>{{ $notas->clases->asignatura->asig_nombre }}</td>
				<td>{{ $notas->not_nota1 }}</td>
				<td>{{ $notas->not_nota2 }}</td>
				<td>{{ $notas->not_nota3 }}</td>
				<td>{{ $notas->not_nota4 }}</td>
				<td>{{ $notas->not_nota5 }}</td>
				<td>{{ $notas->not_nota6 }}</td>
				<td>{{ $notas->not_nota7 }}</td>
				<td>{{ $notas->not_nota8 }}</td>
				<td>{{ $notas->not_nota9 }}</td>
				<td>{{ $notas->not_nota10 }}</td>
				<td>{{ $notas->not_nota11 }}</td>
				<td>{{ $notas->not_nota12 }}</td>
				<td>{{ $notas->not_promedio }}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
  </div>
  <div class="title">
	<h4 class="ui horizontal divider header text-navy2">
		<i class="icon checked calendar"></i>
		Asistencia
	</h4>
  </div>
  <div class="content">
	<table class="ui table table celled">
		<thead>
			<tr>
				<th rowspan="2" class="center aligned">Asignaturas</th>
				<th colspan="13" class="center aligned">Notas</th>
			</tr>
			<tr>
				@for ($i = 1; $i <= 12; $i++)
					<th>N{{ $i }}</th>
				@endfor
				<th>Promedio</th>
			</tr>
		</thead>
		<tbody>
		@foreach ($alumno->notas as $notas)
			{{-- expr --}}
			<tr>
				<td>{{ $notas->clases->asignatura->asig_nombre }}</td>
				<td>{{ $notas->not_nota1 }}</td>
				<td>{{ $notas->not_nota2 }}</td>
				<td>{{ $notas->not_nota3 }}</td>
				<td>{{ $notas->not_nota4 }}</td>
				<td>{{ $notas->not_nota5 }}</td>
				<td>{{ $notas->not_nota6 }}</td>
				<td>{{ $notas->not_nota7 }}</td>
				<td>{{ $notas->not_nota8 }}</td>
				<td>{{ $notas->not_nota9 }}</td>
				<td>{{ $notas->not_nota10 }}</td>
				<td>{{ $notas->not_nota11 }}</td>
				<td>{{ $notas->not_nota12 }}</td>
				<td>{{ $notas->not_promedio }}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
  </div>
</div>

<script type="text/javascript">
		$('.ui.accordion')
		  .accordion()
		;

</script>