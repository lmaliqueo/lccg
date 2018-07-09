@extends('admin.template.main')

@section('title', 'Pruebas SIMCE')

@section('content')


	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="file alternate icon"></i>
					<i class="corner yellow pencil icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
		        Pruebas SIMCE
			</span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('ensayos.simce.index') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>



@if ($errors->any())
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

{!! Form::open(['route' => ['ensayos.simce.update', $simce], 'method'=>'PUT', 'class'=>'ui form']) !!}

<div class="ui segment raised">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon file alternate"></i>
        SIMCE
    </h4>




    <table class="ui celled table">
        <thead>
            <tr>
                <th style="width: 25%">Fecha</th>
                <td style="width: 25%">
                    {!! Form::date('ensayo[ens_fecha]', $simce->ens_fecha, ['placeholder'=>'', 'max'=>date('Y-m-d'), 'required']) !!}
                    {!! Form::hidden('ensayo[periodo_id]', $simce->periodo_id, ['placeholder'=>'']) !!}
                    
                </td>
                <th style="width: 25%">Materia</th>
                <td style="width: 25%">
                    {!! Form::select('aula_id', $materias->pluck('mens_nombre', 'mens_id'), $simce->materia_id, ['class'=>'ui fluid search dropdown selection', 'placeholder'=>'']) !!}
                </td>
            </tr>
        </thead>
    </table>
            
            <div class="text-center margin-bottom">
    <div class="ui pointing menu compact margin-bottom">
        <a value="1" class="item menu_grado" data-tab="cursos_1">1° Grado</a>
        <a value="2" class="item menu_grado" data-tab="cursos_2">2° Grado</a>
        <a value="3" class="item menu_grado" data-tab="cursos_3">3° Grado</a>


    </div>
    </div>

    <div class="field text-center">
        {!! Form::submit('Guardar', ['class'=>'ui button teal']) !!}
    </div>
</div>

@for ($i = 1; $i <= 3 ; $i++)
        <div class="ui bottom attached tab animated fadeIn margin-bottom" data-tab="cursos_{{ $i }}">


            @php
                $array_nivel = $grados->where('pcur_grado', $i)->pluck('pcur_id');
                $cursos = $simce->periodo->cursos->whereIn('parametro_id', $array_nivel);
            @endphp

            <div class="text-center margin-bottom">
                <div class="ui pointing menu compact margin-bottom">
                    @foreach ($cursos as $curso)
                        <a value="{{ $curso->cu_id }}" class="item menu_curso" data-tab="curso_{{ $curso->cu_id }}">
                            {{ $curso->nombreCurso() }}
                        </a>
                    @endforeach
                </div>
            </div>


            @foreach ($cursos as $cu)
                <div class="ui bottom attached tab animated fadeIn margin-bottom tab_cursos" data-tab="curso_{{ $cu->cu_id }}">
                    <div class="segment ui raised secondary">
                        <h4 class="ui horizontal divider header text-navy2">
                            <i class="icon edit outline"></i>
                            {{ $cu->nombreCurso() }}
                        </h4>
                        <table class="table ui celled">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>RUN</th>
                                    <th>Nombre</th>
                                    <th>Estado</th>
                                    <th>Puntaje</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cu->listaAlumnos as $alumno)
                                    <tr>
                                        <td>{{ $alumno->mat_numero }}</td>
                                        <td>{{ $alumno->alumno_rut }}</td>
                                        <td>{{ $alumno->alumno->nombrecompleto() }}</td>
                                        <td>{{ $alumno->mat_estado }}</td>
                                        <td>
                                            <div class="field">
                                                @php
                                                    $alu = $simce->matriculas->where('mat_id', $alumno->mat_id)->first();
                                                @endphp
                                                <input type="number" name="alumno[{{ $alumno->mat_id }}][alr_resultado]" value="{{ ($alu != null) ? $alu->pivot->alr_resultado : null }}">
                                                <input type="hidden" name="alumno[{{ $alumno->mat_id }}][matricula_id]" value="{{ $alumno->mat_id }}">
                                                
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach

        </div>
@endfor






    









{!! Form::close() !!}








@endsection
