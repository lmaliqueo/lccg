@extends('admin.template.main')

@section('title', 'Ingresar Carrera')

@section('content')

<div class="margin-bottom">
	<div class="ui black ribbon label">
	<h1 class="ui huge header add icon text-white"> &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
	Crear Usuario </h1>
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
	{!! Form::open(['route' => 'carreras.store', 'method'=>'POST', 'class'=>'ui form']) !!}
	<div class="field">
	{!! Form::label('nombre', 'Nombre Carrera') !!}
	{!! Form::text('nombre', null, ['placeholder'=>'Nombre Completo' ]) !!}
	</div>

	<div class="field">
	{!! Form::label('siglas', 'Siglas') !!}
	{!! Form::text('siglas', null, ['placeholder'=>'Nombre Completo' ]) !!}
	</div>


	<div class="field">
		{!! Form::submit('Registrar', ['class'=>'ui button positive']) !!}
	</div>

	{!! Form::close() !!}

@endsection