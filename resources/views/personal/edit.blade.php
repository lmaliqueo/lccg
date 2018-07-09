
{!! Form::open(['route' => ['empleados.update', $empleado], 'method'=>'PUT', 'class'=>'ui form']) !!}

		<div class="ui error message">
			<i class="close icon close_alert"></i>
			<div class="header">
				Error en el formulario
			</div>
			<ul class="list list_error">
			</ul>
		</div>


	<div class="ui info visible message">
	    <p><i class="icon info circle"></i> Los campos marcados con <span class="text-red">*</span> son obligatorios</p>
	</div>

			{!! Form::hidden('empleado[pers_id]', $empleado->pers_id, null) !!}
	<div class="fields">
		<div class="eight wide field required">
			{!! Form::label('persona[pe_nombres]', 'Nombre') !!}
			{!! Form::text('persona[pe_nombres]', $empleado->persona->pe_nombres, ['required', 'placeholder'=>'']) !!}
			
		</div>
		<div class="four wide field required">
			{!! Form::label('persona[pe_apellido_pat]', 'Apellido Paterno') !!}
			{!! Form::text('persona[pe_apellido_pat]', $empleado->persona->pe_apellido_pat, ['required', 'placeholder'=>'']) !!}
		</div>
		<div class="four wide field required">
			{!! Form::label('persona[pe_apellido_mat]', 'Apellido Materno') !!}
			{!! Form::text('persona[pe_apellido_mat]', $empleado->persona->pe_apellido_mat, ['required', 'placeholder'=>'']) !!}
		</div>
	</div>
	<div class="field required">
		{!! Form::label('persona[pe_rut]', 'Rut') !!}
		{!! Form::text('persona[pe_rut]', $empleado->persona_rut, ['required', 'tipo-input'=>'rut']) !!}
	</div>
	<div class="fields two">
		<div class="field">
			{!! Form::label('persona[pe_contacto]', 'Contacto') !!}
			{!! Form::text('persona[pe_contacto]', $empleado->persona->pe_contacto, ['placeholder'=>'', 'tipo-input'=>'number']) !!}
		</div>
		<div class="field required">
			{!! Form::label('empleado[cargo_id]', 'Cargo') !!}
			{!! Form::select('empleado[cargo_id]', $cargos, $empleado->cargo_id, ['required', 'placeholder'=>'', 'class'=>'ui dropdown fluid']) !!}
		</div>
	</div>
<br>
	    <div class="actions text-right">

	        <div class="ui negative button" data-value="Cancel" name="Cancel">
	            Cancelar
	        </div>
                    <a class="ui button teal" id="submit_btn">Guardar</a>

	    </div>


			{!! Form::close() !!}

<script type="text/javascript">
$(document).ready(function(){

 	$('.dropdown').dropdown();

 	$('#submit_btn').on('click', function(){
 		$.ajax({
 			url: "{{ route('validate.validate_empl') }}",
 			type: 'put',
 			data: $('form').serialize(),
 			dataType: 'json',
 			success: function(response){
 				if(response.success){
 					//$('form').submit();
 				}else{
	 				console.log(1);
			    	$('.ui.form').addClass('error')
			    	$('.error.message').removeClass('hidden')
					$.each(response.errors, function(index, value){
		    			$('<li>'+value+'</li>').appendTo('.list_error')
						$('label[for="'+response.tipo+'['+index+']"]').parent('.field').addClass('error');
					})
 				}
 			}
 		})
 	})

 	$('.close_alert').on('click', function(){
 		$('.error.message').addClass('transition hidden')
 	})
})
</script>