@extends('admin.template.main')

@section('title', 'Ingresar Matricula')

@section('content')


	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="open folder outline icon"></i>
					<i class="corner yellow add icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
		        Ingresar Matricula{{ ($periodo != null) ? ' | '.$periodo->pac_ano:'' }}
			</span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('matriculas.index') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>

{!! Form::open(['route' => 'matriculas.store', 'method'=>'POST', 'class'=>'ui form']) !!}

	<div class="ui error message">
		<i class="close icon"></i>
		<div class="header">
			Error en el formulario
		</div>
		<ul class="list list_error">
		</ul>
	</div>

<div class="ui info visible message">

    <p><i class="icon info circle"></i> Los campos marcados con <span class="text-red">*</span> son obligatorios</p>
</div>

<div class="ui five top attached steps">
	<div class="active step 1" id="step1">
		<i class="student icon" id="icon_step_1"></i>
		<div class="content">
			<div class="title">Alumno</div>
			<div class="description">Datos del alumno</div>
		</div>
	</div>
	<div class="disabled step 2" id="step2">
		<i class="users icon " id="icon_step_2"></i>
		<div class="content">
			<div class="title">Padres</div>
			<div class="description">Datos de Padres</div>
		</div>
	</div>
	<div class="disabled step 3" id="step3">
		<i class="user outline icon " id="icon_step_3"></i>
		<div class="content">
			<div class="title">Apoderado</div>
			<div class="description">Datos de Apoderado</div>
		</div>
	</div>
	<div class="disabled step 4" id="step4">
		<i class="open folder icon " id="icon_step_4"></i>
		<div class="content">
			<div class="title">Matricula</div>
			<div class="description">Datos de matricula</div>
		</div>
	</div>
	<div class="disabled step 5" id="step5">
		<i class="file text outline icon " id="icon_step_5"></i>
		<div class="content">
			<div class="title">Ficha</div>
			<div class="description">Vista previa</div>
		</div>
	</div>
</div>


{{-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ --}}
{{-- ++++++++++++++++++++++++++++++++++++++++ ALUMNO ++++++++++++++++++++++++++++++++++++++++ --}}
{{-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ --}}

<div class="ui attached segment secondary animated fadeIn" id="step_1">
	<div class="segment ui raised">
	    <h4 class="ui horizontal divider header text-navy2">
	        <i class="icon student"></i>
	        Alumno
	    </h4>
		<div class="field required">
			{!! Form::label('alumno[al_rut]', 'R.U.N.') !!}
			<div class="ui search fluid category focus" ruta_search="{{ route('autocomplete.search_students') }}"  name_input="alumno">
				<div class="ui icon input">
					<input class="prompt alumno_rut alumno block" type="text" placeholder="" autocomplete="off" name="alumno[al_rut]" tipo-input="rut">
					<i class="icon inverted red circular remove link icon_search" id="icon_search_alu" style="display: none;" value="alumno"></i>
				</div>
			</div>
			{!! Form::hidden('alumno[al_rut_old]', null, ['placeholder'=>'', 'required'=>'required', 'maxlength'=>12, 'class'=>'alumno_old']) !!}										
		</div>

		<div class="fields required">
			<div class="eight wide field">
				{!! Form::label('alumno[al_nombres]', 'Nombre Alumno') !!}
				{!! Form::text('alumno[al_nombres]', null, ['placeholder'=>'Nombres', 'class'=>'alumno block']) !!}
				
			</div>
			<div class="four wide field">
				{!! Form::label('alumno[al_apellido_pat]', 'Apellido Paterno') !!}
				{!! Form::text('alumno[al_apellido_pat]', null, ['placeholder'=>'Apellido Paterno', 'class'=>'alumno block']) !!}
			</div>
			<div class="four wide field">
				{!! Form::label('alumno[al_apellido_mat]', 'Apellido Materno') !!}
				{!! Form::text('alumno[al_apellido_mat]', null, ['placeholder'=>'Apellido Materno', 'class'=>'alumno block']) !!}
			</div>
		</div>
		<div class="fields required">
			<div class="eight wide field">
				{!! Form::label('alumno[comuna_id]', 'Comuna') !!}
					{!! Form::select('alumno[comuna_id]', $comunas, null, ['class'=>'ui search editar_alumno dropdown alumno', 'placeholder'=>'', 'value'=>null]) !!}
			</div>
			<div class="eight wide field">
				{!! Form::label('alumno[al_fecha_nacimiento]', 'Fecha de Namiciento') !!}
				{!! Form::date('alumno[al_fecha_nacimiento]', null, ['class'=>'alumno block', 'placeholder'=>'', 'max'=>date('Y-m-d')]) !!}
			</div>		
			
		</div>

		<div class="fields">

			<div class="wide eight field required">
			{!! Form::label('alumno[al_domicilio]', 'Domicilio') !!}
					{!! Form::text('alumno[al_domicilio]', null, ['placeholder'=>'', 'class'=>'alumno editar_alumno']) !!}
			</div>

			<div class="wide eight field">
				{!! Form::label('alumno[al_fono]', 'Fono Contacto') !!}
				{!! Form::text('alumno[al_fono]', null, ['placeholder'=>'Contacto','tipo-input'=>'number' ,'class'=>'alumno editar_alumno', 'maxlength'=>9]) !!}
			</div>
			
		</div>
		<div class="grouped fields required">
			<label>Género</label>
			<div class="field">
				<div class="ui toggle checkbox checkbox_gen check_masculino">
					<input type="radio" name="alumno[al_sexo]" value="masculino">
					<label>Masculino</label>
				</div>
			</div>
			<div class="field">
				<div class="ui toggle checkbox checkbox_gen check_femenino">
					<input type="radio" name="alumno[al_sexo]" value="femenino">
					<label>Femenino</label>
				</div>
			</div>
		</div>
	</div>
	<div class="text-right">
		<a class="ui button blue button_next" posicion="1" valid="{{ route('validate.validate_student') }}">Siguiente</a>
		
	</div>
