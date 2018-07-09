@extends('admin.template.main')

@section('title', 'Admisión Alumnos')

@section('content')


	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="open folder outline icon"></i>
					<i class="corner teal student icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #00B5AD;">
		        Admisión Alumnos
			</span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('matriculas.index') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>
@if ($periodo != null)

	@if (!$periodo->cursos->count())
		<div class="ui error icon message">
			<i class="warning circle icon"></i>
			<div class="content">
				<div class="header">
					No hay cursos disponibles en este año
				</div>
				<p>Deben ingresarse antes de realizar esta acción</p>
			</div>
		</div>
	@else
		{!! Form::open(['class'=>'ui form']) !!}

		<div class="ui raised segment secondary segment_inputs">
		    <h4 class="ui horizontal divider header text-navy2">
		        <i class="icon info circle"></i>
		        Información
		    </h4>
			<table class="ui celled table small ">
				<thead>
					<tr>
						<th>Periodo</th>
						<td>

							<div class="ui input">
								<input type="text" name="periodo" id="periodo" value="{{ $periodo->pac_ano }}" value_input="{{ $periodo->pac_id }}" readonly="">
							</div>
						</td>
						<th>Grado</th>
						<td class="collapsing">
								<div class="ui selection dropdown dropdown_grado">
									<input type="hidden" name="grado" id="grado">
										<i class="dropdown icon"></i>
									<div class="default text">Grado</div>
									<div class="menu menu_semestres">
										<div class="item" data-value="1">1°</div>
										<div class="item" data-value="2">2°</div>
										<div class="item" data-value="3">3°</div>
										<div class="item" data-value="4">4°</div>
									</div>
								</div>
						</td>
						<th>Curso</th>
						<td class="collapsing">
								<div class="ui selection dropdown dropdown_cursos disabled">
									<input type="hidden" name="curso" id="curso">
										<i class="dropdown icon"></i>
									<div class="default text"></div>
									<div class="menu menu_cursos">
									</div>
								</div>
						</td>
					</tr>
				</thead>
			</table>
			


		</div>

		<div class="ui raised segment secondary segment_info" style="display: none;">
		    <h4 class="ui horizontal divider header text-navy2">
		        <i class="icon info circle"></i>
		        Información
		    </h4>
		    <a class="ui red right corner label cancelar_button">
		        <i class="remove icon"></i>
		    </a>

			<table class="table ui celled small">
				<thead>
					<tr>
						<th style="width: 25%">Periodo</th>
						<td data-td="td_periodo" style="width: 25%"></td>
						<th style="width: 25%">Curso</th>
						<td data-td="td_curso" style="width: 25%"></td>
					</tr>
				</thead>
			</table>

		</div>



		<div class="segment ui raised animated fadeInDown" style="display: none;" id="contenido_asig">


			<div id="contenido_asig2"></div>
		</div>

		{!! Form::close() !!}

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




	$('.dropdown_grado').on('change', function(){
		var periodo = $('input[name="periodo"]').attr('value_input');
		var grado = $('input[name="grado"]').val();
		if(grado != ''){
			$.ajax({
				url: '{{ route('ajax.search_cursos_grado') }}',
				type: 'post',
				data: {_token:token, periodo:periodo, grado:grado},
				success: function(response){
		        	$('.dropdown_cursos').removeClass('disabled')
					$('.menu_cursos').html(response);
					$('.dropdown_cursos').dropdown('clear');
					$('.form_prof').hide();
					$('#contenido_asig').hide();
				}
			})

		}
	})


	$('.dropdown_cursos').on('change', function(){
		var periodo = $('input[name="periodo"]').val();
		var curso = $('#curso').val();

        var grado = $('input[name="grado"]').val();

        var nombre_curso = $(this).children('.text').html();
        console.log(nombre_curso)

			$('td[data-td="td_periodo"]').text(periodo)
			$('td[data-td="td_curso"]').text(nombre_curso)

		if(curso != ''){
			$('input[name="curso_id"]').attr('value', curso);
			$.ajax({
				url: '{{ route('matriculas.lista_alumnos_admision') }}',
				type: 'post',
				data: {_token:token, grado:grado, curso:curso},
				success: function(response){
					$('#contenido_asig2').html(response);
					$('#contenido_asig').show();
					$('.form_prof').hide();
					$('.segment_info').show()
					$('.segment_inputs').hide()
				}
			})
			
		}else{
			$('#contenido_asig').hide();
			$('#contenido_asig2').html('');
		}
	})



$('.ui.search').search({

    //type          : 'category',
    minCharacters : 3,
    apiSettings   : {
        responseAsync: function (settings, callback) {
                    var result;
                    var asig = $('input[name="asignatura_id"]').attr('value');
                    var clases = $('input[name="clase_id"]').attr('value');
                    var response = {
                        success: true   // docs say you need to return success: true
                    }
            $.ajax({
                url: '{{ route('autocomplete.search_mat_pendientes') }}',
                type: "post",
                dataType: "json",
                data:{
                	_token:token, rut:settings.urlData.query, asig:asig, clases:clases
                },
                success: function(ret){
                    result = ret;
                },
                complete: function(){
                    response.results = result;
                    callback (response);  // Important to call the callback!
			        /*var
			          response = {
			            results : {}
			          }
			        ;

			        $.each(result.items, function(index, item) {
			          var
			            curso   = item.curso || 'Unknown',
			            maxResults = 8
			          ;
			          if(index >= maxResults) {
			            return false;
			          }
			          // create new curso category
			          if(response.results[curso] === undefined) {
			            response.results[curso] = {
			              name    : 'Curso: '+curso,
			              results : []
			            };
			          }
			          // add result to category
			          response.results[curso].results.push({
			            title       : item.rut,
			            description : item.nombre,
			            price       : item.estado,
			            comuna      : item.comuna
			          });
			        });
			        callback (response);
*/

                }
            })
        },
    },
    fields: {
		//results : 'items',
		title   : 'rut',
		description : 'nombre',
    },
    onSelect: function(result, response){

    	$('#tr_'+result.id).addClass('positive');
		$('input[name="pat_profesor"]').val(result.ape_pat)
		$('input[name="nombres_profesor"]').val(result.nombres)
		$('input[name="mat_profesor"]').val(result.ape_mat)
		$('input[name="clase[profesor_id]"').attr('value', result.prof_id)
		$('.summit_prof').removeClass('disabled');

    }
});



{{--

	$('.summit_prof').on('click', function(){
		$.ajax({
			url:'{{ route('curso.ajax.store_clases') }}',
			type:'post',
			data: $('form').serialize(),
			success: function(response){
				var grado = $('input[name="grado"]').val();
				var curso = $('#curso').val();

				$.ajax({
					url: '{{ route('curso.ajax.cargar_asig') }}',
					type: 'post',
					data: {_token:token, curso:curso, grado:grado},
					success: function(response){
						$('#contenido_asig').html(response).show();
						$('.form_prof').hide();
					}
				})
			}
		})
	})



--}}






    $(document).ready(function(){
		$('.open_asignar').click(function(){
			var id = $(this).attr('cu_id');
			var url = $(this).attr('enlace');
		    $.ajax({
		        url: '{{ route('curso.tabla_asignaturas') }}',
		        type: 'post',
		        //dataType: "JSON",
		        data: {_token:token, id:id },
		        success: function(response) {
		        	$('#contenido_asig').html(response);
		        }
		    })
		})

    });


</script>


@endsection
