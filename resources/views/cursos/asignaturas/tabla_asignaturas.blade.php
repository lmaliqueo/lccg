

<div class="segment ui secondary">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon edit"></i>
        Cursos
    </h4>
	<a class="ui red right corner label remove_curso">
		<i class="remove icon"></i>
	</a>
	<table class="ui celled table">
		<thead>
			<tr>
				<th style="width: 25%;">Periodo</th>
				<td style="width: 25%;">{{ $curso->periodo->pac_ano }}</td>
				<th style="width: 25%;">Curso</th>
				<td style="width: 25%;">{{ $curso->nombreCurso() }}</td>
			</tr>
			<tr>
				
				<th>Plan de Estudio</th>
				<td>{{ $curso->planEstudio->pest_numero.'/'.$curso->planEstudio->pest_ano }}</td>
				<th>Plan de Evaluación</th>
				<td>{{ $curso->planEstudio->pest_eval_num.'/'.$curso->planEstudio->pest_eval_ano }}</td>
			</tr>
		</thead>
	</table>
</div>




<div class="ui two column grid">
	<div class="column">
			<div class="segment ui raised secondary animated fadeInRight form_prof" style="display: none;">
		{!! Form::open(['route' => 'curso.asigna_alu_store', 'method'=>'POST', 'class'=>'ui form']) !!}
	            <div class="ui inverted ribbon label large teal ribbon_form" style="margin-bottom: 20px">
	                <i class="icon male"></i> <span id="title_asig"></span>
	            </div>
	            <div class="field">



					{!! Form::label('rut_profesor', 'Rut Profesor') !!}
<div class="ui search fluid category focus">
		<input class="prompt" type="text" autocomplete="off" name="rut_profesor">
</div>



					{{-- Form::text('rut_profesor', null, ['class'=>'']) --}}
					{!! Form::hidden('asignatura_id', null, ['class'=>'']) !!}
					{!! Form::hidden('clase_id', null, ['class'=>'']) !!}
					{!! Form::hidden('curso_id', $curso->cu_id, ['class'=>'']) !!}
	            </div>
	            <div class="field">
	            	<label>Nombre</label>
	            	<input type="text" name="nombres_profesor" readOnly="" placeholder="Nombres">
	            </div>
	            <div class="field">
	            	<div class="two fields">
	            		<div class="eight wide field">
	            			<input type="text" name="pat_profesor" readOnly="" placeholder="Apellido Paterno">
	            		</div>
	            		<div class="eight wide field">
	            			<input type="text" name="mat_profesor" readOnly="" placeholder="Apellido Materno">
	            		</div>
	            	</div>
	            </div>
	            <div class="text-center margin-bottom">
	            	<a class="ui button teal icon labeled small disabled summit_prof"><i class="checkmark box icon"></i> <span class="text_summit"></span></a>
	            </div>
				{!! Form::hidden('clase[profesor_id]', null, ['class'=>'']) !!}


		{!! Form::close() !!}
	            

			</div>
	</div>
	<div class="column">
		<div class="segment ui raised animated fadeIn">
	        <div class="ui inverted ribbon label large bg-navy2" >
	            <i class="icon copy"></i> Asignaturas
	        </div>

			<table class="ui table celled structured">
				<thead>
					<tr>
						<th rowspan="2" class="center aligned">Asignaturas</th>
						<th colspan="3" class="center aligned">Profesor</th>
					</tr>
					<tr>
						<th>RUN</th>
						<th class="center aligned">Nombre</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($asignaturas as $asignatura)
						<tr class="tr_{{ $asignatura->asig_id }} tr">
							<td class="collapsing">{{ $asignatura->asig_nombre }}</td>
								@if ($curso->clases->where('asignatura_id', $asignatura->asig_id) != '[]')
									@php
										$clases = $curso->clases->where('asignatura_id', $asignatura->asig_id)->first();
									@endphp
											<td class="collapsing">{{ $clases->profesor->persona_rut }}</td>
											<td>{{ $clases->profesor->persona->nombreCompleto() }}</td>
											<td class="collapsing"><a class="ui button btn_profe icon small circular blue" clases="{{ $clases->cla_id }}" asig_tr="{{ $asignatura->asig_id }}"><i class="pencil icon"></i></a>
								@else
									<td></td>
									<td></td>
									<td class="collapsing"><a class="ui button btn_profe icon small circular teal" asig="{{ $asignatura->asig_id }}"><i class="add icon"></i></a>
								@endif
						</tr>
					@endforeach
				</tbody>
			</table>

		</div>
	</div>