</div>
<div class="ui attached segment secondary hide animated fadeIn" id="step_2">
	{{-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ --}}
	{{-- +++++++++++++++++++++++++++++++++++++++++ PADRE +++++++++++++++++++++++++++++++++++++++++ --}}
	{{-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ --}}
	<div class="inline fields no-margin">
		<label>Padres:</label>
		<div class="field required">
			{!! Form::select('padres', [0=>'Ninguno', 1=>'Solo Padre', 2=>'Solo Madre', 3=>'Ambos'],null, ['class'=>'ui selection dropdown padres_drop', 'placeholder'=>'', 'apod'=>'']) !!}
		</div>
	</div>

	<div class="ui raised segment animated fadeIn" data-segm="segm_1" style="display: none;">
	    <h4 class="ui horizontal divider header text-navy2">
	        <i class="icon male"></i>
	        Padre
	    </h4>
		<div class="fields two required">
			<div class="field">
				{!! Form::label('padre[padre_rut]', 'R.U.N.') !!}
				<div class="ui search fluid category focus" ruta_search="{{ route('autocomplete.search_padres') }}" tipo_search="Padre" name_input="padre">
					<div class="ui icon input">
						<input class="prompt padre block" type="text" placeholder="" autocomplete="off" name="padre[pad_rut]" tipo-input="rut">
						<i class="search icon inverted red circular remove link icon_search" id="icon_search_padre" style="display: none;" value="padre"></i>
					</div>
				</div>
			</div>
			<div class="field">
				{!! Form::label('padre[pad_fecha_nacimiento]', 'Fecha de Namiciento') !!}
				{!! Form::date('padre[pad_fecha_nacimiento]', null, ['class'=>'padre', 'placeholder'=>'', 'max'=>date('Y-m-d')]) !!}
			</div>
			{!! Form::hidden('padre[pad_rut_old]', null, ['placeholder'=>'', 'required'=>'required', 'class'=>'padre_old']) !!}
		</div>
		<div class="fields required">
			<div class="eight wide field">
				{!! Form::label('padre[pad_nombres]', 'Nombre') !!}
				{!! Form::text('padre[pad_nombres]', null, ['class'=>'padre block', 'placeholder'=>'Nombres']) !!}
			</div>
			<div class="four wide field">
				{!! Form::label('padre[pad_apellido_pat]', 'Apellido Paterno') !!}
				{!! Form::text('padre[pad_apellido_pat]', null, ['class'=>'padre block', 'placeholder'=>'Apellido Paterno']) !!}
			</div>
			<div class="four wide field">
				{!! Form::label('padre[pad_apellido_mat]', 'Apellido Materno') !!}
				{!! Form::text('padre[pad_apellido_mat]', null, ['class'=>'padre block', 'placeholder'=>'Apellido Materno']) !!}
			</div>
		</div>
		<div class="fields two required">
			<div class="field">
			{!! Form::label('padre[pad_domicilio]', 'Domicilio') !!}
					{!! Form::text('padre[pad_domicilio]', null, ['class'=>'padre', 'placeholder'=>'']) !!}
			</div>		
			<div class="field">
				{!! Form::label('padre[pad_nivel_estudio]', 'Nivel Estudios') !!}
				{!! Form::text('padre[pad_nivel_estudio]', null, ['class'=>'padre', 'placeholder'=>'Nivel Estudios']) !!}
			</div>
			
		</div>

		<div class="fields three">
			<div class="field required">
				{!! Form::label('padre[pad_sit_laboral]', 'Situacion Laboral') !!}
				{!! Form::text('padre[pad_sit_laboral]', null, ['class'=>'padre', 'placeholder'=>'']) !!}
			</div>

			<div class="field">
				{!! Form::label('padre[pad_profesion]', 'Profesion') !!}
				{!! Form::text('padre[pad_profesion]', null, ['class'=>'padre', 'placeholder'=>'']) !!}
			</div>

			<div class="field">
				{!! Form::label('padre[pad_renta]', 'Renta') !!}
				{!! Form::text('padre[pad_renta]', null, ['class'=>'padre', 'placeholder'=>'', 'tipo-input'=>'number', 'maxlength'=>11]) !!}
			</div>
			
		</div>
	</div>
	{{-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ --}}
	{{-- +++++++++++++++++++++++++++++++++++++++++ MADRE +++++++++++++++++++++++++++++++++++++++++ --}}
	{{-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ --}}
	<div class="ui {{-- bottom attached tab --}} segment animated fadeIn" data-segm="segm_2" style="display: none;">

	    <h4 class="ui horizontal divider header text-navy2">
	        <i class="icon female"></i>
	        Madre
	    </h4>
	    		<div class="fields two required">
					<div class="field">
						{!! Form::label('madre[madre_rut]', 'R.U.N.') !!}
						<div class="ui search fluid category focus" ruta_search="{{ route('autocomplete.search_padres') }}" tipo_search="Madre" name_input="madre">
							<div class="ui icon input">
								<input class="prompt madre block" type="text" placeholder="" autocomplete="off" name="madre[pad_rut]" tipo-input="rut">
								<i class="search icon inverted red circular remove link icon_search" id="icon_search_madre" style="display: none;" value="madre"></i>
							</div>
						</div>
						{!! Form::hidden('madre[pad_rut_old]', null, ['class'=>'madre block', 'placeholder'=>'', 'required'=>'required', 'class'=>'madre_old']) !!}										
					</div>
					<div class="field">
						{!! Form::label('madre[pad_fecha_nacimiento]', 'Fecha de Namiciento') !!}
						{!! Form::date('madre[pad_fecha_nacimiento]', null, ['class'=>'madre', 'placeholder'=>'', 'max'=>date('Y-m-d')]) !!}
					</div>
	    		</div>
				<div class="fields required">
					<div class="eight wide field">
						{!! Form::label('madre[pad_nombres]', 'Nombre') !!}
						{!! Form::text('madre[pad_nombres]', null, ['class'=>'madre block', 'placeholder'=>'Nombres']) !!}
					</div>
					<div class="four wide field">
						{!! Form::label('madre[pad_apellido_pat]', 'Apellido Paterno') !!}
						{!! Form::text('madre[pad_apellido_pat]', null, ['class'=>'madre block', 'placeholder'=>'Apellido Paterno']) !!}
					</div>
					<div class="four wide field">
						{!! Form::label('madre[pad_apellido_mat]', 'Apellido Materno') !!}
						{!! Form::text('madre[pad_apellido_mat]', null, ['class'=>'madre block', 'placeholder'=>'Apellido Materno']) !!}
					</div>
				</div>

				<div class="fields two required">
					<div class="field">
						{!! Form::label('madre[pad_domicilio]', 'Domicilio') !!}
						{!! Form::text('madre[pad_domicilio]', null, ['class'=>'madre', 'placeholder'=>'']) !!}
					</div>		
					<div class="field">
					{!! Form::label('madre[pad_nivel_estudio]', 'Nivel Estudios') !!}
							{!! Form::text('madre[pad_nivel_estudio]', null, ['class'=>'madre', 'placeholder'=>'Nivel Estudios']) !!}
					</div>
					
				</div>
				<div class="fields three">
					<div class="field required">
					{!! Form::label('madre[pad_sit_laboral]', 'Situacion Laboral') !!}
							{!! Form::text('madre[pad_sit_laboral]', null, ['class'=>'madre', 'placeholder'=>'']) !!}
					</div>

					<div class="field">
					{!! Form::label('madre[pad_profesion]', 'Profesion') !!}
							{!! Form::text('madre[pad_profesion]', null, ['class'=>'madre', 'placeholder'=>'']) !!}
					</div>

					<div class="field">
					{!! Form::label('madre[pad_renta]', 'Renta') !!}
							{!! Form::text('madre[pad_renta]', null, ['class'=>'madre', 'placeholder'=>'', 'tipo-input'=>'number', 'maxlength'=>11]) !!}
					</div>
					
				</div>


	</div>



	<div class="text-right">
		<a class="ui button basic button_after" posicion="2">Anterior</a>
		<a class="ui button blue button_next disabled" posicion="2" valid="{{ route('validate.validate_padres') }}">Siguiente</a>
		
	</div>
