@extends('admin.template.main')

@section('title', 'Usuarios')

@section('content')


<h2 class="ui center aligned icon header text-navy2" >
  <i class="circular user outline icon"></i>
  <span style="border-bottom: 5px solid #FCDD13;">
  Usuarios
    
  </span>
</h2>
<br>
  <div class="ui four column centered grid" style="margin: 30px;">
    <div class="column center aligned">
                <a href="{{ route('usuarios.create') }}">

      		        <h3 class="ui icon grey header no-margin button_pulse">
      		              <i class=" add icon"></i>
      		                <div class="content">
      		                  Crear Unusario

      		                    <div class="sub header">Registrar nuevo usuario a la base de datos</div>
      		                </div>
      		        </h3>

                </a>
    	
    </div>
    <div class="column center aligned">
                <a href="{{ route('usuarios.admin') }}">

            <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                  <i class=" settings icon"></i>
                    <div class="content">
                      Administrar Usuarios

                        <div class="sub header">Administrar usuarios registrados en el sistema</div>
                    </div>
            </h3>

            </a>
    </div>
  </div>
	
@endsection
