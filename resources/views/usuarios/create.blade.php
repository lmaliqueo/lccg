@extends('admin.template.main')

@section('title', 'Crear Usuario')

@section('content')

	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="user circle icon"></i>
					<i class="corner yellow add icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
		        Nuevo Usuario
			</span>
        </h2>
        <p>
            {{-- <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('usuarios.index') }}"><i class="arrow left icon"></i> Volver</a> --}}
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('usuarios.admin') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>
<br>

			{!! Form::open(['route' => 'usuarios.store', 'method'=>'POST', 'class'=>'ui form']) !!}



			{!! Form::hidden('step', 1, []) !!}										


	<div class="ui error message">
		<i class="close icon"></i>
		<div class="header">
		Error en el formulario
		</div>
		<ul class="list list_error">
		</ul>
	</div>

<div class="ui grid">
	<div class="five wide column">
		<div class="ui vertical fluid steps">
		  <div class="active step 1" id="step1" step="1">
		    <i class="male icon"></i>
		    <div class="content">
		      <div class="title">Persona</div>
		      <div class="description">Datos personales de la cuenta</div>
		    </div>
		  </div>
		  <div class="disabled step 2" id="step2" step="2">
		    <i class="user icon"></i>
		    <div class="content">
		      <div class="title">Cuenta</div>
		      <div class="description">Datos de la cuenta</div>
		    </div>
		  </div>
		  <div class="disabled step 3" id="step3" step="3">
		    <i class="id card icon"></i>
		    <div class="content">
		      <div class="title">Usuario</div>
		      <div class="description">Ver y confirmar usuario</div>
		    </div>
		  </div>
		</div>
		
	</div>
	<div class="eleven wide column">



{{-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ --}}
{{-- ++++++++++++++++++++++++++++++++++++++++ PERSONA ++++++++++++++++++++++++++++++++++++++++ --}}
{{-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ --}}



		<div class="ui segment animated fadeInDown" id="step_1">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon male"></i>
        Persona
    </h4>



		<div class="field" id="field_al_rut">
			{!! Form::label('persona[persona_rut]', 'R.U.N.') !!}
			<div class="ui search fluid category focus">
				<div class="ui icon input">
					<input class="prompt persona" type="text" placeholder="" autocomplete="off" name="persona[persona_rut]" tipo-input="rut" onpaste="return false;">
					<i class="search icon inverted red circular remove link icon_remove" id="icon_person" style="display: none;" value="alumno"></i>
				</div>
			</div>
			{!! Form::hidden('persona[pe_rut_old]', null, ['class'=>'persona', 'placeholder'=>'', 'required'=>'required', 'maxlength'=>12, 'class'=>'alumno_old']) !!}										
		</div>



	<div class="segment ui raised secondary">
		<div class="fields">
			<div class="field wide eight">
				{!! Form::label('persona[pe_nombres]', 'Nombres') !!}
				{!! Form::text('persona[pe_nombres]', null, ['class'=>'persona', 'placeholder'=>'Nombre']) !!}
			</div>

			<div class="field wide four">
				{!! Form::label('persona[pe_apellido_pat]', 'Apellido Paterno') !!}
				{!! Form::text('persona[pe_apellido_pat]', null, ['class'=>'persona', 'placeholder'=>'Apellido Paterno']) !!}
			</div>
			<div class="field wide four">
				{!! Form::label('persona[pe_apellido_mat]', 'Apellido Materno') !!}
				{!! Form::text('persona[pe_apellido_mat]', null, ['class'=>'persona', 'placeholder'=>'Apellido Materno']) !!}
			</div>
			
		</div>

		<div class="fields">
			<div class="field wide ten">
				{!! Form::label('persona[pe_contacto]', 'Fono Contacto') !!}
				{!! Form::text('persona[pe_contacto]', null, ['tipo-input'=>'number', 'class'=>'persona', 'placeholder'=>'', 'max'=>9]) !!}
			</div>
			<div class="field wide six">
				{!! Form::label('personal[cargo_id]', 'Cargo') !!}
				{!! Form::select('personal[cargo_id]', $cargos, null, ['placeholder'=>'Cargo', 'class'=>'ui fluid dropdown selection visible persona']) !!}
			</div>
		</div>

		
	</div>
{{-- 				<div class="field">
					{!! Form::label('persona_rut', 'Rut Persona') !!}
					{!! Form::select('persona_rut', $personas, null, ['class'=>'ui fluid dropdown selection visible']) !!}
				</div>

 --}}

				<div class="text-right">
					<a class="ui button blue button_next" posicion="1">Siguiente</a>
					
				</div>

		</div>



