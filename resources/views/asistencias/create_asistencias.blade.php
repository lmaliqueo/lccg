

      {!! Form::open(['class'=>'ui form']) !!}

		{!! Form::hidden('id_clases', $clase->cla_id, ['class'=>'']) !!}
		{!! Form::hidden('id_semestre', $semestre->sem_id, ['class'=>'']) !!}


<div class="ui segment raised secondary">
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
	<div class="column">
		<div class="text-right">
			<a class="ui button small red labeled icon circular" id="cancel_form"><i class="remove icon"></i> Cancelar</a>
			<a class="ui button small green labeled icon circular" id="save_asist"><i class="plus icon"></i> Guardar</a>
		</div>

	</div>
</div>

	<table id="notasTable" class="table ui celled structured">
		<thead>
			<tr>
				<th rowspan="2">N°</th>
				<th rowspan="2">RUN</th>
				<th rowspan="2">Nombre</th>
				<th class="collapsing center aligned th_fechas" colspan="{{ $clases_r->count() + 1 }}">Fechas</th>
			</tr>
			<tr class="tr_head">
				@php
					$display_th = null;
					$cont_fechas = 1;
					$date_min = $prim_dia;
					$date_max = null;
				@endphp
				@foreach ($clases_r as $fecha)
					<th class="collapsing center aligned fecha_th{{ $cont_fechas }}">
						<a class="button compact ui bg-light-blue small asignar_asis fecha_btn{{ $cont_fechas }} icon">{{ \Carbon\Carbon::parse($fecha->diaClase->dc_fecha)->format('d-m') }}</a>
<div class="ui flowing popup top left transition hidden">
      <p>{!! Form::date('fecha', null, ['class'=>'fecha_popup input_fecha'.$cont_fechas, 'col'=>$cont_fechas, 'fila'=>0, 'status'=>0, 'max'=>$ult_dia, 'min'=>$date_min, 'date_exist']) !!}</p>
      <a class="red inverted circular remove_col compact labeled small ui button icon" style="display: none" data-col="{{ $cont_fechas }}"><i class="icon remove"></i> Remover</a>
</div>
        				{!! Form::hidden('clases_r['.($cont_fechas).'][cr_fecha]', $fecha->diaClase->dc_fecha, ['class'=>'fecha_'.($cont_fechas), ]) !!}
        				{!! Form::hidden('clases_r['.($cont_fechas).'][id]', $fecha->cr_id, ['class'=>'']) !!}
        				@php
				            $date_min = strtotime ( '+1 day' , strtotime ( $fecha->diaClase->dc_fecha ) ) ;
				            $date_min = date ( 'Y-m-d' , $date_min );
				            $cont_fechas++;
        				@endphp
					</th>

				@endforeach
				@for ($j = ($clases_r->count()+1); $j <= 12 ; $j++)
					<th style="display: {{ $display_th }}" class="collapsing center aligned fecha_th{{ $j }}"><a class="button circular compact ui teal small asignar_asis fecha_btn{{ $j }} icon"><i class="icon plus"></i></a>
<div class="ui flowing popup top left transition hidden">
      <p>{!! Form::date('fecha', null, ['class'=>'fecha_popup input_fecha'.$j, 'col'=>$j, 'fila'=>0, 'status'=>0, 'max'=>$ult_dia, 'min'=>$date_min]) !!}</p>
      <a class="red inverted circular remove_col compact labeled small ui button icon" style="display: none" data-col="{{ $j }}"><i class="icon remove"></i> Remover</a>
</div>
        				{!! Form::hidden('clases_r['.$j.'][cr_fecha]', null, ['class'=>'fecha_'.$j, ]) !!}
        				{!! Form::hidden('clases_r['.$j.'][id]', null, ['class'=>'']) !!}
					</th>
					@php
						$display_th = 'none';
					@endphp
				@endfor
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
				<tr class="tr_alumno {{ ($alumno->mat_estado == 3) ? 'negative':'al_activo' }} {{ (!Auth::user()->administrador() && ($alumno->mat_estado == 3)) ? 'disabled':'' }}">
					<td class="collapsing">{{ $alumno->mat_posicion_lista }}</td>
					<td class="collapsing">{{ $alumno->alumno_rut }}</td>
					<td class="collapsing">{{ $alumno->alumno->nombreCompleto() }}</td>
					@php
						$count = 1;
						$display_td = null;
					@endphp
					@if ($clases_r != '[]')
						@foreach ($clases_r as $cont => $realizados)
							@php
								$asist = $realizados->asistencias->where('matricula_id', $alumno->mat_id);
							@endphp
							@if ($asist != '[]')
								@foreach ($asist as $asistencia)
									@php
										$state = null;
										$icon = null;
										$color = null;
										if($asistencia->asis_estado == 1){
											$state = 'positive';
											$icon = 'check';
											$color = 'green';
										}else{
											$state = 'negative';
											$icon = 'remove';
											$color = 'red';
										}
									@endphp

										<td class="{{ $state }} selectable center aligned td_{{ $alumno->mat_id.$count }} td_col{{ $count }}">
							<a datatd-col="{{ $count }}" class="{{ ($alumno->mat_estado != 3) ? 'asignar_asis':'' }} icon_{{ $alumno->mat_id.$count }}">
								<i class="{{ $icon }} {{ $color }} icon"></i>
							</a>
