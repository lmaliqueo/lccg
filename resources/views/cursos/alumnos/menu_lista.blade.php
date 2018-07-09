@extends('admin.template.main')

@section('title', 'Articulos')

@section('content')



	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="edit outline icon"></i>
					<i class="corner yellow list ol icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
		        Editar Lista de Alumnos
			</span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('cursos.index') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>

@if ($periodo)
	<div class="segment ui secondary raised animated fadeIn" id="input_info">
	    <h4 class="ui horizontal divider header text-navy2">
	        <i class="icon edit outline"></i>
	        Curso
	    </h4>
		<table class="ui celled table">
			<thead>
				<tr>
					<th style="width: 25%">Periodo</th>
					<td style="width: 25%">{{ $periodo->pac_ano }}</td>
					<th style="width: 25%">Curso</th>
					<td style="width: 25%">
						<div class="ui selection dropdown buscar_curso">
							<input type="hidden" name="curso" id="curso">
								<i class="dropdown icon"></i>
							<div class="default text">Curso</div>
							<div class="menu">
								@foreach ($periodo->cursos->where('cu_tipo', 1) as $curso)
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


<div id="info_list" style="display: none;"></div>






<script type="text/javascript">
	var token = $('meta[name="csrf-token"]').attr('content');

$('#curso').on('change', function(){
	var id = $(this).val()
	if(id != ''){
		$.ajax({
			url : '{{ route('curso.view_lista') }}',
			type: 'post',
			data: {_token:token, id:id},
			success: function(data){
				$('#info_list').html(data).show();
				$('#input_info').hide();
			}
		})
	}
})



	
</script>


@endsection
