@extends('admin.template.main')

@section('title', 'Actualizar Matrícula')

@section('content')

<p>
    <h2 class="ui header text-navy2">
        <span style="padding: 10px;">
            <i class="big icons">
				<i class="open folder icon"></i>
				<i class="corner yellow pencil icon"></i>
            </i>
        </span>
		<span style="border-bottom: 4px solid #FCDD13;">
	        Actualizar Matrícula | {{ ($matricula->mat_estado != 0)? 'N° '.$matricula->mat_numero:'' }}
		</span>
    </h2>
    <p>
        <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('matriculas.admin') }}"><i class="arrow left icon"></i> Volver</a>
    </p>
</p>


<div class="segment ui raised secondary">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon student"></i>
        Alumno
    </h4>
    <table class="table ui">
        <thead>
            <tr>
                <th style="width: 25%">Rut</th>
                <td style="width: 25%">{{ $matricula->alumno_rut }}</td>
                <th style="width: 25%">Nombre</th>
                <td style="width: 25%">{{ $matricula->alumno->nombreCompleto() }}</td>
            </tr>
            <tr>
                <th>Comuna</th>
                <td>{{ $matricula->alumno->comuna->com_nombre }}</td>
                <th>Dirección</th>
                <td>{{ $matricula->alumno->al_domicilio }}</td>
            </tr>
        </thead>
    </table>
</div>


<div class="ui menu pointing">
    <a data-tab="matricula" class="active item text-navy2"><i class="icon open folder outline"></i> Matricula</a>
    <a data-tab="alumno" class="item text-navy2"><i class="icon calendar student"></i> Alumno</a>
    <a data-tab="padres" class="item text-navy2"><i class="icon users"></i> Padres</a>
    <a data-tab="apoderados" class="item text-navy2"><i class="icon user outline"></i> Apoderados</a>
</div>

{{-- +++++++++++++++++++++++++++++++++++++++++++++++++++ --}}
{{-- ++++++++++++++++++++ MATRICULA ++++++++++++++++++++ --}}
{{-- +++++++++++++++++++++++++++++++++++++++++++++++++++ --}}

