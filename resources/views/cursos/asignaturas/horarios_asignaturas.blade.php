@extends('admin.template.main')

@section('title', 'Horarios')

@section('content')

	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="edit icon"></i>
					<i class="corner teal calendar alternate outline icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #00B5AD;">
		        Ver Horario de Clases
			</span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('cursos.index') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>

@if ($periodo_actual)
	<div class="ui raised segment secondary animated fadeIn" id="input_info">
	    <h4 class="ui horizontal divider header text-navy2">
	        <i class="icon info"></i>
	        Información
	    </h4>
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

	</div>

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


<div id="horario_body" class="animated fadeIn" style="display: none;"></div>


<script type="text/javascript">

var token = $('meta[name="csrf-token"]').attr('content');


$('#curso').on('change', function(){
	var id = $(this).val()
	if(id != ''){
		$.ajax({
			url : '{{ route('curso.ver_horarios') }}',
			type: 'post',
			data: {_token:token, id:id},
			success: function(data){
				$('#horario_body').html(data).show();
				$('#input_info').hide();
			}
		})
	}
})
	$(document).on('click', '.td_form.selectable', function(){
		var td = $(this).attr('td-clase')
		var clase = $('.button_clase.active').attr('data-id');
		var clase_nombre = $('.button_clase.active').text();
		console.log(clase);
		if(td == clase){
			$(this).children('a').text('')
			$(this).attr('td-clase', '').removeClass('warning')
			$(this).children('.field').children('input[input-name="clases"]').val('');
		}else{
			$(this).children('a').text(clase_nombre)
			$(this).attr('td-clase', clase).addClass('warning')
			$(this).children('.field').children('input[input-name="clases"]').val(clase);
		}
	})


</script>

@endsection
