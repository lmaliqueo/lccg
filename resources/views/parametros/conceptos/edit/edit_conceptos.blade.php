{!! Form::open(['route' => ['parametros.update.conceptos', $concepto], 'method'=>'PUT', 'class'=>'ui form']) !!}
	<div class="field">
		{!! Form::label('con_nombre', 'Descripción') !!}
		{!! Form::text('con_nombre', $concepto->con_nombre, ['placeholder' => 'Descripcion']) !!}
	</div>
	<div class="field">
		{!! Form::label('con_descripcion', 'Descripción') !!}
		{!! Form::text('con_descripcion', $concepto->con_descripcion, ['placeholder' => 'Descripcion']) !!}
	</div>
	<br>
    <div class="actions text-right">
        <div class="ui negative button" data-value="Cancel" name="Cancel">
            Cancelar
        </div>
		{!! Form::submit('Guardar', ['class'=>'ui button teal']) !!}
    </div>
{!! Form::close() !!}