<div class="ui segment raised active tab animated fadeIn secondary" data-tab="matricula">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon open folder outline"></i>
        Matrícula
    </h4>
    <div class="segment ui raised">
        {!! Form::open(['route' => ['matriculas.update.matricula', $matricula], 'method'=>'PUT', 'class'=>'ui form', 'id'=>'form_matricula']) !!}
            <div class="ui error message">
                <i class="close icon"></i>
                <div class="header">
                    Error en el formulario
                </div>
                <ul class="list error_matricula">
                </ul>
            </div>
            <div class="fields two">
                <div class="field required {{ ($matricula->curso->count()) ? 'disabled':'' }}">
                    {!! Form::label('matricula[mat_grado_curso]', 'Grado Curso') !!}
                    {!! Form::select('matricula[mat_grado_curso]', [1=>'1°', 2=>'2°', 3=>'3°', 4=>'4°'], $matricula->mat_grado_curso, ['class'=>'ui selection dropdown', 'required']) !!}
                </div>

                <div class="field {{ ($matricula->mat_estado != 1) ? 'disabled':'' }}">
                    {!! Form::label('matricula[mat_numero]', 'Numero Matrícula') !!}
                    {!! Form::number('matricula[mat_numero]', $matricula->mat_numero, ['class'=>'', 'min'=>1]) !!}
                </div>
                
            </div>
            <div class="fields">
                <div class="field wide four">
                    {!! Form::label('matricula[mat_fecha_ingreso]', 'Fecha Ingreso') !!}
                    {!! Form::date('matricula[mat_fecha_ingreso]', $matricula->mat_fecha_ingreso, ['class'=>'']) !!}
                </div>
                <div class="field wide four">
                    {!! Form::label('matricula[mat_prom_ingreso]', 'Promedio de Ingreso') !!}
                    {!! Form::text('matricula[mat_prom_ingreso]', $matricula->mat_prom_ingreso, ['class'=>'']) !!}
                </div>
                <div class="field wide eight">
                    {!! Form::label('matricula[establecimiento_ant]', 'Establecimiento Anterior') !!}
                    <div class="ui search fluid category focus" ruta_search="{{ route('autocomplete.search_col_ant') }}" tipo_search="Padre" name_input="cole_ant">
                        <div class="ui icon input">
                            <input class="prompt cole_ant input block" type="text" placeholder="" autocomplete="off" name="matricula[establecimiento_ant]" value="{{ ($matricula->est_anterior_id != null) ? $matricula->escuela->eant_nombre : null }}" readonly="">
                            <i class="search icon inverted red circular remove link icon_search icon_remove" id="icon_search_cole_ant" style="" value="cole_ant"></i>
                        </div>
                    </div>
                    {!! Form::hidden('matricula[est_anterior_id]', $matricula->est_anterior_id, ['class'=>'cole_ant']) !!}
                </div>
            </div>
            <div class="field">
                <div class="ui toggle checkbox">
                    <input type="checkbox" name="matricula[mat_clases_religion]" value="1" {{ ($matricula->mat_clases_religion) ? 'checked':'' }}>
                    <label>Clases de Religión</label>
                </div>
            </div>
            <div class="field">
                <div class="ui toggle checkbox">
                    <input type="checkbox" class="" name="matricula[mat_condicional]" value="1" {{ ($matricula->mat_condicional) ? 'checked':'' }}>
                    <label>Condicional</label>
                </div>
            </div>
            <div class="field">
                {!! Form::label('matricula[mat_causas_cond]', 'Causas Condicional') !!}
                {!! Form::textarea('matricula[mat_causas_cond]', $matricula->mat_causas_cond, ['placeholder'=>'', 'class'=>'', 'rows'=>4, ($matricula->mat_condicional == 1) ? '':'disabled'=>true]) !!}
            </div>
            <div class="fields two">
                <div class="field">
                    {!! Form::label('matricula[mat_sit_padres]', 'Situación de Padres') !!}
                    {!! Form::select('matricula[mat_sit_padres]', [1=>'Casados', 0=>'Separados', 2=>'Conviven', 3=>'Madre Soltera'], $matricula->mat_sit_padres, ['class'=>'ui selection dropdown sit_padres', 'placeholder'=>'']) !!}
                </div>
                <div class="field">
                    {!! Form::label('matricula[mat_convive]', 'Conviven') !!}
                    {!! Form::text('matricula[mat_convive]', $matricula->mat_convive, ['class'=>'']) !!}
                </div>
            </div>
            <div class="field">
                {!! Form::label('matricula[mat_cant_hermanos]', 'Cantidad de Hermanos') !!}
                {!! Form::number('matricula[mat_cant_hermanos]', $matricula->mat_cant_hermanos, ['class'=>'', 'min'=>0]) !!}
            </div>
            <div class="field">
                {!! Form::label('enfermedades', 'Enfermedades') !!}
                @foreach ($matricula->enfermedades as $cont => $enf)
                    {!! Form::text('enfermedades['.$cont.'][enf_nombre]', $enf->enf_nombre, ['class'=>'']) !!}
                    {!! Form::hidden('enfermedades['.$cont.'][enf_id]', $enf->enf_id, ['class'=>'']) !!}
                @endforeach
                
            </div>

            <a class="button ui teal icon labeled submit_btn" tipo="matricula" valid="{{ route('validate.validate_matricula') }}"><i class="icon save"></i> Modificar Matrícula</a>

        {!! Form::close() !!}
    </div>
</div>

{{-- ++++++++++++++++++++++++++++++++++++++++++++++++++++ --}}
{{-- ++++++++++++++++++++++ ALUMNO ++++++++++++++++++++++ --}}
{{-- ++++++++++++++++++++++++++++++++++++++++++++++++++++ --}}

