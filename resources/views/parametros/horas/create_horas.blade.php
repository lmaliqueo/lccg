	

			
			{!! Form::open(['route' => 'parametros.store.horas', 'method'=>'POST', 'class'=>'ui form']) !!}


				<div class="field">
					{!! Form::label('periodo_id', 'Periodo') !!}
					{!! Form::text('año', $periodo->pac_ano, ['readonly']) !!}
					{!! Form::hidden('periodo_id', $periodo->pac_id, null) !!}
				</div>
				<div class="field">
					{!! Form::label('hors_numero', 'Numero') !!}
					{!! Form::text('hors_numero', $periodo->horas->count()+1, ['placeholder'=>'', 'readonly']) !!}
				</div>
				<div class="fields two">
					<div class="field">
						{!! Form::label('hors_hora_inicio', 'Hora Inicio') !!}
						{!! Form::time('hors_hora_inicio', null, ['placeholder'=>'']) !!}
					</div>
					<div class="field">
						{!! Form::label('hors_hora_termino', 'Hora Término') !!}
						{!! Form::time('hors_hora_termino', null, ['placeholder'=>'']) !!}
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




