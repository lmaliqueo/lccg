@extends('admin.template.main')

@section('title', 'Pruebas SIMCE')

@section('content')



    <p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
                    <i class="book icon"></i>
                    <i class="corner yellow plus icon"></i>
                </i>
            </span>
            <span style="border-bottom: 4px solid #FCDD13;">
                Registrar Resultados
            </span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('ensayos.psu.index') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
    </p>

{!! Form::open(['route' => ['ensayos.psu.update', $psu], 'method'=>'PUT', 'class'=>'ui form animated fadeIn']) !!}


		<div class="ui segment raised secondary">
            <h4 class="ui horizontal divider header text-navy2">
                <i class="icon file text outline"></i>
                Ensayo PSU
            </h4>

			<table class="ui celled table">
				<thead>
					<tr>
                        <th style="width: 25%">Fecha</th>
                        <td style="width: 25%">
                            <div class="field required">
                                {!! Form::date('ensayo[ens_fecha]', $psu->ens_fecha, ['placeholder'=>'', 'max'=>date('Y-m-d'), 'required']) !!}
                                
                            </div>
                            
                        </td>
						<th style="width: 25%">Materia</th>
						<td style="width: 25%">
                            <div class="field required">
                                {!! Form::select('ensayo[materia_id]', $psu->tipo->materias->pluck('mens_nombre', 'mens_id'), $psu->materia_id, ['placeholder'=>'', 'required', 'class'=>'ui dropdown fluid']) !!}
                                
                            </div>

                        </td>
{{-- 
                                                <th>Cursos</th>
                                                <td>{!! Form::text('ensayo[ens_grado_curso]', null, ['placeholder'=>'']) !!}</td>
                         --}}                        
					</tr>
				</thead>
			</table>

		</div>


<div class="ui segment raised secondary">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon list"></i>
        Lista Alumnos
    </h4>

<div class="segment ui tertiary raised">


    <div class="inline fields no-margin">
        <label>Agregar Alumno</label>
        <div class="field no-padding">
            <div class="ui search fluid focus" data-tipo="rut">
                <div class="ui icon input">
                    <input class="prompt persona" type="text" placeholder="Rut Alumno" autocomplete="off" name="matricula[mat_id]">
                    <i class="search icon inverted red circular remove link icon_remove" id="icon_person" style="display: none;" value="alumno"></i>
                </div>
            </div>
        </div>
        <div class="field">
                <div class="ui search fluid focus" data-tipo="nombre">
                    <div class="ui icon input">
                        <input class="prompt persona" type="text" placeholder="Nombre Alumno" autocomplete="off" name="matricula[nombre]" size="35">
                        <i class="search icon inverted red circular remove link icon_remove" id="icon_person" style="display: none;" value="alumno"></i>
                    </div>
                </div>
        </div>
        <div class="field">
            <a class="button icon ui blue disabled no-margin add_alumno" count="0"><i class="icon plus"></i></a>
            <a class="button icon ui basic disabled clean_alumno" count="0"><i class="icon remove"></i></a>
        </div>
    </div>





<table class="table ui celled" style="display: none;">
    <tbody>
        <tr>
            <td class="td_info_al" data-td="id"></td>
            <td class="td_info_al" data-td="numero"></td>
            <td class="td_info_al" data-td="rut"></td>
            <td class="td_info_al" data-td="nombre"></td>
            <td class="td_info_al" data-td="curso_al"></td>
        </tr>
    </tbody>
</table>

</div>

	<table class="table ui celled navy2 table_puntajes">
		<thead>
			<tr>
				<th>N°</th>
				<th>Rut</th>
				<th>Nombre</th>
				<th>Curso</th>
				<th>Puntaje</th>
				<th></th>
			</tr>
		</thead>
		<tbody id="input_alumnos">
            @foreach ($psu->matriculas as $alumno)
                <tr>
                    <td>{{ $alumno->mat_numero }}</td>
                    <td>{{ $alumno->alumno_rut }}</td>
                    <td>{{ $alumno->alumno->nombreCompleto() }}</td>
                    <td>{{ ($alumno->curso != '[]') ? $alumno->curso->first()->nombreCurso() : 'Sin Curso' }}</td>
                    <td class="warning">
                        <div class="field">
                            {!! Form::number('alumno['.$alumno->mat_id.'][alr_resultado]', $alumno->pivot->alr_resultado, ['placeholder'=>'', 'required']) !!}
                            <input class="id_mat" name="alumno[{{ $alumno->mat_id }}][matricula_id]" type="hidden" value="{{ $alumno->mat_id }}">
                        </div>
                    </td>
                    <td class="collapsing">
                        <a class="ui button small negative circular icon rem_trow"><i class="icon remove"></i></a>
                    </td>
                </tr>
            @endforeach
		</tbody>
	</table>
    <div class="text-center">
        {!! Form::submit('Guardar', ['class'=>'ui button teal', 'id'=>'guardar_ensayo']) !!}
    </div>
