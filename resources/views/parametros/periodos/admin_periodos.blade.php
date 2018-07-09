@extends('admin.template.main')

@section('title', 'Administrar Periodos Academicos')

@section('content')

	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="alternate calendar icon"></i>
					<i class="corner yellow settings icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
		        Administrar Periodos Academicos
			</span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('parametros.index') }}"><i class="arrow left icon"></i> Volver</a>
			@if ($periodos->where('pac_estado', 1) == '[]')
				<span class="pull-right">
					<a id="modalButton" class="ui button teal icon labeled small" header="Nuevo Periodo Académico" url="{{ route('periodo.create') }}"><i class="icon plus"></i> Crear Periodo Academico</a>
				</span>
			@endif
        </p>
	</p>


<div class="ui raised segment">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon checked calendar"></i>
        Periodos Academicos
    </h4>
	<table class="ui table celled selectable">
		<thead>
			<tr>
				<th>Año</th>
				<th>Fecha Inicio</th>
				<th>Fecha Término</th>
				<th>Estado</th>
				<th>Semestres</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		@foreach ($periodos as $periodo)
			<tr>
				<td>{{ $periodo->pac_ano }}</td>
				<td>{{ $periodo->pac_fecha_inicio }}</td>
				<td>{{ $periodo->pac_fecha_termino }}</td>
				<td>{{ $periodo->estado() }}</td>
				<td class="center aligned">
					@php
						$flag = 0;
					@endphp
					@if ($periodo->semestres != '[]')
						@foreach ($periodo->semestres as $semestre)
							@if ($periodo->pac_estado == 1)
								@if ($semestre->sem_estado == 0)
									@if ($flag == 0)
										<a class="ui tag label status_sem" id_sem="{{ $semestre->sem_id }}">{{ $semestre->sem_numero }}° Semestre</a>
									@else
										<a class="ui tag label" id_sem="{{ $semestre->sem_id }}">{{ $semestre->sem_numero }}° Semestre</a>
									@endif
								@elseif($semestre->sem_estado == 1)
									@php
										$flag= $semestre->sem_id;
									@endphp
									@if ($semestre->sem_fecha_inicio > date('Y-m-d'))
										<a class="ui tag blue label status_sem">{{ $semestre->sem_numero }}° Semestre</a>
									@else
										<a class="ui tag blue label">{{ $semestre->sem_numero }}° Semestre</a>
									@endif
								@else
									<a class="ui tag green label status_sem" id_sem="{{ $semestre->sem_id }}">{{ $semestre->sem_numero }}° Semestre</a>
								@endif
							@else
								<a class="ui green label" id_sem="{{ $semestre->sem_id }}">{{ $semestre->sem_numero }}° Semestre</a>
							@endif
						@endforeach
					@else
						<em class="text-red">Sin semestres</em>
					@endif
				</td>
				<td class="collapsing">
					@if ($periodo->semestres->count() < 2)
						<a class="ui button small circular green icon semestres_btn" num="1" data-tooltip="Generar semestre" per_id="{{ $periodo->pac_id }}" data-inverted=""><i class="plus icon"></i></a>
					@endif
					@foreach ($periodo->semestres as $semestre)
						@if ($semestre->sem_estado == 1)
							<a class="ui button small circular orange icon fin_semestre" sem_id="{{ $semestre->sem_id }}" data-tooltip="Finalizar {{ $semestre->sem_numero }}° semestre" per_id="{{ $periodo->pac_id }}" data-inverted="" num_sem="{{ $semestre->sem_numero }}"><i class="flag icon"></i></a>
						@endif
					@endforeach
					@if (($periodo->semestres->avg('sem_estado') == 2) &&  ($periodo->pac_estado == 1))
						<a class="button ui circular icon labeled small teal fin_periodo" id_per="{{ $periodo->pac_id }}" ano_per="{{ $periodo->pac_ano }}"><i class="flag icon"></i> Finalizar Periodo</a>
					@endif
					@if ($periodo->pac_estado != 2)
                        <a class="ui blue icon button small circular modalButton" header="Editar Periodo | {{ $periodo->pac_ano }}" url="{{ route('periodo.edit', $periodo->pac_id) }}"><i class="icon pencil"></i></a>
					@endif
					<a class="ui button small icon twitter circular modalButton" header="Ver Periodo | {{ $periodo->pac_ano }}" url="{{ route('periodo.show', $periodo->pac_id) }}" data-tooltip="Ver periodo" data-inverted><i class="eye icon"></i></a>
				</td>
			</tr>
		@endforeach
		</tbody>
		
	</table>