{{-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ --}}
{{-- ++++++++++++++++++++++++++++++++++++++++ USUARIO ++++++++++++++++++++++++++++++++++++++++ --}}
{{-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ --}}


		<div class="ui segment hide no-margin animated fadeInUp" id="step_2">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon user"></i>
        Cuenta
    </h4>


				<div class="field">
					{!! Form::label('us_username', 'Nombre Usuario') !!}
					{!! Form::text('us_username', null, ['placeholder'=>'', 'readonly']) !!}
				</div>

				<div class="field">
					{!! Form::label('us_email', 'Email') !!}
					{!! Form::email('us_email', null, ['placeholder'=>'']) !!}
				</div>

				<div class="field">
					{!! Form::label('password', 'Password') !!}
					{!! Form::password('password', null, ['placeholder'=>'']) !!}
				</div>


			<div class="field wide six">
				{!! Form::label('rol_id', 'Rol') !!}

						<div class="ui selection dropdown dropdown_cursos">
							<input type="hidden" name="rol_id">
								<i class="dropdown icon"></i>
							<div class="default text"></div>
							<div class="menu menu_cursos">
								@foreach ($roles as $rol)
									@if ($rol->name == 'Apoderado' || $rol->name == 'Profesor')
										<div class="item disabled" data-value="{{ $rol->id }}">{{ $rol->name }}</div>
									@else
										<div class="item" data-value="{{ $rol->id }}">{{ $rol->name }}</div>
									@endif
								@endforeach
							</div>
						</div>


			</div>


				<div class="text-right">
					<a class="ui button basic button_after" posicion="2">Anterior</a>
					<a class="ui button blue button_next" posicion="2">Siguiente</a>
				</div>



		</div>

		<div class="ui segment hide no-margin animated fadeInUp" id="step_3">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon id card"></i>
        Usuario
    </h4>

			<div class="ui raised secondary segment">
				<div class="ui inverted ribbon label large bg-navy2">
					<i class="icon user"></i> Cuenta
				</div>		
				<table class="table ui celled small">
					<thead>
						<tr>
							<th>Nombre Usuario</th>
							<td class="td_us_username"></td>
						</tr>
						<tr>
							<th>Email</th>
							<td class="td_us_email"></td>
						</tr>
						<tr>
							<th>Rol</th>
							<td class="td_rol_id"></td>
						</tr>
					</thead>
				</table>
				
			</div>


			<div class="ui raised secondary segment">
				<div class="ui inverted ribbon label large bg-navy2">
					<i class="icon male"></i> Persona
				</div>		
				<table class="table ui celled small">
					<thead>
						<tr>
							<th>RUN</th>
							<td class="td_persona_rut"></td>
						</tr>
						<tr>
							<th>Nombre</th>
							<td class="td_pe_nombres"></td>
						</tr>
						<tr>
							<th>Cargo</th>
							<td class="td_cargo_id"></td>
						</tr>
						<tr>
							<th>Contacto</th>
							<td class="td_pe_contacto"></td>
						</tr>
					</thead>
				</table>
				
			</div>




				<div class="text-center">
					<a class="ui button basic button_after" posicion="3">Anterior</a>
					{!! Form::submit('Guardar', ['class'=>'ui button teal']) !!}
				</div>
		</div>
	</div>
</div>



			{!! Form::close() !!}




<script type="text/javascript">


	var token = $('meta[name="csrf-token"]').attr('content');



$('.ui.search').search({

    //type          : 'category',
    minCharacters : 1,
    showNoResults : false,
    apiSettings   : {
        responseAsync: function (settings, callback) {



                    var result;
                    var response = {
                        success: true   // docs say you need to return success: true
                    }
            $.ajax({
                url: '{{ route('autocomplete.search_person_user') }}',
                type: "post",
                dataType: "json",
                data:{
                	_token:token, rut:settings.urlData.query
                },
                success: function(ret){
                    result = ret;
                },
                complete: function(){
			        var
			          response = {
			            results : {}
			          }
			        ;

				//$('.'+old+'_old').val('');
                    response.results = result;
                    callback (response);  // Important to call the callback!
                    /*
			        $.each(result.items, function(index, item) {
			          var
			            tipo   = item.tipo || 'Unknown',
			            maxResults = 8
			          ;
			          if(index >= maxResults) {
			            return false;
			          }
			          // create new tipo category
			          if(response.results[tipo] === undefined) {
			            response.results[tipo] = {
			              name    : tipo,
			              results : []
			            };
			          }
			          // add result to category
			          response.results[tipo].results.push({
			            title       : item.rut,
			            description : item.nombre_comp,
			            price       : item.cargo,
			            comuna      : item.comuna,
			            category      : item.curso,
			            rol      : item.rol,
			            model      : item.model,
			          });
			        });
			        callback (response);*/


                }
            })
        },
    },
    fields: {
		//results : 'results',
		title   : 'rut',
		description : 'nombre_comp',
		price: 'tipo',
    },
    onSelect: function(result, response){

    	console.log(result.model.persona_rut)
    	$.each(result.model.persona, function(index, value){
    		$('input[name="persona['+index+']"]').val(value);
    		$('input[name="persona['+index+']"]').attr('readonly', 'true')

    	})
    	$.each(result.model, function(index, value){
    		if(result.cargo != ''){
	    		$('select[name="personal[cargo_id]"]').parent().dropdown('set selected', value).addClass('disabled');
	    		//$('.ui.dropdown.alumno').addClass('disabled');
    		}else{
	    		$('select[name="personal[cargo_id]"]').parent().dropdown('clear').addClass('disabled');
    		}
    	})

    	$('input[name="persona[persona_rut]"]').attr('readonly', 'true')
    	$('input[name="us_username"').val(result.model.persona_rut)
		$('#icon_person').show();



    		$('input[name="rol_id"]').parent().dropdown('set selected', result.rol).addClass('disabled');


    		$('input[name="rol_id"]').val(result.rol);





    }
});


