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
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('matriculas.admin') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>

		<div class="segment raised ui attached">
		    <h4 class="ui horizontal divider header text-navy2">
		        <i class="icon user"></i>
		        Datos Personales
		    </h4>


			<table class="table ui celled structured">
				<thead>
{{-- 
										<tr>
											<th>Nombre</th>
											<td colspan="3">{{ $matricula->alumno->nombreCompleto() }}</td>
										</tr>
					 --}}					
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
						<td>{{ $matricula->alumno->al_contacto }}</td>
					</tr>
				</thead>
			</table>
		</div>
<div class="ui styled accordion fluid inverted">
	<div class="title bg-navy1 text-center">
		<i class="dropdown icon"></i>
		Ver más información
	</div>
	<div class="content secondary">



<div class="ui grid">
	<div class="four wide column">
		<div class="ui vertical fluid tabular menu">
			<a class="active item" data-tab="matricula">
				Matricula
			</a>
			<a class="item" data-tab="padres">
				Padres
			</a>
			<a class="item" data-tab="apoderados">
				Apoderados
			</a>
		</div>
	</div>
	<div class="twelve wide stretched column">
		<div class="segment ui raised tab active" data-tab="matricula">
			<table class="ui celled structured table">
				<thead>
					<tr style="border-bottom: 1px solid rgba(34, 36, 38, 0.1); border-top: 1px solid rgba(34, 36, 38, 0.1);">
						<th class="collapsing">Curso</th>
						<td>
							@if ($matricula->cursos != '[]')
								{{ $matricula->curso->first()->nombreCurso() }}
							@endif
						</td>
						<th class="collapsing">Profesor Jefe</th>
						<td>
							@if ($matricula->cursos != '[]')
								{{ $matricula->curso->first()->profesorJefe->persona->nombreCompleto() }}
							@endif
						</td>
					</tr>
					<tr style="height:30px;"></tr>
					<tr style="border-bottom: 1px solid rgba(34, 36, 38, 0.1); border-top: 1px solid rgba(34, 36, 38, 0.1);">
						<th class="collapsing">Procedimiento Escolar</th>
						<td colspan="3">{{ $matricula->mat_proc_escolar }}</td>
					</tr>
					<tr style="border-bottom: 1px solid rgba(34, 36, 38, 0.1);">
						<th class="collapsing">Establecimiento Anterior</th>
						<td>
							@if ($matricula->est_anterior_id != null)
								{{ $matricula->escuela->eant_nombre }}
							@endif
						</td>
						<th class="collapsing">Promedio Ingreso</th>
						<td>{{ $matricula->mat_prom_ingreso }}</td>
						
					</tr>
					<tr style="height:30px;"></tr>
					<tr style="border-bottom: 1px solid rgba(34, 36, 38, 0.1); border-top: 1px solid rgba(34, 36, 38, 0.1);">
						<th class="collapsing">Condicional</th>
						<td>{{ $matricula->mat_condicional }}</td>
						<th class="collapsing">Descripción Condicional</th>
						<td>{{ $matricula->mat_causas_cond }}</td>
					</tr>
					<tr style="height:30px;"></tr>
					<tr>
						<th>Situación Padres</th>
						<td>{{ $matricula->mat_sit_padres }}</td>
						<th>Convive</th>
						<td>{{ $matricula->mat_convive }}</td>
					</tr>
					<tr>
						<th>Cantidad Hermanos</th>
						<td>{{ $matricula->mat_cant_hermanos }}</td>
						<th>Estudios de Hermanos</th>
						<td></td>
					</tr>
					<tr>
						<th>Enfermedades</th>
						<td colspan="3">
							<ul>
								@foreach ($matricula->enfermedades as $enfermedad)
									<li>{{ $enfermedad->enf_nombre }}</li>
								@endforeach
							</ul>
						</td>
					</tr>
				</thead>
			</table>
		</div>
{{-- ######################################## PADRES ######################################## --}}

		<div class="ui tab" data-tab="padres">
				<div class="segment ui raised">
						<h4 class="ui block header">
							<i class="male icon"></i>
							<div class="content">
								Padre
							</div>
						</h4>
						@if ($matricula->padres->where('pad_parentesco', 'Padre') != '[]')
							@php
								$padre = $matricula->padres->where('pad_parentesco', 'Padre')->first();
							@endphp
							<table class="table ui celled structured">
								<thead>
									<tr>
										<th class="collapsing">Rut</th>
										<td colspan="5">{{ $padre->pad_rut }}</td>
									</tr>
									<tr>
										<th class="collapsing">Nombre</th>
										<td colspan="3">{{ $padre->nombreCompleto() }}</td>
										<th class="collapsing">Estudios</th>
										<td>{{ $padre->pad_nivel_estudio }}</td>
									</tr>
									<tr>
										<th class="collapsing">Profesión</th>
										<td colspan="3">{{ $padre->pad_profesion }}</td>
										<th class="collapsing">Situacion Laboral</th>
										<td>{{ $padre->pad_sit_laboral }}</td>
									</tr>
									<tr>
										<th class="collapsing">Domicilio</th>
										<td colspan="3">{{ $padre->pad_domicilio }}</td>
										<th class="collapsing">Renta</th>
										<td>{{ $padre->pad_renta }}</td>
									</tr>
								</thead>
							</table>
						@endif

				</div>


				<div class="segment ui raised">
					<div style="padding-bottom: 10px">
						<h4 class="ui block header">
							<i class="female icon"></i>
							<div class="content">
								Madre
							</div>
						</h4>
						@if ($matricula->padres->where('pad_parentesco', 'Madre') != '[]')
							@php
								$madre = $matricula->padres->where('pad_parentesco', 'Madre')->first();
							@endphp
							<table class="table ui celled structured">
								<thead>
									<tr>
										<th class="collapsing">Rut</th>
										<td colspan="5">{{ $madre->pad_rut }}</td>
									</tr>
									<tr>
										<th class="collapsing">Nombre</th>
										<td colspan="3">{{ $madre->nombreCompleto() }}</td>
										<th class="collapsing">Estudios</th>
										<td>{{ $madre->pad_nivel_estudio }}</td>
									</tr>
									<tr>
										<th class="collapsing">Profesión</th>
										<td colspan="3">{{ $madre->pad_profesion }}</td>
										<th class="collapsing">Situacion Laboral</th>
										<td>{{ $madre->pad_sit_laboral }}</td>
									</tr>
									<tr>
										<th class="collapsing">Domicilio</th>
										<td colspan="3">{{ $madre->pad_domicilio }}</td>
										<th class="collapsing">Renta</th>
										<td>{{ $madre->pad_renta }}</td>
									</tr>
								</thead>
							</table>
						@endif
					</div>

				</div>
		</div>

		{{-- ######################################## APODERADOS ######################################## --}}

		<div class="ui tab" data-tab="apoderados">
				<div class="segment ui raised">
					<h4 class="ui block header">
						<i class="user icon"></i>
						<div class="content">
							Apoderado I
						</div>
					</h4>
					@if ($matricula->apoderados != '[]')
						@php
							$apoderado1 = $matricula->apoderados->where('ap_tipo', 1)->first();
						@endphp
						<table class="table ui celled structured">
							<thead>
								<tr>
									<th class="collapsing">Rut</th>
									<td colspan="5" class="apod1_pe_rut">{{ $apoderado1->persona_rut }}</td>
								</tr>
								<tr>
									<th class="collapsing">Nombre</th>
									<td colspan="3">{{ $apoderado1->persona->nombreCompleto() }}</td>
									<th class="collapsing">Parentesco</th>
									<td>{{ $apoderado1->ap_parentesco }}</td>
								</tr>
								<tr>
									<th class="collapsing">Dirección</th>
									<td colspan="3">{{ $apoderado1->ap_direccion }}</td>
									<th class="collapsing">Contacto</th>
									<td>{{ $apoderado1->persona->pe_contacto }}</td>
								</tr>
							</thead>
						</table>
					@endif

				</div>
				<div class="segment ui raised">
					<h4 class="ui block header">
						<i class="user icon"></i>
						<div class="content">
							Apoderado II
						</div>
					</h4>
					@if ($matricula->apoderados->count() == 2)
						@php
							$apoderado2 = $matricula->apoderados->where('ap_tipo', 2)->first();
						@endphp
						<table class="table ui celled structured">
							<thead>
								<tr>
									<th class="collapsing">Rut</th>
									<td colspan="5" class="apod1_pe_rut">{{ $apoderado2->persona_rut }}</td>
								</tr>
								<tr>
									<th class="collapsing">Nombre</th>
									<td colspan="3">{{ $apoderado2->persona->nombreCompleto() }}</td>
									<th class="collapsing">Parentesco</th>
									<td>{{ $apoderado2->ap_parentesco }}</td>
								</tr>
								<tr>
									<th class="collapsing">Dirección</th>
									<td colspan="3">{{ $apoderado2->ap_direccion }}</td>
									<th class="collapsing">Contacto</th>
									<td>{{ $apoderado2->persona->pe_contacto }}</td>
								</tr>
							</thead>
						</table>
					@endif
				</div>

		</div>
	</div>
</div>







	</div>
</div>
@if ($matricula->cursos != '[]')
	<br>
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon book"></i>
        Datos Académico
    </h4>

	<div class="ui pointing menu">
		<a class="active item" data-tab="curso">
			<i class="edit icon"></i>
			Curso
		</a>
		<a class="item" data-tab="notas">
			<i class="table icon"></i>
			Notas
		</a>
		<a class="item" data-tab="asistencia">
			<i class="calendar icon"></i>
			Asistencia
		</a>
		<a class="item" data-tab="comportamiento">
			<i class="legal icon"></i>
			Comportamiento
		</a>
	</div>
{{-- ########################################## CURSO ########################################## --}}

	<div class="segment ui raised tab active secondary" data-tab="curso">
				<table class="ui celled table">
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
{{-- 
												<tr>
													<th>Cantidad Alumnos</th>
													<td>{{ $curso->listaAlumnos->count() }}</td>
												</tr>
						 --}}						
					</thead>
				</table>
	</div>


{{-- ########################################## NOTAS ########################################## --}}
	<div class="segment ui raised tab secondary" data-tab="notas">
		<table class="table ui celled structured">
			<thead>
				<tr>
					<th rowspan="2" class="center aligned">Asignaturas</th>
					<th rowspan="2" class="center aligned">Profesor</th>
					<th colspan="13" class="center aligned">Notas</th>
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
					<th class="collapsing">Promedio</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($curso->clases as $clases)
					<tr>
						<td>{{ $clases->asignatura->asig_nombre }}</td>
						<td>{{ $clases->profesor->persona_rut }}</td>
						@php
							$notas = $matricula->notas->where('clase_id', $clases->cla_id)->first();
						@endphp
						@if ($notas != null)
							<td>{{ $notas->not_nota1 }}</td>
							<td>{{ $notas->not_nota2 }}</td>
							<td>{{ $notas->not_nota3 }}</td>
							<td>{{ $notas->not_nota4 }}</td>
							<td>{{ $notas->not_nota5 }}</td>
							<td>{{ $notas->not_nota6 }}</td>
							<td>{{ $notas->not_nota7 }}</td>
							<td>{{ $notas->not_nota8 }}</td>
							<td>{{ $notas->not_nota9 }}</td>
							<td>{{ $notas->not_nota10 }}</td>
							<td>{{ $notas->not_nota11 }}</td>
							<td>{{ $notas->not_nota12 }}</td>
							<td class="warning">{{ $notas->not_promedio }}</td>
						@else
							@for ($i = 0; $i < 12; $i++)
								<td></td>
							@endfor
							<td class="warning"></td>
						@endif
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>


{{-- ########################################## ASISTENCIA ########################################## --}}

	<div class="segment ui raised tab secondary" data-tab="asistencia">
		@php
			$mes = date('m');
		@endphp
		<table class="table ui celled structured">
			<thead>
				<tr>
					<th rowspan="2" class="center aligned">Asignaturas</th>
					<th rowspan="2" class="center aligned">Profesor</th>
					<th class="center aligned" colspan="13">Porcentaje Asistencia</th>
				</tr>
				<tr>
					<th>Ene</th>
					<th>Feb</th>
					<th>Mar</th>
					<th>Ab</th>
					<th>May</th>
					<th>Jun</th>
					<th>Jul</th>
					<th>Ag</th>
					<th>Sept</th>
					<th>Oct</th>
					<th>Nov</th>
					<th>Dic</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($curso->clases as $clases)
					<tr>
						<td>{{ $clases->asignatura->asig_nombre }}</td>
						<td>{{ $clases->profesor->persona_rut }}</td>
						@for ($i = 1; $i <= 12; $i++)
							@php
								$array_mes = $matricula->diaClases()->whereMonth('dc_fecha', $i)->get()->pluck('dc_id');
								$array_asis = $clases->clasesRealizadas()->whereIn('dia_clase_id', $array_mes)->get()->pluck('cr_id');
								$array_asis_clase = $clases->clasesRealizadas()->get()->pluck('cr_id');
							@endphp
							<td>
								@if ($array_asis != '[]')
									% {{ $matricula->asistencias()->whereIn('cla_realizados_id', $array_asis)->avg('asis_estado') * 100 }}
								@endif
							</td>
						@endfor
						<td class="warning">
							% {{ $matricula->asistencias()->whereIn('cla_realizados_id', $array_asis_clase)->avg('asis_estado') * 100 }}
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>


{{-- ######################################## COMPORTAMIENTO ######################################## --}}

	<div class="segment ui raised tab secondary" data-tab="comportamiento">
		<table class="ui celled table">
			@foreach ($pauta as $count => $grupo_pauta)
				<thead>
					<tr>
						<th>{{ $count+1 }}.- {{ $grupo_pauta->gp_descripcion }}</th>
						<th>Conceptos</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($grupo_pauta->detalles as $i => $detalles)
						<tr>
							<td style="padding-left: 30px">{{ $count+1 }}.{{ $i+1 }}.- {{ $detalles->dp_descripcion }}</td>
							<td>
								@if ($matricula->detallesConceptos != '[]')
									@foreach ($matricula->conceptos as $conceptos)
										@if ($conceptos->pivot->detallepauta_id == $detalles->dp_id)
											{{ $conceptos->con_nombre }}
											@break
										@endif
									@endforeach
								@endif
							</td>
						</tr>
					@endforeach
				</tbody>
			@endforeach
		</table>
	</div>
@endif


@endsection
