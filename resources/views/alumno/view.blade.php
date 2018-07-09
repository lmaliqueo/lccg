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
		        {{-- Ver Perfil Alumno --}}{{ $alumno->alumno->nombreCompleto() }}
			</span>
        </h2>
        <p>
            {{-- <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('articulos.index') }}"><i class="arrow left icon"></i> Volver</a> --}}
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('alumnos.index') }}"><i class="arrow left icon"></i> Volver</a>
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
						<td style="width: 25%;">{{ $alumno->alumno_rut }}</td>
						<th style="width: 25%;">Fecha Nacimiento</th>
						<td style="width: 25%;">{{ $alumno->alumno->al_fecha_nacimiento }}</td>
					</tr>
					<tr>
						<th>Comuna</th>
						<td>{{ $alumno->alumno->comuna->com_nombre }}</td>
						<th>Dirección</th>
						<td>{{ $alumno->alumno->al_domicilio }}</td>
					</tr>
					<tr>
						<th>Sexo</th>
						<td>{{ $alumno->alumno->al_sexo }}</td>
						<th>Contacto</th>
						<td>{{ $alumno->alumno->al_fono }}</td>
					</tr>
					<tr>
						<th>Fecha de Ingreso</th>
						<td>{{ $alumno->mat_fecha_ingreso }}</td>
						<th>Estado</th>
						<td><label class="label ui {{ $alumno->color_estado() }}">{{ $alumno->estado() }}</label></td>
					</tr>
					@if ($alumno->mat_estado == 3)
						<tr>
							<th>Fecha Retiro</th>
							<td>{{ $alumno->mat_fecha_retiro }}</td>
							<th>Motivo Retiro</th>
							<td>{{ $alumno->mat_motivo }}</td>
						</tr>
					@endif
					@if ($alumno->curso->count())
						<tr>
							<th>Curso</th>
							<td>{{ $alumno->curso->first()->nombreCurso() }}</td>
							<th>Promedio</th>
							<td>{{ $alumno->mat_prom_general }}</td>
						</tr>
					@endif
				</thead>
			</table>
		</div>




@if ($alumno->curso->count())


<div class="ui menu pointing">
	<a data-tab="notas" class="active item text-navy2"><i class="icon table"></i> Notas</a>
	<a data-tab="asistencias" class="item text-navy2"><i class="icon calendar outline check"></i> Asistencia</a>
	<a data-tab="ensayos" class="item text-navy2"><i class="icon file alternate outline"></i> Ensayos</a>
</div>


{{-- ++++++++++++++++++++++++++++++++++ NOTAS ++++++++++++++++++++++++++++++++++ --}}


