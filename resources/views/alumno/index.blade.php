@extends('admin.template.main')

@section('title', 'Alumnos')

@section('content')


<h2 class="ui center aligned icon header text-navy2" >
	<i class="circular student icon"></i>
	<span style="border-bottom: 5px solid #FCDD13;">
		Alumnos | {{ $periodo->pac_ano }}
	</span>
</h2>

<br>
<div class="segment ui raised">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon list"></i>
        Alumnos
    </h4>
	<table class="table ui celled">
		<thead>
			<tr>
				<th>Rut</th>
				<th>Nombre</th>
				<th>Curso</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($alumnos as $alumno)
				<tr>
					<td>{{ $alumno->alumno_rut }}</td>
					<td>{{ $alumno->alumno->nombreCompleto() }}</td>
					<td>{{ ($alumno->curso->count())? $alumno->curso->first()->nombreCurso():'' }}</td>
					<td class="collapsing"><a class="button ui small circular blue icon" href="{{ route('alumnos.show', $alumno->mat_id) }}"><i class="icon eye"></i></a></td>
				</tr>
			@endforeach
			
		</tbody>
		@if (Auth::user()->administrador())
			<tfoot>
				<th colspan="4">{{ $alumnos->links() }}</th>
			</tfoot>
		@endif
	</table>
	
</div>
	



@endsection
