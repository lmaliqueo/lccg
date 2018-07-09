@extends('admin.template.main')

@section('title', 'Asignaturas')

@section('content')
	
<h2 class="ui center aligned icon header text-navy2" >
  <i class="circular copy icon"></i>
  <span style="border-bottom: 5px solid #FCDD13;">
  Asignaturas
    
  </span>
</h2>
<br>
  <div class="ui four column centered grid" style="margin: 30px;">
    <div class="column center aligned">
                <a href="{{ route('asignaturas.create') }}">

      		        <h3 class="ui icon grey header no-margin button_pulse">
      		              <i class=" add icon"></i>
      		                <div class="content">
      		                  Crear Asignatura

      		                    <div class="sub header">Generar nueva asignatura para el plan académico</div>
      		                </div>
      		        </h3>

                </a>
    	
    </div>
    <div class="column center aligned">
                <a href="{{ route('asignaturas.admin') }}">

            <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                  <i class=" settings icon"></i>
                    <div class="content">
                      Administrar Asignaturas

                        <div class="sub header">Ver, modificar y borrar asignaturas</div>
                    </div>
            </h3>

            </a>
    </div>
    <div class="column center aligned">
                <a href="{{ route('plan_estudio.admin_planes') }}">

            <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                  <i class=" paste icon"></i>
                    <div class="content">
                      Administrar Plan de Estudio

                        <div class="sub header">Crear proyectos de construcción</div>
                    </div>
            </h3>

            </a>
    </div>
  </div>


@endsection
