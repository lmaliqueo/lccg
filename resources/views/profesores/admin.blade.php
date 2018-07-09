@extends('admin.template.main')

@section('title', 'Profesores')

@section('content')


	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="male icon"></i>
					<i class="corner yellow settings icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
		        Administrar Profesores
			</span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('parametros.index') }}"><i class="arrow left icon"></i> Volver</a>
            <span class="pull-right">
                <a class="button ui icon labeled teal small" href="{{ route('profesores.create') }}"><i class="add icon"></i> Ingresar Profesor</a>
                
            </span>
        </p>
	</p>


<div class="ui segment raised secondary">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon male"></i>
        Profesores
    </h4>
    <table class="table ui celled">
        <thead>
            <tr>
                <th>ID</th>
                <th>RUN</th>
                <th>Nombre</th>
                <th>Especialidad</th>
                <th>Institución</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($profesores as $profesor)
                <tr>
                    <td>{{ $profesor->pers_id }}</td>
                    <td>{{ $profesor->persona_rut }}</td>
                    <td>{{ $profesor->persona->nombreCompleto() }}</td>
                    <td>
                        @foreach ($profesor->especialidad as $asignaturas)
                            <a class="ui label teal">{{ $asignaturas->asig_nombre }}</a>
                        @endforeach
                    </td>
                    <td>
                        {{ ($profesor->institucion_id != null) ? $profesor->institucion->inst_nombre:'' }}
                    </td>
                    <td class="collapsing">
                        <a class="button ui small icon circular twitter modalButton" header="Profesor | {{ $profesor->persona->nombreCompleto() }}" url="{{ route('profesores.show', $profesor->pers_id) }}"><i class="icon eye"></i></a>
                        <a class="ui button circular blue icon small" href="{{ route('profesores.edit', ['id'=>$profesor->pers_id]) }}"><i class="pencil icon"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
