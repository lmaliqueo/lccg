    <h4 class="ui horizontal divider header text-navy2">
        <i class="checkmark box icon"></i>
        Admisión | {{ $curso->nombreCurso() }}
    </h4>


<div class="text-center margin-bottom">
	<div class="ui menu compact">
	    <a class="item text-navy2 active" data-tab="admision"><i class="checkmark box icon"></i> Admision</a>
	    <a class="item text-navy2" data-tab="lista_alumnos">
	    	<i class="list icon"></i> Lista Alumnos {{ $curso->nombreCurso() }}
    	    <div class="floating ui blue label label_num_al">{{ $curso->listaAlumnos->count() }}</div>
	    </a>
	</div>
  
</div>

<div class="ui bottom attached tab active animated fadeIn margin-bottom small" data-tab="admision">
	<table class="table ui celled selectable ">
		<thead>
			<tr>
				<th></th>
				<th>N° Matricula</th>
				<th>Nombre Completo</th>
				<th>Cedula de Identidad</th>
				<th>Telefono</th>
				<th>Condición Prioritaria</th>
				<th class="center aligned">Promedio Ingreso</th>
				<th>Escuela</th>
			</tr>
		</thead>
		<tbody>
			@if ($alumnos == '[]')
				<tr>
					<td class="negative center aligned" colspan="9"><em>No hay alumnos para el proceso de admisión</em></td>
					
				</tr>
			@else
				@foreach ($alumnos as $alumno)
					<tr id="tr_{{ $alumno->mat_id }}" class="tr_adm">
						<td  class="collapsing">
							<div class="ui toggle checkbox">
									<input type="checkbox" name="matricula[{{ $alumno->mat_id }}][mat_id]" value="{{ $alumno->mat_id }}" valueicon="{{ $alumno->mat_id }}" class="checkbox_alu" estado="0">
									<label></label>
							</div>
						</td>
						<td id="num_mat_{{ $alumno->mat_id }}" class="collapsing"></td>
						<td>{{ $alumno->alumno->nombreCompleto() }}</td>
						<td class="collapsing">{{ $alumno->alumno_rut }}</td>
						<td class="collapsing center aligned">{{ $alumno->alumno->al_fono }}</td>
						<td class="collapsing">{{ $alumno->mat_condicional }}</td>
						<td class="collapsing center aligned">{{ $alumno->mat_prom_ingreso }}</td>
						<td class="collapsing center aligned">
							@if ($alumno->est_anterior_id != null)
								{{ $alumno->escuela->eant_nombre }}
							@endif
						</td>
					</tr>
				@endforeach

			@endif
		</tbody>
	</table>

</div>

<div class="ui bottom attached tab animated fadeIn margin-bottom" data-tab="lista_alumnos">
	<table class="table ui celled">
		<thead>
			<tr>
				<th>N° Matricula</th>
				<th>RUN</th>
				<th>Nombre</th>
				<th>Estado</th>
			</tr>
		</thead>
		<tbody id="body_list_al">
			@foreach ($curso->listaAlumnos as $alumno)
				<tr class="tr_{{ $alumno->mat_id }}">
					<td class="collapsing">{{ $alumno->mat_numero }}</td>
					<td>{{ $alumno->alumno_rut }}</td>
					<td>{{ $alumno->alumno->nombreCompleto() }}</td>
					<td class="center aligned">{{ $alumno->estado() }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>	

</div>





@if ($alumnos != '[]')

	<a class="ui button teal" id="summit_adm" num_mat="{{ $periodo->matriculas()->orderBy('mat_numero', 'DESC')->first()->mat_numero }}">Guardar</a>
@endif


<script type="text/javascript">



$('.menu .item')
  .tab()
;


	$('.cancelar_button').on('click', function(){
		$('.segment_inputs').show();
		$('.segment_info').hide();
		$('#contenido_asig').hide();
		$('.dropdown_cursos').dropdown('clear').addClass('disabled')
		$('.dropdown_grado').dropdown('clear')
	})




	$('#summit_adm').on('click', function(){
		curso = $('#curso').text();
    	swal({
    		title: "¿Esta seguro de asignar los alumnos al "+curso+" este usuario?",
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


					var cont_al = $('.label_num_al').text();
					$.ajax({
						url:'{{ route('matriculas.store_admision') }}',
						type:'post',
						data: $('form').serialize(),
						success : function(response){
							if(response.status == 1){

								//window.alert(response.data.length);
								for (var i = 0; i < response.data.length; i++) {
			                        $(response.data[i]).appendTo('#body_list_al');
								}
								num = parseInt(cont_al)+parseInt(response.data.length);
			                        $('.tr_adm.positive').remove();
			                        $('.label_num_al').text(num);
							}
						}
					});

                    swal({
                        title: "Correcto!",
                        timer: 1300,
                        type: "success",
                        showConfirmButton:false,
                    });
                }});
            });

	})








	/*$('#summit_adm').on('click', function(){
		var cont_al = $('.label_num_al').text();
		$.ajax({
			url:'{{ route('matriculas.store_admision') }}',
			type:'post',
			data: $('form').serialize(),
			success : function(response){
				if(response.status == 1){

					//window.alert(response.data.length);
					for (var i = 0; i < response.data.length; i++) {
                        $(response.data[i]).appendTo('#body_list_al');
					}
					num = parseInt(cont_al)+parseInt(response.data.length);
                        $('.tr_adm.positive').remove();
                        $('.label_num_al').text(num);
				}
			}
		});
	})
*/


	$('.checkbox_alu').on('change', function(){
		var tr = $(this).val();
		var estado = $(this).attr('estado')
		var num_mat = $('#summit_adm').attr('num_mat');
		var min_mat = num_mat;
		if(estado != 1){
			num_mat++;
			$('#num_mat_'+tr).html('<input type="number" name="matricula['+tr+'][mat_numero]" value="'+num_mat+'" min="'+min_mat+'">');

			$('#tr_'+tr).addClass('positive');
			$(this).attr('estado', 1)

			$('#summit_adm').attr('num_mat', num_mat);
		}else{
			num_mat--;
			$('#num_mat_'+tr).html('');
			$('#summit_adm').attr('num_mat', num_mat);


			$('#tr_'+tr).removeClass('positive');
			$(this).attr('estado', 0)
		}
	})
</script>