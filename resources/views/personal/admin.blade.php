@extends('admin.template.main')

@section('title', 'Empleados')

@section('content')




	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="users icon"></i>
					<i class="corner yellow settings icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
		        Administrar Empleados
			</span>
        </h2>
        <p>
            {{-- <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('empleados.index') }}"><i class="arrow left icon"></i> Volver</a> --}}
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('parametros.index') }}"><i class="arrow left icon"></i> Volver</a>
			<span class="pull-right">
			    <a class="button ui icon labeled teal small" href="{{ route('empleados.create') }}"><i class="add icon"></i> Ingresar Empleado</a>
			    
			</span>
        </p>
	</p>
<div class="ui styled fluid accordion margin-bottom accordion_options">
		  <div class="title">
		    <i class="dropdown icon"></i>
		    Cargos
		  </div>
	<div class="content">
    <a id="modalButton" class="ui button teal small labeled circular icon" header="Nuevo Cargo" url="{{ route('empleados.create_cargo') }}"><i class="icon add"></i> Agregar Cargo</a>
		<table class=" ui table celled small">
			<thead>
				<tr>
					<th>ID</th>
					<th>Cargo</th>
					<th>Cantidad Empleados</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($cargos as $cargo)
					<tr>
						<td>{{ $cargo->ca_id }}</td>
						<td>{{ $cargo->ca_nombre }}</td>
						<td>
							{{ $cargo->personal->count() }}
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

<div class="segment ui raised">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon users"></i>
        Empleados
    </h4>
	<table class="ui table celled">
		<thead>
			<tr>
				<th>RUT</th>
				<th>Nombre</th>
				<th>Cargo</th>
				<th>Estado</th>
				<th>Contacto</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		@foreach ($personal as $empleado)
			<tr data-tr="{{ $empleado->pers_id }}">
				<td>{{ $empleado->persona_rut }}</td>
				<td>{{ $empleado->persona->nombreCompleto() }}</td>
				<td>{{ $empleado->cargo->ca_nombre }}</td>
				<td id="state_{{ $empleado->pers_id }}" class="collapsing center aligned"><label class="label ui {{ ($empleado->pers_estado) ? 'green':'red' }}">{{ $empleado->estado() }}</label></td>
				<td>{{ $empleado->persona->pe_contacto }}</td>
				<td class="collapsing">
                    <a class="button ui small icon circular twitter modalButton" header="Empleado #{{ $empleado->pers_id }}" url="{{ route('empleados.show', $empleado->pers_id) }}"><i class="icon eye"></i></a>
                    <a class="button ui small icon circular blue modalButton" header="Actualizar Empleado {{ $empleado->persona_rut }}" url="{{ route('empleados.edit', $empleado->pers_id) }}"><i class="icon pencil"></i></a>

                    <a class="button ui small icon circular red btn-borrar" data-mens_info="El empleado se borrara junto con su cuenta de usuario existente" data-id="{{ $empleado->pers_id }}" data-ruta="{{ route('empleados.delete_empleado') }}"><i class="icon trash"></i></a>
				</td>
				<td class="collapsing">
                    @if ($empleado->pers_estado)
                        <a id="des_{{ $empleado->pers_id }}" class="ui button small red icon inverted state_user" id_user="{{ $empleado->pers_id }}" name="inhabilitar"><i class="remove icon"></i></a>
                        <a id="act_{{ $empleado->pers_id }}" class="ui button small green icon inverted state_user" id_user="{{ $empleado->pers_id }}" name="habilitar" style="display: none;"><i class="check icon"></i></a>
                    @else
                        <a id="des_{{ $empleado->pers_id }}" class="ui button small red icon inverted state_user" id_user="{{ $empleado->pers_id }}" name="inhabilitar" style="display: none;"><i class="remove icon"></i></a>
                        <a id="act_{{ $empleado->pers_id }}"  class="ui button small green icon inverted state_user" id_user="{{ $empleado->pers_id }}" name="habilitar"><i class="check icon"></i></a>
                    @endif
				</td>
			</tr>
		@endforeach
		</tbody>
        <tfoot>
            <tr>
                <th colspan="9">
                    {{ $personal->links() }}
                </th>
            </tr>
        </tfoot>
	</table>
</div>

	
<script type="text/javascript">
	$('.state_user').on('click', function(){

		var state = $(this).attr('name');
        var id = $(this).attr('id_user');
		if(state == 'habilitar'){
            var estado = 1;
        }else{
            var estado = 0;
        }

    	swal({
    		title: "¿Esta seguro de "+state+" este empleado?",
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
    					swal.showInputError("usted no tiene permisos para editar este empleado");
    					return false;
    				}
                    $.ajax({
                        url: "{{ route('empleados.edit_status') }}",
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
                        timer: 1500,
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
