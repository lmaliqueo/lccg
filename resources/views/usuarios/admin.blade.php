@extends('admin.template.main')

@section('title', 'Administrar Usuarios')

@section('content')


	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="user circle icon"></i>
					<i class="corner yellow settings icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
		        Administrar Usuarios
			</span>
        </h2>
        <p>
            {{-- <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('usuarios.index') }}"><i class="arrow left icon"></i> Volver</a> --}}
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('parametros.index') }}"><i class="arrow left icon"></i> Volver</a>
            <span class="pull-right">
                <a class="button ui icon labeled teal small" href="{{ route('usuarios.create') }}"><i class="add icon"></i> Crear Usuario</a>
                
            </span>
        </p>
	</p>

<div class="segment ui raised">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon user circle"></i>
        Usuarios
    </h4>
    <table class="ui celled table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Rut</th>
                <th>Cuenta</th>
                <th>Correo</th>
                <th>Estado</th>
                <th class="center aligned">Rol</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
                <tr data-tr="{{ $usuario->us_id }}">
                    <td>{{ $usuario->us_id }}</td>
                    <td>{{ $usuario->persona_rut }}</td>
                    <td>{{ $usuario->us_username }}</td>
                    <td>{{ $usuario->us_email }}</td>
                    <td id="state_{{ $usuario->us_id }}" class="center aligned"><label class="label ui {{ ($usuario->us_estado) ? 'green':'red' }}">{{ $usuario->estado() }}</label></td>
                    <td class="center aligned">{{ $usuario->rol->name }}</td>
                    <td class="collapsing">
                        <a class="button ui small icon circular twitter modalButton" header="Usuario {{ $usuario->us_username }}" url="{{ route('usuarios.show', $usuario->us_id) }}"><i class="icon eye"></i></a>
                        <a class="ui blue icon button small circular" href="{{ route('usuarios.edit', $usuario->us_id) }}" data-tooltip="Editar Usuario"><i class="pencil icon"></i></a>
                        @if (Auth::user()->us_id != $usuario->us_id)
                            <a class="button ui small icon circular red btn-borrar" data-mens_info="Se eliminara solo la cuenta del usuario" data-id="{{ $usuario->us_id }}" data-ruta="{{ route('usuario.delete_user') }}"><i class="icon trash"></i></a>
                        @endif
                    </td>
                    <td class="collapsing" id="button_{{ $usuario->us_id }}">
                        @if (Auth::user()->us_id != $usuario->us_id)
                            @if ($usuario->us_estado == 1)
                                <a id="des_{{ $usuario->us_id }}" class="ui button small red icon inverted state_user" id_user="{{ $usuario->us_id }}" name="desactivar"><i class="remove icon"></i></a>
                                <a id="act_{{ $usuario->us_id }}" class="ui button small green icon inverted state_user" id_user="{{ $usuario->us_id }}" name="activar" style="display: none;"><i class="check icon"></i></a>
                            @else
                                <a id="des_{{ $usuario->us_id }}" class="ui button small red icon inverted state_user" id_user="{{ $usuario->us_id }}" name="desactivar" style="display: none;"><i class="remove icon"></i></a>
                                <a id="act_{{ $usuario->us_id }}"  class="ui button small green icon inverted state_user" id_user="{{ $usuario->us_id }}" name="activar"><i class="check icon"></i></a>
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
</div>




<script type="text/javascript">
	$('.state_user').on('click', function(){

		var state = $(this).attr('name');
        var id = $(this).attr('id_user');
		if(state == 'activar'){
            var estado = 1;
        }else{
            var estado = 0;
        }

    	swal({
    		title: "¿Esta seguro de "+state+" este usuario?",
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
    				if(!response){
    					swal.showInputError("Ingrese datos nuevamente");
    					return false;
    				}
    				if( response == 2){
    					swal.showInputError("usted no tiene permisos para editar este usuario");
    					return false;
    				}
                    $.ajax({
                        url: "{{ route('usuario.modificar_estado') }}",
                        type: "POST",
                        dataType:"JSON",
                        data: {_token:$('meta[name="csrf-token"]').attr('content'), estado:estado, id:id},
                        success: function(response){
                            if(response.status == 1){
                                button = document.getElementById('des_'+response.id);
                                label = '<label class="ui label green">'+response.estado+'</label>';
                                button_hide = document.getElementById('act_'+response.id);
                            }else{
                                button = document.getElementById('act_'+response.id);
                                label = '<label class="ui label red">'+response.estado+'</label>';
                                button_hide = document.getElementById('des_'+response.id);
                            }
                            td_state = document.getElementById('state_'+response.id);
                            $(td_state).html(label);
                            $(button).show();
                            $(button_hide).hide();
                        }
                    });
                    swal({
                        title: "Correcto!",
                        timer: 2000,
                        type: "success",
                        showConfirmButton:false,
                    });
                    $('.input_retiro').addClass('hide');
    			}
    		});
    	})



	})
</script>

@endsection
