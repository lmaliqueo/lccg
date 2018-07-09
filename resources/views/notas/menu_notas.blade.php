@extends('admin.template.main')

@section('title', 'Notas')

@section('content')
	<script src="{{ asset('js/mindmup-editabletable.js')}}"></script>
	<script src="{{ asset('js/numeric-input-example.js')}}"></script>
	<script src="{{ asset('js/StickyTableHeaders.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('css/edi-table.css')}}">             


	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="table icon"></i>
					<i class="corner blue add icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #2185D0;">
		        Ingresar Notas
			</span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('academico.index') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>

<div class="ui raised segment secondary" id="content_inputs">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon info"></i>
        Información
    </h4>
    @if (!Auth::user()->profesor())
		<table class="ui celled table small">
			<thead>
				<tr>
					<th style="width: 25%">Periodo</th>
					<td style="width: 25%">
							<div class="ui selection dropdown buscar_curso">
								<input type="hidden" name="periodo" id="periodo" value="{{ $periodos->where('pac_estado', 1)->first()->pac_id }}">
									<i class="dropdown icon"></i>
								<div class="default text">Periodo</div>
								<div class="menu">
									@foreach ($periodos as $periodo)
										<div class="item {{ ($periodo->pac_estado == 1) ? 'active':'' }}" data-value="{{ $periodo->pac_id }}">{{ $periodo->pac_ano }}</div>
									@endforeach
								</div>
							</div>
					</td>
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
{{--
					<th style="width: 20%">Semestre</th>
					<td style="width: 20%">
							<div class="ui selection dropdown dropdown_semestres">
								<input type="hidden" name="semestre" id="semestre">
									<i class="dropdown icon"></i>
								<div class="default text">Semestre</div>
								<div class="menu">
									@foreach ($periodo->semestres as $semestre)
										<div class="item {{ ($semestre->sem_estado != 1) ? 'disabled': '' }}" data-value="{{ $semestre->sem_id }}">{{ $semestre->sem_numero }}° Semestre</div>
									@endforeach
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




<div id="content_clases" class=" animated fadeIn" style="display: none;"></div>

<div id="content_notas" class="" style="display: none;"></div>



<script type="text/javascript">
	var token = $('meta[name="csrf-token"]').attr('content');


	$('.buscar_curso').on('change', function(){
		$('.accordion_options').addClass('hide');
		var periodo = $('#periodo').val();
		if(periodo != '')
		{
			{{-- 
		    $.ajax({
		        url: '{{ route('ajax.buscar_semestre') }}',
		        type: 'post',
		        dataType: "JSON",
		        data: {_token:token, periodo:periodo/*, nivel:nivel, letra:letra*/ },
		        success: function(response) {
		        	$('.dropdown_semestres').removeClass('disabled');
		        	$('.menu_semestres').html(response);
		        	//$('.curso_tr').addClass('positive').removeClass('warning')
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

		}else{
        	//$('.curso_tr').removeClass('positive warning')
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
		        	$('.menu_cursos').html(response);
			    	$('.dropdown_cursos').removeClass('disabled');
		        }
		    });
	})
	$('.dropdown_cursos').on('change', function(){
			var curso = $('input[name="curso"]').val();


		    $.ajax({
		        {{-- url: '{{ route('academico.lista_asig') }}', --}}
		        url: '{{ route('curso.cargar_clases') }}',
		        type: 'post',
		        //dataType: "JSON",
		        data: {_token:token, curso:curso, tipo:1/*, nivel:nivel, letra:letra*/ },
		        success: function(response) {
		        	$('#content_clases').html(response).show();
		        	$('#content_notas').html('');
		        }
		    });
	})

	$(document).on('click', '.button_clase', function(){
			//$('.button_clase').removeClass('active');
        	$('#content_clases').hide();
        	$('#content_inputs').hide();

			//$(this).addClass('active');
			var clase = $(this).attr('data-clases');
			var semestre = $(this).attr('data-sem');
			$('input[name="semestre"]').val(semestre);


		    $.ajax({
		        url: '{{ route('academico.mostrar_notas') }}',
		        type: 'post',
		        //dataType: "JSON",
		        data: {_token:token, clase:clase, semestre:semestre/*, nivel:nivel, letra:letra*/ },
		        success: function(response) {
		        	$('#content_notas').html(response).show();
		        }
		    });
	})



</script>

@endsection
