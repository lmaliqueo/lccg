@extends('admin.template.main')

@section('title', 'Certificado de Alumno Regular')

@section('content')


	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="file alternate outline icon"></i>
					<i class="corner blue student icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #2185D0;">
		        Certificado de Alumno Regular
			</span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('documentos.index') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>

{!! Form::open(['route' => 'documentos.print.cert_alu_reg', 'method'=>'POST', 'class'=>'ui form']) !!}
        <div class="segment ui info_inputs animated fadeIn">
            <h4 class="ui horizontal divider header text-navy2">
                <i class="icon student"></i>
                Alumno
            </h4>

                <div class="fields">
                    <div class="field wide four">
                        {!! Form::text('año', $periodo->pac_ano, ['readonly']) !!}

                        {!! Form::hidden('periodo_id', $periodo->pac_id, null) !!}
                    </div>
                    <div class="field wide six">
                        <div class="ui search fluid focus" data-tipo="rut">
                            <div class="ui icon input">
                                <input class="prompt persona" type="text" placeholder="Rut Alumno" autocomplete="off" name="matricula[mat_id]">
                                <i class="search icon inverted red circular remove link icon_remove" id="icon_person" style="display: none;" value="alumno"></i>
                            </div>
                        </div>
                    </div>

                    <div class="field wide six">
                        <div class="ui search fluid focus" data-tipo="nombre">
                            <div class="ui icon input">
                                <input class="prompt persona" type="text" placeholder="Nombre Alumno" autocomplete="off" name="alumno[nombre]">
                                <i class="search icon inverted red circular remove link icon_remove" id="icon_person" style="display: none;" value="alumno"></i>
                            </div>
                        </div>
                    </div>
                    {!! Form::hidden('mat_id', null, null) !!}
                </div>
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
    <div class="field required">
        {!! Form::label('observaciones', 'Observaciones') !!}
        {!! Form::textarea('observaciones', null, ['rows'=>5, 'required']) !!}
    </div>
    <div class="field text-center">
        <button class="ui button teal icon labeled"><i class="print icon"></i> Imprimir Certificado</button>
    </div>
</div>



{!! Form::close() !!}





<script type="text/javascript">
    
    var token = $('meta[name="csrf-token"]').attr('content');




$('.ui.search').search({

    //type          : 'category',
    minCharacters : 2,
    //showNoResults : false,
    apiSettings   : {
        responseAsync: function (settings, callback) {

                var tipo = $(this).attr('data-tipo');
                var periodo = $('select[name="periodo_id"]').val();
                console.log(periodo);

                    var result;
                    var response = {
                        success: true   // docs say you need to return success: true
                    }
            $.ajax({
                url: '{{ route('autocomplete.search_matricula') }}',
                type: "post",
                dataType: "json",
                data:{
                    _token:token, rut:settings.urlData.query, tipo:tipo, periodo:periodo{{-- curso:$('#curso').val() --}}
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
        $('input[name="mat_id"]').val(result.id)
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



    $('.cancelar_button').on('click', function(){
        $('.info_inputs').show();
        $('.info_matricula').hide();
        $('#content_taller').hide()
        $('.ins_inputs').hide()
        $('input[name="matricula[mat_id]"]').val('');
        $('input[name="alumno[nombre]"]').val('');
        $('input[name="mat_id"]').val('')
        $('#mensajes').hide().html('');
    })










</script>










@endsection
