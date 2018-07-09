@extends('admin.template.main')

@section('title', 'Crear Sección')

@section('content')

<div class="margin-bottom">
	<div class="ui black ribbon label">
	<h1 class="ui huge header add icon text-white"> &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
	Crear Sección </h1>
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
	{!! Form::open(['route' => 'secciones.store', 'method'=>'POST', 'class'=>'ui form']) !!}
	<div class="field">
	{!! Form::label('numero', 'Numero Sección') !!}
	{!! Form::number('numero', null, ['placeholder'=>'Nombre Completo' ]) !!}
	</div>

	<div class="field">
	{!! Form::label('periodo', 'Periodo') !!}
	{!! Form::text('periodo', null, ['placeholder'=>'Nombre Completo' ]) !!}
	</div>

	<div class="field">
	{!! Form::label('asignatura_id', 'Asignatura') !!}
	{!! Form::select('asignatura_id', $asignaturas, null, ['class'=>'ui search dropdown']) !!}
	</div>

	<div class="field">
		{!! Form::submit('Registrar', ['class'=>'ui button positive']) !!}
	</div>

	{!! Form::close() !!}

@endsection