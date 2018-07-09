@extends('admin.template.main')

@section('title', 'Asistencia')

@section('content')


	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="checked calendar icon"></i>
					<i class="corner teal add icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #00B5AD;">
		        Asistencia de curso
			</span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('academico.index') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>

<div class="segment ui secondary raised" id="content_inputs">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon info"></i>
        Información
    </h4>
    @if (!Auth::user()->profesor())
		<table class="ui celled table small">
			<thead>
				<tr>
					<th style="width: 25%">Periodo</th>
					<td style="width: 25%" class="collapsing">
							<div class="ui selection dropdown buscar_curso">
								<input type="hidden" name="periodo" id="periodo" value="{{ $periodos->where('pac_estado', 1)->first()->pac_id }}">
									<i class="dropdown icon"></i>
								<div class="default text">Periodo</div>
								<div class="menu">
									@foreach ($periodos as $periodo)
										<div class="item" data-value="{{ $periodo->pac_id }}">{{ $periodo->pac_ano }}</div>
									@endforeach
								</div>
							</div>
					</td>
	{{-- 
									<th>Semestre</th>
									<td class="collapsing">
											<div class="ui selection dropdown dropdown_semestres disabled">
												<input type="hidden" name="semestre" id="semestre">
													<i class="dropdown icon"></i>
												<div class="default text">Semestre</div>
												<div class="menu menu_semestres">
												</div>
											</div>
									</td>
					 --}}				
						<th style="width: 25%">Curso</th>
						<td style="width: 25%">
								<div class="ui search selection dropdown dropdown_cursos">
									<input type="hidden" name="curso" id="curso">
										<i class="dropdown icon"></i>
									<div class="default text"></div>
									<div class="menu menu_cursos">
										@foreach ($periodos->where('pac_estado', 1)->first()->cursos->where('cu_tipo', 1) as $curso)
											<div class="item" data-value="{{ $curso->cu_id }}">{{ $curso->nombreCurso() }}</div>
										@endforeach
									</div>
								</div>
						</td>
				</tr>
			</thead>
		</table>

	@else
		<table class="ui celled table small">
			<thead>
				<tr>
					<th style="width: 25%">Periodo</th>
					<td style="width: 25%">
							<input type="hidden" name="periodo" id="periodo" value="{{ $periodo->pac_id }}">
							{{ $periodo->pac_ano }}
					</td>

					<th style="width: 25%">Curso</th>
					<td style="width: 25%">
							<div class="ui search selection dropdown dropdown_cursos">
								<input type="hidden" name="curso" id="curso">
									<i class="dropdown icon"></i>
								<div class="default text"></div>
								<div class="menu">
									@foreach ($cursos as $curso)
										<div class="item" data-value="{{ $curso->cu_id }}">{{ $curso->nombreCurso() }}</div>
									@endforeach
								</div>
							</div>
					</td>
				</tr>
			</thead>
		</table>
    @endif
	
</div>

<input type="hidden" name="semestre" id="semestre">


<div id="content_clases" class="animated fadeIn" style="display: none;"></div>
{{-- 
<div class="ui styled fluid accordion margin-bottom hide accordion_options animated fadeInDown">
		  <div class="title">
		    <i class="dropdown icon"></i>
		    Opciones
		  </div>
		  <div class="content">
		<p class="text-center">
			<a id="editar_notas" class="ui circular button icon labeled blue buscar_button buscar_horarios"><i class="pencil icon"></i> Editar</a>
			<a id="subir_notas" class="ui circular button icon labeled teal buscar_button buscar_horarios disabled"><i class="upload icon"></i> Guardar</a>
			<a class="ui circular button icon disabled negative cancelar_button labeled"><i class="remove icon"></i> Cancelar</a>
		</p>
		  </div>
		</div>
 --}}

<div id="content_asistencia" class="animated fadeIn" style="display: none;"></div>




<script type="text/javascript">
	
	var token = $('meta[name="csrf-token"]').attr('content');
	$('.buscar_curso').on('change', function(){
		var periodo = $('#periodo').val();
		/*var nivel = $('#nivel').val();
		var letra = $('#letra').val();
		if(periodo != '' && nivel != '' && letra != '')*/
		if(periodo != '')
		{
			{{-- 
		    $.ajax({
		        url: '{{ route('ajax.buscar_semestre') }}',
		        type: 'post',
		        dataType: "JSON",
		        data: {_token:token, periodo:periodo/*, nivel:nivel, letra:letra*/ },
		        success: function(response) {
		        	if(response == ''){
			        	$('#profesor_jefe').html('<em class="text-red">No tiene profesor jefe</em>');
			        	//$('.curso_tr').addClass('warning').removeClass('positive')
		        	}else{
			        	$('.dropdown_semestres').removeClass('disabled');
			        	$('.menu_semestres').html(response);
			        	//$('.curso_tr').addClass('positive').removeClass('warning')
		        	}
		        }
		    }); --}}
		    $.ajax({
		        url: '{{ route('ajax.buscar_curso') }}',
		        type: 'post',
		        dataType: "JSON",
		        data: {_token:token, periodo:periodo/*, nivel:nivel, letra:letra*/ },
		        success: function(response) {
		        	$('.menu_cursos').html(response);
			    	$('.dropdown_cursos').removeClass('disabled');
		        }
		    });

		}
	});
	$('#semestre').on('change', function(){
		var periodo = $('#periodo').val();
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
			        	//$('.dropdown_semestres').removeClass('disabled');
			        	$('.menu_cursos').html(response);
				    	$('.dropdown_cursos').removeClass('disabled');
			        	//$('.curso_tr').addClass('positive').removeClass('warning')
		        	}
		        }
		    });
	})
	$(document).on('change', '#curso', function(){
			var curso = $(this).val();


		    $.ajax({
		        {{-- url: '{{ route('academico.lista_asig') }}', --}}
		        url: '{{ route('curso.cargar_clases') }}',
		        type: 'post',
		        //dataType: "JSON",
		        data: {_token:token, curso:curso/*, nivel:nivel, letra:letra*/ },
		        success: function(response) {
		        	/**/
		        	$('#content_clases').html(response).show();
		        }
		    });


	})

	$(document).on('click', '.button_clase', function(){
        	$('#content_inputs').hide();
        	$('#content_clases').hide();
			//$('.button_clase').removeClass('active');
			//$(this).addClass('active');
			var clase = $(this).attr('data-clases');
			var semestre = $(this).attr('data-sem');
			$('input[name="semestre"]').val(semestre);

		    $.ajax({
		        url: '{{ route('asistencia.ver_asistencia') }}',
		        type: 'post',
		        //dataType: "JSON",
		        data: {_token:token, clase:clase, semestre:semestre/*, nivel:nivel, letra:letra*/ },
		        success: function(response) {
		        	$('#content_asistencia').html(response);
		        	$('#content_asistencia').show();
		        }
		    });


	})



</script>

@endsection
