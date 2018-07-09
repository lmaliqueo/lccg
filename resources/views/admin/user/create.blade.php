@extends('admin.template.main')

@section('title', 'Crear Usuario')

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
	{!! Form::open(['route' => 'user.store', 'method'=>'POST', 'class'=>'ui form']) !!}
	<div class="field">
	{!! Form::label('name', 'Nombre') !!}
	{!! Form::text('name', null, ['placeholder'=>'Nombre Completo' ]) !!}
	</div>

	<div class="field">
	{!! Form::label('email', 'Correo') !!}
	{!! Form::email('email', null, ['placeholder'=>'Correo electronico' ]) !!}
	</div>

	<div class="field">
	{!! Form::label('password', 'Contraseña') !!}
	{!! Form::password('password', null, ['placeholder'=>'Correo electronico' ]) !!}
	</div>

	<div class="field">
	{!! Form::label('type', 'Tipo de Usuario') !!}
	{!! Form::select('type', ['null'=>'', 'member'=>'Miembro', 'admin'=>'Administrador'], null, ['class'=>'ui search dropdown']) !!}
	</div>

	<div class="field">
		{!! Form::submit('Registrar', ['class'=>'ui button positive']) !!}
	</div>

	{!! Form::close() !!}
@endsection