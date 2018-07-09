@extends('admin.template.main')

@section('title', 'Administrar Secciones')

@section('content')


<div class="margin-bottom">
	<div class="ui ui-black ribbon label">
	<h2 class="ui huge header add icon text-white"> &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
	Administrar Secciones </h2>
	</div>
<hr class="style-two ">
</div>


	<table class="ui selectable compact celled table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Numero Sección</th>
				<th>Periodo</th>
				<th>Estado</th>
				<th>Asignatura</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($secciones as $seccion)
				<tr>
					<td class="collapsing">{{ $seccion->id }}</td>
					<td>{{ $seccion->numero }}</td>
					<td>{{ $seccion->periodo }}</td>
					<td>{{ $seccion->estado }}</td>
					<td>{{ $seccion->asignatura->nombre }}</td>
					<td class="collapsing">
						<a class="ui icon button teal" href="{{ route('secciones.show', $seccion->id) }}" data-tooltip="Ver sección"  data-inverted=""><i class="eye icon"></i></a>
						<a class="ui icon button primary" href="{{ route('secciones.edit', $seccion->id) }}" data-tooltip="Modificar sección"  data-inverted=""><i class="pencil icon"></i></a>
						<a href="{{ route('admin.secciones.destroy', $seccion->id) }}" class="ui icon button negative" onclick="return confirm('desea eleminarlo')" data-tooltip="Eliminar sección"  data-inverted="" ><i class="trash icon"></i></a>
					</td>
				</tr>
			@endforeach

		</tbody>
		<tfoot>
		    <tr><th colspan="6">
		    	{!! $secciones->render() !!}
		    </th>
		</tfoot>

	</table>

@endsection
