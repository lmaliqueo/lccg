

{!! Form::open(['route' => 'periodo.store', 'method'=>'POST', 'class'=>'ui form']) !!}

	<div class="field">
		{!! Form::label('pac_ano', 'Año', null) !!}
			{!! Form::number('pac_ano', $periodo_ant->pac_ano + 1, ['min' => $periodo_ant->pac_ano+1, 'required']) !!}
	</div>

	<div class=" two fields">
		<div class="field">
			{!! Form::label('pac_fecha_inicio', 'Fecha Inicio', null) !!}
				{!! Form::date('pac_fecha_inicio', null, ['min'=>($periodo_ant->pac_ano + 1).'-01-01', 'min'=>($periodo_ant->pac_ano + 1).'-12-31', 'required']) !!}
		</div>
		<div class="field">
			{!! Form::label('pac_fecha_termino', 'Fecha Término', null) !!}
				{!! Form::date('pac_fecha_termino', null, ['readonly', 'required', 'max'=>($periodo_ant->pac_ano + 1).'-12-31']) !!}
		</div>
		
	</div>

	<div class="field text-center">
		{!! Form::submit('Guardar', ['class'=>'ui button teal']) !!}
	</div>

<script type="text/javascript">
	$('input[name="pac_fecha_inicio"]').on('change', function(){
		var val = $(this).val();
		$('input[name="pac_fecha_termino"]').attr('min', val).removeAttr('readonly');
	})
	$('input[name="pac_ano"]').on('change', function(){
		var val = $(this).val();
		$('input[name="pac_fecha_inicio"]').attr('min', val+'-01-01').attr('max', val+'-12-31').removeAttr('readonly');
		$('input[name="pac_fecha_termino"]').attr('max', val+'-12-31').removeAttr('readonly');
	})
</script>

{!! Form::close() !!}



