<div class="ui raised segment">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon student"></i>
        Alumno
    </h4>
    <a class="ui red right corner label cancelar_button">
        <i class="remove icon"></i>
    </a>
	<table class="table ui celled small">
		<thead>
			<tr>
				<th style="width: 25%">Nombre</th>
				<td style="width: 25%">{{ $alumno->nombreCompleto() }}</td>
				<th style="width: 25%">Rut</th>
				<td style="width: 25%">{{ $alumno->al_rut }}</td>
			</tr>
			<tr>
				<th>Comuna</th>
				<td>{{ $alumno->comuna->com_nombre }}</td>
				<th>Domicilio</th>
				<td>{{ $alumno->al_domicilio }}</td>
			</tr>
			<tr>
				<th>Sexo</th>
				<td>{{ $alumno->al_sexo }}</td>
				<th>Fecha de Nacimiento</th>
				<td>{{ $alumno->al_fecha_nacimiento }}</td>
			</tr>
		</thead>
	</table>
</div>

<div class="ui top attached menu">
	@foreach ($matriculas as $count => $matricula)
		@if ($matricula->curso->count())
			@if ($count == 0)
				<a class="item active" data-tab="{{ $matricula->mat_id }}">{{ $matricula->periodo->pac_ano }} - <label class="ui label circular {{ $matricula->color_estado() }}">{{ $matricula->curso->first()->nombreCurso() }}</label></a>
			@else
				<a class="item" data-tab="{{ $matricula->mat_id }}">{{ $matricula->periodo->pac_ano }} - <label class="ui label circular {{ $matricula->color_estado() }}">{{ $matricula->curso->first()->nombreCurso() }}</label></a>
			@endif
		@endif
	@endforeach
</div>
@foreach ($matriculas as $i => $matricula)
	@php
		$curso = $matricula->curso->first();
	@endphp
	@if ($matricula->curso->count())
		@if ($i == 0)
			<div class="ui bottom attached tab segment active no-border animated fadeIn secondary" data-tab="{{ $matricula->mat_id }}">
		@else
			<div class="ui bottom attached tab segment no-border animated fadeIn secondary" data-tab="{{ $matricula->mat_id }}">
		@endif

			<div class="segment ui raised">
			    <h4 class="ui horizontal divider header text-navy2">
			        <i class="icon open folder outline"></i>
			        Matrícula
			    </h4>
				<table class="table small ui">
					<thead>
						<tr>
							<th style="width: 25%">Matrícula ID</th>
							<td style="width: 25%">{{ $matricula->mat_id }}</td>
							<th style="width: 25%">Numero Matrícula</th>
							<td style="width: 25%">{{ $matricula->mat_numero }}</td>
						</tr>
						<tr>
							<th>Procedencia Escolar</th>
							<td>
								@if ($matricula->est_anterior_id != null) 
									{{ $matricula->escuela->eant_nombre }}
								@else
									<em>Ninguna</em>
								@endif
							</td>
							<th>Promedio de Ingreso</th>
							<td>{{ $matricula->print_nota($matricula->mat_prom_ingreso) }}</td>
						</tr>
						<tr>
							<th>Condicional</th>
							<td>{{ $matricula->condicional() }}</td>
							<th>Motivo de Condicional</th>
							<td>{{ $matricula->mat_causas_cond }}</td>
						</tr>
						<tr>
							<th>Posoción Lista de Curso</th>
							<td>{{ $matricula->mat_posicion_lista }}</td>
							<th>Clases de Religión</th>
							<td>{{ ($matricula->mat_clases_religion) ? 'Si':'No' }}</td>
						</tr>
						<tr>
							<th>Fecha Ingreso</th>
							<td>{{ $matricula->mat_fecha_ingreso }}</td>
							<th>Estado</th>
							<td><label class="label ui small {{ $matricula->color_estado() }}">{{ $matricula->estado() }}</label></td>
						</tr>
						@if ($matricula->mat_estado == 3)
							<tr>
								<th>Fecha Retiro</th>
								<td>{{ $matricula->mat_fecha_retiro }}</td>
								<th>Motivo de Retiro</th>
								<td>{{ $matricula->mat_motivo }}</td>
							</tr>
						@endif
					</thead>
				</table>
				<table class="table ui small">
					<thead>
						<tr>
							<th style="width: 25%;">Promedio Notas</th>
							<td style="width: 25%;">{{ $matricula->mat_prom_general }}</td>
							<th style="width: 25%;">Promedio Asistencia</th>
							<td style="width: 25%;">{{ $matricula->mat_prom_asis }} %</td>
						</tr>
					</thead>
				</table>
			</div>
