	

			
			{!! Form::open(['route' => 'parametros.store.cursos', 'method'=>'POST', 'class'=>'ui form']) !!}

				<div class="field">
					{!! Form::label('pcur_grado', 'Grado') !!}
						{!! Form::select('pcur_grado', [1=>1, 2=>2, 3=>3, 4=>4], null, ['class'=>'ui search fluid dropdown', 'placeholder'=>'']) !!}
				</div>

				<div class="field">
					{!! Form::label('pcur_letra', 'Letra') !!}
					{!! Form::select('pcur_letra', ['A'=>'A', 'B'=>'B', 'C'=>'C', 'D'=>'D', 'E'=>'E', 'F'=>'F', 'G'=>'G', 'H'=>'H', 'I'=>'I', 'J'=>'J', 'K'=>'K', 'L'=>'L', 'M'=>'M', 'N'=>'N', 'O'=>'O', 'P'=>'P', 'Q'=>'Q', 'R'=>'R', 'S'=>'S', 'T'=>'T', 'U'=>'U', 'V'=>'V', 'W'=>'W', 'X'=>'X', 'Y'=>'Y', 'Z'=>'Z'],null, ['class'=>'ui fluid search dropdown selection', 'placeholder'=>'', 'maxlength'=>1]) !!}
				</div>


                <div class="actions text-right">

                    <div class="ui negative button" data-value="Cancel" name="Cancel">
                        Cancelar
                    </div>
					{!! Form::submit('Guardar', ['class'=>'ui button teal']) !!}

                </div>

			{!! Form::close() !!}






