@extends('admin.template.main')

@section('title', 'Administrar Asignaturas')

@section('content')

<div class="margin-bottom">
	<div class="ui black ribbon label">
	<h2 class="ui huge header add icon text-white"> &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
	Administrar Asignaturas </h2>
	</div>
<hr class="style-two ">
	
</div>


	<table class="ui selectable compact celled table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($asignaturas as $asignatura)
				<tr>
					<td class="collapsing">{{ $asignatura->id }}</td>
					<td>{{ $asignatura->nombre }}</td>
					<td class="collapsing">
						<a class="ui icon button teal" href="{{ route('asignaturas.show', $asignatura->id) }}" data-tooltip="Ver asignatura"  data-inverted=""><i class="eye icon"></i></a>
						<a class="ui icon button primary" href="{{ route('asignaturas.edit', $asignatura->id) }}" data-tooltip="Modificar asignatura"  data-inverted=""><i class="pencil icon"></i></a>
						<a href="{{ route('admin.asignaturas.destroy', $asignatura->id) }}" class="ui icon button negative" onclick="return confirm('desea eleminarlo')" data-tooltip="Eliminar asignatura"  data-inverted="" ><i class="trash icon"></i></a>
					</td>
				</tr>
			@endforeach

		</tbody>
		<tfoot>
		    <tr><th colspan="6">
		    	{!! $asignaturas->render() !!}
		    </th>
		</tfoot>

	</table>


@endsection
