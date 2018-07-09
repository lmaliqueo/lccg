@extends('admin.template.main')

@section('title', 'Administrar Planes de Estudios')

@section('content')


    <p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
                    <i class="clipboard outline icon"></i>
                    <i class="corner yellow settings icon"></i>
                </i>
            </span>
            <span style="border-bottom: 4px solid #FCDD13;">
                Administrar Planes de Estudios
            </span>
        </h2>
        <p>
            {{-- <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('asignaturas.index') }}"><i class="arrow left icon"></i> Volver</a> --}}
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('parametros.index') }}"><i class="arrow left icon"></i> Volver</a>
            <span class="pull-right">
                <a class="button small teal icon labeled ui" href="{{ route('plan_estudio.create') }}"><i class="plus icon"></i> Ingresar Nuevo Plan de Estudio</a>
            </span>
        </p>
    </p>


<div class="segment ui raised">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon paste"></i>
        Planes de Estudios
    </h4>
    <table class="ui celled table structured">
        <thead>
            <tr>
                <th class="center aligned" rowspan="2">ID</th>
                <th class="center aligned" colspan="2">Decreto</th>
                <th class="center aligned" rowspan="2">Estado</th>
                <th class="center aligned" rowspan="2">Niveles Curso</th>
                <th rowspan="2"></th>
                <th rowspan="2"></th>
            </tr>
            <tr>
                <th class="center aligned">Plan de Estudio</th>
                <th class="center aligned">Evaluación</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($planes as $plan)
                <tr data-tr="{{ $plan->pest_id }}" class="{{ ($plan->pest_estado) ? 'positive': 'negative' }}">
                    <td class="center aligned">{{ $plan->pest_id }}</td>
                    <td class="center aligned">{{ $plan->pest_numero.'/'.$plan->pest_ano }}</td>
                    <td class="center aligned">{{ $plan->pest_eval_num.'/'.$plan->pest_eval_ano }}</td>
                    <td td-state class="center aligned collapsing">{{ $plan->estado() }}</td>
                    <td class="collapsing">
                        @foreach ($plan->niveles_plan() as $nivel)
                        @php
                            if($nivel->nic_nivel == 1){
                                $color = 'bg-light-blue';
                            }elseif($nivel->nic_nivel == 2){
                                $color = 'bg-blue';
                            }elseif($nivel->nic_nivel == 3){
                                $color = 'bg-green';
                            }else{
                                $color = 'bg-green-active';
                            }
                        @endphp
                            <label class="label ui inverted {{ $color }}">{{ $nivel->nic_nivel.'°' }}</label>
                        @endforeach
                    </td>
                    <td class="collapsing">
                        <a class="button ui teal icon circular small" href="{{ route('plan_estudio.ver_planes', ['id'=>$plan->pest_id]) }}"><i class="eye icon"></i></a>
                        <a class="button ui blue icon circular small"  href="{{ route('plan_estudio.edit_plan', $plan->pest_id) }}"><i class="pencil icon"></i></a>
                        <a class="button ui small icon circular red btn-borrar" data-mens_info="Los cursos relacionados no tendran un plan de estudio asignado" data-id="{{ $plan->pest_id }}" data-ruta="{{ route('plan_estudio.delete_plan') }}"><i class="icon trash"></i></a>
                    </td>
                    <td class="collapsing">
                        <a class="ui button small inverted red icon state_plan" data-id="{{ $plan->pest_id }}" name="desactivar" {{ ($plan->pest_estado) ? '': 'style=display:none' }}><i class="icon delete"></i></a>
                        <a class="ui button small inverted green icon state_plan" data-id="{{ $plan->pest_id }}" name="activar" {{ ($plan->pest_estado) ? 'style=display:none': '' }}><i class="icon check"></i></a>
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script type="text/javascript">
    $('.state_plan').on('click', function(){

        var state = $(this).attr('name');
        var id = $(this).attr('data-id');
        if(state == 'activar'){
            var estado = 1;
            var text = "se incluira en los cursos del periodo actual";
        }else{
            var estado = 0;
            var text = "se excluira de los cursos del periodo actual";
        }
        var button = $(this);
        swal({
            title: "¿Esta seguro de "+state+" este plan de estudio?",
            text: text,
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
                        url: "{{ route('plan_estudio.ajax.update_state') }}",
                        type: "POST",
                        dataType:"JSON",
                        data: {_token:$('meta[name="csrf-token"]').attr('content'), estado:estado, id:id},
                        success: function(response){
                            if(estado == 1){
                                $(button).parent('td').parent('tr').removeClass('negative').addClass('positive');
                                $(button).parent('td').parent('tr').children('td[td-state]').text('Activo')
                            }else{
                                $(button).parent('td').parent('tr').removeClass('positive').addClass('negative');
                                $(button).parent('td').parent('tr').children('td[td-state]').text('Inactivo')
                            }
                            console.log($(button))
                            $(button).parent('td').children('a').show();
                            $(button).hide();
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






