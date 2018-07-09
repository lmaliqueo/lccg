@extends('admin.template.main')

@section('title', 'Editar Usuario')

@section('content')

<div class="margin-bottom">
	<div class="ui black ribbon label">
	<h1 class="ui huge header add icon text-white"> &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
	Editar Usuario </h1>
	</div>
	
</div>
<h2 class="ui header dividing">
	<i class="user outline icon"></i>
	<div class="content">
		{{ $user->name }}
		
	</div>
</h2>

<br>
	{!! Form::open(['route' => ['user.update', $user], 'method'=>'PUT', 'class'=>'ui form']) !!}
	<div class="field">
	{!! Form::label('name', 'Nombre') !!}
	{!! Form::text('name', $user->name, ['placeholder'=>'Nombre Completo' ]) !!}
	</div>

	<div class="field">
	{!! Form::label('email', 'Correo') !!}
	{!! Form::email('email', $user->email, ['placeholder'=>'Correo electronico' ]) !!}
	</div>

	<div class="field">
	{!! Form::label('type', 'Tipo de Usuario') !!}
	{!! Form::select('type', ['null'=>'', 'member'=>'Miembro', 'admin'=>'Administrador'], $user->type, ['class'=>'ui search dropdown']) !!}
	</div>

	<div class="field">
		{!! Form::submit('Editar', ['class'=>'ui button primary']) !!}
	</div>

	{!! Form::close() !!}
@endsection