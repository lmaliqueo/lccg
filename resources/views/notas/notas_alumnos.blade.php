

{{-- 
<div class="ui styled fluid accordion margin-bottom">
		  <div class="title">
		    <i class="dropdown icon"></i>
		    Busqueda avanzada
		  </div>
		  <div class="content">
		<p class="text-center">
			<a id="editar_notas" class="ui circular button icon labeled blue buscar_button buscar_horarios"><i class="pencil icon"></i> Editar</a>
			<a id="subir_notas" class="ui circular button icon labeled teal buscar_button buscar_horarios disabled"><i class="upload icon"></i> Guardar</a>
			<a class="ui circular button icon disabled negative cancelar_button labeled"><i class="remove icon"></i> Cancelar</a>
		</p>
		  </div>
		</div>
 --}}
<div class="segment ui raised secondary">
{{-- 	<div class="ui inverted ribbon label large blue">
		    		<i class="icon copy"></i> {{ $clase->asignatura->asig_nombre }}
		    	</div>
		     --}}		    
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon info"></i>
        Información
        {{-- $clase->asignatura->asig_nombre --}}
    </h4>
		     		
	<a class="ui red right corner label remove_clase">
		<i class="remove icon"></i>
	</a>
		     		
	<input type="hidden" name="clases_id" value="{{ $clase->cla_id }}">
	<table class="table ui small compact">
		<thead>
			<tr>
				<th style="width: 20%">Curso</th>
				<td style="width: 30%">{{ $clase->curso->nombreCurso() }}</td>
				<th style="width: 20%">Profesor Jefe</th>
				<td style="width: 30%">{{ $clase->curso->profesorJefe->persona->nombreCompleto() }}</td>
			</tr>
			<tr>
				<th>Periodo</th>
				<td>{{ $clase->curso->periodo->pac_ano }}</td>
				<th>Semestre</th>
				<td>{{ $semestre->sem_numero }}</td>
			</tr>
			<tr>
				<th>Asignatura</th>
				<td>{{ $clase->asignatura->asig_nombre }}</td>
				<th>Profesor</th>
				<td>{{ $clase->profesor->persona->nombreCompleto() }}</td>
				<td style="display: none;" id="clases_id">{{ $clase->cla_id }}</td>
			</tr>
		</thead>
	</table>	
</div>
<div class="ui raised secondary segment animated fadeIn">
    <h4 class="ui horizontal divider header no-margin text-navy2">
        <i class="icon table"></i>
        Notas
        {{-- $clase->asignatura->asig_nombre --}}
    </h4>

@if ((Auth::user()->administrador() && ($semestre->periodo->pac_estado == 1)) || (($semestre->sem_estado == 1) && Auth::user()->profesor() && (Auth::user()->persona_rut == $clase->profesor->persona_rut)))
	<div class="text-right">
			<a id="editar_notas" class="ui circular button small icon labeled blue"><i class="pencil icon"></i> Editar</a>
			<a id="subir_notas" class="ui circular button small icon labeled teal disabled" style="display: none;"><i class="upload icon"></i> Guardar</a>
			<a class="ui circular button small icon disabled negative cancelar_button labeled" style="display: none;"><i class="remove icon"></i> Cancelar</a>
	</div>