</div>
<div class="ui attached segment secondary hide animated fadeIn" id="step_3">
		<div class="inline fields no-margin">
				<label>Cantidad Apoderados:</label>
				
			<div class="field">
				{!! Form::select('cant_apod', [1=>1, 2=>2], 1, ['class'=>'ui selection dropdown apod_drop', 'apod'=>'']) !!}
			</div>
		</div>
{{-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ --}}
{{-- +++++++++++++++++++++++++++++++++++++ APODERADO I +++++++++++++++++++++++++++++++++++++ --}}
{{-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ --}}

<div class="ui bottom raised segment active animated fadeIn" data-segm="apoderado1">

    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon outline user"></i>
        Apoderado I
    </h4>
	<div class="ui segment secondary segm_tipo_apod">
		<div class="inline fields no-margin">
			<div class="field wide four">
				<label>Parentesco:</label>
				
			</div>
			<div class="field wide twelve">
				{!! Form::select('parentesco1', ['padre'=>'Padre', 'madre'=>'Madre', 'otros'=>'Otro'],null, ['class'=>'ui selection dropdown parentesco_apod', 'placeholder'=>'', 'apod'=>'']) !!}
			</div>
		</div>
		
	</div>

		<a class="ui red right corner label remove_apod" tipo_apod="">
			<i class="remove icon"></i>
		</a>
		<div class="fields two required">
			<div class="field">
				{!! Form::label('apoderado[pe_rut]', 'R.U.N') !!}
				<div class="ui search fluid category focus" ruta_search="{{ route('autocomplete.search_apod') }}" tipo_search="1" name_input="apoderado">
					<div class="ui left icon input">
						<input class="prompt apoderado block" type="text" placeholder="Search GitHub" autocomplete="off" name="apoderado[pe_rut]" tipo-input="rut">
						<i class="search icon"></i>
					</div>
				</div>
			</div>
			{{-- 
			{!! Form::hidden('apoderado[ap_id]', null, ['class'=>'apoderado']) !!}
			 --}}
			{!! Form::hidden('apoderado[persona_rut]', null, ['class'=>'apoderado']) !!}										
			<div class="field">
				{!! Form::label('apoderado[ap_parentesco]', 'Parentesco') !!}
					{!! Form::text('apoderado[ap_parentesco]', null, ['class'=>'apoderado', 'placeholder'=>'Parentesco']) !!}
			</div>
		</div>

		<div class="fields required">
			<div class="eight wide field">
				{!! Form::label('apoderado[pe_nombres]', 'Nombre') !!}
				{!! Form::text('apoderado[pe_nombres]', null, ['class'=>'apoderado block', 'placeholder'=>'Nombres']) !!}
			</div>
			<div class="four wide field">
				{!! Form::label('apoderado[pe_apellido_pat]', 'Apellido Paterno') !!}
				{!! Form::text('apoderado[pe_apellido_pat]', null, ['class'=>'apoderado block', 'placeholder'=>'Apellido Paterno']) !!}
			</div>
			<div class="four wide field">
				{!! Form::label('apoderado[pe_apellido_mat]', 'Apellido Materno') !!}
				{!! Form::text('apoderado[pe_apellido_mat]', null, ['class'=>'apoderado block', 'placeholder'=>'Apellido Materno']) !!}
			</div>
		</div>
		<div class="fields two">
			<div class="field required">
				{!! Form::label('apoderado[ap_direccion]', 'Dirección') !!}
					{!! Form::text('apoderado[ap_direccion]', null, ['class'=>'apoderado', 'placeholder'=>'Direccion']) !!}
			</div>
			<div class="field">
				{!! Form::label('apoderado[pe_contacto]', 'Fono Contacto') !!}
					{!! Form::text('apoderado[pe_contacto]', null, ['tipo-input'=>'number', 'class'=>'apoderado', 'placeholder'=>'Direccion', 'max'=>9]) !!}
			</div>
		</div>
		

</div>


{{-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ --}}
{{-- +++++++++++++++++++++++++++++++++++++ APODERADO II +++++++++++++++++++++++++++++++++++++ --}}
{{-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ --}}

