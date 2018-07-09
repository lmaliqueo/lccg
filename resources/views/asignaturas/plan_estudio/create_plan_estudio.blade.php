@extends('admin.template.main')

@section('title', 'Nuevo Plan de Estudio')

@section('content')



	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="clipboard outline icon"></i>
					<i class="corner yellow add icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
		        Nuevo Plan de Estudio
			</span>
        </h2>
        <p>
            {{-- <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('asignaturas.index') }}"><i class="arrow left icon"></i> Volver</a> --}}
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('plan_estudio.admin_planes') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>
			{!! Form::open(['route' => 'plan_estudio.store', 'method'=>'POST', 'class'=>'ui form small']) !!}




<div class="segment ui">
    <div class="grid ui two columns margin-bottom">
        <div class="column margin-bottom">
            <div class="segment ui raised secondary margin-bottom">
                <h4 class="ui horizontal divider header text-navy2">
                    <i class="icon clipboard outline"></i>
                    Plan de Estudio
                </h4>
                <table class="table ui small">
                    <thead>
                        <tr>
                            <th style="width: 25%">{!! Form::label('plan_estudio[pest_numero]', 'Numero') !!}</th>
                            <td style="width: 25%">{!! Form::number('plan_estudio[pest_numero]', null, ['min'=>1, 'required']) !!}</td>
                        </tr>
                        <tr>
                            <th style="width: 25%">{!! Form::label('plan_estudio[pest_ano]', 'Año Plan de Estudio') !!}</th>
                            <td style="width: 25%">{!! Form::select('plan_estudio[pest_ano]', $array_años, null, ['placeholder'=>'', 'class'=>'ui fluid selection dropdown', 'required']) !!}</td>
                        </tr>
                    </thead>
                </table>
                
            </div>
        </div>
        <div class="column margin-bottom">
            <div class="ui segment raised secondary">
                <h4 class="ui horizontal divider header text-navy2">
                    <i class="icon pencil"></i>
                    Evaluación
                </h4>
                    <table class="table ui small">
                        <thead>
                            <tr>
                                <th style="width: 25%">{!! Form::label('plan_estudio[pest_eval_num]', 'Numero Evaluación') !!}</th>
                                <td style="width: 25%">
                                    <div class="field">
                                        {!! Form::number('plan_estudio[pest_eval_num]', null, ['min'=>1, 'required']) !!}
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 25%">{!! Form::label('plan_estudio[pest_eval_ano]', 'Año Evaluación') !!}</th>
                                <td style="width: 25%">
                                    <div class="field">
                                        {!! Form::select('plan_estudio[pest_eval_ano]', $array_años, null, ['placeholder'=>'', 'class'=>'ui fluid selection dropdown', 'required']) !!}
                                    </div>
                                </td>
                            </tr>
                        </thead>
                    </table>
            </div>
            
        </div>
    </div>
{{-- 
            {!! Form::hidden('nivel_id', null, ['placeholder'=>'', ]) !!}
             --}}
        <div class="field wide eight">
            {!! Form::label('niveles', 'Niveles Cursos') !!}
            {!! Form::select('niveles[]', [1=>'1°', 2=>'2°', 3=>'3°', 4=>'4°'], null, ['class'=>'ui fluid multiple selection dropdown niveles','placeholder'=>'', 'multiple', 'required']) !!}
        </div>



</div>


    <div class="text-center margin-bottom">
        <div class="ui pointing menu compact margin-bottom">
            <a value="1" class="item menu_grado" style="display: none;" data-tab="1">1° Grado</a>
            <a value="2" class="item menu_grado" style="display: none;" data-tab="2">2° Grado</a>
            <a value="3" class="item menu_grado" style="display: none;" data-tab="3">3° Grado</a>
            <a value="4" class="item menu_grado" style="display: none;" data-tab="4">4° Grado</a>


        </div>
        
    </div>