<div class="ui segment raised tab animated fadeIn secondary" data-tab="alumno">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon student"></i>
        Alumno
    </h4>
    <div class="ui segment raised">
        {!! Form::open(['route' => ['matriculas.update.alumno', $matricula], 'method'=>'PUT', 'class'=>'ui form', 'id'=>'form_alumno']) !!}
            <div class="ui error message">
                <i class="close icon"></i>
                <div class="header">
                Error en el formulario
                </div>
                <ul class="list error_alumno">
                </ul>
            </div>
            <div class="field">
                {!! Form::label('alumno[al_rut]', 'Rut') !!}
                {!! Form::text('alumno[al_rut]', $matricula->alumno->al_rut, ['placeholder'=>'', 'tipo-input'=>'rut']) !!}
                {!! Form::hidden('alumno[al_rut_exist]', $matricula->alumno->al_rut, ['placeholder'=>'', 'tipo-input'=>'rut']) !!}
            </div>
            <div class="fields">
                <div class="field eight wide">
                    {!! Form::label('alumno[al_nombres]', 'Nombres') !!}
                    {!! Form::text('alumno[al_nombres]', $matricula->alumno->al_nombres, ['placeholder'=>'']) !!}
                </div>
                <div class="field four wide">
                    {!! Form::label('alumno[al_apellido_pat]', 'Apellido Paterno') !!}
                    {!! Form::text('alumno[al_apellido_pat]', $matricula->alumno->al_apellido_pat, ['placeholder'=>'']) !!}
                </div>
                <div class="field four wide">
                    {!! Form::label('alumno[al_apellido_mat]', 'Apellido Materno') !!}
                    {!! Form::text('alumno[al_apellido_mat]', $matricula->alumno->al_apellido_mat, ['placeholder'=>'']) !!}
                </div>
            </div>
            <div class="fields two">
                <div class="field">
                    {!! Form::label('alumno[comuna_id]', 'Comuna') !!}
                    {!! Form::select('alumno[comuna_id]', $comunas, $matricula->alumno->comuna_id, ['class'=>'ui search editar_alumno dropdown alumno', 'placeholder'=>'']) !!}
                </div>
                <div class="field">
                    {!! Form::label('alumno[al_apellido_mat]', 'Fecha de Nacimiento') !!}
                    {!! Form::date('alumno[al_fecha_nacimiento]', $matricula->alumno->al_fecha_nacimiento, ['placeholder'=>'', 'max'=>date('Y-m-d')]) !!}
                </div>
            </div>
            <div class="fields two">
                <div class="field">
                    {!! Form::label('alumno[al_domicilio]', 'Dirección') !!}
                    {!! Form::text('alumno[al_domicilio]', $matricula->alumno->al_domicilio, ['placeholder'=>'']) !!}
                </div>
                <div class="field">
                    {!! Form::label('alumno[al_fono]', 'Fono Contacto') !!}
                    {!! Form::text('alumno[al_fono]', $matricula->alumno->al_fono, ['placeholder'=>'']) !!}
                </div>
            </div>
            <div class="grouped fields required">
                <label>Género</label>
                <div class="field">
                    <div class="ui toggle checkbox checkbox_gen check_masculino">
                        <input type="radio" name="alumno[al_sexo]" value="masculino" checked="{{ ($matricula->alumno->al_sexo == 'masculino') ? 'ckeched':'' }}">
                        <label>Masculino</label>
                    </div>
                </div>
                <div class="field">
                    <div class="ui toggle checkbox checkbox_gen check_femenino">
                        <input type="radio" name="alumno[al_sexo]" value="femenino" checked="{{ ($matricula->alumno->al_sexo == 'femenino') ? 'ckeched':'' }}">
                        <label>Femenino</label>
                    </div>
                </div>
            </div>
            <a class="button ui teal icon labeled submit_btn" tipo="alumno" valid="{{ route('validate.validate_student') }}"><i class="icon save"></i> Modificar Alumno</a>
        {!! Form::close() !!}
        
    </div>
</div>

{{-- ++++++++++++++++++++++++++++++++++++++++++++++++++++ --}}
{{-- ++++++++++++++++++++++ PADRES ++++++++++++++++++++++ --}}
{{-- ++++++++++++++++++++++++++++++++++++++++++++++++++++ --}}

