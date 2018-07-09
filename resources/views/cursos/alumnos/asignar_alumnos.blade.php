@extends('admin.template.main')

@section('title', 'Asginar Alumnos')

@section('content')



	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="edit icon"></i>
					<i class="corner yellow student icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
		        Asginar Alumnos
			</span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('cursos.admin') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>
<br>

			<p>
				<div class="ui grid two column">
					<div class="column">
						<table class="ui table celled small">
							<thead>
								<tr>
									<th>Curso</th>
									<td>{{ $curso->nombreCurso() }}</td>
								</tr>
								<tr>
									<th>Profesor Jefe</th>
									<td>{{ $curso->profesor_id }}</td>
								</tr>
								<tr>
									<th>Periodo</th>
									<td>{{ $curso->periodo->pac_ano }}</td>
								</tr>
								<tr>
									<th>Aula</th>
									<td>{{ $curso->aula->aul_numero }}</td>
								</tr>
								
							</thead>
						</table>
					</div>
				</div>
				
			</p>

			{!! Form::open(['route' => 'curso.asigna_alu_store', 'method'=>'POST', 'class'=>'ui form']) !!}

				{!! Form::hidden('curso_id', $curso->cu_id, ['class'=>'']) !!}

				<div class="text-center">
					{!! Form::submit('Asignar', ['class'=>'ui button teal disabled', 'cont'=>0, 'id'=>'subm_buttom']) !!}
				</div>

			<table class="ui table selected small celled selected">
				<thead>
					<tr>
						<th></th>
						<th>N° Matricula</th>
						<th>Rut</th>
						<th>Nombre</th>
						<th>Género</th>
						<th>Promedio</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($alumnos as $count => $matricula)
						@if ($matricula->cursos != '[]')
							{{-- expr --}}
							<tr class="disabled">
								<td  class="collapsing">
									<div class="ui toggle checkbox disabled">
											<input type="checkbox" checked>
											<label></label>
									</div>
								</td>
								<td>{{ $matricula->mat_numero }}</td>
								<td>{{ $matricula->alumno_rut }}</td>
								<td>{{ $matricula->alumno->nombreCompleto() }}</td>
								<td>{{ $matricula->alumno->al_sexo }}</td>
								<td>{{ $matricula->mat_prom_ingreso }}</td>
								<td><i class="check green icon large"></i></td>
							</tr>
						@else
							<tr id="{{ $matricula->mat_id }}">
								<td  class="collapsing">
									<div class="ui toggle checkbox">
											<input type="checkbox" name="mat_id[{{ $count }}]" value="{{ $matricula->mat_id }}" valueicon="{{ $count }}" class="checkbox_alu" estado="0">
											<label></label>
									</div>
								</td>
								<td>{{ $matricula->mat_numero }}</td>
								<td>{{ $matricula->alumno_rut }}</td>
								<td>{{ $matricula->alumno->nombreCompleto() }}</td>
								<td>{{ $matricula->alumno->al_sexo }}</td>
								<td>{{ $matricula->mat_prom_ingreso }}</td>
								<td class="collapsing {{ $count }}">
									<i class="circle icon large blue"></i>
								</td>
							</tr>
						@endif
					@endforeach
				</tbody>
			</table>





			{!! Form::close() !!}



<script type="text/javascript">
	$('.checkbox_alu').on('click', function(){
		var icon = $(this).attr('valueicon');
		var tr = $(this).val();
		var estado = $(this).attr('estado');
		var cont = $('#subm_buttom').attr('cont');
		if(estado == 0){
			estado++;
			cont++;
			tupla = document.getElementById(tr);
			$(tupla).addClass('positive');
			icono = document.getElementsByClassName(icon);
			$(icono).html('<i class="check icon large green"></i>');
			$(this).attr('estado', estado);
			if(cont == 1){
				$('#subm_buttom').removeClass('disabled');
				$('#subm_buttom').attr('cont', cont);
			}
		}else{
			estado--;
			cont--;
			tupla = document.getElementById(tr);
			$(tupla).removeClass('positive');
			icono = document.getElementsByClassName(icon);
			$(icono).html('<i class="circle icon large blue"></i>');

			if(cont == 0){
				$('#subm_buttom').addClass('disabled');
				$('#subm_buttom').attr('cont', cont);
			}

			$(this).attr('estado', estado);
		}
	})
</script>


@endsection
