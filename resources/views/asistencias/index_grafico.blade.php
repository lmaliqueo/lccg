@extends('admin.template.main')

@section('title', 'Gráfico Asistencias')

@section('content')

        {!! Charts::styles() !!}
	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="book icon"></i>
					<i class="corner yellow bar chart icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
		        Gráfico Asistencias
			</span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('academico.index') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>
<form class="ui form">
{!! Form::open(['class'=>'ui form', 'id'=>'form_grafico']) !!}


    <div class="segment ui raised secondary">
        <h4 class="ui horizontal divider header text-navy2">
            <i class="icon calendar checked"></i>
            Periodo Académico
            {{-- $clase->asignatura->asig_nombre --}}
        </h4>
        <table class="table ui celled small compact">
            <thead>
                <tr>
                    <th style="width: 25%;">Periodo</th>
                    <td style="width: 25%;" class="collapsing">
                            <div class="ui selection dropdown buscar_curso">
                                <input type="hidden" name="periodo" id="periodo">
                                    <i class="dropdown icon"></i>
                                <div class="default text">Periodo</div>
                                <div class="menu">
                                    @foreach ($periodos as $periodo)
                                        <div class="item item_ano" data-value="{{ $periodo->pac_id }}">{{ $periodo->pac_ano }}</div>
                                    @endforeach
                                </div>
                            </div>
                    </td>
                    <th style="width: 25%;">Semestre</th>
                    <td style="width: 25%;" class="collapsing">
                            <div class="ui selection dropdown dropdown_semestres disabled">
                                <input type="hidden" name="semestre" id="semestre">
                                    <i class="dropdown icon"></i>
                                <div class="default text">Semestre</div>
                                <div class="menu menu_semestres">
                                </div>
                            </div>
                    </td>
                </tr>
            </thead>
        </table>

    </div>

<div class="ui styled fluid accordion secondary margin-bottom animated fadeIn" style="display: none;">
    <div class="title" style="padding-bottom: 20px">
        <div class="ui inverted ribbon label large bg-navy2">
            <i class="icon options"></i> Opciones
        </div>      
    </div>
    <div class="content">
        <table class="table ui celled">
            <thead>
                <tr>
                    <th>Curso</th>
                    <td class="collapsing">
                            <div class="ui selection dropdown dropdown_cursos curso disabled" td="curso">
                                <input type="hidden" name="curso" id="curso">
                                    <i class="dropdown icon"></i>
                                <div class="default text"></div>
                                <div class="menu menu_cursos">
                                </div>
                            </div>
                            <a class="button ui circular icon bg-light-blue remove_cursos td_curso" drop="curso" style="display: none;"><i class="icon remove"></i></a>
                    </td>
                    <th>Estado</th>
                    <td class="collapsing">
                            <div class="ui selection dropdown">
                                <input type="hidden" name="estado" value="1">
                                    <i class="dropdown icon"></i>
                                <div class="default text"></div>
                                <div class="menu">
                                    <div class="item" data-value="1">Presentes</div>
                                    <div class="item" data-value="0">Ausentes</div>
                                </div>
                            </div>
                    </td>
                </tr>
                <tr>
                    <th>Fecha Inicial</th>
                    <td>
                        <input id="date_ini" type="date" name="fecha_ini" class="date_range" value="{{ ($fecha_ini != null) ? $fecha_ini->dc_fecha:'' }}" min="{{ ($fecha_ini != null) ? $fecha_ini->dc_fecha:'' }}" max="{{ ($fecha_fin != null) ? $fecha_fin->dc_fecha:'' }}" class="">
                    </td>
                    <th>Fecha Final</th>
                    <td>
                        <input id="date_fin" type="date" name="fecha_fin" class="date_range" value="{{ ($fecha_fin != null) ? $fecha_fin->dc_fecha:'' }}" min="{{ ($fecha_ini != null) ? $fecha_ini->dc_fecha:'' }}" max="{{ ($fecha_fin != null) ? $fecha_fin->dc_fecha:'' }}" class="">
                    </td>
                </tr>
            </thead>
        </table>

            <table class="table ui celled collapsing">
                <thead>
                    <tr>
                        <th>Cursos</th>
                        <td>
                            <div class="ui selection dropdown dropdown_cursos disabled cursos" td="cursos">
                                <input type="hidden" name="curso1" id="curso1">
                                    <i class="dropdown icon"></i>
                                <div class="default text"></div>
                                <div class="menu menu_cursos">
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="ui selection dropdown dropdown_cursos disabled cursos" td="cursos">
                                <input type="hidden" name="curso2" id="curso2">
                                    <i class="dropdown icon"></i>
                                <div class="default text"></div>
                                <div class="menu menu_cursos">
                                </div>
                            </div>
                        </td>
                        <td class="td_cursos" style="display: none;">
                            <a class="button ui circular icon bg-light-blue remove_cursos" drop="cursos"><i class="icon remove"></i></a>
                            
                        </td>
                    </tr>
                </thead>
            </table>
            

<input type="hidden" name="mes">
<input type="hidden" name="mes_date">
  </div>
</div>

    


<div class="text-center margin-bottom">
    <a class="ui button teal labeled icon disabled ver_grafico"><i class="icon line chart"></i> Ver Gráfico</a>
