@extends('admin.template.main')

@section('title', 'Parametros')

@section('content')


<h2 class="ui center aligned icon header text-navy2" >
  <i class="circular options icon"></i>
  <span style="border-bottom: 5px solid #FCDD13;">
  Parametros
    
  </span>
</h2>
<br>
  <div class="ui four column centered grid" style="margin: 30px;">
    <div class="column center aligned">
                <a href="{{ route('parametros.admin.aulas') }}">

      		        <h3 class="ui icon grey header no-margin button_pulse">
      		              <i class=" building outline icon"></i>
      		                <div class="content">
      		                  Aulas

      		                    <div class="sub header">Generar nueva asignatura para el plan académico</div>
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

                        <div class="sub header">Lista de alumnos registrados en el periodo actual</div>
                    </div>
            </h3>

            </a>
    </div>
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
  </div>
	
    <div class="column center aligned">
                <a href="{{ route('usuarios.admin') }}">

                  <h3 class="ui icon grey header no-margin button_pulse">
                        <i class=" user outline icon"></i>
                          <div class="content">
                            Crear Unusario

                              <div class="sub header">Registrar nuevo usuario a la base de datos</div>
                          </div>
                  </h3>

                </a>
      
    </div>


@endsection
