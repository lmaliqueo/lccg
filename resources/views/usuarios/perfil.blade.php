@extends('admin.template.main')

@section('title', 'Perfil Usuario')

@section('content')


	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="user circle icon"></i>
					<i class="corner yellow eye icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
		        Perfil Usuario | {{ $user->us_username }}
			</span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ url('/') }}"><i class="arrow left icon"></i> Volver</a>
			<span class="pull-right">
				<a class="button ui small blue icon labeled modalButton" header="Cambiar Password | {{ $user->us_username }}" url="{{ route('usuario.edit_pass') }}"><i class="pencil icon"></i> Cambiar Contraseña</a>
			</span>
        </p>
	</p>


	<div class="segment raised ui">
	    <h4 class="ui horizontal divider header text-navy2">
	        <i class="icon user"></i>
	        Persona
	    </h4>
		<table class="table ui">
			<thead>
				<tr>
					<th style="width: 25%">Nombre</th>
					<td style="width: 25%">{{ $user->persona->nombreCompleto() }}</td>
					<th style="width: 25%">Rut</th>
					<td style="width: 25%">{{ $user->persona_rut }}</td>
				</tr>
				<tr>
					<th>Contacto</th>
					<td>{{ $user->persona->pe_contacto }}</td>
					<th>Tipo</th>
					<td>{{ ($user->persona->empleados->count()) ? 'Empleado':'Apoderado' }}</td>
				</tr>
			</thead>
		</table>
	</div>
	<div class="segment raised ui">
	    <h4 class="ui horizontal divider header text-navy2">
	        <i class="icon user outline"></i>
	        Usuario
	    </h4>
		<table class="table ui celled">
			<thead>
				<tr>
					<th style="width: 50%">Usuario</th>
					<td style="width: 50%">{{ $user->us_username }}</td>
				</tr>
				<tr>
					<th>Email</th>
					<td>{{ $user->us_email }}</td>
				</tr>
				<tr>
					<th>Rol</th>
					<td>{{ $user->rol->name }}</td>
				</tr>
				<tr>
					<th>Estado</th>
					<td><label class="label ui {{ ($user->us_estado) ? 'green':'red' }}">{{ $user->estado() }}</label></td>
				</tr>
			</thead>
		</table>
	</div>

@endsection
