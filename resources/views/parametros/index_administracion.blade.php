@extends('admin.template.main')

@section('title', 'Administracion')

@section('content')


<h2 class="ui center aligned icon header text-navy2" >
    <i class="circular settings icon"></i>
    <span style="border-bottom: 5px solid #FCDD13;">
    Administracion
      
    </span>
</h2>
<br>
<div class="ui four column centered grid" style="margin: 30px;">
    @if (Auth::user()->administrador())
        <div class="column center aligned">
            <a href="{{ route('parametros.admin.aulas') }}">
                <h3 class="ui icon grey header no-margin button_pulse">
                    <i class=" building outline icon"></i>
                        <div class="content">
                        Aulas
                        <div class="sub header">Administrar aulas del establecimiento</div>
                    </div>
                </h3>
            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('parametros.admin.periodos') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" alternate calendar icon"></i>
                    <div class="content">
                        Periodo Académico
                        <div class="sub header">Ver, crear y modificar los periodos académicos</div>
                    </div>
                </h3>
            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('parametros.admin.horas') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" clock outline icon"></i>
                    <div class="content">
                        Horas
                        <div class="sub header">Igresar horas para el calendario académico</div>
                    </div>
                </h3>
            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('parametros.view.liceo') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" university icon"></i>
                    <div class="content">
                        Liceo
                        <div class="sub header">Ver y modificar los datos del liceo</div>
                    </div>
                </h3>
            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('parametros.view.pauta_comportamiento') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" file outline icon"></i>
                    <div class="content">
                        Pauta Comportamiento
                        <div class="sub header">Modificar pauta de comportamiento</div>
                    </div>
                </h3>
            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('parametros.admin.ensayo') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" pencil icon"></i>
                    <div class="content">
                        Ensayos
                        <div class="sub header">Administrar ensayos</div>
                    </div>
                </h3>
            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('asignaturas.admin') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" copy outline icon"></i>
                    <div class="content">
                        Asignaturas
                        <div class="sub header">Crear y modificar asignaturas</div>
                    </div>
                </h3>
            </a>
        </div>

        <div class="column center aligned">
            <a href="{{ route('plan_estudio.admin_planes') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" clipboard outline icon"></i>
                    <div class="content">
                        Plan de Estudio
                        <div class="sub header">Crear y modificar plan de estudio</div>
                    </div>
                </h3>
            </a>
        </div>

        <div class="column center aligned">
            <a href="{{ route('empleados.admin') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" users icon"></i>
                    <div class="content">
                        Empleados
                        <div class="sub header">Ver, modificar y borrar empleados registrados</div>
                    </div>
                </h3>
            </a>
        </div>

        <div class="column center aligned">
            <a href="{{ route('usuarios.admin') }}">
                <h3 class="ui icon grey header no-margin button_pulse">
                    <i class=" user circle icon"></i>
                    <div class="content">
                        Usuarios
                        <div class="sub header">Ver, modificar y borrar usuarios registrados</div>
                    </div>
                </h3>
            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('profesores.admin') }}">
                <h3 class="ui icon grey header no-margin button_pulse">
                    <i class=" male icon"></i>
                    <div class="content">
                        Profesores
                        <div class="sub header">Ver, modificar y eliminar profesores registrados</div>
                    </div>
                </h3>
            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('proveedores.index') }}">
                <h3 class="ui icon grey header no-margin button_pulse">
                    <i class=" shipping icon"></i>
                    <div class="content">
                        Proveedores
                        <div class="sub header">Administrar proveedores registrados en la base de datos</div>
                    </div>
                </h3>
            </a>
        </div>
    @endif
    @if (Auth::user()->jefeUtp())
        <div class="column center aligned">
            <a href="{{ route('parametros.admin.horas') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" clock outline icon"></i>
                    <div class="content">
                        Horas
                        <div class="sub header">Igresar horas para el calendario académico</div>
                    </div>
                </h3>
            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('parametros.admin.ensayo') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" pencil icon"></i>
                    <div class="content">
                        Ensayos
                        <div class="sub header">Administrar ensayos</div>
                    </div>
                </h3>
            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('asignaturas.admin') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" copy outline icon"></i>
                    <div class="content">
                        Asignaturas
                        <div class="sub header">Administrar asignaturas</div>
                    </div>
                </h3>
            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('plan_estudio.admin_planes') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" clipboard outline icon"></i>
                    <div class="content">
                        Plan de Estudio
                        <div class="sub header">Crear y modificar plan de estudio</div>
                    </div>
                </h3>
            </a>
        </div>
    @endif
    @if (Auth::user()->inspector())
        <div class="column center aligned">
            <a href="{{ route('profesores.admin') }}">
                <h3 class="ui icon grey header no-margin button_pulse">
                    <i class=" male icon"></i>
                    <div class="content">
                        Profesores
                        <div class="sub header">Ver, modificar y eliminar profesores registrados</div>
                    </div>
                </h3>
            </a>
        </div>
    @endif
    @if (Auth::user()->director())
        <div class="column center aligned">
            <a href="{{ route('parametros.admin.periodos') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" alternate calendar icon"></i>
                    <div class="content">
                        Periodo Académico
                        <div class="sub header">Lista de alumnos registrados en el periodo actual</div>
                    </div>
                </h3>
            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('parametros.view.liceo') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" university icon"></i>
                    <div class="content">
                        Liceo
                        <div class="sub header">Buscar y ver información académica del alumno</div>
                    </div>
                </h3>
            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('empleados.admin') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" users icon"></i>
                    <div class="content">
                        Empleados
                        <div class="sub header">Ver, modificar y borrar empleados registrados</div>
                    </div>
                </h3>
            </a>
        </div>

        <div class="column center aligned">
            <a href="{{ route('proveedores.index') }}">
                <h3 class="ui icon grey header no-margin button_pulse">
                    <i class=" shipping icon"></i>
                    <div class="content">
                        Proveedores
                        <div class="sub header">Administrar proveedores registrados en la base de datos</div>
                    </div>
                </h3>
            </a>
        </div>
    @endif



</div>



    {{-- 
    <div class="column center aligned">
                <a href="{{ route('parametros.admin.cursos') }}">

            <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                  <i class=" edit icon"></i>
                    <div class="content">
                      Parametros Cursos

                        <div class="sub header">Lista de alumnos registrados en el periodo actual</div>
                    </div>
            </h3>

            </a>
    </div>
     --}}

{{--     <div class="column center aligned">
                <a href="{{ route('parametros.admin.conceptos') }}">

            <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                  <i class=" legal icon"></i>
                    <div class="content">
                      Conceptos

                        <div class="sub header">Administrar conceptos</div>
                    </div>
            </h3>

            </a>
    </div>
 --}}



	


@endsection
