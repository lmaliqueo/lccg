@extends('admin.template.main')

@section('title', 'Asignaturas')

@section('content')


	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="copy outline icon"></i>
					<i class="corner yellow settings icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
		        Administrar Asignaturas
			</span>
        </h2>
        <p>
            {{-- <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('asignaturas.index') }}"><i class="arrow left icon"></i> Volver</a> --}}
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('parametros.index') }}"><i class="arrow left icon"></i> Volver</a>
			<span class="pull-right">
			    <a id="modalButton" class="ui button teal small labeled icon" header="Nueva Asignatura" url="{{ route('asignaturas.create') }}"><i class="icon add"></i> Nueva Asignatura</a>
			</span>
        </p>
	</p>


	<div class="segment ui raised">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon copy outline"></i>
        Asignaturas
    </h4>
			<table class="ui table celled">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nombre</th>
						<th>Nombre Corto</th>
						<th>Tipo</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($asignaturas as $asignatura)
						<tr>
							<td>{{ $asignatura->asig_id }}</td>
							<td>{{ $asignatura->asig_nombre }}</td>
							<td>{{ $asignatura->asig_nombre_corto }}</td>
							<td>{{ $asignatura->tipo_asig() }}</td>
		                    <td class="collapsing">
		                        <a class="ui blue icon button small circular modalButton" header="Editar Aula | {{ $asignatura->asig_nombre }}" url="{{ route('asignaturas.edit', $asignatura->asig_id) }}"><i class="icon pencil"></i></a>
		                    </td>
						</tr>
					@endforeach
				</tbody>
			</table>
			
	</div>


@endsection
