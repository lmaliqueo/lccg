@extends('admin.template.main')

@section('title', 'Matriculas')

@section('content')

	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="open folder outline icon"></i>
					<i class="corner yellow list icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
		        Lista de Alumnos {{ ($periodo)? $periodo->pac_ano:'' }}
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
			    Filtrar Alumnos
			</h5>
		</div>
		<div class="{{ ($request->all() != null) ? 'active':'' }} content">
		{!! Form::open(['route' => 'matriculas.list', 'method'=>'GET', 'class'=>'ui form small']) !!}
		<table class="table ui small">
			<thead>
				<tr>
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
					<th style="width: 13%">Curso</th>
					<td style="width: 20%">
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
					<th>Sexo</th>
					<td>
						<div class="field">
			                {!! Form::select('sexo', ['ambos'=>'Ambos','masculino'=>'Masculino', 'femenino'=>'Femenino'], (isset($request->sexo) ? $request->sexo : null), ['class'=>'ui fluid selection dropdown','placeholder'=>'']) !!}
						</div>					
					</td>
				</tr>
			</thead>
		</table>
			<div class="text-center">
				<button class="ui button small primary">Filtrar</button>
				<a href="{{ route('matriculas.list') }}" class="ui button small">Quitar Filtro</a>
			</div>
				
		{!! Form::close() !!}
		</div>
	</div>
	</div>

    @if (!$periodo->matriculas->count())
        <div class="ui error icon message">
            <i class="warning circle icon"></i>
            <div class="content">
                <div class="header">
                    No hay matrículas registradas en este año
                </div>
                <p>Deben ingresarse antes de realizar esta acción</p>
            </div>
        </div>
    @else
		<div class="segment raised ui">
		    <h4 class="ui horizontal divider header text-navy2">
		        <i class="icon list"></i>
		        Alumnos
		    </h4>
			<table class="ui table celled selectable">
				<thead>
					<tr>
						<th class="collapsing">N° Mat.</th>
						<th>RUT</th>
						<th>Nombre Completo</th>
						<th>Sexo</th>
						<th>Estado</th>
						<th>Curso</th>
						<th class="center aligned">Promedio General</th>
						<th>Comuna</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				@foreach ($matriculas as $matricula)
					{{-- expr --}}
					<tr>
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
						<td class="collapsing center aligned">{{ $matricula->mat_prom_general }}</td>
						<td>{{ $matricula->alumno->comuna->com_nombre }}</td>
						<td class="collapsing">
							<a href="{{ route('matriculas.show', $matricula->mat_id) }}" class="ui button icon circular small twitter"><i class="eye icon"></i></a>
						</td>
					</tr>
				@endforeach
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



	


@endsection