@if ($matricula->curso->count())
    @php
    	$count_sem = $matricula->periodo->semestres->where('sem_estado', '=',2)->count();
    	$total_sem = $matricula->periodo->semestres->count();
    @endphp
		    <h4 class="ui horizontal divider header text-navy2">
		        <i class="icon book"></i>
		        Académico
		    </h4>

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
							@php
								$notas = $matricula->notas->where('clase_id', $clases->cla_id)->where('semestre_id', $semestre->sem_id)->first();
							@endphp
							@if ($notas != null)
								@for ($i = 1; $i < 13; $i++)
								<td class="center aligned {{ $notas->tdColorNota($notas['not_nota'.$i]) }}">
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
					<tr class="active">
						@php
							$prom_sem = $matricula->notas->where('semestre_id', $semestre->sem_id)->avg('not_promedio');
						@endphp
						<td colspan="13" class="right aligned"><b>Promedio {{ $semestre->sem_numero }}° Semestre</b></td>
						<td class="center aligned"><b>{{ $matricula->print_nota($prom_sem) }}</b></td>
					</tr>
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
							@foreach ($curso->periodo->semestres as $sem)
								<td class="center aligned">
									{{ $matricula->prom_clase_sem($clases->cla_id, $sem->sem_id) }}
								</td>
							@endforeach
							<td class="center aligned warning">{{ $matricula->prom_not_clase($clases->cla_id) }}</td>
						</tr>
					@endforeach
					<tr class="active">
						@php
							$prom_sem = $matricula->notas->where('semestre_id', $semestre->sem_id)->avg('not_promedio');
						@endphp
						<td colspan="3" class="right aligned"><b>Promedio Año {{ $matricula->periodo->pac_ano }}</b></td>
						<td class="center aligned"><b>{{ $matricula->mat_prom_general }}</b></td>
					</tr>
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
    <table class="table ui celled">
    	<thead>
    		<tr>
    			<th>ID</th>
    			<th>Tipo Ensayo</th>
    			<th>Materia</th>
    			<th>Fecha</th>
    			<th>Puntaje</th>
    		</tr>
    	</thead>
    	<tbody>
    		@foreach ($matricula->ensayos as $ensayo)
    			<tr>
    				<td>{{ $ensayo->ens_id }}</td>
    				<td>{{ $ensayo->tipo->ten_tipo }}</td>
    				<td>{{ $ensayo->materia->mens_nombre }}</td>
    				<td>{{ $ensayo->ens_fecha }}</td>
    				<td>{{ $ensayo->pivot->alr_resultado }}</td>
    			</tr>
    		@endforeach
    	</tbody>
    </table>
</div>