@endif
		<table id="notasTable" class="ui table celled selected animated fadeIn structured">
			<thead>
				<tr>
					<th rowspan="2">N°</th>
					<th rowspan="2">RUN</th>
					<th rowspan="2">Nombre</th>
					<th class="collapsing center aligned" colspan="14">Notas</th>
					
				</tr>
				<tr>
					<th>N1</th>
					<th>N2</th>
					<th>N3</th>
					<th>N4</th>
					<th>N5</th>
					<th>N6</th>
					<th>N7</th>
					<th>N8</th>
					<th>N9</th>
					<th>N10</th>
					<th>N11</th>
					<th>N12</th>
					<th class="warning collapsing">Promedio</th>
				</tr>
			</thead>
			<tbody>
				@php
					if($clase->asignatura_id == $religion->asig_id){
						$lista_al = $clase->curso->listaAlumnos()->where('mat_clases_religion', 1)->orderBy('mat_posicion_lista', 'ASC')->get();
					}else{
						$lista_al = $clase->curso->listaAlumnos()->orderBy('mat_posicion_lista', 'ASC')->get();
					}
				@endphp
				@foreach ($lista_al as $alumno)
					@if ($alumno->mat_estado == 3)
						<tr class="disabled negative">
					@else
						<tr>
					@endif
						<td id="mat_id" style="display:none;">{{ $alumno->mat_id }}</td>
						<td data-editable="false" class="collapsing">
							{{ $alumno->mat_posicion_lista }}
						</td>
						<td data-editable="false">{{ $alumno->alumno_rut }}</td>
						<td data-editable="false">{{ $alumno->alumno->nombreCompleto() }}</td>
						@php
							$notas_flag= null;
						@endphp
						@foreach ($alumno->notas->where('semestre_id', $semestre->sem_id) as $notas)
							@if ($notas->clase_id == $clase->cla_id)
								@php
									$notas_flag = $notas;
								@endphp
								@break
							@endif
						@endforeach
						@if ($notas_flag != null)
							<td id="notas_id" data-alu="{{ $alumno->mat_id }}" style="display:none;">{{ $notas_flag->not_id }}</td>
							<td tabindex="1" class="editable-o center aligned {{ $notas->tdColorNota($notas_flag->not_nota1) }}">{{ (strlen($notas_flag->not_nota1) == 1) ? $notas_flag->not_nota1.'.0': $notas_flag->not_nota1 }}</td>
							<td tabindex="1" class="editable-o center aligned {{ $notas->tdColorNota($notas_flag->not_nota2) }}">{{ (strlen($notas_flag->not_nota2) == 1) ? $notas_flag->not_nota2.'.0': $notas_flag->not_nota2 }}</td>
							<td tabindex="1" class="editable-o center aligned {{ $notas->tdColorNota($notas_flag->not_nota3) }}">{{ (strlen($notas_flag->not_nota3) == 1) ? $notas_flag->not_nota3.'.0': $notas_flag->not_nota3 }}</td>
							<td tabindex="1" class="editable-o center aligned {{ $notas->tdColorNota($notas_flag->not_nota4) }}">{{ (strlen($notas_flag->not_nota4) == 1) ? $notas_flag->not_nota4.'.0': $notas_flag->not_nota4 }}</td>
							<td tabindex="1" class="editable-o center aligned {{ $notas->tdColorNota($notas_flag->not_nota5) }}">{{ (strlen($notas_flag->not_nota5) == 1) ? $notas_flag->not_nota5.'.0': $notas_flag->not_nota5 }}</td>
							<td tabindex="1" class="editable-o center aligned {{ $notas->tdColorNota($notas_flag->not_nota6) }}">{{ (strlen($notas_flag->not_nota6) == 1) ? $notas_flag->not_nota6.'.0': $notas_flag->not_nota6 }}</td>
							<td tabindex="1" class="editable-o center aligned {{ $notas->tdColorNota($notas_flag->not_nota7) }}">{{ (strlen($notas_flag->not_nota7) == 1) ? $notas_flag->not_nota7.'.0': $notas_flag->not_nota7 }}</td>
							<td tabindex="1" class="editable-o center aligned {{ $notas->tdColorNota($notas_flag->not_nota8) }}">{{ (strlen($notas_flag->not_nota8) == 1) ? $notas_flag->not_nota8.'.0': $notas_flag->not_nota8 }}</td>
							<td tabindex="1" class="editable-o center aligned {{ $notas->tdColorNota($notas_flag->not_nota9) }}">{{ (strlen($notas_flag->not_nota9) == 1) ? $notas_flag->not_nota9.'.0': $notas_flag->not_nota9 }}</td>
							<td tabindex="1" class="editable-o center aligned {{ $notas->tdColorNota($notas_flag->not_nota10) }}">{{ (strlen($notas_flag->not_nota10) == 1) ? $notas_flag->not_nota10.'.0': $notas_flag->not_nota10 }}</td>
							<td tabindex="1" class="editable-o center aligned {{ $notas->tdColorNota($notas_flag->not_nota11) }}">{{ (strlen($notas_flag->not_nota11) == 1) ? $notas_flag->not_nota11.'.0': $notas_flag->not_nota11 }}</td>
							<td tabindex="1" class="editable-o center aligned {{ $notas->tdColorNota($notas_flag->not_nota12) }}">{{ (strlen($notas_flag->not_nota12) == 1) ? $notas_flag->not_nota12.'.0': $notas_flag->not_nota12 }}</td>
							<td data-editable="false" class="edit_prom  warning center aligned">
								@if ($notas_flag->not_promedio != null)
									{{ (strlen($notas_flag->not_promedio) == 1) ? $notas_flag->not_promedio.'.0': $notas_flag->not_promedio }}
								@endif
							</td>
						@else
							<td id="notas_id" data-alu="{{ $alumno->mat_id }}" style="display:none;"></td>
							@for ($i = 0; $i < 12; $i++)
								<td tabindex="1" class="editable-o center aligned"></td>
							@endfor
							<td data-editable="false" class="edit_prom warning center aligned"></td>
						@endif
						
					</tr>
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					@php
						$alu_ret= $clase->curso->listaAlumnos->where('mat_estado', 3)->pluck('mat_id');
					@endphp
					<th colspan="15" class="right aligned"><strong>Promedio Asignatura</strong></th>
					<th class="center aligned prom_asig">{{ $clase->prom_clases_sem($semestre->sem_id) }}</th>
				</tr>
			</tfoot>
		</table>

	
