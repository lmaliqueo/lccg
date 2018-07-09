@extends('admin.template.main')

@section('title', 'Crear Clases')

@section('content')

	<div class="x_panel">
		<div class="x_content">
			{!! Form::open(['route' => 'clases.store', 'method'=>'POST', 'class'=>'form-horizontal form-label-left', 'id'=>'demo-form2']) !!}

				<div class="field">
					{!! Form::label('asig_nombre', 'Nombre Asignatura', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
					<div class="col-md-6 col-sm-6 col-xs-12">
						{!! Form::select('asig_nombre', $,null, ['class'=>'form-control col-md-7 col-xs-12']) !!}
					</div>
				</div>

				<div class="field">
					{!! Form::label('asig_nombre_corto', 'Nombre Corto', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
					<div class="col-md-6 col-sm-6 col-xs-12">
						{!! Form::text('asig_nombre_corto', null, ['class'=>'form-control col-md-7 col-xs-12']) !!}
					</div>
				</div>

				<div class="field">
					{!! Form::label('asig_tipo', 'Tipo', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
					<div class="col-md-6 col-sm-6 col-xs-12">
						{!! Form::select('asig_tipo', [1=>'Asignatura Curso', 2=>'Taller'], null, ['class'=>'form-control col-md-7 col-xs-12']) !!}
					</div>
				</div>

				<div class="field">
					{!! Form::submit('Guardar', ['class'=>'btn btn-success']) !!}
				</div>


			{!! Form::close() !!}
			
		</div>
	</div>



@endsection