</div>
{!! Form::close() !!}

<div class="margin-bottom text-center animated fadeInDown" id="menu_meses" style="display: none;">
    <div class="ui pointing menu compact inverted bg-navy2">
        <a value="1" class="item menu_mes">
            Enero
        </a>
        <a value="2" class="item menu_mes">
            Febrero
        </a>
        <a value="3" class="item menu_mes">
            Marzo
        </a>
        <a value="4" class="item menu_mes">
            Abril
        </a>
        <a value="5" class="item menu_mes">
            Mayo
        </a>
        <a value="6" class="item menu_mes">
            Junio
        </a>
        <a value="7" class="item menu_mes">
            Julio
        </a>
        <a value="8" class="item menu_mes">
            Agosto
        </a>
        <a value="9" class="item menu_mes">
            Septiembre
        </a>
        <a value="10" class="item menu_mes">
            Octubre
        </a>
        <a value="11" class="item menu_mes">
            Noviembre
        </a>
        <a value="12" class="item menu_mes">
            Diciembre
        </a>
        <a value="ano" class="item active menu_mes ano">
            2017
        </a>
    </div>
    
</div>
<div id="chart_content" class="segment ui raised" style="display: none;">
    
        {!! Charts::scripts() !!}



</div>


    <script src="{{ asset('plugins/semantic/semantic.js')}}"></script>


<script type="text/javascript">
    var token = $('meta[name="csrf-token"]').attr('content');


    $('.menu_mes').on('click', function(){
        var mes = $(this).attr('value');
        var año = $('.item_ano.active.selected').text();
        var mes_text = $(this).text();
        if(mes != 'ano'){
            if(mes.length == 1){
                mes = 0+mes;
            }
        }
        $('.menu_mes').removeClass('active');
        $(this).addClass('active');


        fecha=new Date(año, mes, 0);
        fecha_ini=new Date(año, mes, 1);

        date_ini = año+'-'+mes+'-01';
        date_fin = año+'-'+mes+'-'+fecha.getDate();

        //$('input[name=fecha_ini]').attr('value', date_ini).attr('min', date_ini).attr('max', date_fin)
        //$('input[name=fecha_fin]').attr('value', date_fin).attr('min', date_ini).attr('max', date_fin)
        $('input[name=mes]').val(mes_text)
        $('input[name=mes_date]').val(mes)
        $.ajax({
            url:'{{ route('asistencia.view_grafico') }}',
            data: $('form').serialize(),
            type:'post',
            success:function(response){
                $('#chart_content').html(response).show();
            }
        })
    })



    $('.buscar_curso').on('change', function(){
        $('.accordion_options').addClass('hide');
        var periodo = $('#periodo').val();
        var ano = $(this).children('.text').text();
        $('.menu_mes.ano').text(ano);
        /*var nivel = $('#nivel').val();
        var letra = $('#letra').val();
        if(periodo != '' && nivel != '' && letra != '')*/
        if(periodo != '')
        {
            $.ajax({
                url: '{{ route('ajax.buscar_semestre') }}',
                type: 'post',
                dataType: "JSON",
                data: {_token:token, periodo:periodo/*, nivel:nivel, letra:letra*/ },
                success: function(response) {
                    $('.dropdown_semestres').removeClass('disabled');
                    $('.menu_semestres').html(response);
                    //$('.curso_tr').addClass('positive').removeClass('warning')
                    $('.ui.accordion').show();
                }
            });
            $.ajax({
                url: '{{ route('ajax.buscar_curso') }}',
                type: 'post',
                dataType: "JSON",
                data: {_token:token, periodo:periodo/*, nivel:nivel, letra:letra*/ },
                success: function(response) {
                    //$('.dropdown_semestres').removeClass('disabled');
                    $('.menu_cursos').html(response);
                    $('.dropdown_cursos').removeClass('disabled');
                    //$('.curso_tr').addClass('positive').removeClass('warning')
                }
            });

        }else{
            //$('.curso_tr').removeClass('positive warning')
        }
    });




    $('input').on('change', function(){
        $('.ver_grafico').removeClass('disabled');
    })




    $('.ver_grafico').on('click', function(){
        $(this).addClass('disabled');
        $.ajax({
            url:'{{ route('asistencia.view_grafico') }}',
            data: $('form').serialize(),
            type:'post',
            success:function(response){
                $('#chart_content').html(response).show();
                $('#menu_meses').show();
            }
        })
    })


    $('.dropdown_cursos').on('change', function(){
        var td = $(this).attr('td');
        var value = $(this).children('input').val();
        if(value != ''){
            if(td == 'cursos'){
                $('.curso.dropdown').dropdown('clear').attr('readonly', 'true');
                $('.td_curso').hide();
            }else{
                $('.cursos.dropdown').dropdown('clear').attr('readonly', 'true');
                $('.td_cursos').hide();
            }

        }
        $('.td_'+td).show();
        $('.td_'+td).children('.ui.button').show();
    })

    $('.remove_cursos').on('click', function(){
        var drop = $(this).attr('drop');
        $('.dropdown_cursos').removeAttr('readonly')
        $('.dropdown.'+drop).dropdown('clear');
        $(this).parent('.td_'+drop).hide();
        $(this).hide()
    })

</script>









@endsection
