@extends('admin.template.main')

@section('title', 'Matriculas')

@section('content')


	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="open folder outline icon"></i>
					<i class="corner yellow sign out icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
		        Retirar Alumno
			</span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('matriculas.index') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>

@if ($periodo != null)

    @if (!$periodo->matriculas->count())
        <div class="ui error icon message">
            <i class="warning circle icon"></i>
            <div class="content">
                <div class="header">
                    No hay matrículas registradas en este año
                </div>
                <p>Deben ingresarse antes de realizar esta acción</p>
            </div>
        </div>
    @else
        <div id="mensajes">
        </div>



        <div class="ui raised segment secondary info_inputs animated fadeIn">
            <h4 class="ui horizontal divider header text-navy2">
                <i class="icon student"></i>
                Alumno
            </h4>
            <div class="ui info visible message">

                <p><i class="icon info circle"></i> Ingrese el Rut o nombre del alumno</p>
            </div>
            {!! Form::open(['class'=>'ui form retiro']) !!}
                
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
            {!! Form::close() !!}
            
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


        <div class="ui segment raised animated fadeIn input_retiro" style="display: none;">
            <h4 class="ui horizontal divider header text-navy2">
                <i class="icon sign out"></i>
                Retiro
            </h4>
            <form class="ui form retiro">
                <div class="field">
                    {!! Form::label('retiro[mat_fecha_retiro]', 'Fecha de Retiro') !!}
                    {!! Form::date('retiro[mat_fecha_retiro]', null, ['max'=>date('Y-m-d')]) !!}
                    {!! Form::hidden('mat_id', null, null) !!}
                </div>
              <div class="field">
                    {!! Form::label('retiro[mat_motvo]', 'Motivo de Retiro') !!}
                    {!! Form::textarea('retiro[mat_motivo]', null, ['rows'=>3]) !!}
              </div>


                <div class="text-center margin-bottom field">
                      <a class="ui yellow labeled icon button disabled retirar_alu">
                        <i class="sign out icon"></i>
                        Retirar Alumno
                      </a>
                    
                </div>
            </form>
        </div>

        <div id="info_alumno" class="animated fadeInDown" style="display: none;"></div>


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

//$( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd'}).val();
$( 'input[name="retiro[mat_fecha_retiro]"]' ).on('change', function(){
    var val = $(this).val();
    if(val != ''){
        $('.retirar_alu').removeClass('disabled');
    }else{
        $('.retirar_alu').addClass('disabled');
    }
});



	var token = $('meta[name="csrf-token"]').attr('content');


$('.ui.search').search({

    //type          : 'category',
    minCharacters : 2,
    cache : false,
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
                    _token:token, rut:settings.urlData.query, tipo:tipo{{-- curso:$('#curso').val() --}}
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
        $('input[name="mat_id"]').val(result.model.mat_id)
        $('input[name="retiro[mat_fecha_retiro]"]').attr('min', result.model.mat_fecha_ingreso)
        $.each(result, function(index, value){
            $('td[data-alu="'+index+'"]').html(value);
        })

        $.each(result.model, function(index, value){
            $('td[data-alu="'+index+'"]').html(value);
        })
        $('.info_inputs').hide();
        $('.info_matricula').show();
        if(result.model.mat_estado == 1){
            $('.input_retiro').show();
        }
        if(result.model.mat_estado == 3){
            $('<div class="ui warning icon message"><i class="info icon"></i><div class="content"><div class="header">Alumno Retirado</div><p>El alumno ya a sido retirado el '+result.model.mat_fecha_retiro+'</p></div></div>').appendTo('#mensajes');
            $('#mensajes').show();
     }


        //$('#id_mat').attr('value', mat);



    }
});











{{--     $('.search_alumno').on('click', function(){
        var id = $('td[data-alu="mat_id"]').text();
        console.log(id)
        var fecha = $('#datepicker').val();
        var motivo = $('#motivo').val();
        $.ajax({
            url: '{{ route('matriculas.info_matricula') }}',
            type: 'post',
            data: {_token:token, id:id, fecha:fecha, motivo:motivo},
            success: function(response){
                $('#info_alumno').html(response)
                $('#info_alumno').show()
            }
        })
    })
 --}}
    $('.cancelar_button').on('click', function(){
        $('.info_inputs').show();
        $('.info_matricula').hide();
        $('#info_alumno').hide()
        $('.input_retiro').hide()
        $('.ui.search').children().children('input').val('');
        /*
        $('input[name="matricula[mat_id]"]').val('');
        $('input[name="alumno[nombre]"]').val('');*/
        $('#mensajes').hide().html('');
    })

    $('.retirar_alu').on('click', function(){
    	swal({
    		title: "¿Esta seguro de retirar este alumno?",
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
    					swal.shoeInputError("Ingrese datos nuevamente");
    					return false;
    				}
    				if( response == 2){
    					swal.showInputError("usted no tiene permisos para editar notas de este curso");
    					return false;
    				}
                    var id = $('td[data-alu="mat_id"]').text();
                    var fecha = $('#datepicker').val();
                    var motivo = $('#motivo').val();
                    $.ajax({
                        url: "{{ route('matriculas.retirar') }}",
                        type: "POST",
                        dataType:"JSON",
                        data: $('form').serialize(),
                        success: function(response){
                        }
                    });
                    swal({
                        title: "Alumno Retirado",
                        timer: 1500,
                        type: "success",
                        showConfirmButton:false,
                    }, function(){
                        location.reload(true)
                    });
                    $('.input_retiro').hide();
    			}
    		});
    	})
    })

</script>

@endsection