<div class="ui segment raised tab animated fadeIn secondary" data-tab="padres">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon users"></i>
        Datos Padres
    </h4>
    @php
        if($padre != null && $madre != null){
            $drop_padres = 3;
        }else{
            if(($padre == null) && ($madre == null)){
                $drop_padres = 0;
            }elseif($padre != null){
                $drop_padres = 1;
            }elseif($madre != null){
                $drop_padres = 2;
            }
        }
    @endphp
    {!! Form::open(['route' => ['matriculas.update.padres', $matricula], 'method'=>'PUT', 'class'=>'ui form', 'id'=>'form_padres']) !!}
        <div class="inline fields no-margin">
            <label>Padres:</label>
            <div class="field required">
                {!! Form::select('padres', [0=>'Ninguno', 1=>'Solo Padre', 2=>'Solo Madre', 3=>'Ambos'], $drop_padres, ['class'=>'ui selection dropdown padres_drop', 'placeholder'=>'', 'apod'=>'']) !!}
            </div>
        </div>
        <div class="ui error message">
            <i class="close icon"></i>
            <div class="header">
                Error en el formulario
            </div>
            <ul class="list error_padres">
            </ul>
        </div>
        <div class="ui raised segment animated fadeIn" data-segm="segm_1" style="{{ ($padre != null) ? '':'display: none;' }}">
            <h4 class="ui horizontal divider header text-navy2">
                <i class="icon male"></i>
                Padre
            </h4>
            <div class="fields two required">
                <div class="field">
                    {!! Form::label('padre[padre_rut]', 'R.U.N.') !!}
                    {{-- 
                    <div class="ui search fluid category focus" ruta_search="{{ route('autocomplete.search_padres') }}" tipo_search="Padre" name_input="padre">
                        <div class="ui icon input">
                            <input class="prompt padre block" type="text" placeholder="" autocomplete="off" name="padre[pad_rut]" value="{{ ($padre != null)? $padre->pad_rut:null }}" tipo-input="rut">
                            <i class="search icon inverted red circular remove link icon_search" id="icon_search_padre" style="display: none;" value="padre"></i>
                        </div>
                    </div>
                     --}}
                    {!! Form::text('padre[pad_rut]', ($padre != null) ? $padre->pad_rut:null, ['placeholder'=>'', 'required'=>'required', 'tipo-input'=>'rut']) !!}
                </div>
                <div class="field">
                    {!! Form::label('padre[pad_fecha_nacimiento]', 'Fecha de Namiciento') !!}
                    {!! Form::date('padre[pad_fecha_nacimiento]',($padre != null)? $padre->pad_fecha_nacimiento:null, ['class'=>'padre', 'placeholder'=>'', 'max'=>date('Y-m-d')]) !!}
                </div>
                {!! Form::hidden('padre[pad_rut_exist]', ($padre != null) ? $padre->pad_rut:null, ['placeholder'=>'', 'required'=>'required']) !!}
                {!! Form::hidden('padre[pad_rut_old]', null, ['placeholder'=>'', 'required'=>'required', 'class'=>'padre_old']) !!}
            </div>
            <div class="fields required">
                <div class="eight wide field">
                    {!! Form::label('padre[pad_nombres]', 'Nombre') !!}
                    {!! Form::text('padre[pad_nombres]', ($padre != null) ? $padre->pad_nombres:null, ['class'=>'padre block', 'placeholder'=>'Nombres']) !!}
                </div>
                <div class="four wide field">
                    {!! Form::label('padre[pad_apellido_pat]', 'Apellido Paterno') !!}
                    {!! Form::text('padre[pad_apellido_pat]', ($padre != null) ? $padre->pad_apellido_pat:null, ['class'=>'padre block', 'placeholder'=>'Apellido Paterno']) !!}
                </div>
                <div class="four wide field">
                    {!! Form::label('padre[pad_apellido_mat]', 'Apellido Materno') !!}
                    {!! Form::text('padre[pad_apellido_mat]', ($padre != null) ? $padre->pad_apellido_mat:null, ['class'=>'padre block', 'placeholder'=>'Apellido Materno']) !!}
                </div>
            </div>
            <div class="fields two required">
                <div class="field">
                    {!! Form::label('padre[pad_domicilio]', 'Domicilio') !!}
                    {!! Form::text('padre[pad_domicilio]', ($padre != null) ? $padre->pad_domicilio:null, ['class'=>'padre', 'placeholder'=>'']) !!}
                </div>      
                <div class="field">
                    {!! Form::label('padre[pad_nivel_estudio]', 'Nivel Estudios') !!}
                    {!! Form::text('padre[pad_nivel_estudio]', ($padre != null) ? $padre->pad_nivel_estudio:null, ['class'=>'padre', 'placeholder'=>'Nivel Estudios']) !!}
                </div>
            </div>
            <div class="fields three">
                <div class="field required">
                    {!! Form::label('padre[pad_sit_laboral]', 'Situacion Laboral') !!}
                    {!! Form::text('padre[pad_sit_laboral]', ($padre != null) ? $padre->pad_sit_laboral:null, ['class'=>'padre', 'placeholder'=>'']) !!}
                </div>
                <div class="field">
                    {!! Form::label('padre[pad_profesion]', 'Profesion') !!}
                    {!! Form::text('padre[pad_profesion]', ($padre != null) ? $padre->pad_profesion:null, ['class'=>'padre', 'placeholder'=>'']) !!}
                </div>
                <div class="field">
                    {!! Form::label('padre[pad_renta]', 'Renta') !!}
                    {!! Form::text('padre[pad_renta]', ($padre != null) ? $padre->pad_renta:null, ['class'=>'padre', 'placeholder'=>'', 'tipo-input'=>'number']) !!}
                </div>
            </div>
        </div>
        <div class="ui segment animated fadeIn" data-segm="segm_2" style="{{ ($madre != null) ? '':'display: none;' }}">
            <h4 class="ui horizontal divider header text-navy2">
                <i class="icon female"></i>
                Madre
            </h4>
            <div class="fields two required">
                <div class="field">
                    {!! Form::label('madre[madre_rut]', 'R.U.N.') !!}
                    {{-- 
                    <div class="ui search fluid category focus" ruta_search="{{ route('autocomplete.search_padres') }}" tipo_search="Madre" name_input="madre">
                        <div class="ui icon input">
                            <input class="prompt madre block" type="text" placeholder="" autocomplete="off" name="madre[pad_rut]" tipo-input="rut" value="{{ ($madre != null) ? $madre->pad_rut:null }}">
                            <i class="search icon inverted red circular remove link icon_search" id="icon_search_madre" style="display: none;" value="madre"></i>
                        </div>
                    </div>
                     --}}
                    {!! Form::text('madre[pad_rut]', ($madre != null) ? $madre->pad_rut:null, ['placeholder'=>'', 'required'=>'required', 'tipo-input'=>'rut']) !!}                                     
                    {!! Form::hidden('madre[pad_rut_exist]', ($madre != null) ? $madre->pad_rut:null, ['placeholder'=>'', 'required'=>'required']) !!}                                     
                    {!! Form::hidden('madre[pad_rut_old]', null, ['class'=>'madre block', 'placeholder'=>'', 'required'=>'required', 'class'=>'madre_old']) !!}                                     
                </div>
                <div class="field">
                    {!! Form::label('madre[pad_fecha_nacimiento]', 'Fecha de Namiciento') !!}
                    {!! Form::date('madre[pad_fecha_nacimiento]', ($madre != null) ? $madre->pad_fecha_nacimiento:null, ['class'=>'madre', 'placeholder'=>'', 'max'=>date('Y-m-d')]) !!}
                </div>
            </div>
            <div class="fields required">
                <div class="eight wide field">
                    {!! Form::label('madre[pad_nombres]', 'Nombre') !!}
                    {!! Form::text('madre[pad_nombres]', ($madre != null) ? $madre->pad_nombres:null, ['class'=>'madre block', 'placeholder'=>'Nombres']) !!}
                </div>
                <div class="four wide field">
                    {!! Form::label('madre[pad_apellido_pat]', 'Apellido Paterno') !!}
                    {!! Form::text('madre[pad_apellido_pat]', ($madre != null) ? $madre->pad_apellido_pat:null, ['class'=>'madre block', 'placeholder'=>'Apellido Paterno']) !!}
                </div>
                <div class="four wide field">
                    {!! Form::label('madre[pad_apellido_mat]', 'Apellido Materno') !!}
                    {!! Form::text('madre[pad_apellido_mat]', ($madre != null) ? $madre->pad_apellido_mat:null, ['class'=>'madre block', 'placeholder'=>'Apellido Materno']) !!}
                </div>
            </div>
            <div class="fields two required">
                <div class="field">
                    {!! Form::label('madre[pad_domicilio]', 'Domicilio') !!}
                    {!! Form::text('madre[pad_domicilio]', ($madre != null) ? $madre->pad_domicilio:null, ['class'=>'madre', 'placeholder'=>'']) !!}
                </div>      
                <div class="field">
                    {!! Form::label('madre[pad_nivel_estudio]', 'Nivel Estudios') !!}
                    {!! Form::text('madre[pad_nivel_estudio]', ($madre != null) ? $madre->pad_nivel_estudio:null, ['class'=>'madre', 'placeholder'=>'Nivel Estudios']) !!}
                </div>
            </div>
            <div class="fields three">
                <div class="field required">
                    {!! Form::label('madre[pad_sit_laboral]', 'Situacion Laboral') !!}
                    {!! Form::text('madre[pad_sit_laboral]', ($madre != null) ? $madre->pad_sit_laboral:null, ['class'=>'madre', 'placeholder'=>'']) !!}
                </div>
                <div class="field">
                    {!! Form::label('madre[pad_profesion]', 'Profesion') !!}
                    {!! Form::text('madre[pad_profesion]', ($madre != null) ? $madre->pad_profesion:null, ['class'=>'madre', 'placeholder'=>'']) !!}
                </div>

                <div class="field">
                    {!! Form::label('madre[pad_renta]', 'Renta') !!}
                    {!! Form::text('madre[pad_renta]', ($madre != null) ? $madre->pad_renta:null, ['class'=>'madre', 'placeholder'=>'', 'tipo-input'=>'number']) !!}
                </div>
            </div>
        </div>
        <a class="button ui teal icon labeled submit_btn" tipo="padres" valid="{{ route('validate.validate_padres') }}"><i class="icon save"></i> Modificar Padres</a>
    {!! Form::close() !!}
