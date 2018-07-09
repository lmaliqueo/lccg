@extends('admin.template.main')

@section('title', 'Buscar Alumno')

@section('content')

	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="open folder outline icon"></i>
					<i class="corner yellow search icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
		        Buscar Alumno
			</span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('matriculas.index') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>





<div class="ui raised segment secondary info_inputs animated fadeIn">
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



<div id="content_alu" class="animated fadeIn" style="display: none;"></div>




















<script type="text/javascript">
  
  var token = $('meta[name="csrf-token"]').attr('content');

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
                url: '{{ route('autocomplete.search_students') }}',
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
        price: 'genero',
    },
    onSelect: function(result, response){


        $.ajax({
            url: '{{ route('alumnos.info_alumno') }}',
            data: {_token:token, rut:result.rut},
            type:'post',
            success:function(data){
                $('#content_alu').html(data).show();
            }
        })

        $('.info_inputs').hide();



        //console.log(result.estado);
{{-- 
        $.each(result, function(index, value){
            $('td[data-alu="'+index+'"]').html(value);
        })

        $.each(result.model, function(index, value){
            $('td[data-alu="'+index+'"]').html(value);
        })
        $('.info_matricula').show();
        if(result.model.mat_estado == 1){
            $('.input_retiro').show();
        }
        if(result.model.mat_estado == 3){
            $('<div class="ui warning icon message"><i class="info icon"></i><div class="content"><div class="header">Alumno Retirado</div><p>El alumno ya a sido retirado el '+result.model.mat_fecha_retiro+'</p></div></div>').appendTo('#mensajes');
            $('#mensajes').show();
        }

 --}}
        //$('#id_mat').attr('value', mat);



    }
});



</script>













@endsection
