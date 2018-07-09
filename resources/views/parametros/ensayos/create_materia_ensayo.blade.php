	

			
			{!! Form::open(['route' => 'parametros.store.materia_ensayo', 'method'=>'POST', 'class'=>'ui form']) !!}

				<div class="field">
					{!! Form::label('materia[mens_nombre]', 'Nombre') !!}
					{!! Form::text('materia[mens_nombre]', null, ['placeholder'=>'']) !!}
				</div>

				<div class="field">
					{!! Form::label('tipo', 'Tipo Ensayo') !!}
						{!! Form::select('tipo', $tipo_ensayos, null, ['class'=>'ui fluid dropdown', 'placeholder'=>'']) !!}
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




