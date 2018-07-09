@extends('admin.template.main')

@section('title', 'Matriculas')

@section('content')


<h2 class="ui center aligned icon header text-navy2" >
  <i class="circular open folder outline icon"></i>
  <span style="border-bottom: 5px solid #FCDD13;">
  Matrículas
    
  </span>
</h2>
<br>
<div class="ui four column centered grid" style="margin: 30px;">
    @if (Auth::user()->administrador())
        <div class="column center aligned">
            <a href="{{ route('matriculas.create') }}">

                <h3 class="ui icon grey header no-margin button_pulse">
                    <i class=" add icon"></i>
                    <div class="content">
                        Ingreso de Matrícula

                        <div class="sub header">Generar nueva asignatura para el plan académico</div>
                    </div>
                </h3>

            </a>
          
        </div>
        <div class="column center aligned">
            <a href="{{ route('matriculas.list') }}">

                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" list icon"></i>
                    <div class="content">
                        Lista de Alumnos

                        <div class="sub header">Lista de alumnos registrados en el periodo actual</div>
                    </div>
                </h3>

            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('matriculas.admin') }}">

                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" settings icon"></i>
                    <div class="content">
                        Administrar Matrículas

                        <div class="sub header">Ver, editar y eliminar matrículas registradas</div>
                    </div>
                </h3>

            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('matriculas.buscar') }}">

                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" search icon"></i>
                    <div class="content">
                        Buscar Alumno

                        <div class="sub header">Buscar y ver información académica del alumno</div>
                    </div>
                </h3>

            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('matriculas.menu_taller') }}">

                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" edit icon"></i>
                    <div class="content">
                        Inscribir Taller

                        <div class="sub header">Buscar e inscribir alumno en un taller</div>
                    </div>
                </h3>

            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('matriculas.menu_retiro') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" sign out icon"></i>
                    <div class="content">
                        Retirar Alumno
                        <div class="sub header">Buscar y retirar alumno</div>
                    </div>
                </h3>

            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('matriculas.admision') }}">

                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" student icon"></i>
                    <div class="content">
                        Admisión Alumnos

                        <div class="sub header">Asignar alumnos a un curso</div>
                    </div>
                </h3>

            </a>
        </div>
    @endif
    @if (Auth::user()->jefeUtp())
        <div class="column center aligned">
            <a href="{{ route('matriculas.create') }}">

                <h3 class="ui icon grey header no-margin button_pulse">
                    <i class=" add icon"></i>
                    <div class="content">
                        Ingreso de Matrícula

                        <div class="sub header">Registrar una nueva matrícula al sistema</div>
                    </div>
                </h3>

            </a>
          
        </div>
        <div class="column center aligned">
            <a href="{{ route('matriculas.list') }}">

                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" list icon"></i>
                    <div class="content">
                        Lista de Alumnos

                        <div class="sub header">Lista de alumnos registrados en el periodo actual</div>
                    </div>
                </h3>

            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('matriculas.admin') }}">

                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" settings icon"></i>
                    <div class="content">
                        Administrar Matrículas

                        <div class="sub header">>Ver, editar y eliminar matrículas registradas</div>
                    </div>
                </h3>

            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('matriculas.menu_taller') }}">

                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" edit icon"></i>
                    <div class="content">
                        Inscribir Taller

                        <div class="sub header">Buscar e inscribir alumno en un taller</div>
                    </div>
                </h3>

            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('matriculas.admision') }}">

                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" student icon"></i>
                    <div class="content">
                        Admisión Alumnos

                        <div class="sub header">Asignar alumnos a un curso</div>
                    </div>
                </h3>

            </a>
        </div>
    @endif
    @if (Auth::user()->inspector())
        <div class="column center aligned">
            <a href="{{ route('matriculas.list') }}">

                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" list icon"></i>
                    <div class="content">
                        Lista de Alumnos
                        <div class="sub header">Lista de alumnos registrados en el periodo actual</div>
                    </div>
                </h3>

            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('matriculas.buscar') }}">

                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" search icon"></i>
                    <div class="content">
                        Buscar Alumno

                        <div class="sub header">Buscar y ver información académica del alumno</div>
                    </div>
                </h3>

            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('matriculas.menu_retiro') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" sign out icon"></i>
                    <div class="content">
                        Retirar Alumno
                        <div class="sub header">Buscar y retirar alumno</div>
                    </div>
                </h3>

            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('matriculas.admision') }}">

                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" student icon"></i>
                    <div class="content">
                        Admisión Alumnos

                        <div class="sub header">Asignar alumnos a un curso</div>
                    </div>
                </h3>

            </a>
        </div>
    @endif
    @if (Auth::user()->secretaria())
        <div class="column center aligned">
            <a href="{{ route('matriculas.buscar') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" search icon"></i>
                    <div class="content">
                        Buscar Alumno
                        <div class="sub header">Buscar y ver información académica del alumno</div>
                    </div>
                </h3>
            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('matriculas.menu_retiro') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" sign out icon"></i>
                    <div class="content">
                        Retirar Alumno
                        <div class="sub header">Buscar y retirar alumno</div>
                    </div>
                </h3>

            </a>
        </div>
    @endif
    @if (Auth::user()->director())
        <div class="column center aligned">
            <a href="{{ route('matriculas.list') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" list icon"></i>
                    <div class="content">
                        Lista de Alumnos
                        <div class="sub header">Lista de alumnos registrados en el periodo actual</div>
                    </div>
                </h3>
            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('matriculas.buscar') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" search icon"></i>
                    <div class="content">
                        Buscar Alumno
                        <div class="sub header">Buscar y ver información académica del alumno</div>
                    </div>
                </h3>

            </a>
        </div>
    @endif
</div>
	


@endsection
