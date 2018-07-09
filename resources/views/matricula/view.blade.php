@extends('admin.template.main')

@section('title', 'Perfil Alumno')

@section('content')
	

	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="student icon"></i>
					<i class="corner yellow id card outline icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
		        {{-- Ver Perfil Alumno --}}{{ $matricula->alumno->nombreCompleto() }}
			</span>
        </h2>
        <p>
            {{-- <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('articulos.index') }}"><i class="arrow left icon"></i> Volver</a> --}}
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('matriculas.list') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>

		<div class="segment raised ui raised">
		    <h4 class="ui horizontal divider header text-navy2">
		        <i class="icon user"></i>
		        Datos Personales
		    </h4>

		    
			<table class="table ui structured">
				<thead>
					<tr>
						<th style="width: 25%;">R.U.N</th>
						<td style="width: 25%;">{{ $matricula->alumno_rut }}</td>
						<th style="width: 25%;">Fecha Nacimiento</th>
						<td style="width: 25%;">{{ $matricula->alumno->al_fecha_nacimiento }}</td>
					</tr>
					<tr>
						<th>Comuna</th>
						<td>{{ $matricula->alumno->comuna->com_nombre }}</td>
						<th>Dirección</th>
						<td>{{ $matricula->alumno->al_domicilio }}</td>
					</tr>
					<tr>
						<th>Sexo</th>
						<td>{{ $matricula->alumno->al_sexo }}</td>
						<th>Contacto</th>
						<td>{{ $matricula->alumno->al_fono }}</td>
					</tr>
					<tr>
						<th>Fecha de Ingreso</th>
						<td>{{ $matricula->mat_fecha_ingreso }}</td>
						<th>Estado</th>
						<td><label class="label ui {{ $matricula->color_estado() }}">{{ $matricula->estado() }}</label></td>
					</tr>
					@if ($matricula->mat_estado == 3)
						<tr>
							<th>Fecha Retiro</th>
							<td>{{ $matricula->mat_fecha_retiro }}</td>
							<th>Motivo Retiro</th>
							<td>{{ $matricula->mat_motivo }}</td>
						</tr>
					@endif
				</thead>
			</table>
		</div>





@if ($matricula->cursos != '[]')



<div class="ui menu pointing">
	<a data-tab="curso" class="active item text-navy2"><i class="icon edit"></i> Curso</a>
	<a data-tab="notas" class="item text-navy2"><i class="icon table"></i> Notas</a>
	<a data-tab="asistencias" class="item text-navy2"><i class="icon calendar outline check"></i> Asistencia</a>
	<a data-tab="ensayos" class="item text-navy2"><i class="icon file alternate outline"></i> Ensayos</a>
</div>

{{-- ++++++++++++++++++++++++++++++++++ CURSO ++++++++++++++++++++++++++++++++++ --}}

<div class="ui segment raised active tab animated fadeIn" data-tab="curso">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon edit"></i>
        Curso
    </h4>
	<table class="ui table">
		<thead>
			<tr>
				<th style="width: 25%">Curso</th>
				<td style="width: 25%">{{ $curso->nombreCurso() }}</td>
				<th style="width: 25%">Profesor Jefe</th>
				<td style="width: 25%">{{ $curso->profesorJefe->persona->nombreCompleto() }}</td>
			</tr>
			<tr>
				<th>Periodo</th>
				<td>{{ $curso->periodo->pac_ano }}</td>
				<th>Aula</th>
				<td>
					@if ($curso->aula_id != null)
						{{ $curso->aula->aul_numero }}
					@endif
				</td>
			</tr>
			<tr>
				<th>Decreto Plan de Estudio</th>
				<td>{{ $curso->planEstudio->decreto_plan() }}</td>
				<th>Decreto Evaluación</th>
				<td>{{ $curso->planEstudio->decreto_eval() }}</td>
			</tr>
		</thead>
	</table>
</div>

{{-- ++++++++++++++++++++++++++++++++++ NOTAS ++++++++++++++++++++++++++++++++++ --}}