<div class="ui bottom raised segment animated fadeIn" data-segm="apoderado2" style="display: none;">

    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon outline user"></i>
        Apoderado II
    </h4>
	<div class="ui segment secondary segm_tipo_apod2">
		<div class="inline fields no-margin required">
			<div class="field wide four">
				<label>Parentesco:</label>
				
			</div>
			<div class="field wide twelve">
				{!! Form::select('parentesco2', ['padre'=>'Padre', 'madre'=>'Madre', 'otros'=>'Otro'],null, ['class'=>'ui selection dropdown parentesco_apod', 'placeholder'=>'', 'apod'=>'2']) !!}
			</div>
		</div>
		
	</div>
		<a class="ui red right corner label remove_apod" tipo_apod="2">
			<i class="remove icon"></i>
		</a>
		<div class="fields two required">
			<div class="field">
				{!! Form::label('apoderado2[pe_rut]', 'R.U.N') !!}
				<div class="ui search fluid category focus" ruta_search="{{ route('autocomplete.search_apod') }}" tipo_search="2" name_input="apoderado2">
					<div class="ui left icon input">
						<input class="prompt apoderado2 block" type="text" placeholder="Search GitHub" autocomplete="off" name="apoderado2[pe_rut]" tipo-input="rut">
						<i class="search icon"></i>
					</div>
				</div>
				{{-- 
				{!! Form::hidden('apoderado2[ap_id]', null, ['class'=>'apoderado2 block', 'placeholder'=>'', 'class'=>'apoderado2']) !!}
				 --}}					
				{!! Form::hidden('apoderado2[persona_rut]', null, ['class'=>'apoderado2 block', 'placeholder'=>'', 'class'=>'apoderado2']) !!}										
			</div>
			
			<div class="field">
				{!! Form::label('apoderado2[ap_parentesco]', 'Parentesco') !!}
					{!! Form::text('apoderado2[ap_parentesco]', null, ['class'=>'apoderado2', 'placeholder'=>'Parentesco']) !!}
			</div>
		</div>

		<div class="fields required">
			<div class="eight wide field">
				{!! Form::label('apoderado2[pe_nombres]', 'Nombre') !!}
				{!! Form::text('apoderado2[pe_nombres]', null, ['class'=>'apoderado2 block', 'placeholder'=>'Nombres']) !!}
			</div>
			<div class="four wide field">
				{!! Form::label('apoderado2[pe_apellido_pat]', 'Apellido Paterno') !!}
				{!! Form::text('apoderado2[pe_apellido_pat]', null, ['class'=>'apoderado2 block', 'placeholder'=>'Apellido Paterno']) !!}
			</div>
			<div class="four wide field">
				{!! Form::label('apoderado2[pe_apellido_mat]', 'Apellido Materno') !!}
				{!! Form::text('apoderado2[pe_apellido_mat]', null, ['class'=>'apoderado2 block', 'placeholder'=>'Apellido Materno']) !!}
			</div>
		</div>
		<div class="fields two">
			<div class="field required">
				{!! Form::label('apoderado2[ap_direccion]', 'Dirección') !!}
				{!! Form::text('apoderado2[ap_direccion]', null, ['class'=>'apoderado2', 'placeholder'=>'Direccion']) !!}
			</div>
			<div class="field">
				{!! Form::label('apoderado2[pe_contacto]', 'Fono Contacto') !!}
				{!! Form::text('apoderado2[pe_contacto]', null, ['tipo-input'=>'number', 'class'=>'apoderado2', 'placeholder'=>'', 'max'=>9]) !!}
			</div>
		</div>
</div>


	<div class="text-right">
		<a class="ui button basic button_after" posicion="3">Anterior</a>
		<a class="ui button blue button_next" posicion="3" valid="{{ route('validate.validate_apoderados') }}">Siguiente</a>
		
	</div>

</div>

{{-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ --}}
{{-- +++++++++++++++++++++++++++++++++++++++ MATRICULA +++++++++++++++++++++++++++++++++++++++ --}}
{{-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ --}}

<div class="ui attached segment secondary hide animated fadeIn" id="step_4">
	<div class="segment ui raised">
	    <h4 class="ui horizontal divider header text-navy2">
	        <i class="icon book"></i>
	        Ácademico
	    </h4>
		<div class="fields required">
			<div class="four wide field">
				{!! Form::label('matricula[mat_grado_curso]', 'Año Curso') !!}
				{!! Form::select('matricula[mat_grado_curso]', [1=>'1°', 2=>'2°', 3=>'3°', 4=>'4°'],null, ['class'=>'ui selection dropdown', 'required']) !!}
			</div>
			<div class="twelve wide field">
				{!! Form::label('matricula[mat_prom_ingreso]', 'Promedio de Ingreso') !!}
				{!! Form::text('matricula[mat_prom_ingreso]', null, ['placeholder'=>'', 'required', 'tipo-input'=>'promedio']) !!}
			</div>
			
		</div>
		<div class="fields">
			<div class="four wide field required">
				{!! Form::label('matricula[mat_fecha_ingreso]', 'Fecha de Ingreso') !!}
				{!! Form::date('matricula[mat_fecha_ingreso]', null, ['max'=>date('Y-m-d')]) !!}
			</div>
			<div class="twelve wide field">
				{!! Form::label('matricula[establecimiento_ant]', 'Establecimiento Anterior') !!}
	            <div class="ui search fluid category focus" ruta_search="{{ route('autocomplete.search_col_ant') }}" tipo_search="cole_ant" name_input="cole_ant">
	                <div class="ui icon input">
	                    <input class="prompt cole_ant input block" type="text" placeholder="" autocomplete="off" name="matricula[establecimiento_ant]">
	                    <i class="search icon inverted red circular remove link icon_remove" id="icon_search_cole_ant" style="display: none;" value="cole_ant"></i>
	                </div>
	            </div>
	            {!! Form::hidden('matricula[est_anterior_id]', null, ['class'=>'cole_ant']) !!}
            	{{-- 
				{!! Form::text('colegio_ant[nombre]', null, ['placeholder'=>'']) !!}
            	 --}}
			</div>
			
		</div>
	</div>
	<div class="segment ui raised">

	    <h4 class="ui horizontal divider header text-navy2">
	        <i class="icon open folder"></i>
	        Matrícula
	    </h4>
	<div class="field">
		<div class="ui toggle checkbox">
			<input type="checkbox" class="" name="matricula[mat_condicional]" value="1">
			<label>Condicional</label>
		</div>
	</div>

			<div class="field">
				{!! Form::label('matricula[mat_causas_cond]', 'Causas Condicional') !!}
				{!! Form::textarea('matricula[mat_causas_cond]', null, ['placeholder'=>'', 'class'=>'', 'rows'=>4, 'disabled'=>true]) !!}
			</div>
			
	<div class="field">
		<div class="ui toggle checkbox">
			<input type="checkbox" name="matricula[mat_clases_religion]" value="1" >
			<label>Clases de Religión</label>
		</div>
	</div>

	</div>
	<div class="segment ui raised">

	    <h4 class="ui horizontal divider header text-navy2">
	        <i class="icon users"></i>
	        Familiar
	    </h4>

		<div class="field required">
			{!! Form::label('matricula[mat_sit_padres]', 'Situacion de Padres') !!}
			{!! Form::select('matricula[mat_sit_padres]', [1=>'Casados', 0=>'Separados', 2=>'Conviven', 3=>'Solo Madre'],null, ['class'=>'ui selection dropdown sit_padres', 'placeholder'=>'']) !!}
		</div>
		<div class="field required">
			{!! Form::label('matricula[mat_convive]', 'Convive') !!}
			{!! Form::text('matricula[mat_convive]', null, ['placeholder'=>'']) !!}
		</div>
		<div class="field required">
			{!! Form::label('matricula[mat_cant_hermanos]', 'Cantidad de Hermanos') !!}
			{!! Form::number('matricula[mat_cant_hermanos]', null, ['placeholder'=>'', 'min'=>0, 'id'=>'cant_herm']) !!}
		</div>

		<div class="segment secondary ui raised animated fadeInDown" id="segment_herm" style="display: none;">
			<div style="padding-bottom: 13px">
				<div class="ui inverted ribbon label large blue">
					<i class="icon users"></i> Estudios de Hermanos
				</div>		

			</div>
			<p>
				<a class="ui button teal tiny icon labeled circular button_add_herm" cant="1" cant_input="0"><i class="icon plus"></i> Agregar Estudios</a>
			</p>
			<div id="body_herm">
				<div class="fields">
					<div class="four wide field">
						<input type="number" name="hermanos[cantidad]">
					</div>
					<div class="twelve wide field">
						<input type="text" name="hermanos[estudios]">
					</div>
				</div>
			</div>
		</div>

	</div>
	<div class="segment ui raised">

	    <h4 class="ui horizontal divider header text-navy2">
	        <i class="icon heartbeat"></i>
	        Enfermedades
	    </h4>

			<div class="field">
				<p>
					<a class="ui button teal tiny icon labeled circular button_add_enf" count="0"><i class="icon plus"></i> Agregar Enfermedad</a>
				</p>
				<div id="body_enfermedad">
				</div>
			</div>
	</div>


				<div class="field text-right">
					<a class="ui button basic button_after" posicion="4">Anterior</a>
					<a class="ui button blue button_next" posicion="4" valid="{{ route('validate.validate_matricula') }}">Siguiente</a>
				</div>
