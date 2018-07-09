@extends('admin.template.main')

@section('title', 'Profesores')

@section('content')


<h2 class="ui center aligned icon header text-navy2" >
	<i class="circular male icon"></i>
	<span style="border-bottom: 5px solid #FCDD13;">
		Profesores

	</span>
</h2>
<br>


  <div class="ui four column centered grid" style="margin: 30px;">
    <div class="column center aligned">
                <a href="{{ route('profesores.create') }}">

      		        <h3 class="ui icon grey header no-margin button_pulse">
      		              <i class=" add icon"></i>
      		                <div class="content">
      		                  	Ingresar Profesor

      		                    <div class="sub header">Crear nuevo curso para este periodo académico</div>
      		                </div>
      		        </h3>

                </a>
    	
    </div>
    <div class="column center aligned">
                <a href="{{ route('profesores.admin') }}">

            <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                  <i class=" settings icon"></i>
                    <div class="content">
                      	Administrar Profesores

                        <div class="sub header">Administrar cursos pertenecientes al actual periodo académico</div>
                    </div>
            </h3>

            </a>
    </div>
  </div>



@endsection
