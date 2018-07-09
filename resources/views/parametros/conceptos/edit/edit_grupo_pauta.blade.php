			{!! Form::open(['route' => ['parametros.update.grupo_pauta', $grupo], 'method'=>'PUT', 'class'=>'ui form']) !!}
				
				<div class="field">
					{!! Form::label('gp_descripcion', 'Descripción') !!}
					{!! Form::text('gp_descripcion', $grupo->gp_descripcion, ['placeholder' => 'Descripcion']) !!}
				</div>

				<br>
                <div class="actions text-right">

                    <div class="ui negative button" data-value="Cancel" name="Cancel">
                        Cancelar
                    </div>
					{!! Form::submit('Guardar', ['class'=>'ui button teal']) !!}

                </div>



			{!! Form::close() !!}