</div>
<div class="ui attached segment secondary hide animated fadeIn" id="step_5">


	<div class="segment ui raised">
			<div class="ui inverted ribbon label large teal">
				<i class="icon student"></i> Alumno
			</div>		

		<table class="table ui celled structured">
			<thead>
				<tr>
					<th class="collapsing">Rut</th>
					<td colspan="5" class="alu_al_rut"></td>
				</tr>
				<tr>
					<th class="collapsing">Nombres</th>
					<td class="alu_al_nombres"></td>
					<th class="collapsing">Apellido Paterno</th>
					<td class="alu_al_apellido_pat"></td>
					<th class="collapsing">Apellido Materno</th>
					<td class="alu_al_apellido_mat"></td>
				</tr>
				<tr>
					<th class="collapsing">Fecha Nacimiento</th>
					<td class="alu_al_fecha_nacimiento"></td>
					<th class="collapsing">Comuna</th>
					<td class="alu_comuna_id"></td>
					<th class="collapsing">Sexo</th>
					<td class="alu_al_sexo"></td>
				</tr>
				<tr>
					<th class="collapsing">Domicilio</th>
					<td colspan="3" class="alu_al_domicilio"></td>
					<th class="collapsing">Contacto</th>
					<td class="alu_al_fono"></td>
				</tr>
			</thead>
		</table>
	</div>

	<div class="segment raised ui">
		<div class="ui inverted ribbon label large teal">
			<i class="icon users"></i> Padres
		</div>		
		<div class="segment ui raised">
				<h4 class="ui block header">
					<i class="male icon"></i>
					<div class="content">
						Padre
					</div>
				</h4>

				<table class="table ui celled structured">
					<thead>
						<tr>
							<th class="collapsing">Rut</th>
							<td colspan="3" class="padre_pad_rut"></td>
							<th class="collapsing">Fecha Nacimiento</th>
							<td class="padre_pad_fecha_nacimiento"></td>
						</tr>
						<tr>
							<th class="collapsing">Nombres</th>
							<td class="padre_pad_nombres"></td>
							<th class="collapsing">Apellido Paterno</th>
							<td class="padre_pad_apellido_pat"></td>
							<th class="collapsing">Apellido Materno</th>
							<td class="padre_pad_apellido_mat"></td>
						</tr>
						<tr>
							<th class="collapsing">Domicilio</th>
							<td colspan="3" class="padre_pad_domicilio"></td>
							<th class="collapsing">Estudios</th>
							<td class="padre_pad_nivel_estudio"></td>
						</tr>
						<tr>
							<th class="collapsing">Situacion Laboral</th>
							<td class="padre_pad_sit_laboral"></td>
							<th class="collapsing">Profesión</th>
							<td class="padre_pad_profesion"></td>
							<th class="collapsing">Renta</th>
							<td class="padre_pad_renta"></td>
						</tr>
					</thead>
				</table>

		</div>


		<div class="segment ui raised">
			<div style="padding-bottom: 10px">
				<h4 class="ui block header">
					<i class="female icon"></i>
					<div class="content">
						Madre
					</div>
				</h4>
				<table class="table ui celled structured">
					<thead>
						<tr>
							<th class="collapsing">Rut</th>
							<td colspan="3" class="madre_pad_rut"></td>
							<th class="collapsing">Fecha Nacimiento</th>
							<td class="madre_pad_fecha_nacimiento"></td>
						</tr>
						<tr>
							<th class="collapsing">Nombres</th>
							<td class="madre_pad_nombres"></td>
							<th class="collapsing">Apellido Paterno</th>
							<td class="madre_pad_apellido_pat"></td>
							<th class="collapsing">Apellido Materno</th>
							<td class="madre_pad_apellido_mat"></td>
						</tr>
						<tr>
							<th class="collapsing">Domicilio</th>
							<td colspan="3" class="madre_pad_domicilio"></td>
							<th class="collapsing">Estudios</th>
							<td class="madre_pad_nivel_estudio"></td>
						</tr>
						<tr>
							<th class="collapsing">Situacion Laboral</th>
							<td class="madre_pad_sit_laboral"></td>
							<th class="collapsing">Profesión</th>
							<td class="madre_pad_profesion"></td>
							<th class="collapsing">Renta</th>
							<td class="madre_pad_renta"></td>
						</tr>
					</thead>
				</table>
			</div>

		</div>
	</div>

	<div class="segment ui raised">
		<div class="ui inverted ribbon label large teal">
			<i class="icon user outline"></i> Apoderados
		</div>		
		<div class="segment ui raised">
				<h4 class="ui block header">
					<i class="user icon"></i>
					<div class="content">
						Apoderado I
					</div>
				</h4>
				<table class="table ui celled structured">
					<thead>
						<tr>
							<th class="collapsing">Rut</th>
							<td colspan="5" class="apod1_pe_rut"></td>
						</tr>
						<tr>
							<th class="collapsing">Nombres</th>
							<td class="apod1_pe_nombres"></td>
							<th class="collapsing">Apellido Paterno</th>
							<td class="apod1_pe_apellido_pat"></td>
							<th class="collapsing">Apellido Materno</th>
							<td class="apod1_pe_apellido_mat"></td>
						</tr>
						<tr>
							<th class="collapsing">Parentesco</th>
							<td class="apod1_ap_parentesco"></td>
							<th class="collapsing">Dirección</th>
							<td class="apod1_ap_direccion"></td>
							<th class="collapsing">Contacto</th>
							<td class="apod1_pe_contacto"></td>
						</tr>
					</thead>
				</table>

		</div>
		<div class="segment ui raised">
				<h4 class="ui block header">
					<i class="user icon"></i>
					<div class="content">
						Apoderado II
					</div>
				</h4>
				<table class="table ui celled structured">
					<thead>
						<tr>
							<th class="collapsing">Rut</th>
							<td colspan="5" class="apod2_pe_rut"></td>
						</tr>
						<tr>
							<th class="collapsing">Nombres</th>
							<td class="apod2_pe_nombres"></td>
							<th class="collapsing">Apellido Paterno</th>
							<td class="apod2_pe_apellido_pat"></td>
							<th class="collapsing">Apellido Materno</th>
							<td class="apod2_pe_apellido_mat"></td>
						</tr>
						<tr>
							<th class="collapsing">Parentesco</th>
							<td class="apod2_ap_parentesco"></td>
							<th class="collapsing">Dirección</th>
							<td class="apod2_ap_direccion"></td>
							<th class="collapsing">Contacto</th>
							<td class="apod2_pe_contacto"></td>
						</tr>
					</thead>
				</table>

		</div>
	</div>



	<div class="segment ui raised">
		<div style="padding-bottom: 10px">
			<div class="ui inverted ribbon label large teal">
				<i class="icon folder"></i> Matricula
			</div>		
			<table class="table ui celled structured">
				<thead>
					<tr>
						<th class="collapsing">Nivel Curso</th>
						<td class="matricula_mat_grado_curso"></td>
						<th class="collapsing">Procedimiento Escolar</th>
						<td class="colegio_nombre" colspan="3"></td>
					</tr>
					<tr style="border-bottom: 1px solid rgba(34, 36, 38, 0.1);">
						<th class="collapsing">Promedio Ingreso</th>
						<td class="matricula_mat_prom_ingreso"></td>
						<th class="collapsing">Clases de Religión</th>
						<td class="matricula_mat_clases_religion"></td>
					</tr>
					<tr style="height:30px;"></tr>
					<tr style="border-bottom: 1px solid rgba(34, 36, 38, 0.1); border-top: 1px solid rgba(34, 36, 38, 0.1);">
						<th class="collapsing">Condicional</th>
						<td class="matricula_mat_condicional"></td>
						<th class="collapsing">Descripción Condicional</th>
						<td class="matricula_mat_causas_cond"></td>
					</tr>
					<tr style="height:30px;"></tr>
					<tr style="border-top: 1px solid rgba(34, 36, 38, 0.1);">
						<th class="collapsing">Situación Padres</th>
						<td class="matricula_mat_sit_padres"></td>
						<th class="collapsing">Convive</th>
						<td class="matricula_mat_convive"></td>
					</tr>
					<tr>
						
						<th class="collapsing">Cantidad Hermanos</th>
						<td class="matricula_mat_cant_hermanos"></td>
						<th class="collapsing">Estudios Hermanos</th>
						<td class="matricula_"></td>
					</tr>
					<tr>
						
						<th class="collapsing">Enfermedades</th>
						<td colspan="3">
								<ul class="enfermedades_enf_nombre">
								</ul>
						</td>
					</tr>

				</thead>
			</table>
		</div>

	</div>


				<div class="field text-center">

					<a class="ui button basic button_after" posicion="5">Anterior</a>

					{!! Form::submit('Guardar', ['class'=>'ui button teal']) !!}
				</div>
