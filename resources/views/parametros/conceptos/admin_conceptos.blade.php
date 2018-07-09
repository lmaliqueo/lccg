@extends('admin.template.main')

@section('title', 'Administrar Conceptos')

@section('content')



	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="options icon"></i>
					<i class="corner yellow legal icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
		        Administrar Conceptos
			</span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('parametros.index') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>
<div class="text-right">
    <a id="modalButton" class="ui button teal small labeled icon" header="Nuevo Concepto" url="{{ route('parametros.create.conceptos') }}"><i class="icon add"></i> Nuevo Concepto</a>
</div>
<table class="ui table celled selectable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($conceptos as $concepto)
            <tr>
                <td>{{ $concepto->con_id }}</td>
                <td>{{ $concepto->con_nombre }}</td>
                <td>{{ $concepto->con_descripcion }}</td>
                <td></td>
            </tr>
        @endforeach
    </tbody>
</table>





@endsection
