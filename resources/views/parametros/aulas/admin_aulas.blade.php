@extends('admin.template.main')

@section('title', 'Administrar Aulas')

@section('content')

	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="building outline icon"></i>
					<i class="corner yellow settings icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
		        Administrar Aulas
			</span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('parametros.index') }}"><i class="arrow left icon"></i> Volver</a>
            <span class="pull-right">
                <a id="modalButton" class="ui button teal small labeled icon" header="Nueva Aula" url="{{ route('parametros.create.aulas') }}"><i class="icon add"></i> Nueva Aula</a>
            </span>
        </p>
	</p>
<div class="segment raised ui">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon building outline"></i>
        Aulas
    </h4>
    <table class="ui table celled selectable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Tipo</th>
                <th></th>
            </tr>
        </thead>    
        <tbody>
            @foreach ($aulas as $aula)
                <tr>
                    <td>{{ $aula->aul_id }}</td>
                    <td>{{ $aula->aul_numero }}</td>
                    <td>{{ $aula->tipo() }}</td>
                    <td class="collapsing">
                        <a class="ui blue icon button small circular modalButton" header="Editar Aula | {{ $aula->aul_numero }}" url="{{ route('parametros.edite.aulas', $aula->aul_id) }}"><i class="icon pencil"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
</div>

@endsection