</div>


<div style="padding-bottom: 100px;"></div>

			

{!! Form::close() !!}



<script type="text/javascript">
	var token = $('meta[name="csrf-token"]').attr('content');

	$('.padres_drop').on('change', function(){
		var tipo = $(this).val();
		$('.button_next.disabled').removeClass('disabled');
		if(tipo != 0){
			$('.segm_tipo_apod').show();
			$('.segm_tipo_apod2').show();
			if(tipo== 3){
				$('div[data-segm="segm_1"]').show()
				$('div[data-segm="segm_2"]').show()
				return;
			}
			if(tipo == 1){
				$('div[data-segm="segm_1"]').show()
				$('div[data-segm="segm_2"]').hide()
				return;
			}
			if(tipo == 2){
				$('div[data-segm="segm_1"]').hide()
				$('div[data-segm="segm_2"]').show()
				return;
			}
		}
		if(tipo == 0){
			$('div[data-segm="segm_1"]').hide()
			$('div[data-segm="segm_2"]').hide()
			$('.segm_tipo_apod').hide();
			$('.segm_tipo_apod2').hide();
			return;
		}
	})


	$('.apod_drop').on('change', function(){
		var val = $(this).val();
		if(val == 2){
			$('div[data-segm="apoderado2"]').show();
		}else{
			$('div[data-segm="apoderado2"]').hide();
		}
	})


	$('.remove_apod').on('click', function(){
		var apod = $(this).attr('tipo_apod')
		if(apod == ''){
			$('select[name="parentesco1"]').dropdown('clear')
		}else{
			$('select[name="parentesco2"]').dropdown('clear')
		}
		$('.segm_tipo_apod'+apod).show();
		//$('.segment_apod'+apod).hide();
			$('.apoderado'+apod).val('').removeAttr('readonly');
			$('.apoderado'+apod+'_rut').val('').removeAttr('readonly');
	})

	$('.parentesco_apod').on('change', function(){
		var parent = $(this).val();
		var apod = $(this).attr('apod');
		if(parent != 'otros'){
			$.each( $('.'+parent), function(index, value){
				var ind = $(value).attr('name');
				var valor = $(value).val();
				var res = ind.split(parent+"[pad_");
				var name = res[1].split("]");
				if(index == 3){
					$('input[name="apoderado'+apod+'[ap_direccion]"]').val(valor)

				}
				$('input[name="apoderado'+apod+'[pe_'+name[0]+']"]').val(valor)


				//console.log(valor);
			})
{{-- 
			var rut = $('input[name="'+parent+'[pad_rut]"]').val()
			console.log(rut)
			$('input[name="apoderado'+apod+'[pe_rut]"]').val(rut)
 --}}

			$('input[name="apoderado'+apod+'[ap_parentesco]"]').val(parent)
			//$('.segment_apod'+apod).show();
			$('.segm_tipo_apod'+apod).hide();
		}else{
			$('.apoderado'+apod).val('');
			$('.apoderado'+apod+'_rut').val('');
			//$('.segment_apod'+apod).show();
			$('.segm_tipo_apod'+apod).hide();
		}
		$('select[name="parentesco2"]').children('.item').addClass('disabled')
	})




