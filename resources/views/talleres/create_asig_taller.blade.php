			{!! Form::open(['route' => 'talleres.store_asig_taller', 'method'=>'POST', 'class'=>'ui form']) !!}

				<div class="field">
					{!! Form::label('asig_nombre', 'Nombre') !!}
					{!! Form::text('asig_nombre', null, ['placeholder'=>'', 'required']) !!}
				</div>

				<div class="field">
					{!! Form::label('asig_nombre_corto', 'Nombre Corto') !!}
					{!! Form::text('asig_nombre_corto', null, ['placeholder'=>'', 'required']) !!}
				</div>


                <div class="actions text-right">

                    <div class="ui negative button" data-value="Cancel" name="Cancel">
                        Cancelar
                    </div>
					{!! Form::submit('Guardar', ['class'=>'ui button teal']) !!}

                </div>

			{!! Form::close() !!}