<div class="ui segment raised tab animated fadeIn" data-tab="notas">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon table"></i>
        Notas
    </h4>
	<div class="ui secondary menu sem_notas">
	    @foreach ($curso->periodo->semestres as $count => $semestre)
			<a class="item sem {{ ($semestre->sem_estado == 1) ? 'active bg-light-blue':'' }}" data-tab="notas{{ $semestre->sem_numero }}">{{ $semestre->sem_numero }}° Semestre</a>
	    @endforeach
		@if ($matricula->periodo->semestres->where('sem_estado', 2)->count() == 2)
			<a class="item active sem bg-light-blue" data-tab="total_notas">Total</a>
		@endif
	</div>

	@foreach ($matricula->periodo->semestres as $semestre)
		<div class="ui {{ ($semestre->sem_estado == 1)? 'active':'' }} tab secondary no-margin animated fadeIn" data-tab="notas{{ $semestre->sem_numero }}">
			<table class="table ui celled structured">
				<thead>
					<tr>
						<th rowspan="2" class="center aligned">ASIGNATURAS</th>
						<th rowspan="2" class="center aligned">PROFESOR</th>
						<th colspan="13" class="center aligned">NOTAS</th>
					</tr>
					<tr>
						<th>N1</th>
						<th>N2</th>
						<th>N3</th>
						<th>N4</th>
						<th>N5</th>
						<th>N6</th>
						<th>N7</th>
						<th>N8</th>
						<th>N9</th>
						<th>N10</th>
						<th>N11</th>
						<th>N12</th>
						<th class="collapsing">Prom</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($curso->clases as $clases)
						<tr>
							<td>{{ $clases->asignatura->asig_nombre }}</td>
							<td>{{ $clases->profesor->persona_rut }}</td>
							@php
								$notas = $matricula->notas->where('clase_id', $clases->cla_id)->where('semestre_id', $semestre->sem_id)->first();
							@endphp
							@if ($notas != null)
								@for ($i = 1; $i < 13; $i++)
								<td class="center aligned {{ $notas->tdColorNota($notas->not_nota1) }}">
									{{ (strlen($notas['not_nota'.$i]) == 1) ? $notas['not_nota'.$i].'.0': $notas['not_nota'.$i] }}
								</td>
								@endfor
								<td class="warning center aligned">
									{{ (strlen($notas->not_promedio) == 1) ? $notas->not_promedio.'.0': $notas->not_promedio }}
								</td>
							@else
								@for ($i = 0; $i < 12; $i++)
									<td></td>
								@endfor
								<td class="warning center aligned"></td>
							@endif
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	@endforeach
	@if ($matricula->periodo->semestres->where('sem_estado', 2)->count() == 2)
		<div class="ui active tab secondary no-margin animated fadeIn" data-tab="total_notas">
			<table class="table ui celled structured">
				<thead>
					<tr>
						<th rowspan="2" class="center aligned">ASIGNATURAS</th>
						<th rowspan="2" class="center aligned">PROFESOR</th>
						<th colspan="{{ $matricula->periodo->semestres->count()+1 }}" class="center aligned">NOTAS</th>
					</tr>
					<tr>
						@foreach ($matricula->periodo->semestres as $semestre)
							<th class="center aligned collapsing">{{ $semestre->sem_numero }}° SEM</th>
						@endforeach
						<th class="collapsing">Promedio General</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($curso->clases as $clases)
						<tr>
							<td>{{ $clases->asignatura->asig_nombre }}</td>
							<td>{{ $clases->profesor->persona->nombreCompleto() }}</td>
							@foreach ($curso->periodo->semestres as $sem)
								<td class="center aligned">
									{{ $matricula->prom_clase_sem($clases->cla_id, $sem->sem_id) }}
								</td>
							@endforeach
							<td class="center aligned warning">{{ $matricula->prom_not_clase($clases->cla_id) }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	@endif
</div>

{{-- ++++++++++++++++++++++++++++++++++ ASISTENCIAS ++++++++++++++++++++++++++++++++++ --}}

<div class="ui segment raised tab animated fadeIn" data-tab="asistencias">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon calendar outline check"></i>
        Asistencia
    </h4>
    @php
    	$count_sem = $matricula->periodo->semestres->where('sem_estado', '=',2)->count();
    	$total_sem = $matricula->periodo->semestres->count();
    @endphp
	<div class="ui secondary menu sem_notas">
	    @foreach ($curso->periodo->semestres as $count => $semestre)
			<a class="item sem {{ ($semestre->sem_estado == 1) ? 'active bg-light-blue':'' }}" data-tab="asis{{ $semestre->sem_numero }}">{{ $semestre->sem_numero }}° Semestre</a>
	    @endforeach
		@if ($matricula->periodo->semestres->where('sem_estado','<>', 0)->count() == 2)
			<a class="item {{ ($count_sem == $total_sem)? 'active bg-light-blue':'' }} sem" data-tab="total_asis">Total</a>
		@endif
	</div>
		@foreach ($matricula->periodo->semestres as $semestre)
			<div class="ui {{ ($semestre->sem_estado == 1)? 'active':'' }} tab secondary no-margin animated fadeIn" data-tab="asis{{ $semestre->sem_numero }}">
				<table class="table ui celled structured small compact">
					<thead>
						<tr>
							<th rowspan="2" class="center aligned">Asignatura</th>
							{{-- 
							<th rowspan="2">Profesor</th>
							 --}}
							<th colspan="{{ $meses_count[$semestre->sem_id] }}" class="center aligned">Cantidad Inasistencia</th>
							<th colspan="4" class="center aligned">Resumen Total Hrs. Semestrales</th>
						</tr>
						<tr style="font-size: 11px;">
							@foreach ($meses_asis[$semestre->sem_id] as $mes)
								<th class="center aligned">{{ $mes['mes'] }}</th>
							@endforeach
							<th class="center aligned">T. ASIS</th>
							<th class="center aligned">T. INAS.</th>
							<th class="center aligned">% ASIS.</th>
							<th class="center aligned">% INAS.</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($curso->clases as $clases)
							<tr>
								<td>{{ $clases->asignatura->asig_nombre }}</td>
								{{-- 
								<td>{{ $clases->profesor->persona_rut }}</td>
								 --}}
								@foreach ($meses_asis[$semestre->sem_id] as $mes)
									@php
										$dias_mes = $matricula->diaClases()->where('semestre_id', $semestre->sem_id)->whereMonth('dc_fecha', $mes['num'])->pluck('dc_id');
										$clases_mes = $clases->clasesRealizadas()->whereIn('dia_clase_id', $dias_mes)->pluck('cr_id');
									@endphp
									@if ($clases_mes != '[]')
										<td class="center aligned">
											{{-- 
											{{ round($matricula->asistencias->whereIn('cla_realizados_id', $clases_mes)->avg('asis_estado') * 100, 1) }} %
											 --}}
											 {{ $matricula->asistencias->whereIn('cla_realizados_id', $clases_mes)->where('asis_estado', 0)->count() }}
										</td>
									@else
										<td></td>
									@endif
								@endforeach
								@php
									$array_dia_clase = $matricula->diaClases->where('semestre_id', $semestre->sem_id)->pluck('dc_id');
									$array_asis_clase = $clases->clasesRealizadas->whereIn('dia_clase_id', $array_dia_clase)->pluck('cr_id');
									$count_asis = $matricula->asistencias->whereIn('cla_realizados_id', $array_asis_clase)->where('asis_estado', 1)->count();
									$count_inasis = $matricula->asistencias->whereIn('cla_realizados_id', $array_asis_clase)->where('asis_estado', 0)->count();
								@endphp
								<td class="center aligned">{{ $count_asis }}</td>
								<td class="center aligned">{{ $count_inasis }}</td>
								<td class="center aligned">{{ $matricula->prom_asis_cla_sem($semestre->sem_id, $clases->cla_id).' %' }}</td>
								<td class="center aligned">{{ $matricula->prom_inasis_cla_sem($semestre->sem_id, $clases->cla_id).' %' }}</td>
								{{-- 
								<td class="center aligned warning">
									{{ round($matricula->asistencias->whereIn('cla_realizados_id', $array_asis_clase)->avg('asis_estado') * 100, 1) }} %
								</td>
								 --}}
							</tr>
						@endforeach
						<tr class="active">
							<td class="right aligned"><b>Asistencia General</b></td>
							@foreach ($meses_asis[$semestre->sem_id] as $mes)
								<td class="center aligned"><b>{{ $matricula->diaClases()->whereMonth('dc_fecha', $mes['num'])->where('semestre_id', $semestre->sem_id)->wherePivot('ala_estado', 0)->count() }}</b></td>
							@endforeach
							<td class="center aligned"><b>{{ $matricula->diaClases()->where('semestre_id', $semestre->sem_id)->wherePivot('ala_estado', 1)->count() }}</b></td>
							<td class="center aligned"><b>{{ $matricula->diaClases()->where('semestre_id', $semestre->sem_id)->wherePivot('ala_estado', 0)->count() }}</b></td>
							<td class="center aligned"><b>{{ $matricula->prom_asis_sem($semestre->sem_id).' %' }}</b></td>
							<td class="center aligned"><b>{{ $matricula->prom_inasis_sem($semestre->sem_id).' %' }}</b></td>
						</tr>
					</tbody>
				</table>
			</div>
		@endforeach

		@if ($matricula->periodo->semestres->where('sem_estado','<>', 0)->count() == 2)
			<div class="ui {{ ($count_sem == $total_sem)? 'active':'' }} tab secondary no-margin animated fadeIn" data-tab="total_asis">
				<table class="table ui celled structured small compact">
					<thead>
						<tr>
							<th rowspan="2">Asignatura</th>
							@foreach ($matricula->periodo->semestres as $semestre)
								<th class="center aligned" colspan="2">{{ $semestre->sem_numero }}° SEMESTRE</th>
							@endforeach
							<th colspan="4" class="center aligned">Resumen Total Hrs. Anual</th>
						</tr>
						<tr style="font-size: 11px;">
							@for ($i = 0; $i < $matricula->periodo->semestres->count(); $i++)
								<th class="" >T. Asis.</th>
								<th class="" >T. Inas.</th>
							@endfor
							<th class="center aligned">T. ASIS</th>
							<th class="center aligned">T. INAS.</th>
							<th class="center aligned">% ASIS.</th>
							<th class="center aligned">% INAS.</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($curso->clases as $clases)
							<tr>
								<td>{{ $clases->asignatura->asig_nombre }}</td>
								@foreach ($matricula->periodo->semestres as $semestre)
									@php
										$array_dia_clase = $matricula->diaClases->where('semestre_id', $semestre->sem_id)->pluck('dc_id');
										$array_asis_clase = $clases->clasesRealizadas->whereIn('dia_clase_id', $array_dia_clase)->pluck('cr_id');
										$count_asis = $matricula->asistencias->whereIn('cla_realizados_id', $array_asis_clase)->where('asis_estado', 1)->count();
										$count_inasis = $matricula->asistencias->whereIn('cla_realizados_id', $array_asis_clase)->where('asis_estado', 0)->count();
									@endphp
									<td class="center aligned">{{ $count_asis }}</td>
									<td class="center aligned">{{ $count_inasis }}</td>
								@endforeach
								@php
									$array_dia_clase = $matricula->diaClases->pluck('dc_id');
									$array_asis_clase = $clases->clasesRealizadas->whereIn('dia_clase_id', $array_dia_clase)->pluck('cr_id');
									$total_asig_asis = $matricula->asistencias->whereIn('cla_realizados_id', $array_asis_clase)->where('asis_estado', 1)->count();
									$total_asig_inas = $matricula->asistencias->whereIn('cla_realizados_id', $array_asis_clase)->where('asis_estado', 0)->count();


									$total_asis = $matricula->diaClases()->wherePivot('ala_estado', 1)->count();
									$total_inas = $matricula->diaClases()->wherePivot('ala_estado', 0)->count();
								@endphp
								<td class="center aligned"><b>{{ $total_asig_asis }}</b></td>
								<td class="center aligned"><b>{{ $total_asig_inas }}</b></td>
								<td class="warning center aligned"><b>{{ $matricula->prom_asis_anual_clase($clases->cla_id).' %' }}</b></td>
								<td class="warning center aligned"><b>{{ $matricula->prom_inasis_anual_clase($clases->cla_id).' %' }}</b></td>
							</tr>
						@endforeach
						<tr class="active">
							@php
								$total_asis = $matricula->diaClases()->wherePivot('ala_estado', 1)->count();
								$total_inas = $matricula->diaClases()->wherePivot('ala_estado', 0)->count();

							@endphp
							<td class="right aligned"><b>Asistencia General</b></td>
							@foreach ($matricula->periodo->semestres as $semestre)
								@php
									$cont_asis = $matricula->diaClases()->wherePivot('ala_estado', 1)->where('semestre_id', $semestre->sem_id)->count();
									$cont_inas = $matricula->diaClases()->wherePivot('ala_estado', 0)->where('semestre_id', $semestre->sem_id)->count();
								@endphp
								<td class="center aligned">{{ $cont_asis }}</td>
								<td class="center aligned">{{ $cont_inas }}</td>
							@endforeach
							<td class="center aligned"><b>{{ $total_asis }}</b></td>
							<td class="center aligned"><b>{{ $total_inas }}</b></td>
							<td class="center aligned"><b>{{ $matricula->prom_asis_anual().' %' }}</b></td>
							<td class="center aligned"><b>{{ $matricula->prom_inasis_anual().' %' }}</b></td>
						</tr>
					</tbody>
				</table>
			</div>
		@endif
</div>

{{-- ++++++++++++++++++++++++++++++++++ ENSAYOS ++++++++++++++++++++++++++++++++++ --}}

<div class="ui segment raised tab animated fadeIn" data-tab="ensayos">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon file alternate outline"></i>
        Ensayos
    </h4>
	<div class="ui secondary menu sem_notas">
		<a class="item sem active bg-light-blue" data-tab="simce">SIMCE</a>
		<a class="item sem" data-tab="psu">PSU</a>
	</div>
	<div class="ui active tab secondary animated fadeIn" data-tab="simce">
		<table class="table ui celled">
			<thead>
				<tr>
					<th>Materia</th>
					<th>Fecha</th>
					<th>Puntaje</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($matricula->ensayos->where('tipo_id', $ensayos->where('ten_tipo', 'SIMCE')->first()->ten_id) as $ensayo)
					<tr>
						<td>{{ $ensayo->materia->mens_nombre }}</td>
						<td>{{ $ensayo->ens_fecha }}</td>
						<td class="warning">{{ $ensayo->pivot->alr_resultado }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="ui tab secondary animated fadeIn" data-tab="psu">
		<table class="table ui celled">
			<thead>
				<tr>
					<th>Materia</th>
					<th>Fecha</th>
					<th>Puntaje</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($matricula->ensayos->where('tipo_id', $ensayos->where('ten_tipo', 'PSU')->first()->ten_id) as $ensayo)
					<tr>
						<td>{{ $ensayo->materia->mens_nombre }}</td>
						<td>{{ $ensayo->ens_fecha }}</td>
						<td class="warning">{{ $ensayo->pivot->alr_resultado }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>


@endif





<script type="text/javascript">
	$('.item.sem').on('click', function(){
		$(this).parent('.menu').children('.bg-light-blue').removeClass('bg-light-blue')
		$(this).addClass('bg-light-blue');
	})
</script>




@endsection