{{-- 
	$('#cant_herm').on('change', function(){
		var cant = $(this).val();
		if(cant > 0){
			$('#segment_herm').show();
			$('#btn_herm').attr('cant', cant)
		}else{
			$('#segment_herm').hide();
		}
	})
 --}}

	$('.button_add_herm').on('click', function(){
		var cant = $(this).attr('cant')
		var cant_input = $(this).attr('cant_input')
		if(cant > cant_input){
			$('<div class="fields"><div class="four wide field"><input type="number" name="hermanos[cantidad]"></div><div class="twelve wide field"><input type="text" name="hermanos[estudios]">					</div></div>').appendTo('#body_herm')

		}
	})



	$('.button_add_enf').on('click', function(){

		var count = $(this).attr('count');
		count++;

        $('<div class="field animated fadeInDown field_enf_'+count+'"><div class="ui icon input"><input name="enfermedades['+count+'][enf_nombre]" type="text" placeholder="Nombre Enfermedad" maxlength="30"><i class="inverted red circular remove link icon rem_input" i="'+count+'"></i></div></div>').appendTo('#body_enfermedad');
        $(this).attr('count', count);
	})


$(function() {

        $(document).on('click', '.rem_input', function() { 
			//var count = $('.button_add_enf').attr('count');
			var i = $(this).attr('i');

	        $('.field_enf_'+i).remove();
	        //count--;
	        //$('.button_add_enf').attr('count', count);

        });
})



	$('.button_next').on('click', function(){
		var posicion = $(this).attr('posicion');
		var actual = posicion;
		posicion++;

		var url = $(this).attr('valid');


		$.ajax({
			url: url,
			type:'post',
			data:$('form').serialize(),
			success: function(response){

				if(response.success == 1){
					step_actual = document.getElementsByClassName(actual);
					$(step_actual).addClass('completed').removeClass('active');

			    	step_siguiente = document.getElementsByClassName(posicion);
			    	$(step_siguiente).removeClass('disabled').addClass('active');


			    	segment_actual = document.getElementById('step_'+actual);
			    	$(segment_actual).addClass('hide');

			    	segment_siguiente = document.getElementById('step_'+posicion);
			    	$(segment_siguiente).removeClass('hide');
			    	$('.ui.form').removeClass('error')
			    	$('.field.error').removeClass('error');


			    	if(posicion == $('.step').length){
				    	$.each(response.data.alumno, function(index, value){
							$('.alu_'+index).text(value);
				    	})
				    	$.each(response.data.padre, function(index, value){
							$('.padre_'+index).text(value);
				    	})
				    	$.each(response.data.madre, function(index, value){
							$('.madre_'+index).text(value);
				    	})
				    	$.each(response.data.matricula, function(index, value){
							$('.matricula_'+index).text(value);
				    	})

				    	$.each(response.data.apoderado, function(index, value){
							$('.apod1_'+index).text(value);
				    	})

				    	$.each(response.data.apoderado2, function(index, value){
							$('.apod2_'+index).text(value);
				    	})

				    	if(response.data.matricula.mat_clases_religion == null){
				    		$('.matricula_mat_clases_religion').text('No');
				    	}
				    	if(response.data.matricula.mat_condicional == null){
				    		$('.matricula_mat_condicional').text('No');
				    	}
				    	var sit_padres = $('.dropdown.sit_padres').children('.menu').children('.item.active.selected').text()
				    	$('.matricula_mat_sit_padres').text(sit_padres);
						$('.colegio_nombre').text(response.data.colegio_ant.nombre);




				    	$.each(response.data.enfermedades, function(index, value){
				    		console.log(index)
				    		console.log(value.enf_nombre)
				    		$('<li>'+value.enf_nombre+'</li>').appendTo('.enfermedades_enf_nombre')
				    	})
			    	}


				}else{
					$('.list_error').html('')
					$('.field.error').removeClass('error')
			    	$.each(response.errors, function(index, value){
			    		$('<li>'+value+'</li>').appendTo('.list_error')

			    		$('label[for="'+response.tipo+'['+index+']"]').parent('.field').addClass('error')

			    		$('input[name="'+response.tipo+'['+index+']"]').parent('.field').addClass('error')
			    		$('input[name="'+response.tipo+'['+index+']"]').parent().parent().parent('.field').addClass('error')
			    		$('select[name="'+response.tipo+'['+index+']"]').parent().parent('.field').addClass('error')
			    		$('input[name="'+response.tipo+'['+index+']"]').parent().parent('.field').parent('.grouped').addClass('error')
			    	})
			    	$('.ui.form').addClass('error')
			    	$('.error.message').removeClass('hidden')
				}
			}
		})

		$('input').on('change', function(){
			$(this).parent('div.field.error').removeClass('error');
		})
		$('.ui.search').on('change', function(){
			$(this).parent('div.field.error').removeClass('error');
		})

		$('.ui.checkbox').on('change', function(){
			$(this).parent().parent('div.fields.error').removeClass('error');
		})




	})
	$('.button_after').on('click', function(){
		var posicion = $(this).attr('posicion');
		var actual = posicion;
		posicion--;

		step_actual = document.getElementsByClassName(actual);
		$(step_actual).removeClass('active').addClass('disabled');

    	step_anterior = document.getElementsByClassName(posicion);
    	$(step_anterior).removeClass('completed').addClass('active');


    	segment_actual = document.getElementById('step_'+actual);
    	$(segment_actual).addClass('hide');

    	segment_anterior = document.getElementById('step_'+posicion);
    	$(segment_anterior).removeClass('hide');


	})
    $('.icon_remove').on('click', function(){
        $(this).parent('.input').children('input').removeAttr('readonly');
        var inputs = $(this).attr('value');
        $('.'+inputs).val('')
        $(this).hide()
    })

