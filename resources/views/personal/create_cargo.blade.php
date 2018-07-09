	

			
			{!! Form::open(['route' => 'empleados.store_cargo', 'method'=>'POST', 'class'=>'ui form']) !!}

				<div class="field">
					{!! Form::label('ca_nombre', 'Nombre') !!}
					{!! Form::text('ca_nombre', null, ['placeholder'=>'', 'required']) !!}
				</div>


                <div class="actions text-right">

                    <div class="ui negative button" data-value="Cancel" name="Cancel">
                        Cancelar
                    </div>
					{!! Form::submit('Guardar', ['class'=>'ui button teal']) !!}

                </div>

			{!! Form::close() !!}




