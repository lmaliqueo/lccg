{!! Form::open(['class'=>'ui form', 'id'=>'form_horario']) !!}
	{!! Form::hidden('curso_id', $curso->cu_id, null) !!}
	<div class="segment raised ui animated fadeIn">
        <h4 class="ui horizontal divider header text-navy2">
            <i class="icon calendar alternate outline"></i>
            Horario
        </h4>
		@foreach ($curso->clases as $clases)
			<a class="button ui small button_clase" data-id="{{ $clases->cla_id }}">{{ $clases->asignatura->asig_nombre }}</a>
		@endforeach


		<table class="ui definition celled table" id="form_calendar">
			<thead>
	            <tr>
	                <th class="collapsing">Horas</th>
	                @foreach ($dias as $dia)
	                    <th>{{ $dia->di_nombre }}</th>
	                @endforeach
	                {{-- 
	                @for ($i = 1; $i <= 5 ; $i++)
	                    <th>{{ $dias[$i] }}</th>
	                @endfor
	                 --}}
	            </tr>
			</thead>
			<tbody>
				@foreach ($curso->periodo->horas as $count => $hora)
					<tr>
						<td class="center aligned">{{ $hora->hors_numero }}</td>
	                	@foreach ($dias as $dia)
		                    @php
		                      $horario = $horarios->where('hora_id', $hora->hors_id)->where('dia_id', $dia->di_id)->first();
		                    @endphp
			                    @if ($horario != null)
				                        <td class="center aligned td_form" td-clase="{{ $horario->clases_id }}" td-pos="{{ $hora->hors_id.$dia->di_id }}">
				                        	<a class="text-black">{{ $horario->clases->asignatura->asig_nombre }}</a>
				                        	<div class="field">
				                        		{!! Form::hidden('horario['.$hora->hors_numero.']['.$dia->di_id.'][clases_id]', $horario->clases_id, ['input-name'=>'clases']) !!}
				                        		{!! Form::hidden('horario['.$hora->hors_numero.']['.$dia->di_id.'][horario_id]', $horario->hor_id, null) !!}
				                        	</div>
				                        </td>
			                    @else
			                        <td class="center aligned td_form" td-clase="" td-pos="{{ $hora->hors_id.$dia->di_id }}">
			                        	<a></a>
			                        	<div class="field">
			                        		{!! Form::hidden('horario['.$hora->hors_numero.']['.$dia->di_id.'][dia_id]', $dia->di_id, null) !!}
			                        		{!! Form::hidden('horario['.$hora->hors_numero.']['.$dia->di_id.'][hora_id]', $hora->hors_id, null) !!}
			                        		{!! Form::hidden('horario['.$hora->hors_numero.']['.$dia->di_id.'][clases_id]', null, ['input-name'=>'clases']) !!}
			                        	</div>
			                        </td>
			                    @endif
						@endforeach

{{-- 
	                    @for ($i = 1; $i <= 5 ; $i++)
	                    @php
	                      $horarios = $hora->horarios->whereIn('clases_id', $curso->clases->pluck('cla_id'))->where('hor_dia', $dias[$i]);
	                    @endphp
	                    @if ($horarios != '[]')
	                    @foreach ($horarios as $horario)
	                        <td class="center aligned td_form" td-clase="{{ $horario->clases_id }}">
	                        	<a class="text-black">{{ $horario->clases->asignatura->asig_nombre }}</a>
	                        	<div class="field">
	                        		{!! Form::hidden('horario['.$hora->hors_numero.']['.$i.'][hor_dia]', $dias[$i], null) !!}
	                        		{!! Form::hidden('horario['.$hora->hors_numero.']['.$i.'][hora_id]', $hora->hors_id, null) !!}
	                        		{!! Form::hidden('horario['.$hora->hors_numero.']['.$i.'][clases_id]', $horario->clases_id, ['input-name'=>'clases']) !!}
	                        		{!! Form::hidden('horario['.$hora->hors_numero.']['.$i.'][horario_id]', $horario->hor_id, null) !!}
	                        	</div>
	                        </td>
	                    @endforeach
	                    @else
	                        <td class="center aligned td_form" td-clase="">
	                        	<a></a>
	                        	<div class="field">
	                        		{!! Form::hidden('horario['.$hora->hors_numero.']['.$i.'][hor_dia]', $dias[$i], null) !!}
	                        		{!! Form::hidden('horario['.$hora->hors_numero.']['.$i.'][hora_id]', $hora->hors_id, null) !!}
	                        		{!! Form::hidden('horario['.$hora->hors_numero.']['.$i.'][clases_id]', null, ['input-name'=>'clases']) !!}
	                        	</div>
	                        </td>
	                    @endif
	                    @endfor
 --}}

					</tr>
				@endforeach
			</tbody>
		</table>
		<div class="field text-center">
			<a class="button ui teal icon labeled" id="guardar_horario"><i class="icon save"></i> Guardar</a>
			<a class="button ui red icon labeled" id="button_cancel"><i class="icon remove"></i> Cancelar</a>
		</div>
	</div>






{!! Form::close() !!}




<script type="text/javascript">
var token = $('meta[name="csrf-token"]').attr('content');
	$('.button_clase').on('click', function(){
		var id = $(this).attr('data-id');
		$('.button_clase.active').removeClass('active bg-light-blue');
		$(this).addClass('active bg-light-blue');
		$('.td_form').addClass('selectable')
		$('.td_form.warning').removeClass('warning')
		$('td[td-clase="'+id+'"]').addClass('warning')
		$.ajax({
			url: "{{ route('curso.ajax.clase_horarios') }}",
			type: 'post',
			dataType: 'json',
			data: {_token:token, id:id},
			success: function(response){
				$.each(response.horarios, function(index, value){
					$('td[td-pos="'+value.hora+value.dia+'"]').addClass('negative').removeClass('selectable')
				})
			}
		})
	})



	$('#button_cancel').on('click', function(){
		var id = $('#curso').val()
		if(id != ''){
			$.ajax({
				url : '{{ route('curso.ver_horarios') }}',
				type: 'post',
				data: {_token:token, id:id},
				success: function(data){
					$('#horario_body').html(data).show();
				}
			})
		}
	})

	$('#guardar_horario').on('click', function(){
		var id = $('#curso').val()
		$.ajax({
			url:"{{ route('curso.guardar_horarios') }}",
			type: 'post',
			dataType: 'json',
			data: $('#form_horario').serialize(),
			success: function(response){
                swal({
                    title: "Horario Guardado",
                    timer: 1200,
                    type: "success",
                    showConfirmButton:false,
                });
				$.ajax({
					url : '{{ route('curso.ver_horarios') }}',
					type: 'post',
					data: {_token:token, id:id},
					success: function(data){
						$('#horario_body').html(data).show();
					}
				})

			}
		})
	})
</script>