$('.icon_search').on('click', function(){
	var input = $(this).attr('value');
	if(input == 'alumno'){
    		$('.padre').val('').removeAttr('readonly');
    		$('.padre_rut').val('').removeAttr('readonly');
			$('.'+input+'_rut').removeAttr('readonly')
			$('.icon_search').hide()
			$('.checkbox.checked').checkbox('uncheck read-only')
    		$('.madre').val('').removeAttr('readonly');
    		$('.madre_rut').val('').removeAttr('readonly');
    		$('.checkbox_gen').removeClass('read-only');

	}
	$('.'+input).val('')
	$('.'+input+'_rut').val('')
	$('.'+input+'_old').val('')
	$('.ui.dropdown.'+input).dropdown('clear')
	$('.ui.dropdown.'+input).removeClass('disabled');
	$(this).hide()
	$('.'+input).removeAttr('readonly')
	$('.'+input+'_rut').removeAttr('readonly')
})


$('.edit_label').on('click', function(){
	var edit = $(this).attr('value')
	$('.editar_'+edit).removeAttr('readonly').removeClass('disabled');
})

$('.ui.search').search({

    minCharacters : 1,
    showNoResults : false,
    cache : false,
    apiSettings   : {
        responseAsync: function (settings, callback) {

        		var ruta = $(this).attr('ruta_search');
        		var tipo = $(this).attr('tipo_search');


                    var result;
                    var response = {
                        success: true   // docs say you need to return success: true
                    }
            $.ajax({
                url: ruta,
                type: "post",
                dataType: "json",
                data:{
                	_token:token, rut:settings.urlData.query, tipo:tipo
                },
                success: function(ret){
                    result = ret;
                },
                complete: function(){

                    response.results = result;
                    callback (response);  // Important to call the callback!

                }
            })
        },
    },
    fields: {
		//results : 'items',
		title   : 'rut',
		description : 'nombre_comp',
    },
    onSelect: function(result, response){
        var input = $(this).attr('name_input')

        if(input == 'cole_ant'){
            $('input[name="matricula[est_anterior_id]"]').val(result.id);
            $(this).children('.ui.icon.input').children('.cole_ant.input').attr('readonly','');
            $(this).children('.ui.icon.input').children('.icon_remove').show();
        }

    	if(result.model_student != null){
	    	$.each(result.model_student, function(index, value){
	    		$('input[name="alumno['+index+']"]').val(value);
	    		$('input[name="alumno['+index+'_old]"]').val(value);
	    		if(index == 'comuna_id'){
		    		$('.ui.dropdown.alumno').dropdown('set selected', value);
		    		//$('.ui.dropdown.alumno').addClass('disabled');
	    		}
	    		$('#icon_search_alu').show();
	    		$('#edit_alu').show();
	    		//$('.alumno').attr('readonly', 'true')
	    		//$('.alumno_rut').attr('readonly', 'true')

	    		if(index == 'al_sexo'){
		    		$('.check_'+value).checkbox('check');

	    		}
	    	})
    		$('.checkbox_gen').addClass('read-only');
	    	$('.alumno.block').attr('readonly', 'true')

    	}

    	if(result.model_padre != null){
	    	$.each(result.model_padre, function(index, value){
	    		$('input[name="padre['+index+']"]').val(value);
	    		$('input[name="padre['+index+'_old]"]').val(value);
	    		$('#icon_search_padre').show();
	    		//$('.padre').attr('readonly', 'true')
	    		//$('.padre_rut').attr('readonly', 'true')
	    	})
	    	$('.padre.block').attr('readonly', 'true')
    	}


    	if(result.model_madre != null){
	    	$.each(result.model_madre, function(index, value){
	    		$('input[name="madre['+index+']"]').val(value);
	    		$('input[name="madre['+index+'_old]"]').val(value);
	    		$('#icon_search_madre').show();
	    		//$('.madre').attr('readonly', 'true')
	    		//$('.madre_rut').attr('readonly', 'true')
	    	})
	    	$('.madre.block').attr('readonly', 'true')
    	}



    	if(result.model_persona_1 != null){
    		$('.segment_apod').show();
    		$('.segm_tipo_apod').hide();
	    	$.each(result.model_apod_1, function(index, value){
	    		$('input[name="apoderado['+index+']"]').val(value);
	    		$('input[name="apoderado['+index+'_old]"]').val(value);
	    		//$('input[name="apoderado['+index+']"]').attr('readonly', 'true');
	    	})
	    	$('input[name="apoderado[persona_rut]]"]').val(result.model_persona_1.pe_rut);
	    	
	    	$.each(result.model_persona_1, function(index, value){
	    		$('input[name="apoderado['+index+']"]').val(value);
	    		if(index == 'pe_rut'){
	    			$('input[name="apoderado[persona_rut]"]').val(value);
	    		}
	    		//$('input[name="apoderado['+index+']"]').attr('readonly', 'true');
	    		//if(index == 'pe_rut'){
		    	//	$('input[name="apoderado[pe_rut]"]').attr('readonly', 'true');
	    		//}
	    	})
	    	$('.apoderado.block').attr('readonly', 'true')
    	}

    	if(result.model_persona_2 != null){
    		$('.segment_apod2').show();
    		$('.segm_tipo_apod2').hide();
	    	$.each(result.model_persona_2, function(index, value){
	    		$('input[name="apoderado2['+index+']"]').val(value);
	    		if(index == 'pe_rut'){
	    			$('input[name="apoderado2[persona_rut]"]').val(value);
	    		}
{{-- 	    		$('input[name="apoderado2['+index+']"]').attr('readonly', 'true');
	    		    		if(index == 'pe_rut'){
	    			    		$('input[name="apoderado2[pe_rut]"]').attr('readonly', 'true');
	    		    		}
	    	 --}}	    	
	    	})
	    	$.each(result.model_apod_2, function(index, value){
	    		$('input[name="apoderado2['+index+']"]').val(value);
	    		$('input[name="apoderado2['+index+'_old]"]').val(value);
{{-- 	    		$('input[name="apoderado2['+index+']"]').attr('readonly', 'true');
	    	 --}}	    	
	    	})
	    	$('.apoderado2.block').attr('readonly', 'true')
    	}





    }
});
    	$('input[name="matricula[mat_condicional]"]').on('change', function(){
    		if($(this).is(":checked")){
    			$('textarea[name="matricula[mat_causas_cond]"]').removeAttr('disabled').attr('required',true)
    		}else{
    			$('textarea[name="matricula[mat_causas_cond]"]').attr('disabled', true).val('').removeAttr('required').parents('.field').removeClass('error')
    		}
    	})

</script>





@endsection