</div>








<script type="text/javascript">
	var token = $('meta[name="csrf-token"]').attr('content');
	$('.btn_profe').on('click', function(){
		$('.btn_profe.active').removeClass('active');


		//$('input[name="rut_profesor"').val("")
		$('input[name="nombres_profesor"').val("")
		$('input[name="pat_profesor"').val("")
		$('input[name="mat_profesor"').val("")
		$('input[name="clase[profesor_id]"').attr('value', '')



		$(this).addClass('active');
		var clases = $(this).attr('clases');
		var asig = $(this).attr('asig');
		$('.tr.active').removeClass('active');
		if(asig != null){
			tr = document.getElementsByClassName('tr_'+asig);
		}else{
			var asig_tr = $(this).attr('asig_tr');
			tr = document.getElementsByClassName('tr_'+asig_tr);
		}
		$(tr).addClass('active')
		$.ajax({
			url:'{{ route('curso.ajax.buscar_profe_asig') }}',
			type: 'post',
			data:{_token:token, clases:clases, asig:asig},
			success: function(response){
				if(response.type == 1){
					$('input[name="clase_id"]').attr('value', response.data.clases_id)
					$('#title_asig').html(response.data.title);
					$('.summit_prof').removeClass('teal').addClass('blue disabled').html('<i class="icon edit"></i> Cambiar Profesor')
					$('.ribbon_form').removeClass('teal').addClass('blue')

					$('input[name="asignatura_id"]').attr('value', '')
					$('.form_prof').show();
				}else{
					$('input[name="asignatura_id"]').attr('value', response.data.asignatura_id)

					$('input[name="clase_id"]').attr('value', '')
					$('#title_asig').html(response.data.title);

					$('.summit_prof').removeClass('blue').addClass('teal disabled').html('<i class="icon checkmark box"></i> Asignar Profesor')
					$('.ribbon_form').removeClass('blue').addClass('teal')

					$('.form_prof').show();
				}
			}
		})
	})


$('.ui.search').search({

    //type          : 'category',
    minCharacters : 1,
    apiSettings   : {
        responseAsync: function (settings, callback) {
                    var result;
                    var asig = $('input[name="asignatura_id"]').attr('value');
                    var clases = $('input[name="clase_id"]').attr('value');
                    var response = {
                        success: true   // docs say you need to return success: true
                    }
                    console.log(clases)
            $.ajax({
                url: '{{ route('autocomplete.search_profesor') }}',
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
		description : 'nombre_comp',
    },
    onSelect: function(result, response){


		$('input[name="pat_profesor"]').val(result.ape_pat)
		$('input[name="nombres_profesor"]').val(result.nombres)
		$('input[name="mat_profesor"]').val(result.ape_mat)
		$('input[name="clase[profesor_id]"').attr('value', result.prof_id)
		$('.summit_prof').removeClass('disabled');

    }
});





	$('.summit_prof').on('click', function(){
		$.ajax({
			url:'{{ route('curso.ajax.store_clases') }}',
			type:'post',
			data: $('form').serialize(),
			success: function(response){
				var grado = $('input[name="grado"]').val();
				var curso = $('input[name="curso"]').val();
				console.log(curso)
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

	$('.remove_curso').on('click', function(){
		$('#contenido_asig').hide();
		$('#input_menu').show();
	})


</script>