<div class="ui flowing popup top left transition hidden">
	<a class="{{ ($asistencia->asis_estado == 1) ? 'active':'' }} button ui green icon small inverted circular btn_status btn_{{ $count.$alumno->mat_id }}" columna="{{ $count }}" fila="{{ $alumno->mat_id }}" value="1"><i class="check icon"></i></a>
	<a class="{{ ($asistencia->asis_estado == 0) ? 'active':'' }} button ui red icon small inverted circular btn_status btn_{{ $count.$alumno->mat_id }}" columna="{{ $count }}" fila="{{ $alumno->mat_id }}" value="0"><i class="icon remove"></i></a>
</div>


    {!! Form::hidden('asistencia['.$alumno->mat_id.']['.$count.'][estado]', $asistencia->asis_estado, ['class'=>'asis_input'.$alumno->mat_id.$count, 'asis_col'=>$count]) !!}
    {!! Form::hidden('asistencia['.$alumno->mat_id.']['.$count.'][matricula]', $alumno->mat_id, ['class'=>'']) !!}
    {!! Form::hidden('asistencia['.$alumno->mat_id.']['.$count.'][id]', $asistencia->asis_id, ['class'=>'']) !!}

										</td>
										@php
											$count++;
										@endphp
{{-- 
									@if ($asistencia->asis_estado == 1)
										<td class="positive selectable center aligned td_{{ $alumno->mat_id.$count }} td_col{{ $count }}">
							<a datatd-col="{{ $count }}" class="asignar_asis icon_{{ $alumno->mat_id.$count }}">
								<i class="check green icon"></i>
							</a>
<div class="ui flowing popup top left transition hidden">
	<a class="active button ui green icon small inverted circular btn_status btn_{{ $count.$alumno->mat_id }}" columna="{{ $count }}" fila="{{ $alumno->mat_id }}" value="1"><i class="check icon"></i></a>
	<a class="button ui red icon small inverted circular btn_status btn_{{ $count.$alumno->mat_id }}" columna="{{ $count }}" fila="{{ $alumno->mat_id }}" value="0"><i class="icon remove"></i></a>
</div>


    {!! Form::hidden('asistencia['.$alumno->mat_id.']['.$count.'][estado]', $asistencia->asis_estado, ['class'=>'asis_input'.$alumno->mat_id.$count, 'asis_col'=>$count]) !!}
    {!! Form::hidden('asistencia['.$alumno->mat_id.']['.$count.'][matricula]', $alumno->mat_id, ['class'=>'']) !!}
    {!! Form::hidden('asistencia['.$alumno->mat_id.']['.$count.'][id]', $asistencia->asis_id, ['class'=>'']) !!}
										</td>
										@php
											$count++;
										@endphp
										@break
									@else
										<td class="negative selectable center aligned td_{{ $alumno->mat_id.$count }} td_col{{ $count }}">
							<a datatd-col="{{ $count }}" class="asignar_asis icon_{{ $alumno->mat_id.$count }}">
								<i class="remove red icon"></i>
							</a>
<div class="ui flowing popup top left transition hidden">
	<a class="button ui green icon small inverted circular btn_status btn_{{ $count.$alumno->mat_id }}" columna="{{ $count }}" fila="{{ $alumno->mat_id }}" value="1"><i class="check icon"></i></a>
	<a class="active button ui red icon small inverted circular btn_status btn_{{ $count.$alumno->mat_id }}" columna="{{ $count }}" fila="{{ $alumno->mat_id }}" value="0"><i class="icon remove"></i></a>
</div>


    {!! Form::hidden('asistencia['.$alumno->mat_id.']['.$count.'][estado]', $asistencia->asis_estado, ['class'=>'asis_input'.$alumno->mat_id.$count, 'asis_col'=>$count]) !!}
    {!! Form::hidden('asistencia['.$alumno->mat_id.']['.$count.'][matricula]', $alumno->mat_id, ['class'=>'']) !!}
    {!! Form::hidden('asistencia['.$alumno->mat_id.']['.$count.'][id]', $asistencia->asis_id, ['class'=>'']) !!}
										</td>
										@php
											$count++;
										@endphp
										@break
									@endif --}}
								@endforeach
							@else
								<td class="{{ ($alumno->mat_estado != 3)? 'selectable':'' }} center aligned td_{{ $alumno->mat_id.$count }} td_col{{ $count }}">
						<a datatd-col="{{ $count }}" class="{{ ($alumno->mat_estado != 3) ? 'asignar_asis':'' }} icon_{{ $alumno->mat_id.$count }}"></a>
