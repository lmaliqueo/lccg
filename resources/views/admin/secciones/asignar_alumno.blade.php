
@extends('admin.template.main')

@section('title', 'Ver Sección')

@section('content')
	<div class="margin-bottom">
		<div class="ui black ribbon label">
		<h1 class="ui huge header add icon text-white"> &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
		Asignar Alumno </h1>
		</div>
		
	</div>



	<br>
		{!! Form::open(['route' => 'admin.secciones.guardar_asignacion', 'method'=>'POST', 'class'=>'ui form']) !!}
		<div class="field">
		{!! Form::label('numero', 'Numero Sección') !!}
		{!! Form::number('numero', null, ['placeholder'=>'Nombre Completo' ]) !!}
		</div>

		<div class="field">
		{!! Form::text('asignatura_id', $id, ['class'=>'ui search dropdown']) !!}
		</div>
		<div class="field">
		{!! Form::label('alumno_id', 'Alumno') !!}
		{!! Form::select('alumno_id', $alumnos, null, ['class'=>'ui search dropdown']) !!}
		</div>

		<div class="field">
			{!! Form::submit('Registrar', ['class'=>'ui button positive']) !!}
		</div>

		{!! Form::close() !!}

@endsection

