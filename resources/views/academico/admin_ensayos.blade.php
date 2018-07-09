<p class="text-right">
	
	<a class="ui button labeled small icon teal" id="create_ensayo"><i class="plus icon"></i> Nuevo Ensayo</a>
	<a class="ui button icon small red circular" id="volver_menu"><i class="remove icon"></i></a>
</p>
<div class="ui segment raised secondary">
	<table class="table ui celled navy2">
			@if ($ensayos != '[]')

		<thead>
			<tr>
				<th>ID</th>
				<th>Materia</th>
				<th>Fecha</th>
				<th>Alumnos</th>
				<th></th>
			</tr>
		</thead>
			@endif
		<tbody>
			@if ($ensayos != '[]')
				@foreach ($ensayos as $ensayo)
					<tr>
						<td>{{ $ensayo->ens_id }}</td>
						<td>{{ $ensayo->materia->mens_nombre }}</td>
						<td>{{ $ensayo->ens_fecha }}</td>
						<td>{{ $ensayo->matriculas->count() }}</td>
						<td>
							<a class="ui button icon circular small twitter"><i class="eye icon"></i></a>
						</td>
					</tr>
				@endforeach
			@else
				<tr>
					<td class="active center aligned" colspan="5"><em class="text-red">No se han realizado ensayos</em></td>
				</tr>
			@endif
		</tbody>
	</table>	
</div>

<script type="text/javascript">
	$('#volver_menu').on('click', function(){
		$('#body_ensayo').hide();
		$('#info_inputs').show();
	})
	$('#create_ensayo').on('click', function(){
		var tipo = $('#ensayo').val();
        var periodo = $('#periodo').val();
		$.ajax({
			url: '{{ route('academico.form_ensayos') }}',
			type: 'post',
			data: {_token:token, tipo:tipo, periodo:periodo},
			success: function(response){
				$('#body_ensayo').html(response);
			}
		})
	})
</script>