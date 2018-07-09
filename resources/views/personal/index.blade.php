@extends('admin.template.main')

@section('title', 'Empleados')

@section('content')



<h2 class="ui center aligned icon header text-navy2" >
  <i class="circular users icon"></i>
  <span style="border-bottom: 5px solid #FCDD13;">
  Empleados
    
  </span>
</h2>
<br>
  <div class="ui three column centered grid" style="margin: 30px;">
    <div class="column center aligned">
                <a href="{{ route('empleados.create') }}">

      		        <h3 class="ui icon grey header no-margin button_pulse">
      		              <i class="user add icon"></i>
      		                <div class="content">
      		                  Ingresar Empleado

      		                    <div class="sub header">Generar nueva asignatura para el plan académico</div>
      		                </div>
      		        </h3>

                </a>
    	
    </div>
    <div class="column center aligned">
                <a href="{{ route('empleados.admin') }}">

            <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                  <i class=" settings icon"></i>
                    <div class="content">
                      Administrar Empleados

                        <div class="sub header">Ver, modificar y borrar asignaturas</div>
                    </div>
            </h3>

            </a>
    </div>
  </div>
	


@endsection
