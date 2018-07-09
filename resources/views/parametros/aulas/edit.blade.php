	

			
    		{!! Form::open(['route' => ['parametros.update.aulas', $aula], 'method'=>'PUT', 'class'=>'ui form']) !!}

				<div class="field">
					{!! Form::label('aul_numero', 'Codigo') !!}
						{!! Form::text('aul_numero', $aula->aul_numero, ['placeholder'=>'', 'maxlength'=>5]) !!}
				</div>

				<div class="field">
					{!! Form::label('aul_tipo', 'Tipo') !!}
					{!! Form::select('aul_tipo', [1=>'Sala de Clases', 2=>'Sala de Estudio', 3=>'Sala de Actividades'], $aula->aul_tipo, ['placeholder'=>'', 'class'=>'ui fluid dropdown']) !!}
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



