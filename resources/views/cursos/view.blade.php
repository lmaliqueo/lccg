@extends('admin.template.main')

@section('title', $curso->nombreCurso())

@section('content')

	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="edit outline icon"></i>
					<i class="corner blue eye icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #2185D0;">
		        Ver Curso | {{ $curso->nombreCurso() }}
			</span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ (Auth::user()->profesor()) ? route('cursos.index'):route('cursos.admin') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>


	<div class="segment ui raised">
	    <h4 class="ui horizontal divider header text-navy2">
	        <i class="icon edit"></i>
	        Curso
	    </h4>
		<table class="ui table small">
			<thead>
				<tr>
					{{-- 
					<th style="width: 25%">Curso</th>
					<td style="width: 25%">{{ $curso->nombreCurso() }}</td>
					 --}}
					<th style="width: 25%">Periodo</th>
					<td style="width: 25%">{{ $curso->periodo->pac_ano }}</td>
					<th style="width: 25%">Profesor Jefe</th>
					<td style="width: 25%">{{ $curso->profesorJefe->persona->nombreCompleto() }}</td>
				</tr>
				<tr>
					<th>Decreto Plan de Estudio</th>
					<td>{{ $curso->planEstudio->decreto_plan() }}</td>
					<th>Decreto Evaluación</th>
					<td>{{ $curso->planEstudio->decreto_eval() }}</td>
				</tr>
				<tr>
					<th>Aula</th>
					<td>{{ ($curso->aula_id != null) ? $curso->aula->aul_numero:'Sin aula' }}</td>
					<th>Promedio Curso</th>
					<td>{{ $curso->prom_curso() }}</td>
				</tr>
				
			</thead>
		</table>
		
	</div>

<div class="ui pointing menu blue">
	<a class="item text-navy2 active" data-tab="asignaturas"><i class="icon book"></i> Clases</a>
	<a class="item text-navy2" data-tab="alumnos"><i class="icon student"></i> Alumnos</a>
	<a class="item text-navy2" data-tab="notas"><i class="icon table"></i> Notas</a>
	<a class="item text-navy2" data-tab="asistencias"><i class="icon calendar check"></i> Asistencia</a>
	<a class="item text-navy2" data-tab="ensayos"><i class="icon file alternate outline"></i> Ensayos</a>
