@extends('admin.template.main')

@section('title', 'Administrar Carreras')

@section('content')
<div class="margin-bottom">
	<div class="ui ui-black ribbon label">
	<h2 class="ui huge header add icon text-white"> &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
	Administrar Carreras </h2>
	</div>
	<hr class="style-two ">
	
</div>


	<table class="ui selectable compact celled table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Carrera</th>
				<th>Siglas</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($carreras as $carrera)
			<tr>
				<td class="collapsing">{{ $carrera->id }}</td>
				<td>{{ $carrera->nombre }}</td>
				<td>{{ $carrera->siglas }}</td>
				<td class="collapsing">
					<a class="ui icon button teal" href="{{ route('carreras.show', $carrera->id) }}" data-tooltip="Ver carrera"  data-inverted=""><i class="eye icon"></i></a>
					<a class="ui icon button primary" href="{{ route('carreras.edit', $carrera->id) }}" data-tooltip="Modificar carrera"  data-inverted=""><i class="pencil icon"></i></a>
					<a href="{{ route('admin.carreras.destroy', $carrera->id) }}" class="ui icon button negative" onclick="return confirm('desea eleminarlo')" data-tooltip="Eliminar carrera"  data-inverted="" ><i class="trash icon"></i></a>
				</td>
				
			</tr>
			@endforeach
		</tbody>
		<tfoot>
		    <tr><th colspan="6">
		    	{!! $carreras->render() !!}
		    </th>
		</tfoot>
	</table>


@endsection
