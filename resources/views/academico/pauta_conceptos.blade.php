
<div class="ui secondary segment animated fadeIn">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon student"></i>
        Alumno
    </h4>
{{-- 
		<a class="ui button negative icon circular remove_pauta"><i class="remove icon"></i></a>
	 --}}	
	<a class="ui red right corner label remove_pauta">
		<i class="remove icon"></i>
	</a>
	<table class="ui table celled">
		<thead>
			<tr>
				<th>Nombre</th>
				<td>{{ $alumno->alumno->nombreCompleto() }}</td>
				<th>Curso</th>
				<td>
					@foreach ($alumno->cursos as $curso)
						{{ $curso->nombreCurso() }}
						@break
					@endforeach
				</td>
			</tr>
			<tr>
				<th>RUT</th>
				<td>{{ $alumno->alumno_rut }}</td>
				<th>Prof. Jefe</th>
				<td>
					@foreach ($alumno->cursos as $curso)
						@if ($curso->profesor_id != null)
							{{ $curso->profesorJefe->persona->nombreCompleto() }}
						@endif
						@break
					@endforeach
				</td>
			</tr>
		</thead>
	</table>
</div>

<div class="ui secondary segment animated fadeIn form_pauta">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon legal"></i>
        Comportamiento
    </h4>
<p>
	<a class="ui button circular labeled icon twitter editar_pauta" mat="{{ $alumno->mat_id }}"><i class="edit icon"></i> Editar</a>
</p>
	<table class="ui table celled">
		@foreach ($pauta as $count => $grupo_pauta)
			<thead>
				<tr>
					<th>{{ $count+1 }}.- {{ $grupo_pauta->gp_descripcion }}</th>
					<th>Conceptos</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($grupo_pauta->detalles as $i => $detalles)
					<tr>
						<td>{{ $count+1 }}.{{ $i+1 }}.- {{ $detalles->dp_descripcion }}</td>
						<td>
							@if ($alumno->detallesConceptos != '[]')
								@foreach ($alumno->conceptos as $conceptos)
									@if ($conceptos->pivot->detallepauta_id == $detalles->dp_id)
										{{ $conceptos->con_nombre }}
										@break
									@endif
								@endforeach
							@endif
						</td>
					</tr>
				@endforeach
			</tbody>
		@endforeach
	</table>
</div>

<script type="text/javascript">
	$('.remove_pauta').on('click', function(){
		$('.button_comp.active').removeClass('active');
		$('#pauta_comp').hide();
		$('.segment_inputs').show();
		$('.ui.search').children().children('input').val('');
		//$('input[name="id_mat"]').val('');
	})
	{{--  --}}
	$('.editar_pauta').on('click', function(){
		var mat = $(this).attr('mat');
		$.ajax({
			url:'{{ route('academico.create_pauta') }}',
			type:'post',
			data: {_token:token, mat:mat},
			success: function(response){
				$('.editar_pauta').addClass('disabled');
				$('.form_pauta').html(response);
			}
		});
	})
</script>