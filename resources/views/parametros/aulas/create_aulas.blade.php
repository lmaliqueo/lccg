	

			
			{!! Form::open(['route' => 'parametros.store.aulas', 'method'=>'POST', 'class'=>'ui form']) !!}

				<div class="field required">
					{!! Form::label('aul_numero', 'Codigo') !!}
						{!! Form::text('aul_numero', null, ['placeholder'=>'', 'maxlength'=>5, 'required']) !!}
				</div>

				<div class="field required">
					{!! Form::label('aul_tipo', 'Tipo') !!}
					{!! Form::select('aul_tipo', [1=>'Sala de Clases', 2=>'Sala de Estudio', 3=>'Sala de Actividades'], null, ['placeholder'=>'', 'class'=>'ui fluid dropdown', 'required']) !!}
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



