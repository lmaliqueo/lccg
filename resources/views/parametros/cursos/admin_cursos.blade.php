@extends('admin.template.main')

@section('title', 'Administrar Parametros Cursos')

@section('content')

	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="edit icon"></i>
					<i class="corner yellow settings icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
		        Administrar Parametros Cursos
			</span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('parametros.index') }}"><i class="arrow left icon"></i> Volver</a>
            <span class="pull-right">
                <a id="modalButton" class="ui button teal small labeled icon" header="Nuevo Curso" url="{{ route('parametros.create.cursos') }}"><i class="icon add"></i> Nuevo Curso</a>
            </span>
        </p>
	</p>
<table class="ui table celled selectable">
    <thead>
        <tr>
            <th>Grado</th>
            <th>Letra</th>
            <th></th>
        </tr>
    </thead>    
    <tbody>
        @foreach ($param_cursos as $parametros)
            <tr>
                <td>{{ $parametros->pcur_grado }}</td>
                <td>{{ $parametros->pcur_letra }}</td>
                <td></td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
