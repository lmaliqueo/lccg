    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon legal"></i>
        Comportamiento
    </h4>


			{!! Form::open(['route' => 'academico.store_pauta', 'method'=>'POST', 'class'=>'ui form margin-bottom']) !!}
	{!! Form::hidden('alumno[mat_id]', $alumno->mat_id, ['class'=>'ui fluid search dropdown']) !!}
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
						<td class="selected collapsing">
								@php
									$flag_conceptos = null;
								@endphp
								@if ($alumno->detallesConceptos != '[]')
									@foreach ($alumno->conceptos as $conceptos_old)
										@if ($conceptos_old->pivot->detallepauta_id == $detalles->dp_id)
											{{-- $conceptos->con_nombre --}}
											@php
												$flag_conceptos = $conceptos_old->con_id;
											@endphp
											@break
										@endif
									@endforeach
					{!! Form::select('old_conceptos['.$count.$i.'][concepto_id]', $conceptos, $flag_conceptos, ['class'=>'ui dropdown', 'placeholder'=>'Concepto']) !!}
					{!! Form::hidden('old_conceptos['.$count.$i.'][detalle_id]', $detalles->dp_id, ['class'=>'ui fluid search dropdown']) !!}
					{!! Form::hidden('old_conceptos['.$count.$i.'][old_concepto]', $flag_conceptos, ['class'=>'ui fluid search dropdown']) !!}
								@else

					{!! Form::select('conceptos['.$count.$i.'][concepto_id]', $conceptos, null, ['class'=>'ui fluid search dropdown', 'placeholder'=>'Concepto']) !!}
					{!! Form::hidden('conceptos['.$count.$i.'][detalle_id]', $detalles->dp_id, ['class'=>'ui fluid search dropdown']) !!}
								@endif
								
						</td>
					</tr>
				@endforeach
			</tbody>
		@endforeach
	</table>



			{!! Form::close() !!}
<p class="text-center">
	<a class="ui button teal circular labeled icon" id="button_submit"><i class="add icon"></i> Guardar</a>
	<a class="ui button red circular labeled icon" id="button_cancel"><i class="remove icon"></i> Cancelar</a>
	
</p>

<script type="text/javascript">
 $(document).ready(function(){
	$('#button_submit').click(function(){
		$.ajax({
			url: '{{ route('academico.store_pauta') }}',
			type: 'post',
			data: $('form').serialize(),
			success: function(response){
				$('#pauta_comp').html(response);
				$('.button_comp.active').addClass('blue');
			}
		})
	})
})
 	$('.dropdown').dropdown();

 	$('#button_cancel').on('click', function(){
 		var mat = $('input[name="id_mat"]').val();
	    $.ajax({
	        url: '{{ route('academico.pauta_conceptos') }}',
	        type: 'post',
	        //dataType: "JSON",
	        data: {_token:token, matricula:mat/*, nivel:nivel, letra:letra*/ },
	        success: function(response) {
	        	$('#pauta_comp').html(response);
	        	$('.segment_inputs').hide();
	        	$('#pauta_comp').show();
	        }
	    });
 	})
</script>