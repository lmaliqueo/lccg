@extends('admin.template.main')

@section('title', 'Ver Sección')

@section('content')

								<div id="modaldiv" class="ui modal">
								    <i class="close icon"></i>
									<div class="header">
									</div>
								    <div class="content modalContent">
										<i class="large loading icon"></i>
								    </div>
									<div class="actions">
										<div class="ui negative button" data-value="Cancel" name="Cancel">
											No
										</div>
										<div class="ui positive right labeled icon button"  date-value="Success" onclick="successModal();" name="Success">
											Si
											<i class="checkmark icon"></i>
										</div>
									</div>
								</div>

<div class="margin-bottom">
	<div class="ui black ribbon label">
	<h2 class="ui huge header add icon text-white"> &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
	Sección {{ $seccion->numero }} - {{ $seccion->asignatura->nombre }} </h2>
	</div>
<hr class="style-two ">
</div>

<button class="ui positive button" id="modalButton">Modal</button>
	<table class="ui compact celled table">
		<thead>
			<tr>
				<th rowspan="2">N°</th>
				<th colspan="4">Alumnos</th>
				<th colspan="3">Calificaciones</th>
			</tr>
			<tr>
				<th>Nombre</th>
				<th>Apeliido Paterno</th>
				<th>Apellido Materno</th>
				<th>Carrera</th>

				<th>Asistencia</th>
				<th>Trabajos</th>
				<th>Evaluaciones</th>
			</tr>
		</thead>
	</table>

<script type="text/javascript">
	$(document).ready(function(){
	     $('#modalButton').click(function(){
	     		var id = {{ $seccion->id }};
                $.ajax({
                    url: 'asignar_alumno',
                    type: "post",
                    data: { id: id },
                    success: function(response) {
				        $('#modaldiv').modal('show')    
					     .find('.modalContent')
					     .load(response);

                    }
                })


	     });
	});

</script>

@endsection
