
<div class="segment ui raised secondary">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon info"></i>
        Información
        {{-- $clase->asignatura->asig_nombre --}}
    </h4>
		     		
	<a class="ui red right corner label remove_clase">
		<i class="remove icon"></i>
	</a>
		     		

	<table class="table ui small compact small">
		<thead>
			<tr>
				<th style="width: 20%">Curso</th>
				<td style="width: 30%">{{ $clase->curso->nombreCurso() }}</td>
				<th style="width: 20%">Profesor Jefe</th>
				<td style="width: 30%">{{ $clase->curso->profesorJefe->persona->nombreCompleto() }}</td>
			</tr>
			<tr>
				<th>Periodo</th>
				<td>{{ $clase->curso->periodo->pac_ano }}</td>
				<th>Semestre</th>
				<td>{{ $semestre->sem_numero }}</td>
			</tr>
			<tr>
				<th>Asignatura</th>
				<td>{{ $clase->asignatura->asig_nombre }}</td>
				<th>Profesor</th>
				<td>{{ $clase->profesor->persona->nombreCompleto() }}</td>
				<td style="display: none;" id="clases_id">{{ $clase->cla_id }}</td>
			</tr>
		</thead>
	</table>	
</div>

<div class="margin-bottom text-center">
	<div class="ui pointing menu compact">
		@for ($i = 1; $i <= 12 ; $i++)
			@if (($i <= \Carbon\Carbon::parse($semestre->sem_fecha_termino)->format('m')) && ($i >= \Carbon\Carbon::parse($semestre->sem_fecha_inicio)->format('m')))
				<a val_mes="{{ $i }}" class="item item_mes">{{ $meses[$i] }}</a>
			@else
				<a class="item disabled">{{ $meses[$i] }}</a>
			@endif
		@endfor
		<a val_mes="ano" class="item active item_mes">
			{{ $semestre->sem_numero }}° Semestre
		</a>
	</div>
	
</div>
<div id="body_asis">
	<div class="segment ui raised secondary">
    <h4 class="ui horizontal divider header text-navy2 no-margin">
        <i class="icon checked calendar"></i>
        Asistencias
    </h4>
		<div class="title">
			<div class="ui inverted ribbon label large bg-navy2 title_mes">
				<i class="icon calendar"></i> {{ $semestre->sem_numero }}° Semestre
			</div>      
		</div>

{{--
		@if ( ($semestre->sem_estado == 1) || Auth::user()->administrador() && ($semestre->periodo->pac_estado == 1))
			<a class="button ui blue small labeled circular icon editar_asis"><i class="icon pencil"></i>Editar</a>
		@endif
--}}

		<table class="table ui celled structured">
				<thead>
					<tr>
						<th rowspan="2">N°</th>
						<th rowspan="2">RUN</th>
						<th rowspan="2">Nombre</th>
						<th class="collapsing center aligned th_fechas" colspan="13">Fechas</th>
					</tr>
					<tr class="tr_head">
						<th>Ene</th>
						<th>Feb</th>
						<th>Mar</th>
						<th>Ab</th>
						<th>May</th>
						<th>Jun</th>
						<th>Jul</th>
						<th>Ag</th>
						<th>Sept</th>
						<th>Oct</th>
						<th>Nov</th>
						<th>Dic</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
					@php
						if($clase->asignatura_id == $religion->asig_id){
							$lista_al = $clase->curso->listaAlumnos()->where('mat_clases_religion', 1)->orderBy('mat_posicion_lista', 'ASC')->get();
						}else{
							$lista_al = $clase->curso->listaAlumnos()->orderBy('mat_posicion_lista', 'ASC')->get();
						}
					@endphp

					@foreach ($lista_al as $alumno)
						<tr class="{{ ($alumno->mat_estado == 3) ? 'negative':'' }}">
							<td>{{ $alumno->mat_posicion_lista }}</td>
							<td>{{ $alumno->alumno_rut }}</td>
							<td>{{ $alumno->alumno->nombreCompleto() }}</td>
							@for ($j = 1; $j <= 12; $j++)
								@php
									$array_mes = $alumno->diaClases()->whereMonth('dc_fecha', $j)->where('semestre_id', $semestre->sem_id)->pluck('dc_id');
									$array_asis = $clase->clasesRealizadas()->whereIn('dia_clase_id', $array_mes)->pluck('cr_id');
								@endphp
								@if ($array_asis != '[]')
									<td class="center aligned">
										{{ round($alumno->asistencias->whereIn('cla_realizados_id', $array_asis)->avg('asis_estado') * 100, 1) }} %
									</td>
								@else
									<td></td>
								@endif
							@endfor
							@php
								$array_dia_clase = $alumno->diaClases->where('semestre_id', $semestre->sem_id)->pluck('dc_id');
								$array_asis_clase = $clase->clasesRealizadas()->whereIn('dia_clase_id', $array_dia_clase)->pluck('cr_id');
							@endphp
							<td class="warning">
								{{ round($alumno->asistencias()->whereIn('cla_realizados_id', $array_asis_clase)->avg('asis_estado') * 100, 1) }} %
							</td>
						</tr>
					@endforeach













{{--
					
										@foreach ($clase->curso->listaAlumnos as $alumno)
											<tr>
												<td>{{ $alumno->mat_numero }}</td>
												<td>{{ $alumno->alumno_rut }}</td>
												<td>{{ $alumno->alumno->nombreCompleto() }}</td>
												@for ($i = 0; $i < $clase->clasesRealizadas->count() ; $i++)
													@if ($clase->clasesRealizadas[$i]->diaClase->semestre_id == $semestre->sem_id)
														@foreach ($clase->clasesRealizadas[$i]->asistencias as $asistencia)
															@if ($asistencia->matricula_id == $alumno->mat_id)
																@if ($asistencia->asis_estado == 1)
																	<td class="center aligned positive"><i class="icon green check"></i></td>
																@elseif($asistencia->asis_estado == 0)
																	<td class="center aligned negative"><i class="icon red remove"></i></td>
																@endif
															@endif
														@endforeach
													@endif
												@endfor
											</tr>
										@endforeach
					
					
					--}}					
				</tbody>
		</table>
	</div>
</div>


<script type="text/javascript">
	var token = $('meta[name="csrf-token"]').attr('content');
	$('.editar_asis').on('click', function(){
		var token = $('meta[name="csrf-token"]').attr('content');
		var clase = $('#clases_id').text();
		var semestre = $('#semestre').val();
		var mes = $('.item_mes.active').attr('val_mes')
		var mes_text = $('.item_mes.active').text()
		$.ajax({
			url: '{{ route('academico.crear_asis') }}',
			type: 'post',
			data: {_token:token, clase:clase, semestre:semestre, mes:mes, mes_text:mes_text},
			success: function(response){
				$('#body_asis').html(response);
			}
		})
	})

	$('.remove_clase').on('click', function(){
		$('#content_asistencia').hide();
		$('.button_clase.active').removeClass('active');
		$('#content_clases').show();
    	$('#content_inputs').show();
	})

	$('.item_mes').on('click', function(){
		$('.item_mes.active').removeClass('active')
		$('.item_ano.active').removeClass('active')
		$(this).addClass('active')
		var mes_text = $(this).text();
		var mes = $(this).attr('val_mes');
		var clase = $('#clases_id').text();
		var semestre = $('#semestre').val();
		$.ajax({
			url:"{{ route('asistencia.view_mes_asis') }}",
			type: "post",
			data: {_token:token, clase:clase, mes:mes, semestre:semestre, mes_text:mes_text},
			success: function(response){
				$('#body_asis').html(response);
			}
		})
	})



</script>