<div class="ui segment raised active tab animated fadeIn" data-tab="notas">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon table"></i>
        Notas
    </h4>
	<div class="ui secondary menu sem_notas">
	    @foreach ($curso->periodo->semestres as $count => $semestre)
			<a class="item sem {{ ($semestre->sem_estado == 1) ? 'active bg-light-blue':'' }}" data-tab="notas{{ $semestre->sem_numero }}">{{ $semestre->sem_numero }}° Semestre</a>
	    @endforeach
		@if ($alumno->periodo->semestres->where('sem_estado', 2)->count() == 2)
			<a class="item active sem bg-light-blue" data-tab="total_notas">Total</a>
		@endif
	</div>

	@foreach ($alumno->periodo->semestres as $semestre)
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
								$notas = $alumno->notas->where('clase_id', $clases->cla_id)->where('semestre_id', $semestre->sem_id)->first();
							@endphp
							@if ($notas != null)
								<td class="center aligned {{ $notas->tdColorNota($notas->not_nota1) }}">
									{{ (strlen($notas->not_nota1) == 1) ? $notas->not_nota1.'.0': $notas->not_nota1 }}
								</td>
								<td class="center aligned {{ $notas->tdColorNota($notas->not_nota2) }}">
									{{ (strlen($notas->not_nota2) == 1) ? $notas->not_nota2.'.0': $notas->not_nota2 }}
								</td>
								<td class="center aligned {{ $notas->tdColorNota($notas->not_nota3) }}">
									{{ (strlen($notas->not_nota3) == 1) ? $notas->not_nota3.'.0': $notas->not_nota3 }}
								</td>
								<td class="center aligned {{ $notas->tdColorNota($notas->not_nota4) }}">
									{{ (strlen($notas->not_nota4) == 1) ? $notas->not_nota4.'.0': $notas->not_nota4 }}
								</td>
								<td class="center aligned {{ $notas->tdColorNota($notas->not_nota5) }}">
									{{ (strlen($notas->not_nota5) == 1) ? $notas->not_nota5.'.0': $notas->not_nota5 }}
								</td>
								<td class="center aligned {{ $notas->tdColorNota($notas->not_nota6) }}">
									{{ (strlen($notas->not_nota6) == 1) ? $notas->not_nota6.'.0': $notas->not_nota6 }}
								</td>
								<td class="center aligned {{ $notas->tdColorNota($notas->not_nota7) }}">
									{{ (strlen($notas->not_nota7) == 1) ? $notas->not_nota7.'.0': $notas->not_nota7 }}
								</td>
								<td class="center aligned {{ $notas->tdColorNota($notas->not_nota8) }}">
									{{ (strlen($notas->not_nota8) == 1) ? $notas->not_nota8.'.0': $notas->not_nota8 }}
								</td>
								<td class="center aligned {{ $notas->tdColorNota($notas->not_nota9) }}">
									{{ (strlen($notas->not_nota9) == 1) ? $notas->not_nota9.'.0': $notas->not_nota9 }}
								</td>
								<td class="center aligned {{ $notas->tdColorNota($notas->not_nota10) }}">
									{{ (strlen($notas->not_nota10) == 1) ? $notas->not_nota10.'.0': $notas->not_nota10 }}
								</td>
								<td class="center aligned {{ $notas->tdColorNota($notas->not_nota11) }}">
									{{ (strlen($notas->not_nota11) == 1) ? $notas->not_nota11.'.0': $notas->not_nota11 }}
								</td>
								<td class="center aligned {{ $notas->tdColorNota($notas->not_nota12) }}">
									{{ (strlen($notas->not_nota12) == 1) ? $notas->not_nota12.'.0': $notas->not_nota12 }}
								</td>
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
	@if ($alumno->periodo->semestres->where('sem_estado', 2)->count() == 2)
		<div class="ui active tab secondary no-margin animated fadeIn" data-tab="total_notas">
			<table class="table ui celled structured">
				<thead>
					<tr>
						<th rowspan="2" class="center aligned">ASIGNATURAS</th>
						<th rowspan="2" class="center aligned">PROFESOR</th>
						<th colspan="{{ $alumno->periodo->semestres->count()+1 }}" class="center aligned">NOTAS</th>
					</tr>
					<tr>
						@foreach ($alumno->periodo->semestres as $semestre)
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
									{{ $alumno->prom_clase_sem($clases->cla_id, $sem->sem_id) }}
								</td>
							@endforeach
							<td class="center aligned warning">{{ $alumno->prom_not_clase($clases->cla_id) }}</td>
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
	<div class="ui secondary menu sem_notas">
	    @foreach ($curso->periodo->semestres as $count => $semestre)
			<a class="item sem {{ ($semestre->sem_estado == 1) ? 'active bg-light-blue':'' }}" data-tab="asis{{ $semestre->sem_numero }}">{{ $semestre->sem_numero }}° Semestre</a>
	    @endforeach
		@if ($alumno->periodo->semestres->where('sem_estado', 2)->count() == 2)
			<a class="item active sem bg-light-blue" data-tab="total_asis">Total</a>
		@endif
	</div>
		@foreach ($alumno->periodo->semestres as $semestre)
			<div class="ui {{ ($semestre->sem_estado == 1)? 'active':'' }} tab secondary no-margin animated fadeIn" data-tab="asis{{ $semestre->sem_numero }}">
				<table class="table ui celled structured">
					<thead>
						<tr>
							<th rowspan="2">Asignatura</th>
							<th rowspan="2">Profesor</th>
							<th colspan="13" class="center aligned">Asistencia</th>
						</tr>
						<tr>
							<th class="center aligned">Ene</th>
							<th class="center aligned">Feb</th>
							<th class="center aligned">Mar</th>
							<th class="center aligned">Abr</th>
							<th class="center aligned">May</th>
							<th class="center aligned">Jun</th>
							<th class="center aligned">Jul</th>
							<th class="center aligned">Ago</th>
							<th class="center aligned">Sep</th>
							<th class="center aligned">Oct</th>
							<th class="center aligned">Nov</th>
							<th class="center aligned">Dic</th>
							<th class="center aligned">Prom</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($curso->clases as $clases)
							<tr>
								<td>{{ $clases->asignatura->asig_nombre }}</td>
								<td>{{ $clases->profesor->persona_rut }}</td>
								@for ($j = 1; $j <= 12; $j++)
									@php
										$dias_mes = $alumno->diaClases()->where('semestre_id', $semestre->sem_id)->whereMonth('dc_fecha', $j)->pluck('dc_id');
										$clases_mes = $clases->clasesRealizadas()->whereIn('dia_clase_id', $dias_mes)->pluck('cr_id');
									@endphp
									@if ($clases_mes != '[]')
										<td class="center aligned">
											{{ round($alumno->asistencias->whereIn('cla_realizados_id', $clases_mes)->avg('asis_estado') * 100, 1) }} %
										</td>
									@else
										<td></td>
									@endif
								@endfor
								@php
									$array_dia_clase = $alumno->diaClases->where('semestre_id', $semestre->sem_id)->pluck('dc_id');
									$array_asis_clase = $clases->clasesRealizadas->whereIn('dia_clase_id', $array_dia_clase)->pluck('cr_id');
								@endphp
								<td class="center aligned warning">
									{{ round($alumno->asistencias->whereIn('cla_realizados_id', $array_asis_clase)->avg('asis_estado') * 100, 1) }} %
								</td>
							</tr>
						@endforeach
						
					</tbody>
				</table>
			</div>
		@endforeach

		@if ($alumno->periodo->semestres->where('sem_estado', 2)->count() == 2)
			<div class="ui active tab secondary no-margin animated fadeIn" data-tab="total_asis">
				<table class="table ui celled structured">
					<thead>
						<tr>
							<th rowspan="2">Asignatura</th>
							<th rowspan="2">Profesor</th>
							<th colspan="3" class="center aligned">Asistencia</th>
						</tr>
						<tr>
							<th class="center aligned">Sem 1</th>
							<th class="center aligned">Sem 2</th>
							<th class="center aligned">Prom</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($curso->clases as $clases)
							<tr>
								<td>{{ $clases->asignatura->asig_nombre }}</td>
								<td>{{ $clases->profesor->persona->nombreCompleto() }}</td>
								@for ($i = 1; $i <= 2; $i++)
									@php
										$sem = $alumno->periodo->semestres->where('sem_numero', $i)->first();
									@endphp
									@if ($sem != null)
										<td class="center aligned">
											{{ $alumno->prom_asis_cla_sem($sem->sem_id, $clases->cla_id) }}
										</td>
									@else
										<td class="center aligned">-</td>
									@endif
								@endfor
								<td class="warning center aligned">{{ $alumno->prom_asis_anual_clase($clases->cla_id) }}</td>
							</tr>
						@endforeach
						
					</tbody>
				</table>
			</div>

		@endif
</div>

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
				@foreach ($alumno->ensayos->where('tipo_id', $ensayos->where('ten_tipo', 'SIMCE')->first()->ten_id) as $ensayo)
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
				@foreach ($alumno->ensayos->where('tipo_id', $ensayos->where('ten_tipo', 'PSU')->first()->ten_id) as $ensayo)
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
{{-- 

<div class="segment ui raised">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon book"></i>
        Datos Académico
    </h4>
</div>
 --}}


@endif




<script type="text/javascript">
	$('.item.sem').on('click', function(){
		$(this).parent('.menu').children('.bg-light-blue').removeClass('bg-light-blue')
		$(this).addClass('bg-light-blue');
	})
</script>


@endsection

