	

			
{!! Form::open(['route' => ['parametros.update.horas', $horas], 'method'=>'PUT', 'class'=>'ui form']) !!}


	<div class="field">
		{!! Form::label('periodo_id', 'Periodo') !!}
		{!! Form::text('año', $horas->periodo->pac_ano, ['readonly']) !!}
		{!! Form::hidden('periodo_id', $horas->periodo_id, null) !!}
	</div>
	<div class="field">
		{!! Form::label('hors_numero', 'Numero') !!}
		{!! Form::text('hors_numero', $horas->hors_numero, ['placeholder'=>'', 'readonly']) !!}
	</div>
	<div class="fields two">
		<div class="field">
			{!! Form::label('hors_hora_inicio', 'Hora Inicio') !!}
			{!! Form::time('hors_hora_inicio', $horas->hors_hora_inicio, ['placeholder'=>'']) !!}
		</div>
		<div class="field">
			{!! Form::label('hors_hora_termino', 'Hora Término') !!}
			{!! Form::time('hors_hora_termino', $horas->hors_hora_termino, ['placeholder'=>'']) !!}
		</div>
		
	</div>


    <div class="actions text-right">

        <div class="ui negative button" data-value="Cancel" name="Cancel">
            Cancelar
        </div>
		{!! Form::submit('Guardar', ['class'=>'ui button teal']) !!}

    </div>

{!! Form::close() !!}


<script type="text/javascript">

 	$('.dropdown').dropdown();

</script>




