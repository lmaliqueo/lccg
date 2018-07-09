



			{!! Form::open(['route' => 'parametros.store.conceptos', 'method'=>'POST', 'class'=>'ui form']) !!}
				
				<div class="field">
					{!! Form::label('con_nombre', 'Nombre Concepto') !!}
					{!! Form::text('con_nombre', null, ['class'=>'ui fluid search dropdown']) !!}
				</div>

				<div class="field">
					{!! Form::label('con_descripcion', 'Descripción') !!}
					{!! Form::text('con_descripcion', null, ['class'=>'ui fluid search dropdown']) !!}
				</div>

				<br>
                <div class="actions text-right">

                    <div class="ui negative button" data-value="Cancel" name="Cancel">
                        Cancelar
                    </div>
					{!! Form::submit('Guardar', ['class'=>'ui button teal']) !!}

                </div>



			{!! Form::close() !!}
