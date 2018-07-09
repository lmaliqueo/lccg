@extends('admin.template.main')

@section('title', 'Horas')

@section('content')

	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="clock outline icon"></i>
					<i class="corner blue settings icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #00B5AD;">
		        Administrar Horas | {{ $periodo->pac_ano }}
			</span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('parametros.index') }}"><i class="arrow left icon"></i> Volver</a>
            <span class="pull-right">
                <a class="small button ui teal icon labeled modalButton" header="Ingresar Hora | {{ $periodo->pac_ano }}" url="{{ route('parametros.create.horas') }}"><i class="icon add"></i> Ingresar Hora</a>
            </span>
        </p>
	</p>


<div class="ui segment raised secondary">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon clock outline"></i>
        Horas
    </h4>
    <table class="table ui celled">
        <thead>
            <tr>
                <th class="center aligned">N°</th>
                <th>Hora Inicio</th>
                <th>Hora Término</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($periodo->horas as $hora)
            <tr>
                <td class="center aligned">{{ $hora->hors_numero }}</td>
                <td>{{ $hora->hors_hora_inicio }}</td>
                <td>{{ $hora->hors_hora_termino }}</td>
                <td class="collapsing">
                    <a class="ui blue icon button small circular modalButton" header="Editar Aula #{{ $hora->hors_numero }} | {{ $periodo->pac_ano }}" url="{{ route('parametros.edit.horas', $hora->hors_id) }}"><i class="icon pencil"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