</div>

{{-- ++++++++++++++++++++++++++++++++++++++++++++++++++++ --}}
{{-- ++++++++++++++++++++ APODERADOS ++++++++++++++++++++ --}}
{{-- ++++++++++++++++++++++++++++++++++++++++++++++++++++ --}}

<div class="ui segment raised tab animated fadeIn secondary" data-tab="apoderados">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon user outline"></i>
        Datos Apoderados
    </h4>
    {!! Form::open(['route' => ['matriculas.update.apoderados', $matricula], 'method'=>'PUT', 'class'=>'ui form', 'id'=>'form_apoderados']) !!}
        <div class="inline fields no-margin">
                <label>Cantidad Apoderados:</label>
                
            <div class="field">
                {!! Form::select('cant_apod', [1=>1, 2=>2], $matricula->apoderados->count(), ['class'=>'ui selection dropdown apod_drop', 'apod'=>'']) !!}
            </div>
        </div>
        <div class="ui error message">
            <i class="close icon"></i>
            <div class="header">
            Error en el formulario
            </div>
            <ul class="list error_apoderados">
            </ul>
        </div>
        <div class="ui bottom raised segment active animated fadeIn" data-segm="apoderado1">
            <h4 class="ui horizontal divider header text-navy2">
                <i class="icon user"></i>
                Apoderado I
            </h4>
            <div class="ui segment secondary segm_tipo_apod">
                <div class="inline fields no-margin">
                    <div class="field wide four">
                        <label>Parentesco:</label>
                    </div>
                    <div class="field wide twelve">
                        {!! Form::select('parentesco1', ['padre'=>'Padre', 'madre'=>'Madre', 'otros'=>'Otro'], (($apod1->ap_parentesco == 'madre') || ($apod1->ap_parentesco == 'padre')) ? $apod1->ap_parentesco:'otros', ['class'=>'ui selection dropdown parentesco_apod', 'placeholder'=>'', 'apod'=>'']) !!}
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
                            <input class="prompt apoderado block" type="text" placeholder="Search GitHub" autocomplete="off" name="apoderado[pe_rut]" tipo-input="rut" value="{{ $apod1->persona_rut }}">
                            <i class="search icon"></i>
                        </div>
                    </div>
                </div>
                {!! Form::hidden('apoderado[ap_id]', $apod1->ap_id, ['placeholder'=>'', 'required'=>'required', 'class'=>'apoderado']) !!}                                       
                <div class="field">
                    {!! Form::label('apoderado[ap_parentesco]', 'Parentesco') !!}
                        {!! Form::text('apoderado[ap_parentesco]', $apod1->ap_parentesco, ['class'=>'apoderado block', 'placeholder'=>'Parentesco']) !!}
                </div>
            </div>
            <div class="fields required">
                <div class="eight wide field">
                    {!! Form::label('apoderado[pe_nombres]', 'Nombre') !!}
                    {!! Form::text('apoderado[pe_nombres]', $apod1->persona->pe_nombres, ['class'=>'apoderado block', 'placeholder'=>'Nombres']) !!}
                </div>
                <div class="four wide field">
                    {!! Form::label('apoderado[pe_apellido_pat]', 'Apellido Paterno') !!}
                    {!! Form::text('apoderado[pe_apellido_pat]', $apod1->persona->pe_apellido_pat, ['class'=>'apoderado block', 'placeholder'=>'Apellido Paterno']) !!}
                </div>
                <div class="four wide field">
                    {!! Form::label('apoderado[pe_apellido_mat]', 'Apellido Materno') !!}
                    {!! Form::text('apoderado[pe_apellido_mat]', $apod1->persona->pe_apellido_mat, ['class'=>'apoderado block', 'placeholder'=>'Apellido Materno']) !!}
                </div>
            </div>
            <div class="fields two">
                <div class="field required">
                    {!! Form::label('apoderado[ap_direccion]', 'Dirección') !!}
                        {!! Form::text('apoderado[ap_direccion]', $apod1->ap_direccion, ['class'=>'apoderado', 'placeholder'=>'Direccion']) !!}
                </div>
                <div class="field">
                    {!! Form::label('apoderado[pe_contacto]', 'Fono Contacto') !!}
                        {!! Form::text('apoderado[pe_contacto]', $apod1->persona->pe_contacto, ['tipo-input'=>'number', 'class'=>'apoderado', 'placeholder'=>'Direccion', 'max'=>9]) !!}
                </div>
            </div>
        </div>
        <div class="ui bottom raised segment animated fadeIn" data-segm="apoderado2" style="{{ ($apod2 != null) ? '':'display: none;' }}">
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
                        @php
                            if($apod2 != null){
                                if(($apod2->ap_parentesco == 'madre') || ($apod2->ap_parentesco == 'padre')){
                                    $parentesco = $apod2->ap_parentesco;
                                }else{
                                    $parentesco = 'otros';
                                }
                            }else{
                                $parentesco = 'otros';
                            }
                        @endphp
                        {!! Form::select('parentesco2', ['padre'=>'Padre', 'madre'=>'Madre', 'otros'=>'Otro'], $parentesco, ['class'=>'ui selection dropdown parentesco_apod', 'placeholder'=>'', 'apod'=>'2']) !!}
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
                            <input class="prompt apoderado2 block" type="text" placeholder="Search GitHub" autocomplete="off" name="apoderado2[pe_rut]" tipo-input="rut" value="{{ ($apod2 != null) ? $apod2->persona_rut:null }}">
                            <i class="search icon"></i>
                        </div>
                    </div>
                    {!! Form::hidden('apoderado2[ap_id]', ($apod2 != null) ? $apod2->ap_id:null, ['class'=>'apoderado2 block', 'placeholder'=>'', 'required'=>'required', 'class'=>'apoderado2']) !!}                                        
                </div>
                <div class="field">
                    {!! Form::label('apoderado2[ap_parentesco]', 'Parentesco') !!}
                    {!! Form::text('apoderado2[ap_parentesco]', ($apod2 != null) ? $apod2->ap_parentesco:null, ['class'=>'apoderado2 block', 'placeholder'=>'Parentesco']) !!}
                </div>
            </div>
            <div class="fields required">
                <div class="eight wide field">
                    {!! Form::label('apoderado2[pe_nombres]', 'Nombre') !!}
                    {!! Form::text('apoderado2[pe_nombres]', ($apod2 != null) ? $apod2->persona->pe_nombres:null, ['class'=>'apoderado2 block', 'placeholder'=>'Nombres']) !!}
                </div>
                <div class="four wide field">
                    {!! Form::label('apoderado2[pe_apellido_pat]', 'Apellido Paterno') !!}
                    {!! Form::text('apoderado2[pe_apellido_pat]', ($apod2 != null) ? $apod2->persona->pe_apellido_pat:null, ['class'=>'apoderado2 block', 'placeholder'=>'Apellido Paterno']) !!}
                </div>
                <div class="four wide field">
                    {!! Form::label('apoderado2[pe_apellido_mat]', 'Apellido Materno') !!}
                    {!! Form::text('apoderado2[pe_apellido_mat]', ($apod2 != null) ? $apod2->persona->pe_apellido_mat:null, ['class'=>'apoderado2 block', 'placeholder'=>'Apellido Materno']) !!}
                </div>
            </div>
            <div class="fields two">
                <div class="field required">
                    {!! Form::label('apoderado2[ap_direccion]', 'Dirección') !!}
                    {!! Form::text('apoderado2[ap_direccion]', ($apod2 != null) ? $apod2->ap_direccion:null, ['class'=>'apoderado2', 'placeholder'=>'Direccion']) !!}
                </div>
                <div class="field">
                    {!! Form::label('apoderado2[pe_contacto]', 'Fono Contacto') !!}
                    {!! Form::text('apoderado2[pe_contacto]', ($apod2 != null) ? $apod2->persona->pe_contacto:null, ['tipo-input'=>'number', 'class'=>'apoderado2', 'placeholder'=>'', 'max'=>9]) !!}
                </div>
            </div>
        </div>
        <a class="button ui teal icon labeled submit_btn" tipo="apoderados" valid="{{ route('validate.validate_apoderados') }}"><i class="icon save"></i> Modificar Apoderados</a>
    {!! Form::close() !!}
