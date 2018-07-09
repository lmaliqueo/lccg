
			{!! Form::open(['route' => 'asignaturas.store', 'method'=>'POST', 'class'=>'ui form']) !!}
	<div class="ui error message">
		<i class="close icon close_alert"></i>
		<div class="header">
			Error en el formulario
		</div>
		<ul class="list list_error">
		</ul>
	</div>

				<div class="field">
					{!! Form::label('asig_nombre', 'Nombre Asignatura') !!}
					{!! Form::text('asig_nombre', null, ['placeholder'=>'', 'required']) !!}
				</div>

				<div class="field">
					{!! Form::label('asig_nombre_corto', 'Nombre Corto') !!}
					{!! Form::text('asig_nombre_corto', null, ['placeholder'=>'', 'maxlength'=>10, 'required']) !!}
				</div>

				<div class="field">
					{!! Form::label('asig_tipo_asignatura', 'Tipo de Asignatura') !!}
					{!! Form::select('asig_tipo_asignatura', [1=>'Básico', 2=>'Electivo'], null, ['placeholder'=>'', 'class'=>'ui fluid search selection dropdown', 'required']) !!}
				</div>


{{-- 
				<div class="field">
					{!! Form::label('asig_tipo', 'Tipo') !!}
					{!! Form::select('asig_tipo', [1=>'Asignatura Curso', 2=>'Taller'], null, ['placeholder'=>'', 'class'=>'ui fluid search selection dropdown']) !!}
				</div>
 --}}
                <div class="actions text-right">

                    <div class="ui negative button" data-value="Cancel" name="Cancel">
                        Cancelar
                    </div>
                    <a class="ui button teal" id="submit_btn">Guardar</a>
{{-- 					{!! Form::submit('Guardar', ['class'=>'ui button teal']) !!}
 --}}
                </div>


			{!! Form::close() !!}



<script type="text/javascript">
$(document).ready(function(){

 	$('.dropdown').dropdown();

 	$('#submit_btn').on('click', function(){
 		$.ajax({
 			url: "{{ route('validate.validate_asig') }}",
 			type: 'post',
 			data: $('form').serialize(),
 			dataType: 'json',
 			success: function(response){
 				if(response.success){
 					$('form').submit();
 				}else{
	 				console.log(1);
			    	$('.ui.form').addClass('error')
			    	$('.error.message').removeClass('hidden')
					$.each(response.errors, function(index, value){
		    			$('<li>'+value+'</li>').appendTo('.list_error')
						$('label[for="'+index+'"]').parent('.field').addClass('error');
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