@extends('admin.template.main')

@section('title', 'Ingresar Artículo')

@section('content')



	<p>
        <h2 class="ui header text-navy2">
			<span style="padding: 10px;">
				<i class="big icons">
					<i class="cubes icon"></i>
					<i class="corner yellow add icon"></i>
				</i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
            	Nuevo Artículo

			</span>
        </h2>
        <p>
            {{-- <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('articulos.index') }}"><i class="arrow left icon"></i> Volver</a> --}}
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('articulos.index') }}"><i class="arrow left icon"></i> Volver</a>
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

<div class="segment ui raised">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon cubes"></i>
        Articulo
    </h4>
	{!! Form::open(['route' => 'articulos.store', 'method'=>'POST', 'class'=>'ui form']) !!}
		<div class="fields two">
			<div class="field {{ ($errors->has('art_item')) ? 'error':'' }}">
				{!! Form::label('art_item', 'Item') !!}
				{!! Form::text('art_item', null, ['placeholder'=>'']) !!}
			</div>
			<div class="field {{ ($errors->has('tipo_id')) ? 'error':'' }}">
				{!! Form::label('tipo_id', 'Tipo') !!}
				{!! Form::select('tipo_id', $tipos, null, ['placeholder'=>'', 'class'=>'ui fluid search dropdown']) !!}
			</div>
			
		</div>

		<div class="field {{ ($errors->has('art_nombre')) ? 'error':'' }}">
			{!! Form::label('art_nombre', 'Nombre') !!}
			{!! Form::text('art_nombre', null, ['placeholder'=>'']) !!}
		</div>

		<div class="field {{ ($errors->has('art_descripcion')) ? 'error':'' }}">
			{!! Form::label('art_descripcion', 'Descripcion') !!}
			{!! Form::textarea('art_descripcion', null, ['placeholder'=>'']) !!}
		</div>

		<div class="field">
			{!! Form::submit('Guardar', ['class'=>'ui button teal']) !!}
		</div>


	{!! Form::close() !!}
</div>



@endsection
