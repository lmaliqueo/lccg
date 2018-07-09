@extends('admin.template.main')

@section('title', 'Pruebas SIMCE')

@section('content')



	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="file alternate icon"></i>
					<i class="corner yellow plus icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
		        Registrar Resultados
			</span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('ensayos.simce.index') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>

{!! Form::open(['route' => 'ensayos.simce.store', 'method'=>'POST', 'class'=>'ui form animated fadeIn']) !!}


    <div class="ui segment raised secondary">
        <h4 class="ui horizontal divider header text-navy2">
            <i class="icon file alternate"></i>
            Ensayo SIMCE
        </h4>

        <table class="ui celled table">
            <thead>
                <tr>
                    <td style="display: none;">
                        {!! Form::text('ensayo[tipo_id]', $simce->ten_id, ['placeholder'=>'', 'class'=>'disabled']) !!}
                        
                    </td>
                    <th style="width: 25%">Fecha</th>
                    <td style="width: 25%">
                        <div class="field">
                            {!! Form::date('ensayo[ens_fecha]', null, ['placeholder'=>'', 'max'=>date('Y-m-d'), 'required']) !!}
                            {!! Form::hidden('ensayo[periodo_id]', $periodo_actual->pac_id, ['placeholder'=>'']) !!}
                        </div>
                        
                    </td>
                    <th style="width: 25%">Materia</th>
                    <td style="width: 25%">
                        <div class="field">
                            <select class="ui fluid dropdown" name="ensayo[materia_id]">
                                @foreach ($simce->materias as $materia)
                                    <option value="{{ $materia->mens_id }}">{{ $materia->mens_nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </td>
                    {{-- 
                    <th>Cursos</th>
                    <td>
                        <select class="ui fluid selection dropdown" name="ensayo[ens_grado_curso]" multiple="">
                            @foreach ($grados as $grado)
                                <option value="{{ $grado->pcur_grado }}">{{ $grado->pcur_grado }}</option>
                            @endforeach
                        </select>
                     --}}
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
            <button class="ui button teal">Guardar</button>
        </div>

    </div>


    @foreach ($cursos as $count => $curso)
        <div class="ui bottom attached tab animated fadeIn margin-bottom" data-tab="cursos_{{ $count }}">
            <div class="text-center margin-bottom">
                <div class="ui pointing menu compact margin-bottom">
                    @foreach ($curso as $cu)
                        <a value="{{ $cu->cu_id }}" class="item menu_curso" data-tab="curso_{{ $cu->cu_id }}">
                            {{ $cu->nombreCurso() }}
                        </a>
                    @endforeach
                </div>
            </div>


            @foreach ($curso as $cu)
                <div class="ui bottom attached tab animated fadeIn margin-bottom tab_cursos" data-tab="curso_{{ $cu->cu_id }}">
                    <div class="segment ui raised secondary">
                        <div class="title">
                            <div class="ui inverted ribbon label large blue">
                                <i class="icon edit"></i> Curso {{ $cu->nombreCurso() }}
                            </div>      
                        </div>
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
                                @foreach ($cu->listaAlumnos()->orderBy('mat_posicion_lista', 'ASC')->get() as $alumno)
                                    <tr class="{{ ($alumno->mat_estado == 3)? 'negative disabled':'' }}">
                                        <td>{{ $alumno->mat_posicion_lista }}</td>
                                        <td>{{ $alumno->alumno_rut }}</td>
                                        <td>{{ $alumno->alumno->nombrecompleto() }}</td>
                                        <td>{{ $alumno->estado() }}</td>
                                        <td>
                                            <input type="number" name="alumno[{{ $alumno->mat_id }}][puntaje]" min="0" max="800">
                                            <input type="hidden" name="alumno[{{ $alumno->mat_id }}][matricula]" value="{{ $alumno->mat_id }}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
   







{!! Form::close() !!}







<script type="text/javascript">

        $('.head_acc').on('click', function(){
            var grado = $(this).attr('data-grado');
            $('.tab_cursos').removeClass('active');
            $('.head_acc.active').removeClass('active');
            $('.content.active').removeClass('active');
        })



</script>








@endsection