</div>

{{-- +++++++++++++++++++++++++++++++++++++++++++++++++++ --}}
{{-- +++++++++++++++++++++++++++++++++++++++++++++++++++ --}}
{{-- +++++++++++++++++++++++++++++++++++++++++++++++++++ --}}


<script type="text/javascript">
    var token = $('meta[name="csrf-token"]').attr('content');

    $('.submit_btn').on('click', function(){
        var url = $(this).attr('valid');
        var tipo = $(this).attr('tipo');
        $('.field.error').removeClass('error')
        $('#form_'+tipo).removeClass('error')
        $.ajax({
            url: url,
            type: 'put',
            data: $('#form_'+tipo).serialize(),
            success: function(response){
                if(!response.success){
                    var list_error = $('#form_'+tipo).children('.list_error');
                    $('#form_'+tipo).addClass('error');
                    $('.error_'+tipo).html('');
                    $.each(response.errors, function(index, value){
                        $('label[for="'+response.tipo+'['+index+']"]').parents('.field').addClass('error');
                        $('<li>'+value+'</li>').appendTo('.error_'+tipo)
                    })
                    $('#form_'+tipo).children('.error.message').removeClass('hidden')
                }else{
                    $('#form_'+tipo).submit();
                }
            }
        })
    })


    $('.padres_drop').on('change', function(){
        var tipo = $(this).val();
        if(tipo != 0){
            $('.segm_tipo_apod').show();
            $('.segm_tipo_apod2').show();
            if(tipo== 3){
                $('.segm_padre').show()
                $('.segm_madre').show()
                return;
            }
            if(tipo == 1){
                $('.segm_madre').hide()
                $('.segm_padre').show()
                return;
            }
            if(tipo == 2){
                $('.segm_padre').hide()
                $('.segm_madre').show()
                return;
            }
        }
        if(tipo == 0){
            $('.segm_madre').hide()
            $('.segm_padre').hide()
            return;
        }
    })