</div>


{!! Form::close() !!}


<script type="text/javascript">

    var token = $('meta[name="csrf-token"]').attr('content');

$('.ui.search').search({

    //type          : 'category',
    cache         : false,
    minCharacters : 1,
    //showNoResults : false,
    apiSettings   : {
        responseAsync: function (settings, callback) {


            var id_mats = [];

            if($('.id_mat') != ''){
                $.each($('.id_mat'), function(index, value){
                    id_mats.push(value.value);
                    //console.log(items)

                })

            }


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
                    _token:token, rut:settings.urlData.query, tipo:tipo, id_mats:id_mats{{-- curso:$('#curso').val() --}}
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

                var tipo = $(this).attr('data-tipo');

            $('.ui.search').children().children('input').attr('readonly', 'true')


            //$('input[name="alumno[nombre]"]').attr('readonly', 'true')
            //$('input[name="matricula[mat_id]"]').attr('readonly', 'true')
        if(tipo == 'rut'){
            $('input[name="matricula[nombre]"]').val(result.nombre);
        }else{
            $('input[name="matricula[mat_id]"]').val(result.rut);
        }

        //console.log(result.estado);

        $.each(result, function(index, value){
            $('td[data-td="'+index+'"]').text(value);
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
        $('.add_alumno').removeClass('disabled');
        $('.clean_alumno').removeClass('disabled');
        //$('#id_mat').attr('value', mat);


    }
});





    
    $('.clean_alumno').on('click', function(){
        $('.ui.search').children().children('input').val('').removeAttr('readonly')
        $('.td_info_al').text('');
        $(this).addClass('disabled');
        $('.add_alumno').addClass('disabled');
    })


{{-- 

    $('#puntaje').on('change', function(){
        var puntaje = $(this).val();
        if(puntaje > 0){
            $('#add_alumno').removeClass('disabled');
        }else{
            $('#add_alumno').addClass('disabled');
        }
    })
 --}}
    $('.add_alumno').on('click', function(){


        var mat = $('td[data-td="id"]').text();
        var numero = $('td[data-td="numero"]').text();
        var nombre = $('td[data-td="nombre"]').text();
        var rut = $('td[data-td="rut"]').text();
        var curso = $('td[data-td="curso_al"]').text();
        //var i = $('#input_alumnos tr').length + 1;
        var count = $(this).attr('count');
        count++;



        $('<tr class="animated fadeInDown"><td>'+numero+'</td><td>'+rut+'</td><td>'+nombre+'</td><td>'+curso+'</td><td class="warning"><div class="field"><input class="form-control disabled" required name="alumno['+mat+'][alr_resultado]" type="number" min="0" max="800" required><input class="id_mat" name="alumno['+mat+'][matricula_id]" type="hidden" value="'+mat+'"></div></td><td class="collapsing"><a class="ui button small negative circular icon rem_trow" id=""><i class="icon remove"></i></a></td></tr>').appendTo('#input_alumnos');

        $('.td_info_al').text('')
        $(this).addClass('disabled').attr('count', count);
        $('.clean_alumno').addClass('disabled');
        $('.ui.search').children().children('input').val('').removeAttr('readonly')

        $('.table_puntajes').show();
        //$('#guardar_ensayo').removeClass('disabled')
})


$(function() {

        $(document).on('click', '.rem_trow', function() { 
            $count = $('.add_alumno').attr('cont');
            $count++;



            $('.add_alumno').attr('cont', $count)
                    //document.getElementById("add_alumno").setAttribute('cont', $count)
                    $(this).parents('tr').remove();
            if($('#input_alumnos tr').length == 0){
                $('.table_puntajes').hide();
                $('#guardar_ensayo').addClass('disabled')
            }
                return false;

        });
})


</script>


@endsection

