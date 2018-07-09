@extends('admin.template.main')

@section('title', 'Crear Asignaturas')

@section('content')

<div class="margin-bottom">
	<div class="ui black ribbon label">
	<h1 class="ui huge header add icon text-white"> &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
	Crear Asignaturas </h1>
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
	{!! Form::open(['route' => 'asignaturas.store', 'method'=>'POST', 'class'=>'ui form']) !!}
	<div class="field">
	{!! Form::label('nombre', 'Nombre') !!}
	{!! Form::text('nombre', null, ['placeholder'=>'Nombre' ]) !!}
	</div>

	<div class="field">
		{!! Form::submit('Registrar', ['class'=>'ui button positive']) !!}
	</div>

	{!! Form::close() !!}
@endsection