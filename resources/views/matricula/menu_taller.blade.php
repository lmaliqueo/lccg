@extends('admin.template.main')

@section('title', 'Matriculas')

@section('content')


	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="open folder outline icon"></i>
					<i class="corner yellow edit icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
		        Inscribir Taller
			</span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('matriculas.index') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>

@if ($periodo != null)

    @if (!$periodo->cursos->where('cu_tipo', 2)->count())
        <div class="ui error icon message">
            <i class="warning circle icon"></i>
            <div class="content">
                <div class="header">
                    No hay talleres disponibles en este año
                </div>
                <p>Deben ingresarse antes de realizar esta acción</p>
            </div>
        </div>
    @else
        <div id="mensajes">
        </div>



        <div class="ui segment raised info_inputs secondary animated fadeIn">
            <h4 class="ui horizontal divider header text-navy2">
                <i class="icon student"></i>
                Alumno
            </h4>

            <div class="ui info visible message">

                <p><i class="icon info circle"></i> Ingrese el Rut o nombre del alumno</p>
            </div>

            <form class="ui form">
                
                <div class="two fields">

                    <div class="field">


                        {!! Form::label('persona[persona_rut]', 'Rut Alumno') !!}
                        <div class="ui search fluid focus" data-tipo="rut">
                            <div class="ui icon input">
                                <input class="prompt persona" type="text" placeholder="" autocomplete="off" name="matricula[mat_id]">
                                <i class="search icon inverted red circular remove link icon_remove" id="icon_person" style="display: none;" value="alumno"></i>
                            </div>
                        </div>


                    </div>
                    <div class="field">
                        {!! Form::label('alumno[nombre]', 'Nombre Alumno') !!}
                        <div class="ui search fluid focus" data-tipo="nombre">
                            <div class="ui icon input">
                                <input class="prompt persona" type="text" placeholder="" autocomplete="off" name="alumno[nombre]">
                                <i class="search icon inverted red circular remove link icon_remove" id="icon_person" style="display: none;" value="alumno"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>



        <div class="ui raised segment secondary info_matricula animated fadeIn" style="display: none;">
            <h4 class="ui horizontal divider header text-navy2">
                <i class="icon student"></i>
                Alumno
            </h4>
            <a class="ui red right corner label cancelar_button">
                <i class="remove icon"></i>
            </a>
            <table class="ui table celled">
                <thead>
                    <tr>
                        <th>N° Matricula</th>
                        <th>Rut</th>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th>Genero</th>
                        <th>Fecha Ingreso</th>
                        <th>Promedio</th>
                        <th>Curso</th>
                    </tr>
                </thead>
                <tbody>
                    <td data-alu="mat_numero"></td>
                    <td data-alu="alumno_rut"></td>
                    <td data-alu="nombre"></td>
                    <td data-alu="estado"></td>
                    <td data-alu="genero"></td>
                    <td data-alu="mat_fecha_ingreso"></td>
                    <td data-alu="mat_prom_general"></td>
                    <td data-alu="curso_al"></td>
                    <td class="hide" data-alu="mat_id"></td>
                </tbody>
            </table>
        </div>



        <div class="text-center ins_inputs margin-bottom" style="display: none;">
            <div class="ui action input">
                <div class="ui selection dropdown select_taller">
                    <input type="hidden" name="taller" id="taller">
                        <i class="dropdown icon"></i>
                    <div class="default text">--Seleccionar Taller--</div>
                    <div class="menu menu_talleres">
        {{--
                                        @foreach ($talleres as $taller)
                                            <div class="item" data-value="{{ $taller->cu_id }}">{{ $taller->nombreTaller() }}</div>
                                        @endforeach
                        --}}                
                    </div>
                </div>
                <div class="ui button teal icon labeled ins_button disabled"><i class="icon edit"></i> Inscribir Alumno</div>
            </div>
        </div>












        <div id="content_taller" class="fadeIn animated" style="display: none;"></div>


    @endif




@else


    <div class="ui error icon message">
        <i class="warning circle icon"></i>
        <div class="content">
            <div class="header">
                No existe un periodo académico activo
            </div>
            <p>Debe crear un nuevo periodo académico</p>
        </div>
    </div>


@endif























<script type="text/javascript">
    var token = $('meta[name="csrf-token"]').attr('content');




    $('.cancelar_button').on('click', function(){
        $('.info_inputs').show();
        $('.info_matricula').hide();
        $('#content_taller').hide()
        $('.ins_inputs').hide()
        $('input[name="matricula[mat_id]"]').val('');
        $('input[name="alumno[nombre]"]').val('');
        $('#mensajes').hide().html('');
    })






$('#taller').on('change', function(){
    var id = $(this).val();
    if(id != ''){
        $('#content_taller').show();
        $('.ins_button').removeClass('disabled');
        $.ajax({
            url: '{{ route('talleres.info_taller') }}',
            data: {_token:token, id:id},
            type: 'post',
            success: function(response){
                $('#content_taller').html(response);
            }
        })
    }
})




$('.ui.search').search({

    //type          : 'category',
    minCharacters : 2,
    //showNoResults : false,
    apiSettings   : {
        responseAsync: function (settings, callback) {

                var tipo = $(this).attr('data-tipo');
                console.log(tipo);

                    var result;
                    var response = {
                        success: true   // docs say you need to return success: true
                    }
            $.ajax({
                url: '{{ route('autocomplete.search_matricula') }}',
                type: "post",
                dataType: "json",
                data:{
                    _token:token, rut:settings.urlData.query, tipo:tipo, taller:1{{-- curso:$('#curso').val() --}}
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
                    response.results = result;
                    callback (response);  // Important to call the callback!

                }
            })
        },
    },
    fields: {
        //results : 'results',
        title   : 'title',
        description : 'description',
        price: 'curso_al',
    },
    onSelect: function(result, response){

        //console.log(result.estado);

        $.each(result, function(index, value){
            $('td[data-alu="'+index+'"]').html(value);
        })

        $.each(result.model, function(index, value){
            $('td[data-alu="'+index+'"]').html(value);
        })
        $('.info_inputs').hide();
        $('.info_matricula').show();
        if(result.model.mat_estado == 1){
            $('.ins_inputs').show();
        }
        if(result.model.mat_estado == 3){
            $('#mensajes').html('<div class="ui error icon message"><i class="info icon"></i><div class="content"><div class="header">Alumno Retirado</div><p>El alumno no puede ser inscrito en un taller por que fue retirado el '+result.model.mat_fecha_retiro+'</p></div></div>');
            $('#mensajes').show();
        }

        if(result.talleres != null){
            console.log(result.talleres)
            $('.menu_talleres').html(result.talleres);
        }


        //$('#id_mat').attr('value', mat);



    }
});






    $('.ins_button').on('click', function(){
        var mat_id = $('td[data-alu="mat_id"]').text();
        var ta_id = $('#taller').val();
        console.log('mat = '+mat_id+' -- taller = '+ta_id)
        $.ajax({
            url: '{{ route('matriculas.ins_taller') }}',
            type: 'post',
            dataType: 'JSON',
            data: {_token:token, mat_id:mat_id, ta_id:ta_id},
            success: function(response){
                if (response == 1) {
                    swal({
                        title: "Alumno Inscrito!",
                        timer: 2000,
                        type: "success",
                        showConfirmButton:false,
                    }, function(){
                        location.reload(true);
                    });
                    $('.ins_button').addClass('disabled');
                }
            }
        })
    })


</script>



@endsection
