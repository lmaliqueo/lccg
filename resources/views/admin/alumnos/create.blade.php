@extends('admin.template.main')

@section('title', 'Ingresar Alumno')

@section('content')

<div class="margin-bottom">
	<div class="ui black ribbon label">
	<h1 class="ui huge header add icon text-white"> &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
	Ingresar Alumno </h1>
	</div>
	
</div>

@if (count($errors) > 0)
	<div class="ui error message">
		<i class="close icon"></i>
		<div class="header">
		Error en el formulario
		</div>
		<ul class="list">
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>

@endif


<br>
	{!! Form::open(['route' => 'alumnos.store', 'method'=>'POST', 'class'=>'ui form']) !!}
	<div class="field">
	{!! Form::label('nombre', 'Nombre') !!}
	{!! Form::text('nombre', null, ['placeholder'=>'Nombre' ]) !!}
	</div>

	<div class="field">
	{!! Form::label('apellido_pat', 'Apellido Paterno') !!}
	{!! Form::text('apellido_pat', null, ['placeholder'=>'Apellido Paterno' ]) !!}
	</div>

	<div class="field">
	{!! Form::label('apellido_mat', 'Apellido Materno') !!}
	{!! Form::text('apellido_mat', null, ['placeholder'=>'Apellido Materno' ]) !!}
	</div>

	<div class="field">
	{!! Form::label('carrera_id', 'Carrera') !!}
	{!! Form::select('carrera_id', $carreras, null, ['class'=>'ui search dropdown']) !!}
	</div>

	<div class="field">
		{!! Form::submit('Registrar', ['class'=>'ui button positive']) !!}
	</div>

	{!! Form::close() !!}
@endsection