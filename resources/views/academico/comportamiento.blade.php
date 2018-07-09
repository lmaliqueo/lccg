@extends('admin.template.main')

@section('title', 'Asistencia')

@section('content')

	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="checked calendar icon"></i>
					<i class="corner blue add icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #2185D0;">
		        Evaluar Comportamiento Alumno{{ (isset($curso)) ? ' | '.$curso->nombreCurso():'' }}
			</span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('academico.index') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>

@if (Auth::user()->profesor())
	@if (isset($curso))
		<div class="segment segment_inputs ui raised animated fadeIn">
		    <h4 class="ui horizontal divider header text-navy2">
		        <i class="icon student"></i>
		        Alumnos
		    </h4>
		    <table class="table ui celled">
		    	<thead>
		    		<tr>
		    			<th>N°</th>
		    			<th>Rut</th>
		    			<th>Nombre</th>
		    			<th>Estado</th>
		    			<th></th>
		    		</tr>
		    	</thead>
		    	<tbody>
		    		@foreach ($curso->listaAlumnos()->orderBy('mat_posicion_lista', 'ASC')->get() as $alumno)
		    			<tr>
		    				<td>{{ $alumno->mat_posicion_lista }}</td>
		    				<td>{{ $alumno->alumno_rut }}</td>
		    				<td>{{ $alumno->alumno->nombreCompleto() }}</td>
		    				<td>{{ $alumno->estado() }}</td>
		    				<td class="collapsing">
		    					<a class="button ui small icon circular button_comp {{ ($alumno->conceptos->count()) ? 'blue':'' }}" data-mat="{{ $alumno->mat_id }}"><i class="icon file alternate"></i></a>
		    				</td>
		    			</tr>
		    		@endforeach
		    	</tbody>
		    </table>
		</div>
	@endif
@else
	<form class="ui form">
		<div class="ui segment segment_inputs animated fadeIn">
		    <h4 class="ui horizontal divider header text-navy2">
		        <i class="icon student"></i>
		        Alumno
		    </h4>
			<table class="ui celled table">
				<thead>
					<tr>
						<th style="width: 15%;">Periodo</th>
						<td style="width: 20%;">
							<div class="field">
								{!! Form::select('periodo', $periodos->pluck('pac_ano', 'pac_id'), null, ['class'=>'dropdown ui selection', 'id'=>'periodo'] ) !!}
								
							</div>
							{{-- 
							<div class="ui selection dropdown buscar_curso">
								<input type="hidden" name="periodo" id="periodo">
									<i class="dropdown icon"></i>
								<div class="default text">Periodo</div>
								<div class="menu">
									@foreach ($periodos as $periodo)
										<div class="item" data-value="{{ $periodo->pac_id }}">{{ $periodo->pac_ano }}</div>
									@endforeach
								</div>
							</div>

							 --}}
						</td>
						<th style="width: 15%;">Alumno</th>
						<td style="width: 50%;" class="collapsing">
							<div class="inline fields no-margin">
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
					                        <input class="prompt persona" type="text" placeholder="Nombre Alumno" autocomplete="off" name="alumno[nombre]" size="30">
					                        <i class="search icon inverted red circular remove link icon_remove" id="icon_person" style="display: none;" value="alumno"></i>
					                    </div>
					                </div>
					                <input type="hidden" name="id_mat">
									
								</div>
							</div>
						</td>
					</tr>
				</thead>
			</table>
		</div>

		
	</form>
@endif





<div id="pauta_comp"></div>

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

		var mat = result.id;

		$('input[name="id_mat"]').val(mat);

		    $.ajax({
		        url: '{{ route('academico.pauta_conceptos') }}',
		        type: 'post',
		        //dataType: "JSON",
		        data: {_token:token, matricula:mat/*, nivel:nivel, letra:letra*/ },
		        success: function(response) {
		        	$('#pauta_comp').html(response);
		        	$('.segment_inputs').hide();
		        	$('#pauta_comp').show();
		        }
		    });


    }
});



$('.button_comp').on('click', function(){
	var id = $(this).attr('data-mat');
	$(this).addClass('active');
    $.ajax({
        url: '{{ route('academico.pauta_conceptos') }}',
        type: 'post',
        //dataType: "JSON",
        data: {_token:token, matricula:id/*, nivel:nivel, letra:letra*/ },
        success: function(response) {
        	$('#pauta_comp').html(response);
        	$('.segment_inputs').hide();
        	$('#pauta_comp').show();
        }
    });
})









{{-- 
var content = [
	{
		title: "Semantic UI",
		description: "asd asd asdasdsasd asa",
	},
	{
		title: "Bootstrap UI",
		description: "asd asd asdasdsasd asa",
	},
	{
		title: "Angular UI",
		description: "asd asd asdasdsasd asa",
	},
];
$('.ui.search').search({ 
	apiSettings: {
		onRequest: function( request, response){
				$.ajax({
					url: "{{ route('autocomplete.search_matricula') }}",
			        type: 'post',
					dataType: 'json',
					data: {_token:token, curso:$('#curso').val(), rut:request.term},
					success: function(data){
						return data;
						return{
							result: $.map(data, function(item){
								return {title: item.rut, description: item.nombre}
							})

						}
					}
				})
			},
		},
	minCharacters : 3,
}) --}}

//	var token = $('meta[name="csrf-token"]').attr('content');

	$('.buscar_curso').on('change', function(){
		$('.curso_input').removeClass('hide');
	})
	$('.curso_input').on('change', function(){
		$('.alumno_input').removeClass('hide');
	})


	$('.buscar_curso').on('change', function(){
		$('.accordion_options').addClass('hide');
		var periodo = $('#periodo').val();
		var token = $('meta[name="csrf-token"]').attr('content');
		/*var nivel = $('#nivel').val();
		var letra = $('#letra').val();
		if(periodo != '' && nivel != '' && letra != '')*/
		if(periodo != '')
		{
		    $.ajax({
		        url: '{{ route('ajax.buscar_curso') }}',
		        type: 'post',
		        dataType: "JSON",
		        data: {_token:token, periodo:periodo/*, nivel:nivel, letra:letra*/ },
		        success: function(response) {
		        	if(response == ''){
			        	$('#profesor_jefe').html('<em class="text-red">No tiene profesor jefe</em>');
			        	//$('.curso_tr').addClass('warning').removeClass('positive')
		        	}else{
			        	$('.dropdown_cursos').removeClass('disabled');
			        	$('.menu_cursos').html(response);
			        	//$('.curso_tr').addClass('positive').removeClass('warning')
		        	}
		        }
		    });

		}else{
        	//$('.curso_tr').removeClass('positive warning')
		}
	});

</script>

@endsection
