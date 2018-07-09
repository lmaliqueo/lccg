@extends('admin.template.main')

@section('title', 'Talleres')

@section('content')


<h2 class="ui center aligned icon header text-navy2" >
  <i class="circular cut icon"></i>
  <span style="border-bottom: 5px solid #FCDD13;">
  Talleres
    
  </span>
</h2>
<br>
  <div class="ui four column centered grid" style="margin: 30px;">
    <div class="column center aligned">
                <a href="{{ route('talleres.create') }}">

      		        <h3 class="ui icon grey header no-margin button_pulse">
      		              <i class=" add icon"></i>
      		                <div class="content">
      		                  Crear Taller

      		                    <div class="sub header">Registrar nuevo taller para la base de datos</div>
      		                </div>
      		        </h3>

                </a>
    	
    </div>
    <div class="column center aligned">
                <a href="{{ route('talleres.admin') }}">

            <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                  <i class=" settings icon"></i>
                    <div class="content">
                      Administrar Talleres

                        <div class="sub header">Administrar talleres habilitados durante este periodo</div>
                    </div>
            </h3>

            </a>
    </div>
    <div class="column center aligned">
                <a href="{{ route('talleres.lista_alumnos') }}">

            <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                  <i class=" list icon"></i>
                    <div class="content">
                      Lista Alumnos

                        <div class="sub header">Lista de alumnos inscritos en un taller</div>
                    </div>
            </h3>

            </a>
    </div>
  </div>
	


@endsection
