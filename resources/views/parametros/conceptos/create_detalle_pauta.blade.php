

			{!! Form::open(['route' => 'parametros.store.detalle_pauta', 'method'=>'POST', 'class'=>'ui form']) !!}
				
				<div class="field">
					{!! Form::label('dp_descripcion', 'Descripción') !!}
					{!! Form::text('dp_descripcion', null, ['placeholder' => 'Descripcion']) !!}
				</div>
					{!! Form::hidden('grupopauta_id', $grupo, ['placeholder' => 'Descripcion']) !!}

				<br>
                <div class="actions text-right">

                    <div class="ui negative button" data-value="Cancel" name="Cancel">
                        Cancelar
                    </div>
					{!! Form::submit('Guardar', ['class'=>'ui button teal']) !!}

                </div>



			{!! Form::close() !!}
