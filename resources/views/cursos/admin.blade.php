@extends('admin.template.main')

@section('title', 'Cursos')

@section('content')


	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="edit outline icon"></i>
					<i class="corner yellow settings icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
		        Administrar Cursos
			</span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('cursos.index') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>

<div class="segment ui raised secondary">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon edit"></i>
        Cursos
    </h4>
	<table class="ui selectable structured celled table">
		<thead>
			<tr>
				<th rowspan="2">Grado</th>
				<th rowspan="2">Letra</th>
				<th rowspan="2">Sala</th>
				<th rowspan="2">Año</th>
				<th class="center aligned" colspan="2">Decreto</th>
				<th rowspan="2">Profesor Jefe</th>
				<th rowspan="2">Cant. Alumnos</th>
				<th rowspan="2" class="center aligned">Promedio</th>
				<th rowspan="2"></th>
				
			</tr>
			</tr>
				<th class="center aligned">Plan de Estudio</th>
				<th class="center aligned">Evaluación</th>
			<tr>
		</thead>
		<tbody>
			@foreach ($cursos as $curso)
				<tr>
					<td class="center aligned">{{ $curso->parametros->pcur_grado }}</td>
					<td class="center aligned">{{ $curso->parametros->pcur_letra }}</td>
					<td>
						@if ($curso->aula_id != NULL)
									<label class="ui yellow label small">{{ $curso->aula->aul_numero }}</label>
						@else
							<em class="text-red">Sin Sala</em>
						@endif
					</td>
					<td>{{ $curso->periodo->pac_ano }}</td>
					<td class="center aligned">{{ $curso->planEstudio->decreto_plan() }}</td>
					<td class="center aligned">{{ $curso->planEstudio->decreto_eval() }}</td>
					<td>
					@if ($curso->profesorJefe != NULL)
						{{ $curso->profesorJefe->persona->nombreCompleto() }}
					@else
						<em style="color: red;">Sin Profesor Jefe</em>
					@endif
					</td>
					<td class="center aligned">
						{{ $curso->listaAlumnos->count() }}
					</td>
					<td class="center aligned">{{ $curso->prom_curso() }}</td>
					<td class="collapsing">
						<a class="ui button icon teal small circular" data-tooltip="Ver curso" href="{{ route('cursos.show', $curso->cu_id) }}"><i class="eye icon"></i></a>
						{{-- 
						<a class="ui twitter icon button small circular" href="{{ route('curso.asignar_alumnos', $curso->cu_id) }}" data-tooltip="Asignar Alumnos"><i class="student icon"></i></a>

						 --}}
						<a class="ui blue icon button small circular" href="{{ route('cursos.edit', $curso->cu_id) }}" data-tooltip="Actualizar Curso"><i class="pencil icon"></i></a>
						@if ($curso->profesorJefe == NULL)

							<button class="ui icon button blue small circular" data-tooltip="Asignar Profesor Jefe"><i class="user icon"></i></button>

						@endif
					</td>
				</tr>

			@endforeach
		</tbody>
		<tfoot>
		    <tr><th colspan="10">
					{{ $cursos->links() }}
		    </th>
		</tfoot>

	</table>
	
</div>







@endsection
