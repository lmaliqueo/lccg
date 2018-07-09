{!! Form::open(['route' => ['usuario.update_pass'], 'method'=>'POST', 'class'=>'ui form']) !!}

    <div class="field">
			{!! Form::label('user[old_pass]', 'Password Actual') !!}
            {!! Form::password('user[old_pass]', null, ['placeholder'=>'Ingrese su Clave Actual', 'required']) !!}
        
    </div>
    <div class="field">
			{!! Form::label('user[new_pass]', 'Nuevo Password') !!}
            {!! Form::password('user[new_pass]', null, ['placeholder'=>'Nueva Clave', 'required']) !!}
        
    </div>
    <div class="field">
			{!! Form::label('user[rep_new_pass]', 'Confirmar Nuevo Password') !!}
            {!! Form::password('user[conf_new_pass]', null, ['placeholder'=>'Repetir Nueva Clave', 'required']) !!}
        
    </div>

                <div class="actions text-right">

                    <div class="ui negative button" data-value="Cancel" name="Cancel">
                        Cancelar
                    </div>
					{!! Form::submit('Guardar', ['class'=>'ui button teal']) !!}

                </div>



{!! Form::close() !!}