</div>

<script type="text/javascript">


   	$('table').stickyTableHeaders();
	$('#notasTable').numericInputExample().find('td:first').next().next().focus();


	$('.editable-o').on('change', function(){
		var nota = parseFloat($(this).text());
		if(nota < 4.0){
			$(this).addClass('negative').removeClass('positive');
		}else{
			if(nota >= 4.0){
				$(this).addClass('positive').removeClass('negative');
			}else{
				$(this).removeClass('positive negative');
			}
		}
	})

	$('#editar_notas').on('click', function(){


    	swal({
    		title: "¿Esta seguro de modificar las notas?",
            text: "ingrese su clave de usuario",
    		type: "input",
    		inputType: "password",
    		showCancelButton: true,
    		closeOnConfirm: false,
    		animation: "slide-from-top",
            inputPlaceholder: "Contraseña",
    	},
    	function(inputValue){
    		$.ajax({
    			url: "{{ route('ajax.confirm_user') }}",
    			type: "POST",
    			dataType:"JSON",
    			data: {_token:$('meta[name="csrf-token"]').attr('content') ,pass:inputValue},
    			success: function(response){
    				if(!response){
    					swal.showInputError("Ingrese datos nuevamente");
    					return false;
    				}
    				if( response == 2){
    					swal.showInputError("usted no tiene permisos para editar este usuario");
    					return false;
    				}
					$('#editar_notas').hide();
					$('#subir_notas').removeClass('disabled').show();
					$('.cancelar_button').removeClass('disabled').show();
					$('.button_clase').addClass('disabled')
					$(this).addClass('disabled')
					$('#notasTable').editableTableWidget();
					$('#notasTable').numericInputExample().find('td:first').next().next().focus();
                    swal({
                        title: "Correcto!",
                        timer: 1000,
                        type: "success",
                        showConfirmButton:false,
                    });
    			}
    		})
    	})

	})

	$('.editable-o').on('change', function(){

		var prom = 0;
		var cant = 0;

		$(this).parent('tr').children('td').each(function(index, value){
			if(index > 4 && index <= 16){
				var int = $(value).text();
				if(int != ''){
					prom += parseFloat(int);
					cant++;
				}

			}
			if(index == 17){
				if(prom > 0){
					prom = prom/cant;
					$(value).html(prom.toFixed(1));
				}else{
					$(value).html('');

				}
			}
		})

		var i = 0;
		var prom_tot = 0;
		$.each($('.edit_prom'), function(index, value){
			var prom = parseFloat($(value).text());
			if(prom >= 1){
				prom_tot += prom;
				i++;
			}
		})
		if(i == 0){
			$('.prom_asig').text('')
		}else{
			var prom_asig = prom_tot/i;
			prom_asig = prom_asig.toFixed(1);
			$('.prom_asig').text(prom_asig)
		}
			        //console.log(prom.toFixed(2));

			var notas = [];


{{-- 
					var cant_notas = 0;
		
					var sum_notas = 0;
		
					if((cells.item(j).text) >= 1 && (cells.item(j).text <= 7)){
						cant_notas++;
						sum_notas+=cells.item(j).text;
					}		  	
		            prom = sum_notas/cant_notas;
		 --}}		
	})


	$("#subir_notas").on('click',function(){

		var semestre = $('#semestre').val();
		var clase = $('input[name="clases_id"]').val();
		var tabla = document.getElementById('notasTable');
		var rowLength = tabla.rows.length-1;
		var curso_notas = [];
		var token = $('meta[name="csrf-token"]').attr('content');

		for(var i = 2; i <= rowLength; i++ ){ // si se activa el stickyHeader Cambiar i=2, por que se agrega un header adicional (normal i = 1)
			
			var prom = 0;
			var alumno = [];
			var notas = [];
			var cells = tabla.rows.item(i).cells;
			var numero_cells = cells.length;
			for(var j = 0; j < numero_cells-1; j++){// numero_cells-1 para no contar al promedio
				if( j == 0){  // posicion 0 esta escondida y  es la id de las notas 
					alumno.push(cells.item(j).innerHTML); //  se guarda la id_notas del alumno
				}else if( j > 3 ){ // posicion 1 = nombre del alumno
					notas.push(cells.item(j).innerHTML); // se crea un array de notas 
				}

            }

           	prom = cells.item(j).innerHTML; // j es la ultima posicion de la tabla, que el for se salta por ser el promedio.
           	//console.log(prom);
			
			alumno.push(notas); //  se guardan las notas del alumno en la posicion 1 alumno[id_notas,notas,prom]
           	alumno.push(prom); // promedio del alumno.
			curso_notas.push(alumno); //  se agrega el alumno  al curso
		}
		$.ajax({
			url: '{{ route('academico.guardar_notas') }}',
			type: 'POST',
			data: {_token:token, curso_notas: curso_notas, clase:clase, semestre:semestre },
			success: function(response){

				$.each(response, function(index, value){
			        //console.log(value.mat+'--'+value.id);
					$('td[data-alu="'+value.mat+'"]').text(value.id);
				})


				$("#subir_notas").addClass('disabled').hide();
				$('#editar_notas').removeClass('disabled').show();
				$('.cancelar_button').addClass('disabled').hide();
				swal({   
                    title: "Guardado!",     
                    timer: 1000,
                    type: "success",   
                    showConfirmButton: false 
                });
			    $.ajax({
			        url: '{{ route('academico.mostrar_notas') }}',
			        type: 'post',
			        //dataType: "JSON",
			        data: {_token:token, clase:clase, semestre:semestre/*, nivel:nivel, letra:letra*/ },
			        success: function(response) {
			        	$('#content_notas').html(response);
			        }
			    });
			}
		})
	})

	$('.cancelar_button').on('click', function(){
		$(this).addClass('disabled').hide();
		$('#editar_notas').removeClass('disabled').show();
		$('#subir_notas').addClass('disabled').hide();
		$('.button_clase').removeClass('disabled');
			var clase = $('input[name="clases_id"]').val();

			var token = $('meta[name="csrf-token"]').attr('content');
			var semestre = $('#semestre').val();

		    $.ajax({
		        url: '{{ route('academico.mostrar_notas') }}',
		        type: 'post',
		        //dataType: "JSON",
		        data: {_token:token, clase:clase, semestre:semestre/*, nivel:nivel, letra:letra*/ },
		        success: function(response) {
		        	$('#content_notas').html(response);
		        }
		    });
	})

	$('.remove_clase').on('click', function(){
		$('#content_notas').hide();
    	$('#content_clases').show();
		$('.button_clase').removeClass('disabled');
    	$('#content_inputs').show();
	})


</script>
