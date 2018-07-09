@extends('admin.template.main')

@section('title', 'Matriculas')

@section('content')

	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="open folder outline icon"></i>
					<i class="corner yellow settings icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
		        Administrar Matrículas
			</span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('matriculas.index') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>

@if ($periodo != null)

<div class="segment ui secondary raised">
<div class="ui accordion">
	<div class="{{ ($request->all() != null) ? 'active':'' }} title no-padding">
		<h5 class="ui center aligned header text-navy2">
		    <i class="icon filter"></i>
		    Filtrar Matrículas
		</h5>
	</div>
	<div class="{{ ($request->all() != null) ? 'active':'' }} content">
	{!! Form::open(['route' => 'matriculas.admin', 'method'=>'GET', 'class'=>'ui form small']) !!}
	<table class="table ui small">
		<thead>
			<tr>
				<th style="width: 13%">Periodo</th>
				<td style="width: 20%">
					<div class="field">
		                {!! Form::select('periodo', $periodos, (isset($request->periodo) ? $request->periodo : $periodo->pac_id), ['class'=>'ui fluid selection dropdown','placeholder'=>'']) !!}
					</div>					
				</td>
				<th style="width: 13%">N° Matrícula</th>
				<td style="width: 20%">
					<div class="field">
						<input type="text" tipo-input="number" name="numero" value="{{ isset($request->numero) ? $request->numero : '' }}" placeholder="">
					</div>
					
				</td>
				<th style="width: 13%">Estado</th>
				<td style="width: 20%">
					<div class="field">
		                {!! Form::select('estado', [0=>'Pendiente', 1=>'Activo', 2=>'Egresado', 3=>'Retirado', 4=>'Repitente'], (isset($request->estado) ? $request->estado : ''), ['class'=>'ui fluid selection dropdown','placeholder'=>'']) !!}
					</div>
				</td>
			</tr>
			<tr>
				<th>RUT</th>
				<td>
					<div class="field">
						<input type="text" name="rut" value="{{ isset($request->rut) ? $request->rut : '' }}" placeholder="">
					</div>					
				</td>
				<th>Nombre</th>
				<td>
					<div class="field">
						<input type="text" name="nombre" value="{{ isset($request->nombre) ? $request->nombre : '' }}" placeholder="">
					</div>					
				</td>
				<th>Curso</th>
				<td>
					<div class="field">
						<div class="ui search selection dropdown dropdown_cursos">
							<input type="hidden" name="curso" id="curso" value="{{ (isset($request->curso) ? $request->curso : '') }}">
								<i class="dropdown icon"></i>
							<div class="default text"></div>
							<div class="menu menu_cursos">
								@foreach ($periodo->cursos->where('cu_tipo', 1) as $curso)
									<div class="item" data-value="{{ $curso->cu_id }}">{{ $curso->nombreCurso() }}</div>
								@endforeach
							</div>
						</div>
					</div>
				</td>
			</tr>
		</thead>
	</table>
		<div class="text-center">
			<button class="ui button primary small">Filtrar</button>
			<a class="ui button small" href="{{ route('matriculas.admin') }}">Quitar Filtro</a>
		</div>
			
	{!! Form::close() !!}
	</div>
</div>
</div>


<div class="segment raised ui">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon open folder outline"></i>
        Matrículas
    </h4>
		<table class="ui table celled selectable">
			<thead>
				<tr>
					<th class="collapsing">ID</th>
					<th class="collapsing">N° Mat.</th>
					<th>RUT</th>
					<th>Nombre Completo</th>
					<th>Sexo</th>
					<th>Estado</th>
					<th>Curso</th>
					<th>Periodo</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@if ($matriculas->count())
					@foreach ($matriculas as $matricula)
						{{-- expr --}}
						<tr data-tr="{{ $matricula->mat_id }}">
							<td>{{ $matricula->mat_id }}</td>
							<td class="center aligned">{{ $matricula->mat_numero }}</td>
							<td class="collapsing">{{ $matricula->alumno_rut }}</td>
							<td>{{ $matricula->alumno->nombreCompletoB() }}</td>
							<td class="center aligned collapsing">{{ $matricula->alumno->letra_sexo() }}</td>
							<td class=" collapsing center aligned"><label class="label ui {{ $matricula->color_estado() }} small">{{ $matricula->estado() }}</label></td>
							<td class="center aligned">
								@if ($matricula->curso == '[]')
									<em class="text-red">Sin Curso</em>
								@else
									{{ $matricula->curso->first()->nombreCurso() }}
								@endif
							</td>
							<td class="center aligned">{{ $matricula->periodo->pac_ano }}</td>
							<td class="collapsing">
								<a href="{{ route('matriculas.view_mat', $matricula->mat_id) }}" class="ui button icon circular small twitter"><i class="eye icon"></i></a>
								<a class="ui button small icon blue circular" href="{{ route('matriculas.edit', $matricula->mat_id) }}"><i class="pencil icon"></i></a>
								<button data-ruta="{{ route('matriculas.delete_mat') }}" data-mens_info="se borrara junto con sus datos académicos" data-id="{{ $matricula->mat_id }}" class="ui button small icon red circular btn-borrar"><i class="trash icon"></i></button>
							</td>
						</tr>
					@endforeach
				@else
					<td colspan="9" class="error center aligned"><em class="text-red">No existen matrículas registradas durante el año {{ $periodo->pac_ano }}</em></td>
				@endif
			</tbody>
			<tfoot>
				<tr>
					<th colspan="9">
						{{ $matriculas->appends(['request'=>$request])->links() }}
					</th>
				</tr>
			</tfoot>
		</table>
</div>
    @endif
	
<script type="text/javascript">
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
		        	$('.dropdown_cursos').dropdown('clear');
		        	$('.menu_cursos').html(response);
		        }
		    });

		}else{
        	//$('.curso_tr').removeClass('positive warning')
		}
	});

</script>

@endsection
