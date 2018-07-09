

			{!! Form::open(['route' => 'parametros.store.grupo_pauta', 'method'=>'POST', 'class'=>'ui form']) !!}
				
				<div class="field">
					{!! Form::label('gp_descripcion', 'Descripción') !!}
					{!! Form::text('gp_descripcion', null, ['placeholder' => 'Descripcion']) !!}
				</div>

				<br>
                <div class="actions text-right">

                    <div class="ui negative button" data-value="Cancel" name="Cancel">
                        Cancelar
                    </div>
					{!! Form::submit('Guardar', ['class'=>'ui button teal']) !!}

                </div>



			{!! Form::close() !!}
