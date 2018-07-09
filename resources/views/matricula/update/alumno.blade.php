<div class="segment ui">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon user"></i>
        Datos Personales
    </h4>
<div class="ui error message">
    <i class="close icon"></i>
    <div class="header">
    Error en el formulario
    </div>
    <ul class="list list_error">
    </ul>
</div>
{!! Form::open(['class'=>'ui form']) !!}
	<div class="fields">
        {!! Form::label('alumno[al_rut]', 'Rut') !!}
        {!! Form::text('alumno[al_rut]', $matricula->alumno->al_rut, ['placeholder'=>'']) !!}
	</div>
{!! Form::close() !!}
</div>