</div>
<div class="ui tab segment blue animated fadeIn active" data-tab="asignaturas">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon book"></i>
        Clases
    </h4>
    @if ($curso->clases->count())
		<table class="table ui celled structured">
			<thead>
				<tr>
					<th rowspan="2">ID</th>
					<th rowspan="2">Asignatura</th>
					<th rowspan="2">Docente</th>
					<th colspan="3" class="center aligned">Promedio Clase</th>
				</tr>
				<tr>
					<th class="collapsing">SEM 1</th>
					<th class="collapsing">SEM 2</th>
					<th class="collapsing">ANUAL</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($curso->clases as $clase)
					<tr>
						<td class="collapsing">{{ $clase->cla_id }}</td>
						<td style="width: 50%">{{ $clase->asignatura->asig_nombre }}</td>
						<td style="width: 50%">{{ $clase->profesor->persona->nombreCompleto() }}</td>
						@for ($i = 1; $i <= 2 ; $i++)
							@php
								$sem = $curso->periodo->semestres->where('sem_numero', $i)->whereNotIn('sem_estado', 0)->first();
							@endphp
							@if ($sem != null)
								<td class="center aligned {{ ($sem->sem_estado == 2) ? 'positive':'' }}">{{ $clase->prom_clases_sem($sem->sem_id)  }}</td>
							@else
								<td class="center aligned">-</td>
							@endif
						@endfor
						<td class="center aligned warning">{{ $clase->prom_clases() }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
    @else
    @endif
</div>
<div class="ui tab segment blue animated fadeIn" data-tab="alumnos">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon student"></i>
        Alumnos
    </h4>

	<table class="ui table celled">
		<thead>
			<tr>
				<th>N°</th>
				<th>Ingreso</th>
				<th>Retiro</th>
				<th>Nombre Completo</th>
				<th>RUN</th>
				<th>Sexo</th>
				<th>Fecha de Nacimiento</th>
				<th>Comuna</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($curso->listaAlumnos()->orderBy('mat_posicion_lista', 'ASC')->get() as $alumno)
				<tr>
					<td class="collapsing">{{ $alumno->mat_posicion_lista }}</td>
					<td>{{ $alumno->mat_fecha_ingreso }}</td>
					<td>{{ $alumno->mat_fecha_retiro }}</td>
					<td>{{ $alumno->alumno->nombreCompleto() }}</td>
					<td>{{ $alumno->alumno_rut }}</td>
					<td>{{ $alumno->alumno->al_sexo }}</td>
					<td>{{ $alumno->alumno->al_fecha_nacimiento }}</td>
					<td>{{ $alumno->alumno->comuna->com_nombre }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>

</div>
<div class="ui tab segment blue animated fadeIn" data-tab="notas">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon table"></i>
        Notas
    </h4>

    @if ($curso->clases->count())
		<div class="ui secondary menu sem_notas">
		    @foreach ($curso->periodo->semestres as $count => $semestre)
				<a class="item sem {{ ($count == 0) ? 'active bg-light-blue':'' }}" data-tab="not_sem_{{ $semestre->sem_numero }}">{{ $semestre->sem_numero }}° Semestre</a>
		    @endforeach
		</div>
			
		@foreach ($curso->periodo->semestres as $count => $semestre)
			<div class="ui tab {{ ($count == 0) ? 'active':'' }} animated fadeIn" data-tab="not_sem_{{ $semestre->sem_numero }}">
				<table class="table ui celled structured">
					<thead>
						<tr>
							<th rowspan="2">N°</th>
							<th rowspan="2">Rut</th>
							<th rowspan="2">Alumno</th>
							<th class="center aligned" colspan="{{ $curso->clases->count()+1 }}">Notas</th>
						</tr>
						<tr>
							@foreach ($curso->clases as $clase)
								<th class="collapsing">{{ $clase->asignatura->asig_nombre_corto }}</th>
							@endforeach
							<th class="collapsing">{{ $semestre->sem_numero }}° SEM</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($curso->listaAlumnos()->orderBy('mat_posicion_lista', 'ASC')->get() as $alumno)
							<tr>
								<td class="collapsing">{{ $alumno->mat_posicion_lista }}</td>
								<td class="collapsing">{{ $alumno->alumno_rut }}</td>
								<td>{{ $alumno->alumno->nombreCompleto() }}</td>
								@foreach ($curso->clases as $clase)
									<td class="center aligned">{{ $alumno->prom_clase_sem($clase->cla_id, $semestre->sem_id) }}</td>
								@endforeach
								<td class="center aligned warning">{{ $alumno->prom_sem($semestre->sem_id) }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		@endforeach
    @else
    @endif
</div>
<div class="ui tab segment blue animated fadeIn" data-tab="asistencias">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon checked calendar"></i>
        Asistencias
    </h4>

    @if ($curso->clases->count())
		<div class="ui secondary menu sem_notas">
		    @foreach ($curso->periodo->semestres as $count => $semestre)
				<a class="item sem {{ ($count == 0) ? 'active bg-light-blue':'' }}" data-tab="asis_sem_{{ $semestre->sem_numero }}">{{ $semestre->sem_numero }}° Semestre</a>
		    @endforeach
		</div>

		@foreach ($curso->periodo->semestres as $count => $semestre)
			<div class="ui tab {{ ($count == 0) ? 'active':'' }} animated fadeIn" data-tab="asis_sem_{{ $semestre->sem_numero }}">
				<table class="table ui celled structured">
					<thead>
						<tr>
							<th rowspan="2">N°</th>
							<th rowspan="2">Rut</th>
							<th rowspan="2">Alumno</th>
							<th class="center aligned" colspan="{{ $curso->clases->count()+1 }}">Asistencias</th>
						</tr>
						<tr>
							@foreach ($curso->clases as $clase)
								<th class="center aligned">{{ $clase->asignatura->asig_nombre_corto }}</th>
							@endforeach
							<th>PROM</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($curso->listaAlumnos()->orderBy('mat_posicion_lista', 'ASC')->get() as $alumno)
							<tr>
								<td class="collapsing">{{ $alumno->mat_posicion_lista }}</td>
								<td class="collapsing">{{ $alumno->alumno_rut }}</td>
								<td>{{ $alumno->alumno->nombreCompleto() }}</td>
								@foreach ($curso->clases as $clase)
									{{-- 
									@php
										$dias = $semestre->diaClase->pluck('dc_id');
										$dias_clase = $clase->clasesRealizadas->whereIn('dia_clase_id', $dias)->pluck('cr_id');
										$asis_prom = null;
										if($dias_clase != null){
											$asis_prom = $alumno->asistencias->whereIn('cla_realizados_id', $dias_clase)->avg('asis_estado');
										}
									@endphp
									 --}}
										<td class="collapsing center aligned">{{ $alumno->prom_asis_cla_sem($semestre->sem_id, $clase->cla_id) }}</td>
								@endforeach
								<td class="collapsing warning center aligned">{{ $alumno->prom_asis_sem($semestre->sem_id) }} %</td>
							</tr>
						@endforeach
					</tbody>
				</table>

			</div>
		@endforeach
	@else

    @endif
</div>

<div class="ui tab animated fadeIn" data-tab="ensayos">
	<div class="ui top attached menu">
		@foreach ($tipo_ensayos as $count => $tipo)
			<a class="item {{ ($count == 0) ? 'active':'' }}" data-tab="{{ $tipo->ten_tipo }}"><i class="icon file alternate outline"></i>{{ $tipo->ten_tipo }}</a>
		@endforeach
	</div>
	@foreach ($tipo_ensayos as $count => $tipo)
		<div class="ui bottom attached segment animated fadeIn tab no-border {{ ($count == 0) ? 'active':'' }}" data-tab="{{ $tipo->ten_tipo }}">
		    <h4 class="ui horizontal divider header text-navy2">
		        <i class="icon file alternate outline"></i>
		        {{ $tipo->ten_tipo }}
		    </h4>
			<div class="ui secondary menu sem_notas">
				@foreach ($tipo->materias as $index => $materia)
					<a class="item sem {{ ($index == 0) ? 'active bg-light-blue':'' }} " data-tab="{{ $tipo->ten_tipo }}_{{ $materia->mens_nombre }}">{{ $materia->mens_nombre }}</a>
				@endforeach
			</div>
			@foreach ($tipo->materias as $index => $materia)
				<div class="tab ui animated fadeIn {{ ($index == 0) ? 'active':'' }}" data-tab="{{ $tipo->ten_tipo }}_{{ $materia->mens_nombre }}">
					@php
						$ensayos = $curso->periodo->ensayos->where('tipo_id', $tipo->ten_id)->where('materia_id', $materia->mens_id);
					@endphp
					<table class="table ui celled structured">
						<thead>
							<tr>
								<th rowspan="2">N°</th>
								<th rowspan="2">Rut</th>
								<th rowspan="2">Alumno</th>
								<th class="center aligned" colspan="{{ ($ensayos->count()) ? $ensayos->count():1 }}">Fecha Ensayos</th>
							</tr>
							<tr>
								@if ($ensayos->count())
								@foreach ($ensayos as $ensayo)
									<th class="collapsing">{{ $ensayo->ens_fecha }}</th>
								@endforeach
								@else
									<th class="center aligned">-</th>
								@endif
							</tr>
						</thead>
						<tbody>
							@foreach ($curso->listaAlumnos()->orderBy('mat_posicion_lista', 'ASC')->get() as $alu)
								<tr>
									<td>{{ $alu->mat_posicion_lista }}</td>
									<td>{{ $alu->alumno_rut }}</td>
									<td>{{ $alu->alumno->nombreCompleto() }}</td>
									@if ($ensayos->count())
										@foreach ($ensayos as $ensayo)
										@php
											$result = $ensayo->matriculas()->where('mat_id', $alu->mat_id);
										@endphp
											@if ($result->count())
												<td class="center aligned">{{ $result->first()->pivot->alr_resultado }}</td>
											@else
												<td class="center aligned">-</td>
											@endif
										@endforeach
									@else
										<td class="center aligned">-</td>
									@endif
								</tr>
							@endforeach
			{{--
											@foreach ($matricula->ensayos->where('tipo_id', $ensayos->where('ten_tipo', 'SIMCE')->first()->ten_id) as $ensayo)
											@endforeach
							--}}				
						</tbody>
					</table>
					
				</div>
			@endforeach
		</div>
	@endforeach
</div>


<script type="text/javascript">
	$('.item.sem').on('click', function(){
		$(this).parent('.menu').children('.bg-light-blue').removeClass('bg-light-blue')
		$(this).addClass('bg-light-blue');
	})
</script>
	

@endsection