@for ($i = 1; $i <= 4 ; $i++)
    <div class="ui bottom attached tab animated fadeIn margin-bottom" data-tab="{{ $i }}">


        <div class="segment ui raised" nivel="{{ $i }}" cont_tr="0">
            <h4 class="ui horizontal divider header text-navy2">
                <i class="icon copy"></i>
                Asignaturas | Nivel {{ $i }}°
            </h4>
            <div class="fields">
                <div class="field wide eight">
                    {!! Form::label('asignaturas_tr', 'Asignaturas') !!}

                    <div class="ui selection dropdown asignar_asig">
                        <input type="hidden" name="asignatura_tr">
                            <i class="dropdown icon"></i>
                        <div class="default text">--Seleccionar Asignatura--</div>
                        <div class="menu menu_asig{{ $i }}">
                            @foreach ($asignaturas as $asig)
                                <div class="item" data-value="{{ $asig->asig_id }}">
                                    <span class="description {{ ($asig->asig_tipo_asignatura == 1) ? 'text-blue':'text-green' }}">{{ $asig->tipo_asig() }}</span>
                                    <span class="text">{{ $asig->asig_nombre }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>



                </div>                
            </div>
                    <div class="segment ui secondary">
                        <h4 class="ui horizontal divider header text-navy2">
                            <i class="icon list"></i>
                            Plan Básico
                        </h4>
                        <table class="table ui celled">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Asignatura</th>
                                    <th>Nombre Corto</th>
                                    <th class="collapsing">Cat. Horas</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="tr_plan_asig{{ $i }}" data-tipo="1">
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="segment ui secondary">
                        <h4 class="ui horizontal divider header text-navy2">
                            <i class="icon tasks"></i>
                            Plan Electivo
                        </h4>
                        <table class="table ui celled">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Asignatura</th>
                                    <th>Nombre Corto</th>
                                    <th class="collapsing">Cat. Horas</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="tr_plan_asig_elec{{ $i }}" data-tipo="2">
                            </tbody>
                        </table>
                    </div>
                    

        </div>

    </div>
@endfor






<div class="segment ui raised secondary animated fadeIn" style="display: none;" id="body_plan">
	



</div>
				<div class="text-center">
					{!! Form::submit('Guardar', ['class'=>'ui button teal', 'cont'=>0, 'id'=>'subm_buttom']) !!}
				</div>


			{!! Form::close() !!}













<script type="text/javascript">
	var token = $('meta[name="csrf-token"]').attr('content');
    {{-- 
                    $('.nivel_id').on('change', function(){
                        var id = $('input[name="plan_estudio[pest_ano_inicio]"]').val();
                        var grado = $(this).val();
                        $.ajax({
                            url:'{{ route('plan_estudio.table_plan_estudio') }}',
                            type:'post',
                            data:{_token:token, id:id},
                            success: function(response){
                                $('#body_plan').html(response).show();
                            }
                        })
                    })
                 --}}

    $('.niveles').on('change', function(){
        $('.menu_grado').hide().removeClass('active');
        $('.attached.tab').removeClass('active')
        $.each($(this).val(), function(index, value){
            console.log(index)
            if(index == 0){
                $('a[data-tab="'+value+'"]').addClass('active')
                $('div[data-tab="'+value+'"]').addClass('active')
            }
            $('a[data-tab="'+value+'"]').show()
        })
    })

    $('.asignar_asig').on('change', function(){
    	var id = $(this).children('input[name="asignatura_tr"]').val();

        if(id != ''){
            var grado = $('.menu_grado.active').attr('data-tab');
            var i = $('div[data-tab="'+grado+'"]').children('.ui.segment').attr('cont_tr');

            i++;
            $('div[data-tab="'+grado+'"]').children('.ui.segment').attr('cont_tr', i);

            $.ajax({
                url: "{{ route('plan_estudio.ajax.buscar_asig') }}",
                type: 'post',
                data: {_token:token, id:id, grado:grado},
                success: function(response){
                    if(response.tipo == 1){
                        var tr = document.getElementsByClassName('tr_plan_asig'+grado);
                    }else{
                        var tr = document.getElementsByClassName('tr_plan_asig_elec'+grado);
                    }
                    $('<tr class="animated fadeInDown"><td>'+response.id+'</td><td>'+response.nombre+'</td><td>'+response.nombre_corto+'</td><td><div class="field"><input class="form-control" name="horas['+response.id+grado+'][horas]" required type="number" min="1" value="1"><input class="form-control" name="horas['+response.id+grado+'][asignaturas]" type="hidden" value="'+response.id+'"><input class="form-control" name="horas['+response.id+grado+'][nivel]" type="hidden" value="'+response.grado+'"></div></td><td class="collapsing"><a class="ui remove_asig button small negative circular icon rem_trow" nom_asig="'+response.nombre+'" id_asig="'+response.id+'"><i class="icon remove"></i></a></td></tr>').appendTo(tr);
                    $('.item.selected.active').remove();
                    //$('.tr_plan_asig')
                }
            })

        }
	    //var i = $('.tr_asig tr').length + 1;
    })

    $(document).on('click', '.remove_asig', function(){
        var id = $(this).attr('id_asig');
        var nombre = $(this).attr('nom_asig');
        var grado = $('.menu_grado.active').attr('data-tab');
        if($(this).parent().parent('tr').parent('tbody').attr('data-tipo') == 1){
            var tipo = 'Básico';
            var text = 'blue';
        }else{
            var tipo = 'Electivo'
            var text = 'green';
        }
        $('<div class="item" data-value="'+id+'"><span class="description text-'+text+'">'+tipo+'</span><span class="text">'+nombre+'</span></div>').appendTo('.menu_asig'+grado);
        $(this).parent().parent('tr').remove();
        $('.menu_asig'+grado).parent('.asignar_asig').dropdown('clear')
    })


</script>







@endsection