$('.ui.search').search({
    minCharacters : 1,
    showNoResults : false,
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
        $(this).children('.icon.input').children('.icon_remove').show();
        $(this).children('.input').children('.'+input).attr('readonly', 'true');
        if(input == 'cole_ant'){
            $('input[name="matricula[est_anterior_id]"]').val(result.id);
            $(this).children('.cole_ant.input').attr('readonly','');
            $(this).children('.ui.icon.input').children('.icon_search').show();
        }
        if(input == 'padre'){
            $.each(result.model_padre, function(index, value){
                $('input[name="'+input+'['+index+']"]').val(value);
            })
        }
        if(input == 'madre'){
            $.each(result.model_madre, function(index, value){
                $('input[name="'+input+'['+index+']"]').val(value);
            })
        }
        if(input == 'apod1'){
            $.each(result.model_apod_1, function(index, value){
                $('input[name="'+input+'['+index+']"]').val(value);
            })
            $.each(result.model_apod_1.persona, function(index, value){
                $('input[name="'+input+'['+index+']"]').val(value);
            })
            $('input[name="'+input+'[ap_id_old]"]').val(result.model_apod_1.ap_id);
        }
        if(input == 'apod2'){
            $.each(result.model_apod_2, function(index, value){
                $('input[name="'+input+'['+index+']"]').val(value);
                console.log(index+'="'+value+'"')
            })
            $.each(result.model_apod_2.persona, function(index, value){
                $('input[name="'+input+'['+index+']"]').val(value);
                console.log(index+'="'+value+'"')
            })
            $('input[name="'+input+'[ap_id_old]"]').val(result.model_apod_2.ap_id);
        }
    }
});

    $('.icon_remove').on('click', function(){
        $(this).parent('.input').children('input').removeAttr('readonly');
        var inputs = $(this).attr('value');
        $('.'+inputs).val('')
        $(this).hide()
    })


    $('.apod_drop').on('change', function(){
        var val = $(this).val();
        if(val == 2){
            $('.segment.apoderado2').show();
        }else{
            $('.segment.apoderado2').hide();
        }
    })



</script>


@endsection
