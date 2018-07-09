@extends('admin.template.main')

@section('title', 'Academico')

@section('content')


<h2 class="ui center aligned icon header text-navy2" >
    <i class="circular book icon"></i>
    <span style="border-bottom: 5px solid #FCDD13;">
    Academico

    </span>
</h2>
<br>
<div class="ui four column centered grid" style="margin: 30px;">
    @if (Auth::user()->administrador())
        <div class="column center aligned">
            <a href="{{ route('academico.menu_notas') }}">

                <h3 class="ui icon grey header no-margin button_pulse">
                    <i class=" table icon"></i>
                    <div class="content">
                    Ingresar Calificaciones

                    <div class="sub header">Ingresar las notas de los alumnos por curso</div>
                    </div>
                </h3>

            </a>

        </div>
        <div class="column center aligned">
            <a href="{{ route('academico.menu_asistencia') }}">

                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class="calendar check outline icon"></i>
                    <div class="content">
                    Asistencia de Curso

                    <div class="sub header">Ingresar las asistencias de los alumnos por curso</div>
                    </div>
                </h3>

            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('academico.eva_comportamiento') }}">

                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class="file text icon"></i>
                    <div class="content">
                    Evaluar Comp. Alumno

                    <div class="sub header">Evaluar el comportamiento escolar de un alumno</div>
                    </div>
                </h3>

            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('ensayos.psu.index') }}">

                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class="check circle outline icon"></i>
                    <div class="content">
                    Registrar Ensayos PSU

                    <div class="sub header">Registrar y modificar los ensayos PSU</div>
                    </div>
                </h3>

            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('ensayos.simce.index') }}">

                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class="check circle icon"></i>
                    <div class="content">
                    Registrar Ensayos SIMCE

                    <div class="sub header">Registrar y modificar los ensayos SIMCE</div>
                    </div>
                </h3>

            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('asistencia.index_grafico') }}">

                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class="bar chart icon"></i>
                    <div class="content">
                    Grafico Asistencias

                    <div class="sub header">Ver gráfico de asistencias de los alumnos durante un periodo académico</div>
                    </div>
                </h3>

            </a>
        </div>
    @endif
    @if (Auth::user()->jefeUtp())
        <div class="column center aligned">
            <a href="{{ route('ensayos.psu.index') }}">

                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class="check circle outline icon"></i>
                    <div class="content">
                    Registrar Ensayos PSU

                    <div class="sub header">Registrar y modificar los ensayos PSU</div>
                    </div>
                </h3>

            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('ensayos.simce.index') }}">

                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class="check circle icon"></i>
                    <div class="content">
                    Registrar Ensayos SIMCE

                    <div class="sub header">Registrar y modificar los ensayos SIMCE</div>
                    </div>
                </h3>

            </a>
        </div>
    @endif
    @if (Auth::user()->inspector())
        <div class="column center aligned">
            <a href="{{ route('asistencia.index_grafico') }}">

                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class="bar chart icon"></i>
                    <div class="content">
                    Grafico Asistencias

                    <div class="sub header">Ver gráfico de asistencias de los alumnos durante un periodo académico</div>
                    </div>
                </h3>

            </a>
        </div>
    @endif
    @if (Auth::user()->profesor())
        <div class="column center aligned">
            <a href="{{ route('academico.menu_notas') }}">

                <h3 class="ui icon grey header no-margin button_pulse">
                    <i class=" table icon"></i>
                    <div class="content">
                    Ingresar Calificaciones

                    <div class="sub header">Ingresar las notas de los alumnos por curso</div>
                    </div>
                </h3>

            </a>

        </div>
        <div class="column center aligned">
            <a href="{{ route('academico.menu_asistencia') }}">

                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class="calendar check outline icon"></i>
                    <div class="content">
                    Asistencia de Curso

                    <div class="sub header">Ingresar las asistencias de los alumnos por curso</div>
                    </div>
                </h3>

            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('academico.eva_comportamiento') }}">

                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class="file text icon"></i>
                    <div class="content">
                    Evaluar Comp. Alumno

                    <div class="sub header">Evaluar el comportamiento escolar de un alumno</div>
                    </div>
                </h3>

            </a>
        </div>
    @endif

</div>
	


@endsection