<div class="ui flowing popup top left transition hidden">
<a class="button ui green icon small inverted circular btn_status btn_{{ $count.$alumno->mat_id }}" columna="{{ $count }}" fila="{{ $alumno->mat_id }}" value="1"><i class="check icon"></i></a>
<a class="button ui red icon small inverted circular btn_status btn_{{ $count.$alumno->mat_id }}" columna="{{ $count }}" fila="{{ $alumno->mat_id }}" value="0"><i class="icon remove"></i></a>
</div>


{!! Form::hidden('asistencia['.$alumno->mat_id.']['.$count.'][estado]', null, ['class'=>'asis_input'.$alumno->mat_id.$count, 'asis_col'=>$count]) !!}
{!! Form::hidden('asistencia['.$alumno->mat_id.']['.$count.'][matricula]', $alumno->mat_id, ['class'=>'']) !!}
{!! Form::hidden('asistencia['.$alumno->mat_id.']['.$count.'][id]', null, ['class'=>'']) !!}
								</td>
								@php
									$count++;
								@endphp

							@endif
						@endforeach
					@endif
					@for ($i = $count; $i <= 12 ; $i++)
						<td class="center aligned td_{{ $alumno->mat_id.$i }} td_col{{ $i }}" style="display: {{ $display_td }};">
							<a datatd-col="{{ $i }}" class="{{ ($alumno->mat_estado != 3) ? 'asignar_asis':'' }} icon_{{ $alumno->mat_id.$i }}"></a>
<div class="ui flowing popup top left transition hidden">
	<a class="button ui green icon small inverted circular btn_status btn_{{ $i.$alumno->mat_id }}" columna="{{ $i }}" fila="{{ $alumno->mat_id }}" value="1"><i class="check icon"></i></a>
	<a class="button ui red icon small inverted circular btn_status btn_{{ $i.$alumno->mat_id }}" columna="{{ $i }}" fila="{{ $alumno->mat_id }}" value="0"><i class="icon remove"></i></a>
</div>


    {!! Form::hidden('asistencia['.$alumno->mat_id.']['.$i.'][estado]', null, ['class'=>'asis_input'.$alumno->mat_id.$i, 'asis_col'=>$i]) !!}
    {!! Form::hidden('asistencia['.$alumno->mat_id.']['.$i.'][matricula]', $alumno->mat_id, ['class'=>'']) !!}
    {!! Form::hidden('asistencia['.$alumno->mat_id.']['.$i.'][id]', null, ['class'=>'']) !!}
    	@php
    		$display_td = 'none';
    	@endphp
						</td>
					@endfor
				</tr>
			@endforeach
		</tbody>
	</table>
	
</div>
		
      {!! Form::close() !!}

