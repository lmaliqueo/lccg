@extends('admin.template.main')

@section('title', 'Cursos')

@section('content')




<h2 class="ui center aligned icon header text-navy2" >
    <i class="circular edit outline icon"></i>
    <span style="border-bottom: 5px solid #FCDD13;">
    Cursos
      
    </span>
</h2>
<br>

<div class="ui four column centered grid" style="margin: 30px;">

    @if (Auth::user()->administrador())
        <div class="column center aligned">
            <a href="{{ route('cursos.create') }}">
                <h3 class="ui icon grey header no-margin button_pulse">
                    <i class=" add icon"></i>
                    <div class="content">
                        Crear Curso
                        <div class="sub header">Crear nuevo curso para este periodo académico</div>
                    </div>
                </h3>
            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('cursos.admin') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" settings icon"></i>
                    <div class="content">
                        Administrar Cursos
                        <div class="sub header">Administrar cursos pertenecientes al actual periodo académico</div>
                    </div>
                </h3>

            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('curso.asignar_asignaturas') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" checkmark box icon"></i>
                    <div class="content">
                        Asignar Asignaturas
                        <div class="sub header">Asignar asignaturas y profesores a un curso</div>
                    </div>
                </h3>
            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('curso.horarios_asignaturas') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" calendar alternate outline icon"></i>
                    <div class="content">
                        Horarios Cursos
                        <div class="sub header">Mostrar y editar horarios de clases de un curso</div>
                    </div>
                </h3>
            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('curso.menu_list_al') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" list ol icon"></i>
                    <div class="content">
                        Editar Lista de Alumnos
                        <div class="sub header">Mostrar y editar horarios de clases de un curso</div>
                    </div>
                </h3>
            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('talleres.admin') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" cut icon"></i>
                    <div class="content">
                        Talleres
                        <div class="sub header">Administrar talleres habilitados durante este periodo</div>
                    </div>
                </h3>
            </a>
        </div>
    @endif
    @if (Auth::user()->jefeUtp())
        <div class="column center aligned">
            <a href="{{ route('curso.asignar_asignaturas') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" checkmark box icon"></i>
                    <div class="content">
                        Asignar Asignaturas
                        <div class="sub header">Asignar asignaturas y profesores a un curso</div>
                    </div>
                </h3>
            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('curso.horarios_asignaturas') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" calendar alternate outline icon"></i>
                    <div class="content">
                        Horarios Cursos
                        <div class="sub header">Mostrar y editar horarios de clases de un curso</div>
                    </div>
                </h3>
            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('curso.menu_list_al') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" list ol icon"></i>
                    <div class="content">
                        Editar Lista de Alumnos
                        <div class="sub header">Mostrar y editar horarios de clases de un curso</div>
                    </div>
                </h3>
            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('talleres.admin') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" cut icon"></i>
                    <div class="content">
                        Talleres
                        <div class="sub header">Administrar talleres habilitados durante este periodo</div>
                    </div>
                </h3>
            </a>
        </div>
    @endif
    @if (Auth::user()->inspector())
        <div class="column center aligned">
            <a href="{{ route('cursos.create') }}">
                <h3 class="ui icon grey header no-margin button_pulse">
                    <i class=" add icon"></i>
                    <div class="content">
                        Crear Curso
                        <div class="sub header">Crear nuevo curso para este periodo académico</div>
                    </div>
                </h3>
            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('cursos.admin') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" settings icon"></i>
                    <div class="content">
                        Administrar Cursos
                        <div class="sub header">Administrar cursos pertenecientes al actual periodo académico</div>
                    </div>
                </h3>

            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('curso.asignar_asignaturas') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" checkmark box icon"></i>
                    <div class="content">
                        Asignar Asignaturas
                        <div class="sub header">Asignar asignaturas y profesores a un curso</div>
                    </div>
                </h3>
            </a>
        </div>
    @endif
    @if (Auth::user()->profesor())
        <div class="column center aligned">
            <a href="{{ route('cursos.prof_jefe.curso') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" edit icon"></i>
                    <div class="content">
                        Ver Curso
                        <div class="sub header">Administrar talleres habilitados durante este periodo</div>
                    </div>
                </h3>
            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('cursos.prof_jefe.clases') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" copy outline icon"></i>
                    <div class="content">
                        Clases
                        <div class="sub header">Administrar talleres habilitados durante este periodo</div>
                    </div>
                </h3>
            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('talleres.admin') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" cut icon"></i>
                    <div class="content">
                        Talleres
                        <div class="sub header">Administrar talleres habilitados durante este periodo</div>
                    </div>
                </h3>
            </a>
        </div>
    @endif


</div>


@endsection
