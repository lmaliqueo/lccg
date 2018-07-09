@extends('layouts.blank')

@section('title', 'Administrar Alumnos')

@section('content')

<div class="margin-bottom">
	<div class="ui ui-black ribbon label">
	<h2 class="ui huge header add icon text-white"> &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
	Administrar Alumnos </h2>
	</div>
<hr class="style-two ">
	
</div>


	<table class="ui selectable compact celled table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>Apellido Pat</th>
				<th>Apellido Mat</th>
				<th>Carrera</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($alumnos as $alumno)
				<tr>
					<td class="collapsing">{{ $alumno->id }}</td>
					<td>{{ $alumno->nombre }}</td>
					<td>{{ $alumno->apellido_pat }}</td>
					<td>{{ $alumno->apellido_mat }}</td>
					<td><span data-tooltip="{{ $alumno->carrera->nombre }}">{{ $alumno->carrera->siglas }}</span></td>
					<td class="collapsing">
						<a class="ui icon button teal" href="{{ route('alumnos.show', $alumno->id) }}" data-tooltip="Ver alumno"  data-inverted=""><i class="eye icon"></i></a>
						<a class="ui icon button primary" href="{{ route('alumnos.edit', $alumno->id) }}" data-tooltip="Modificar alumno"  data-inverted=""><i class="pencil icon"></i></a>
						<a href="{{ route('admin.alumnos.destroy', $alumno->id) }}" class="ui icon button negative" onclick="return confirm('desea eleminarlo')" data-tooltip="Eliminar alumno"  data-inverted="" ><i class="trash icon"></i></a>
					</td>
					
				</tr>
			@endforeach
		</tbody>
		<tfoot>
		    <tr><th colspan="6">
		    	{!! $alumnos->render() !!}
		    </th>
		</tfoot>
	</table>


@endsection
