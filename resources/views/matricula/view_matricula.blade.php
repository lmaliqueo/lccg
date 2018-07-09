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
		        Ver Matrícula | {{ $matricula->alumno->nombreCompleto() }}
			</span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('matriculas.admin') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>

		<div class="segment raised ui">
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


<div class="segment ui raised">
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
							@if ($matricula->curso->count())
								<th class="collapsing">Curso</th>
								<td>
										{{ $matricula->curso->first()->nombreCurso() }}
								</td>
								<th class="collapsing">Profesor Jefe</th>
								<td>
										{{ $matricula->curso->first()->profesorJefe->persona->nombreCompleto() }}
								</td>
							@else
								<th>Nivel Curso</th>
								<td>{{ $matricula->mat_grado_curso }}</td>
							@endif
						</tr>
						<tr style="height:30px;"></tr>
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
							<td>{{ $matricula->condicional() }}</td>
							<th class="collapsing">Descripción Condicional</th>
							<td>{{ $matricula->mat_causas_cond }}</td>
						</tr>
						<tr style="height:30px;"></tr>
						<tr>
							<th>Situación Padres</th>
							<td>{{ $matricula->sit_padres() }}</td>
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
				@if ($matricula->padres->where('pad_parentesco', 'Padre')->first() != null)
					<div class="segment ui raised">
						<h4 class="ui block header">
							<i class="male icon"></i>
							<div class="content">
								Padre
							</div>
						</h4>
						@php
							$padre = $matricula->padres->where('pad_parentesco', 'Padre')->first();
						@endphp
						<table class="table ui celled structured">
							<thead>
								<tr>
									<th class="collapsing">Rut</th>
									<td colspan="3">{{ $padre->pad_rut }}</td>
									<th class="collapsing">Fecha Nacimiento</th>
									<td>{{ $padre->pad_fecha_nacimiento }}</td>
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

					</div>
				@endif


				@if ($matricula->padres->where('pad_parentesco', 'Madre')->first() != null)
					<div class="segment ui raised">
						<div style="padding-bottom: 10px">
							<h4 class="ui block header">
								<i class="female icon"></i>
								<div class="content">
									Madre
								</div>
							</h4>
							@php
								$madre = $matricula->padres->where('pad_parentesco', 'Madre')->first();
							@endphp
							<table class="table ui celled structured">
								<thead>
									<tr>
										<th class="collapsing">Rut</th>
										<td colspan="3">{{ $madre->pad_rut }}</td>
										<th class="collapsing">Fecha Nacimiento</th>
										<td>{{ $madre->pad_fecha_nacimiento }}</td>
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
						</div>
					</div>
				@endif
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
						@if ($matricula->apoderados->count())
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


@endsection
