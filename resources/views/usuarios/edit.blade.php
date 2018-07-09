@extends('admin.template.main')

@section('title', 'Editar Usuario')

@section('content')

	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="user circle icon"></i>
					<i class="corner yellow pencil icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
		        Editar Usuario | {{ $usuario->us_username }}
			</span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('usuarios.admin') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>

@if ($errors->any())
	<div class="ui error message">
		<i class="close icon"></i>
		<div class="header">
		Error en el formulario
		</div>
		<ul class="list list_error">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
		</ul>
	</div>
@endif

    {!! Form::open(['route' => ['usuarios.update', $usuario], 'method'=>'PUT', 'class'=>'ui form', 'id'=>'edit']) !!}

<div class="ui segment raised">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon user"></i>
        Persona
    </h4>


    	<table class="table ui celled">
    		<thead>
    			<tr>
    				<th style="width: 25%">Rut</th>
    				<td colspan="3" style="width: 75%">
                        <div class="field {{ ($errors->has('pe_rut')) ? 'error':'' }}">
                                {!! Form::text('persona[pe_rut]', $usuario->persona->pe_rut, ['placeholder'=>'Nombre del usuario', 'tipo-input'=>'rut', 'required']) !!}
                            
                        </div>
                    </td>
                </tr>
                <tr>
    				<th style="width: 25%">Nombre</th>
    				<td colspan="3" style="width: 75%">
                        <div class="fields" style="margin-bottom: 0px">
                            <div class="field wide eight {{ ($errors->has('pe_nombres')) ? 'error':'' }}">
                                {!! Form::text('persona[pe_nombres]', $usuario->persona->pe_nombres, ['placeholder'=>'Nombre del usuario', 'required']) !!}
                                
                            </div>
                            <div class="field wide four {{ ($errors->has('pe_apellido_pat')) ? 'error':'' }}">
                                {!! Form::text('persona[pe_apellido_pat]', $usuario->persona->pe_apellido_pat, ['placeholder'=>'Apellido Paterno del usuario', 'required']) !!}
                                
                            </div>
                            <div class="field wide four {{ ($errors->has('pe_apellido_mat')) ? 'error':'' }}">
                                {!! Form::text('persona[pe_apellido_mat]', $usuario->persona->pe_apellido_mat, ['placeholder'=>'Apellido Materno del usuario', 'required']) !!}
                                
                            </div>
                        </div>
                    </td>
    			</tr>
    			<tr>
    				<th>Contacto</th>
    				<td>
                        <div class="field {{ ($errors->has('pe_contacto')) ? 'error':'' }}">
                            {!! Form::text('persona[pe_contacto]', $usuario->persona->pe_contacto, ['placeholder'=>'Contacto']) !!}
                            
                        </div>
                    </td>
    				<th>Rol</th>
    				<td>{{ $usuario->rol->name }}</td>
    			</tr>
    		</thead>
    	</table>




</div>

<div class="segment ui">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon user outline"></i>
        Usuario
    </h4>
    	<table class="table ui celled">
    		<thead>
    			<tr>
    				<th style="width: 50%">Username</th>
    				<td style="width: 50%">
                        <div class="field {{ ($errors->has('us_username')) ? 'error':'' }}">
                            {!! Form::text('usuario[us_username]', $usuario->us_username, ['placeholder'=>'Nombre de Usuario']) !!}
                            
                        </div>
                    </td>
    			</tr>
    			<tr>
    				<th>Email</th>
    				<td>
                        <div class="field {{ ($errors->has('us_email')) ? 'error':'' }}">
                            {!! Form::email('usuario[us_email]', $usuario->us_email, ['placeholder'=>'Correo de Usuario']) !!}
                            
                        </div>
                    </td>
    			</tr>
    		</thead>
    	</table>

    <div class="field">
        <div class="ui toggle checkbox">
            <input type="checkbox" class="" name="confir_new_pass" value="1">
            <label>Modificar Password?</label>
        </div>
    </div>

    <div class="segment ui secondary" style="display: none;">
        <h4 class="ui horizontal divider header text-navy2">
            <i class="icon lock"></i>
            Nuevo Password
        </h4>
        <div class="field">
            {!! Form::label('usuario[password]', 'Password') !!}
        </div>
    </div>



		<div class="field">
            <a class="button ui teal " id="btn_submit">Guardar</a>
{{-- 
            {!! Form::submit('Guardar', ['class'=>'ui button teal']) !!}
             --}}
		</div>



</div>
    {!! Form::close() !!}

<script type="text/javascript">

    $('#btn_submit').on('click', function(){
        swal({
            title: "¿Esta seguro de modificar este usuario?",
            text: "ingrese su clave de usuario",
            type: "input",
            inputType: "password",
            showCancelButton: true,
            closeOnConfirm: false,
            animation: "slide-from-top",
            inputPlaceholder: "Contraseña",
        },
        function(inputValue){
            $.ajax({
                url: "{{ route('ajax.confirm_user') }}",
                type: "POST",
                dataType:"JSON",
                data: {_token:$('meta[name="csrf-token"]').attr('content') ,pass:inputValue},
                success: function(response){
                    console.log(response);
                    if(!response){
                        swal.showInputError("Ingrese los datos nuevamente");
                        return false;
                    }
                    if( response == 2){
                        swal.showInputError("La clave ingresada es incorrecta");
                        return false;
                    }else{
                        swal({
                            title: "Correcto",
                            timer: 1000,
                            type: "success",
                            showConfirmButton:false,
                        });

                        $('form').submit();
                    }
                    /*
                    $.ajax({
                        url: $('#edit').attr('action'),
                        type: "POST",
                        data: $('#edit').serialize(),
                        success: function(data){
                            console.log(data.success);

                            if(data.success == 0){
                                swal({   
                                    title: "Error en el formulario!",     
                                    timer: 1000,
                                    type: "error",   
                                    showConfirmButton: false 
                                });
                                $.each(data.errors, function(index, value){
                                    console.log(index+'=='+value);
                                })
                            }else{
                                    swal({
                                        title: "Guardado!",
                                        timer: 1000,
                                        type: "success",
                                        showConfirmButton:false,
                                    }, function(){
                                    window.history.back();

                                    });


                            }
                        }
                    });*/
                }
            })
        })
    })


    $('input[name="confir_new_pass"]').on('change', function(){
        if($(this).is(":checked")){
            var field = $('label[for="usuario[password]"]').parents('.field');
            $('<input name="usuario[password]" type="password" minlength="6" required>').appendTo($(field))
            $(field).parents().show();
        }else{
            $('input[name="usuario[password]"]').parents('.segment.secondary').hide();
            $('input[name="usuario[password]"]').remove()
        }
    })


</script>



@endsection