<div id="wea"></div>
<script type="text/javascript">


	$('#save_asist').on('click', function(){
		$.ajax({
			url: '{{ route('academico.save_asis') }}',
			type: 'post',
			data: $('form').serialize(),
			success: function(response){
				var mes_text = $('.item_mes.active').text();
				var mes = $('.item_mes.active').attr('val_mes');
				var clase = $('#clases_id').text();
				var semestre = $('#semestre').val();
				if(response === 1){
	                swal({
	                    title: "Guardado!",
	                    timer: 1000,
	                    type: "success",
	                    showConfirmButton:false,
	                });
					$.ajax({
						url:"{{ route('asistencia.view_mes_asis') }}",
						type: "post",
						data: {_token:token, clase:clase, mes:mes, semestre:semestre, mes_text:mes_text},
						success: function(response){
							$('#body_asis').html(response);
							$('.item_mes').parent('.menu').show()
						}
					})
				}
			}
		})
	})


	$('#cancel_form').on('click', function(){
		$('.item_mes').removeClass('disabled')
		var mes_text = $('.item_mes.active').text();
		var mes = $('.item_mes.active').attr('val_mes');
		var clase = $('#clases_id').text();
		var semestre = $('#semestre').val();
		$.ajax({
			url:"{{ route('asistencia.view_mes_asis') }}",
			type: "post",
			data: {_token:token, clase:clase, mes:mes, semestre:semestre, mes_text:mes_text},
			success: function(response){
				$('#body_asis').html(response);
				$('.item_mes').parent('.menu').show()
			}
		})
	})


	$('.remove_col').on('click', function(){
		var col = $(this).attr('data-col');
		col_next = parseInt(col)+1;
		col_after = parseInt(col)-1;
		colspan = $('.th_fechas').attr('colspan');
		$('.th_fechas').attr('colspan', (parseInt(colspan)-1));
		$(this).hide()
		$('input[col="'+col+'"]').val('').attr('status', 0);
		$('.fecha_btn'+col).removeClass('bg-light-blue').addClass('teal circular').html('<i class="icon plus"></i>');


		$('a[datatd-col="'+col+'"]').html('').parent('td').removeClass('negative positive');

		$('.td_col'+col).removeClass('selectable');
		$('.fecha_th'+col_next).hide();
		$('.td_col'+col_next).hide();

		$('input[asis_col="'+col+'"]').val('');

		$('a[data-col="'+col_after+'"]').show();

	})



	$('.fecha_popup').on('change', function(){
		var status = $(this).attr('status');
		var valor = $(this).val();
		var col = $(this).attr('col');
		var btn = document.getElementsByClassName('fecha_btn'+col);
		fecha = document.getElementsByClassName('fecha_'+col);
		$('.al_activo').children('.td_col'+col).addClass('selectable')
		$('.remove_col').hide();
		$('a[data-col="'+col+'"]').show();

		//col++;
		var col_next = parseInt(col)+1;
		if(status == 0){
			var th = document.getElementsByClassName('fecha_th'+col_next);
			var td_next = document.getElementsByClassName('td_col'+col_next);
			//$(th).show();
			$('.fecha_th'+col_next).show();
			$('.td_col'+col_next).show();
			if($(this).attr('date_exist') == undefined){
				$('.th_fechas').attr('colspan', col_next);
			}
			//$(btn).removeClass('teal circular').addClass('bg-light-blue');
			$('.fecha_btn'+col).removeClass('teal circular').addClass('bg-light-blue');
			$(this).attr('status', 1);
		}
		input_fecha = document.getElementsByClassName('input_fecha'+col_next)
		var fecha_val = new Date(valor);
		var date = new Date(valor);
		fecha_val.setDate(fecha_val.getDate() + 2);
		date.setDate(date.getDate() + 1);
		//console.log($.datepicker.formatDate('yy-mm-dd', fecha_val));
		$(input_fecha).attr('min', $.datepicker.formatDate('yy-mm-dd', fecha_val));
		$(btn).text($.datepicker.formatDate('dd-mm', date));
		$(fecha).val(valor);
	})



	$('.btn_status').on('click', function(){
		var status = $(this).attr('value');
		var col = $(this).attr('columna');
		var fila = $(this).attr('fila');

		btns = document.getElementsByClassName('btn_'+col+fila)
		$(btns).removeClass('active');
		$(this).addClass('active');

		var input = document.getElementsByClassName('asis_input'+fila+col);
		$(input).attr('value', status);

		var icon = document.getElementsByClassName('icon_'+fila+col);
		var td_asis = document.getElementsByClassName('td_'+fila+col)
		if(status == 1){
			$(icon).html('<i class="icon check green"></i>');
			$(td_asis).removeClass('negative').addClass('positive');
		}else{
			$(icon).html('<i class="icon remove red"></i>');
			$(td_asis).removeClass('positive').addClass('negative');
		}
	})

	$('.editable-o').on('change', function(){
		var nota = $(this).text();
		if(nota >= '4'){
			$(this).addClass('positive').removeClass('negative');
		}else{
			$(this).addClass('negative').removeClass('positive');
		}
	})


    $('.asignar_asis')
		.popup({
			inline     : true,
			hoverable  : true,
			position   : 'top center',
			on    : 'click',
			delay: {
				show: 200,
				hide: 400
			}
		})
    ;



</script>
