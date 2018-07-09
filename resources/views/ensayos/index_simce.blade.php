@extends('admin.template.main')

@section('title', 'Pruebas SIMCE')

@section('content')


	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="book icon"></i>
					<i class="corner yellow check circle icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
		        Pruebas SIMCE
			</span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('academico.index') }}"><i class="arrow left icon"></i> Volver</a>
            <span class="pull-right">
                <a class="button labeled icon ui teal small" href="{{ route('ensayos.simce.create') }}"><i class="plus icon"></i> Registrar Resultados</a>
            </span>
        </p>
	</p>

<div class="segment ui raised secondary">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon file text"></i>
        Ensayos SIMCE
    </h4>
    <table class="table ui celled">
        <thead>
            <tr>
                <th>ID</th>
                <th>Periodo</th>
                <th>Materia</th>
                <th>Fecha</th>
                <th>Cantidad Alumnos</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pruebas_simces as $simce)
                <tr data-tr="{{ $simce->ens_id }}">
                    <td>{{ $simce->ens_id }}</td>
                    <td>{{ $simce->periodo->pac_ano }}</td>
                    <td>{{ $simce->materia->mens_nombre }}</td>
                    <td>{{ $simce->ens_fecha }}</td>
                    <td>{{ $simce->matriculas->count() }}</td>
                    <td class="collapsing">
                        <a class="ui button small circular teal icon modalButton" url="{{ route('ensayos.simce.view', ['id'=>$simce->ens_id]) }}" header="SIMCE: {{ $simce->materia->mens_nombre }} - {{ $simce->ens_fecha }}"><i class="eye icon"></i></a>
                        <a class="ui button small circular blue icon" href="{{ route('ensayos.simce.edit', $simce->ens_id) }}"><i class="pencil icon"></i></a>
                        <button data-ruta="{{ route('ensayos.delete') }}" data-mens_info="se borrara todos los puntajes de los alumnos relacinado a este ensayo" data-id="{{ $simce->ens_id }}" class="ui button small icon red circular btn-borrar"><i class="trash icon"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endsection
