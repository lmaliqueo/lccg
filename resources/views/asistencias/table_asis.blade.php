	<div class="segment ui raised secondary animated fadeIn">
    <h4 class="ui horizontal divider header text-navy2 no-margin">
        <i class="icon checked calendar"></i>
        Asistencias
    </h4>




<div class="ui grid two columns">
	<div class="column">
		  <div class="title">
		        <div class="ui inverted ribbon label large bg-navy2 title_mes">
		            <i class="icon calendar"></i> {{ $mes_text }}
		        </div>      
		  </div>
	</div>
	@if ($mes!='ano')
		<div class="column">
			@if ( ($semestre->sem_estado == 1) || Auth::user()->administrador() && ($semestre->periodo->pac_estado == 1))
			    <div class="text-right">
					<a class="button ui blue small labeled circular icon editar_asis_mes"><i class="icon pencil"></i>Editar</a>
			    </div>
			@endif
		</div>
	@endif
</div>

@if ($mes!='ano')
		<table class="table ui celled structured">
				<thead>
					<tr>
						<th rowspan="2">N°</th>
						<th rowspan="2">RUN</th>
						<th rowspan="2">Nombre</th>
						<th class="collapsing center aligned th_fechas" colspan="{{ ($clase->clasesRealizadas->count()) ? $clase->clasesRealizadas->count()+1 : 2 }}">Fechas</th>
					</tr>
					<tr class="tr_head">
						@if ($clases_r == '[]')
							<th class="center aligned">-</th>
						@else
							@foreach ($clases_r as $fecha)
								<th class="center aligned">{{ \Carbon\Carbon::parse($fecha->diaClase->dc_fecha)->format('d/m') }}</th>
							@endforeach
						@endif
						<th class="center aligned">%</th>
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
			@if ($clases_r == '[]')
				<td class="center aligned">-</td>
			@else
				@foreach ($clases_r as $clases)
					@php
						$asis_alu = $clases->asistencias->where('matricula_id', $alumno->mat_id)->first();
					@endphp
					@if ($asis_alu != null)
						@if ($asis_alu->asis_estado == 1)
							<td class="center aligned positive"><i class="icon green check"></i></td>
						@elseif($asis_alu->asis_estado == 0)
							<td class="center aligned negative"><i class="icon red remove"></i></td>
						@endif
					@else
						<td></td>
					@endif
				@endforeach


			@endif
			<td class="center aligned warning collapsing">
				@php
					$cla_pluck = $clases_r->pluck('cr_id');
					$asis_prom = $alumno->asistencias->whereIn('cla_realizados_id', $cla_pluck)->avg('asis_estado');
				@endphp
				<strong>
					{{ round($asis_prom*100, 1) }} %
				</strong>
			</td>

						</tr>
					@endforeach


{{--
				@foreach ($clases_r as $clases)
					@foreach ($clases->asistencias as $asistencia)
						$asistencia->matricula()->where('matricula_id', $alumno)
						@if ($asistencia->matricula_id == $alumno->mat_id)
							@if ($asistencia->asis_estado == 1)
								<td class="center aligned positive"><i class="icon green check"></i></td>
							@elseif($asistencia->asis_estado == 0)
								<td class="center aligned negative"><i class="icon red remove"></i></td>
							@endif
						@endif
					@endforeach
				@endforeach
--}}


				</tbody>
		</table>
@else
	<table class="table ui structured celled">
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

			@foreach ($clase->curso->listaAlumnos()->orderBy('mat_posicion_lista', 'ASC')->get() as $alumno)
				@if ($religion->asig_id == $clase->asignatura_id)
					<tr class="{{ ($alumno->mat_clases_religion) ? '':'disabled' }} {{ ($alumno->mat_estado == 3) ? 'negative':'' }}">
				@else
					<tr class="{{ ($alumno->mat_estado == 3) ? 'negative':'' }}">
				@endif
					<td>{{ $alumno->mat_posicion_lista }}</td>
					<td>{{ $alumno->alumno_rut }}</td>
					<td>{{ $alumno->alumno->nombreCompleto() }}</td>
					@for ($j = 1; $j <= 12; $j++)
						@php
							$array_mes = $alumno->diaClases()->whereMonth('dc_fecha', $j)->where('semestre_id', $semestre->sem_id)->get()->pluck('dc_id');
							$array_asis = $clase->clasesRealizadas()->whereIn('dia_clase_id', $array_mes)->get()->pluck('cr_id');
							$array_dia_clase = $alumno->diaClases->where('semestre_id', $semestre->sem_id)->pluck('dc_id');
							$array_asis_clase = $clase->clasesRealizadas()->whereIn('dia_clase_id', $array_dia_clase)->get()->pluck('cr_id');
						@endphp
						@if ($array_asis != '[]')
							<td class="center aligned">
								{{ round($alumno->asistencias->whereIn('cla_realizados_id', $array_asis)->avg('asis_estado') * 100, 1) }} %
							</td>
						@else
							<td></td>
						@endif
					@endfor
					<td class="warning center aligned">
						<strong>
							{{ round($alumno->asistencias()->whereIn('cla_realizados_id', $array_asis_clase)->avg('asis_estado') * 100, 1) }} %
						</strong>
					</td>
				</tr>
			@endforeach


		</tbody>
	</table>
@endif
	</div>

<script type="text/javascript">
	var token = $('meta[name="csrf-token"]').attr('content');
	$('.editar_asis_mes').on('click', function(){

    	swal({
    		title: "¿Esta seguro de modificar las asistencias?",
            text: "ingrese su clave de usuario",
    		type: "input",
    		inputType: "password",
    		showCancelButton: true,
    		closeOnConfirm: false,
    		animation: "slide-from-top",
            inputPlaceholder: "Contraseña",
    	},
    	function(inputValue){
    		$.ajax({
    			url: "{{ route('ajax.confirm_user') }}",
    			type: "POST",
    			dataType:"JSON",
    			data: {_token:$('meta[name="csrf-token"]').attr('content') ,pass:inputValue},
    			success: function(response){
    				if(!response){
    					swal.showInputError("Ingrese datos nuevamente");
    					return false;
    				}
    				if( response == 2){
    					swal.showInputError("usted no tiene permisos para editar este usuario");
    					return false;
    				}
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
							$('.item_mes').parent('.menu').hide()
						}
					})
                    swal({
                        title: "Correcto!",
                        timer: 1000,
                        type: "success",
                        showConfirmButton:false,
                    });

    			}
    		})
    	})

	})
</script>