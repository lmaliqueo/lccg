@extends('admin.template.main')

@section('title', 'Asginar Asignaturas')

@section('content')


	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="edit outline icon"></i>
					<i class="corner teal checkmark box icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #00B5AD;">
		        Asignar Asignaturas
			</span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('cursos.index') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>


<div class="ui raised segment secondary" id="input_menu">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon edit"></i>
        Cursos
    </h4>
	<table class="ui celled table small">
		<thead>
			<tr>
				<th>Periodo</th>
				<td class="collapsing">

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



<div  id="contenido_asig">
	
</div>

























<script type="text/javascript">

	var token = $('meta[name="csrf-token"]').attr('content');

	$('.dropdown_grado').on('change', function(){
		var periodo = $('input[name="periodo"]').attr('value_input');
		var grado = $('input[name="grado"]').val();
		$.ajax({
			url: '{{ route('ajax.search_cursos_grado') }}',
			type: 'post',
			data: {_token:token, periodo:periodo, grado:grado},
			success: function(response){
	        	$('.dropdown_cursos').removeClass('disabled').dropdown('clear')
				$('.menu_cursos').html(response);
				$('.form_prof').hide();
				$('#contenido_asig').hide();
			}
		})
	})


	$('.dropdown_cursos').on('change', function(){
		var grado = $('input[name="grado"]').val();
		var curso = $('#curso').val();
		if(curso != ''){
			$('input[name="curso_id"]').attr('value', curso);
			$.ajax({
				url: '{{ route('curso.ajax.cargar_asig') }}',
				type: 'post',
				data: {_token:token, curso:curso, grado:grado},
				success: function(response){
					$('#contenido_asig').html(response).show();
					$('.form_prof').hide();
					$('#input_menu').hide();
				}
			})
		}
	})












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
