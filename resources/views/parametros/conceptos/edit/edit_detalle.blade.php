			{!! Form::open(['route' => ['parametros.update.detalle_pauta', $detalle], 'method'=>'PUT', 'class'=>'ui form']) !!}
				
				<div class="field">
					{!! Form::label('dp_descripcion', 'Descripción') !!}
					{!! Form::text('dp_descripcion', $detalle->dp_descripcion, ['placeholder' => 'Descripcion']) !!}
				</div>

				<br>
                <div class="actions text-right">

                    <div class="ui negative button" data-value="Cancel" name="Cancel">
                        Cancelar
                    </div>
					{!! Form::submit('Guardar', ['class'=>'ui button teal']) !!}

                </div>



			{!! Form::close() !!}
