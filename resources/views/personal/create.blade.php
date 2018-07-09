@extends('admin.template.main')

@section('title', 'Ingresar Empleado')

@section('content')

	
	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="users icon"></i>
					<i class="corner yellow add icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
		        Nuevo Empleado
			</span>
        </h2>
        <p>
            {{-- <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('empleados.index') }}"><i class="arrow left icon"></i> Volver</a> --}}
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('empleados.admin') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>


    @if (count($errors) > 0)
        <div class="ui error message">
            <i class="close icon"></i>
            <div class="header">
            Error en el formulario
            </div>
            <ul class="list list_error">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    
                @endforeach
            </ul>
        </div>
    @endif

<div class="ui info visible message">
    <p><i class="icon info circle"></i> Los campos marcados con <span class="text-red">*</span> son obligatorios</p>
</div>

			{!! Form::open(['route' => 'empleados.store', 'method'=>'POST', 'class'=>'ui form']) !!}

<div class="ui raised segment">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon users"></i>
        Empleado
    </h4>
	<div class="fields">
		<div class="eight wide field {{ ($errors->has('pe_nombres')) ? 'error':'' }} required">
			{!! Form::label('persona[pe_nombres]', 'Nombre') !!}
			{!! Form::text('persona[pe_nombres]', null, ['required', 'placeholder'=>'']) !!}
			
		</div>
		<div class="four wide field {{ ($errors->has('pe_apellido_pat')) ? 'error':'' }} required">
			{!! Form::label('persona[pe_apellido_pat]', 'Apellido Paterno') !!}
			{!! Form::text('persona[pe_apellido_pat]', null, ['required', 'placeholder'=>'']) !!}
		</div>
		<div class="four wide field {{ ($errors->has('pe_apellido_mat')) ? 'error':'' }} required">
			{!! Form::label('persona[pe_apellido_mat]', 'Apellido Materno') !!}
			{!! Form::text('persona[pe_apellido_mat]', null, ['required', 'placeholder'=>'']) !!}
		</div>
	</div>
	<div class="fields">
		<div class="field wide ten {{ ($errors->has('pe_rut')) ? 'error':'' }} required">
			{!! Form::label('persona[pe_rut]', 'Rut') !!}
			{!! Form::text('persona[pe_rut]', null, ['required', 'placeholder'=>'', 'tipo-input'=>'rut']) !!}
		</div>
		<div class="field wide six {{ ($errors->has('pe_contacto')) ? 'error':'' }}">
			{!! Form::label('persona[pe_contacto]', 'Contacto') !!}
			{!! Form::text('persona[pe_contacto]', null, ['placeholder'=>'', 'tipo-input'=>'number', 'maxlength'=>11]) !!}
		</div>
		
	</div>
	<div class="field {{ ($errors->has('cargo_id')) ? 'error':'' }} required">
		{!! Form::label('personal[cargo_id]', 'Cargo') !!}
		{!! Form::select('personal[cargo_id]', $cargos, null, ['placeholder'=>'', 'class'=>'ui dropdown fluid']) !!}
	</div>

	<div class="field">
		{!! Form::submit('Guardar', ['class'=>'ui button teal']) !!}
	</div>
</div>


			{!! Form::close() !!}



@endsection