@endif

			
	{{-- 	<div class="segment ui raised">
		    <h4 class="ui horizontal divider header text-navy2">
		        <i class="icon book"></i>
		        Académico
		    </h4>
				<div class="ui secondary menu sem_notas">
					<a class="item opciones active bg-light-blue" data-tab="notas">Notas</a>
					<a class="item opciones" data-tab="asistencias">Asistencias</a>
					<a class="item opciones" data-tab="ensayos">Ensayos</a>
				</div>

				<div class="ui active tab secondary no-margin animated fadeIn" data-tab="notas">
					<table class="table ui celled structured">
						<thead>
							<tr>
								<th rowspan="2">ID</th>
								<th rowspan="2">Asignatura</th>
								<th rowspan="2">Profesor</th>
								<th class="center aligned" colspan="4">Notas</th>
							</tr>
							<tr>
								<th class="center aligned collapsing">1° SEM</th>
								<th class="center aligned collapsing">2° SEM</th>
								<th class="center aligned collapsing">Prom General</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($mat->curso->first()->clases as $clase)
							@if (($clase->asignatura->asig_nombre != 'Religion') || ($mat->mat_clases_religion == 1))
								<tr>
									<td>{{ $clase->cla_id }}</td>
									<td>{{ $clase->asignatura->asig_nombre }}</td>
									<td>{{ $clase->profesor->persona->nombreCompleto() }}</td>


									@for ($i = 1; $i <= 2; $i++)
										@php
											$sem = $mat->periodo->semestres->where('sem_numero', $i)->first();
										@endphp

										@if ($sem != null)
											<td class="center aligned">{{ $mat->prom_clase_sem($clase->cla_id, $sem->sem_id) }}</td>
										@else
											<td class="center aligned">-</td>
										@endif

									@endfor
									<td class="warning collapsing center aligned">{{ $mat->prom_not_clase($clase->cla_id) }}</td>
								</tr>
							@endif
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th colspan="5" class="right aligned"><strong>Promedio Final</strong></th>
								<th class="center aligned"><b>{{ $mat->mat_prom_general }}</b></th>
							</tr>
						</tfoot>
					</table>
				</div>
				<div class="ui tab secondary no-margin animated fadeIn" data-tab="asistencias">
					<table class="table ui celled structured">
						<thead>
							<tr>
								<th rowspan="2">ID</th>
								<th rowspan="2" class="center aligned">Asignatura</th>
								<th rowspan="2">Profesor</th>
								<th colspan="3" class="center aligned">Asistencias</th>
							</tr>
							<tr>
								<th class="collapsing center aligned">1° SEM</th>
								<th class="collapsing center aligned">2° SEM</th>
								<th class="collapsing center aligned">ANUAL</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($mat->curso->first()->clases as $clases)
							@if (($clases->asignatura->asig_nombre != 'Religion') || ($mat->mat_clases_religion == 1))
								<tr>
									<td>{{ $clases->cla_id }}</td>
									<td>{{ $clases->asignatura->asig_nombre }}</td>
									<td>{{ $clases->profesor->persona->nombreCompleto() }}</td>
									@for ($i = 1; $i <= 2; $i++)
										@php
											$sem = $mat->periodo->semestres->where('sem_numero', $i)->first();
										@endphp
										@if ($sem != null)
											<td class="center aligned">
												{{ $mat->prom_asis_cla_sem($sem->sem_id, $clases->cla_id) }}
											</td>
										@else
											<td class="center aligned">-</td>
										@endif
									@endfor
									<td class="warning center aligned">{{ $mat->prom_asis_anual_clase($clases->cla_id) }}</td>
								</tr>

							@endif
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th colspan="5" class="right aligned">Promedio Asistencia</th>
								<th class="center aligned">{{ $mat->prom_asis_anual() }}</th>
							</tr>
						</tfoot>
					</table>
				</div>
				<div class="ui tab secondary no-margin animated fadeIn" data-tab="ensayos">
		    <table class="table ui celled">
		    	<thead>
		    		<tr>
		    			<th>ID</th>
		    			<th>Tipo Ensayo</th>
		    			<th>Materia</th>
		    			<th>Fecha</th>
		    			<th>Puntaje</th>
		    		</tr>
		    	</thead>
		    	<tbody>
		    		@foreach ($mat->ensayos as $ensayo)
		    			<tr>
		    				<td>{{ $ensayo->ens_id }}</td>
		    				<td>{{ $ensayo->tipo->ten_tipo }}</td>
		    				<td>{{ $ensayo->materia->mens_nombre }}</td>
		    				<td>{{ $ensayo->ens_fecha }}</td>
		    				<td>{{ $ensayo->pivot->alr_resultado }}</td>
		    			</tr>
		    		@endforeach
		    	</tbody>
		    </table>
				</div>
		</div>--}}
 

		</div>
	@endif
@endforeach






<script type="text/javascript">
$('.ui .menu .item')
  .tab()
;


    $('.cancelar_button').on('click', function(){
        $('.info_inputs').show();
        $('#content_alu').hide();
        $('input[name="matricula[mat_id]"]').val('');
        $('input[name="alumno[nombre]"]').val('');
        $('#mensajes').hide().html('');
    })
	$('.item.sem').on('click', function(){
		$(this).parent('.menu').children('.bg-light-blue').removeClass('bg-light-blue')
		$(this).addClass('bg-light-blue');
	})


	$('.item.opciones').on('click', function(){
		$(this).parent('.menu').children('.bg-light-blue').removeClass('bg-light-blue')
		$(this).addClass('bg-light-blue');
	})
</script>