</div>
	

<script type="text/javascript">
	var token = $('meta[name="csrf-token"]').attr('content');
    $('.semestres')
		.popup({
			inline     : true,
			hoverable  : true,
			position   : 'top center',
			on    : 'click',
			delay: {
				show: 200,
				hide: 400
			}
		})
    ;
    $('.semestres_btn').on('click', function(){
    	var id = $(this).attr('per_id');
    	$.ajax({
    		url: '{{ route('periodo.add_semestre') }}',
    		type: 'post',
    		data: {_token:token, id:id},
    		success: function(response){
                $('.modalContent').html(response);
                $('#modaldiv').modal('show');
                $('.header-modal').html('Generar semestre');

    		}
    	})
    })
    $('.fin_periodo').on('click', function(){
    	var id = $(this).attr('id_per');
    	var ano = $(this).attr('ano_per');
    	swal({
    		title: "¿Seguro que desas finalizar el periodo academico "+ano+"?",
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
    			data: {_token:token ,pass:inputValue},
    			success: function(response){
    				if(!response){
    					swal.shoeInputError("Ingrese datos nuevamente");
    					return false;
    				}
    				if( response == 2){
    					swal.showInputError("usted no tiene permisos para editar notas de este curso");
    					return false;
    				}
    				if(response){
				            $.ajax({
				                url: "{{ route('periodo.fin_periodo') }}",
				                type: "POST",
				                dataType:"JSON",
				                data: {_token:token ,id:id},
				                success: function(response){

				                }
				            });
			                    swal({
			                        title: "Correcto!",
			                        timer: 1000,
			                        type: "success",
			                        showConfirmButton:false,
			                    }, function(){
				                	location.reload(true);

			                    });

    				}
    			}
    		});
    	})
    })


    $('.fin_semestre').on('click', function(){
    	var num = $(this).attr('num_sem');
    	var id = $(this).attr('sem_id');
    	swal({
    		title: "¿Confirmar término del "+num+"° Semestre?",
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
    			data: {_token:token ,pass:inputValue},
    			success: function(response){
    				if(!response){
    					swal.shoeInputError("Ingrese datos nuevamente");
    					return false;
    				}
    				if( response == 2){
    					swal.showInputError("usted no tiene permisos para editar notas de este curso");
    					return false;
    				}
    				if(response){
				            $.ajax({
				                url: "{{ route('periodo.fin_sem') }}",
				                type: "POST",
				                dataType:"JSON",
				                data: {_token:token ,id:id},
				                success: function(response){
				                }
				            });
		                    swal({
		                        title: "Correcto!",
		                        timer: 1000,
		                        type: "success",
		                        showConfirmButton:false,
		                    }, function(){
			                	location.reload(true);

		                    });

    				}
    			}
    		});
    	})
    })



    $('.status_sem').on('click', function(){
    	var text = $(this).text();
    	var id = $(this).attr('id_sem');
    	swal({
    		title: "¿Confirmar inicio del "+text+"?",
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
    					swal.showInputError("usted no tiene permisos para editar notas de este curso");
    					return false;
    				}
    				if(response){
				            $.ajax({
				                url: "{{ route('periodo.active_sem') }}",
				                type: "POST",
				                dataType:"JSON",
				                data: {_token:$('meta[name="csrf-token"]').attr('content') ,id:id},
				                success: function(response){
				                }
				            });
				                    swal({
				                        title: "Correcto!",
				                        timer: 1000,
				                        type: "success",
				                        showConfirmButton:false,
				                    }, function(){
		                	location.reload(true);

				                    });

    				}
    			}
    		});
    	})
    })



</script>

@endsection
