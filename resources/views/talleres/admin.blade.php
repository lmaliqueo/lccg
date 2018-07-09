@extends('admin.template.main')

@section('title', 'Talleres')

@section('content')


	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="cut icon"></i>
					<i class="corner yellow settings icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
		        Administrar Talleres
			</span>
        </h2>
        <p>
            {{-- <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('talleres.index') }}"><i class="arrow left icon"></i> Volver</a> --}}
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('cursos.index') }}"><i class="arrow left icon"></i> Volver</a>
			<span class="pull-right">
			    <a class="ui button teal small labeled icon" header="Nueva Aula" href="{{ route('talleres.create') }}"><i class="icon add"></i> Nuevo Taller</a>
			</span>
        </p>
	</p>

<div class="ui styled fluid accordion margin-bottom accordion_options">
		  <div class="title">
		    <i class="dropdown icon"></i>
		    Talleres
		  </div>
	<div class="content">
    <a id="modalButton" class="ui button teal small labeled circular icon" header="Nuevo Taller" url="{{ route('talleres.create_asig_taller') }}"><i class="icon add"></i> Agregar Taller</a>
		<table class=" ui table celled small">
			<thead>
				<tr>
					<th>ID</th>
					<th>Nombre</th>
					<th>Nombre Corto</th>
					<th>Cantidad Clases</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($asig_talleres as $tal)
					<tr>
						<td>{{ $tal->asig_id }}</td>
						<td>{{ $tal->asig_nombre }}</td>
						<td>{{ $tal->asig_nombre_corto }}</td>
						<td>{{ $tal->clases->count() }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

	<div class="segment ui raised">
	    <h4 class="ui horizontal divider header text-navy2">
	        <i class="icon cut"></i>
	        Talleres
	    </h4>
			<table class="ui table celled">
				<thead>
					<tr>
						<th>ID</th>
						<th>Taller</th>
						<th>Periodo</th>
						<th>Profesor a Cargo</th>
						<th>Cantidad Alumnos</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($talleres as $taller)
						<tr data-tr="{{ $taller->cu_id }}">
							<td>{{ $taller->cu_id }}</td>
							<td>
								@if ($taller->clases != '[]')
									@foreach ($taller->clases as $tall)
										{{ $tall->asignatura->asig_nombre }}
										@break
									@endforeach
								@endif
							</td>
							<td>{{ $taller->periodo->pac_ano }}</td>
							<td>
								@if ($taller->profesorJefe != null)
									{{ $taller->profesorJefe->persona->nombreCompleto() }}
								@endif
							</td>
							<td>{{ $taller->listaAlumnos->count() }}</td>
							<td class="collapsing">
								<a class="ui button icon teal small circular" data-tooltip="Ver taller" href="{{ route('talleres.show', $taller->cu_id) }}"><i class="eye icon"></i></a>
								<a class="ui blue icon button small circular" href="{{ route('talleres.edit', $taller->cu_id) }}" data-tooltip="Editar Taller"><i class="pencil icon"></i></a>
								<button data-ruta="{{ route('talleres.delete_taller') }}" data-mens_info="los alumnos inscritos no perteneceran a este taller" data-id="{{ $taller->cu_id }}" class="ui button small icon red circular btn-borrar"><i class="trash icon"></i></button>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			
	</div>


@endsection