$('input').on('change', function(){
	console.log($(this).attr('name'))
})




$('.icon_remove').on('click', function(){
	$('.persona').removeAttr('readonly').val('');
	$('.persona.dropdown').dropdown('clear').removeClass('disabled');
	$('input[name="rol_id"]').parent().dropdown('clear').removeClass('disabled');
	$(this).hide();
})

	$('.button_next').on('click', function(){
		var posicion = $(this).attr('posicion');
		var actual = posicion;
		var step = posicion
		posicion++;

/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

		$.ajax({
			url: '{{ route('validate.validate_user') }}',
			type:'post',
			dataType: 'json',
			data:$('form').serialize(),
			success: function(response){
				$('.field.error').removeClass('error');		

				if(response.success == 1){
					step_actual = document.getElementsByClassName(actual);
					$(step_actual).addClass('completed').removeClass('active');

			    	step_siguiente = document.getElementsByClassName(posicion);
			    	$(step_siguiente).removeClass('disabled').addClass('active');


			    	segment_actual = document.getElementById('step_'+actual);
			    	$(segment_actual).addClass('hide');

			    	segment_siguiente = document.getElementById('step_'+posicion);
			    	$(segment_siguiente).removeClass('hide');
			    	$('.ui.form').removeClass('error')
			    	$('.field.error').removeClass('error');
			    	$('input[name="step"]').val(posicion);

			    	if($('.step').length == posicion){
				    	$.each(response.data, function(index, value){
				    		console.log(index)
							$('.td_'+index).text(value);
				    	})
				    	$.each(response.data.persona, function(index, value){
				    		console.log(index)
							$('.td_'+index).text(value);
				    	})
				    	$.each(response.data.personal, function(index, value){
				    		console.log(index)
							$('.td_'+index).text(value);
				    	})
				    	var cargo = $('.dropdown.persona').children('.menu').children('.item.active.selected').text()
				    	var rol = $('.dropdown_cursos').children('.menu').children('.item.active.selected').text()
				    	$('.td_rol_id').text(rol);
				    	$('.td_cargo_id').text(cargo);
			    	}


				}else{
					if(response.tipo != null){
						var tipo = response.tipo+'_';
					}else{
						var tipo = '';
					}
					$('.list_error').html('')
			    	$.each(response.errors, function(index, value){
			    		$('<li>'+value+'</li>').appendTo('.list_error')
			    		if(step == 1){
				    		$('input[name="persona['+index+']"]').parent().addClass('error');
				    		$('input[name="persona['+index+']"]').parent().parent().parent('.field').addClass('error');
			    		}else{
				    		$('input[name="'+index+'"]').parent().addClass('error');
			    		}
			    	})
			    	$('.ui.form').addClass('error')
			    	$('.error.message').removeClass('hidden')
				}

				if(actual == 1){
					var rut = $('input[name="persona[persona_rut]"]').val();
					$('input[name="us_username"]').val(rut);
				}
			}
		})



/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/


	})
	$('.button_after').on('click', function(){
		var posicion = $(this).attr('posicion');
		var actual = posicion;
		posicion--;

		step_actual = document.getElementsByClassName(actual);
		$(step_actual).removeClass('active').addClass('disabled');

    	step_anterior = document.getElementsByClassName(posicion);
    	$(step_anterior).removeClass('completed').addClass('active');


    	segment_actual = document.getElementById('step_'+actual);
    	$(segment_actual).addClass('hide');

    	segment_anterior = document.getElementById('step_'+posicion);
    	$(segment_anterior).removeClass('hide');

    	$('input[name="step"]').val(posicion);


















/*
		step_actual = document.getElementById('step_'+actual);
    	step_siguiente = document.getElementById('step_'+posicion);
    	step_actual.classList.add("hide");
    	step_siguiente.classList.remove("hide");


		nav_step_actual = document.getElementById('step'+actual);
    	nav_step_anterior = document.getElementById('step'+posicion);
    	nav_step_actual.classList.remove("active");
    	nav_step_anterior.classList.remove("disabled");
    	nav_step_anterior.classList.add("active");


    	icon_step_next = document.getElementById('icon_step_'+posicion);
    	icon_step_actual = document.getElementById('icon_step_'+actual);
    	icon_step_actual.classList.remove("blue");
    	icon_step_next.classList.remove("teal");
    	icon_step_next.classList.add("blue");
    	$('.step .'.actual).addClass("disabled");*/
	})
</script>




@endsection
