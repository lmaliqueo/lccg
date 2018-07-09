@extends('admin.template.main')

@section('title', 'Modificar Profesor')

@section('content')

	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="university icon"></i>
					<i class="corner yellow pencil icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
		        Modificar Liceo
			</span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('parametros.view.liceo') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>

<div class="segment ui raised">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon university"></i>
        Liceo
    </h4>
    {!! Form::open(['route' => ['parametros.update.liceo', $liceo], 'method'=>'PUT', 'class'=>'ui form', 'files'=>true]) !!}
        <div class="field">
            {!! Form::label('lic_nombre', 'Nombre del Liceo') !!}
            {!! Form::text('lic_nombre', $liceo->lic_nombre, null) !!}
        </div>
        <div class="field">
            {!! Form::label('lic_rol_base_datos', 'Rol de Base de Datos') !!}
            {!! Form::text('lic_rol_base_datos', $liceo->lic_rol_base_datos, null) !!}
        </div>
        <div class="field">
            {!! Form::label('lic_letra', 'Letra Liceo') !!}
            {!! Form::text('lic_letra', $liceo->lic_letra, null) !!}
        </div>
        <div class="field">
            {!! Form::label('lic_numero', 'Numero Liceo') !!}
            {!! Form::text('lic_numero', $liceo->lic_numero, ['tipo-input'=>'number']) !!}
        </div>
        <div class="field">
            {!! Form::label('lic_numero_resol_rec_ofic', 'Numero Documento que lo Declara Reconocido Oficialmente') !!}
            {!! Form::text('lic_numero_resol_rec_ofic', $liceo->lic_numero_resol_rec_ofic, null) !!}
        </div>
        <div class="field">
            {!! Form::label('lic_fecha_resol_rec_ofic', 'Año Documento que lo Declara Reconocido Oficialmente') !!}
            {!! Form::text('lic_fecha_resol_rec_ofic', $liceo->lic_fecha_resol_rec_ofic, null) !!}
        </div>
        <div class="field">
            {!! Form::label('lic_semestres', 'Semestres') !!}
            {!! Form::text('lic_semestres', $liceo->lic_semestres, null) !!}
        </div>
        <div class="field">
            {!! Form::label('logo', 'Logo') !!}
            {!! Form::file('logo') !!}
        </div>
                <div class="field">
                    {!! Form::submit('Guardar', ['class'=>'ui button teal']) !!}
                </div>


    {!! Form::close() !!}

</div>

@endsection
