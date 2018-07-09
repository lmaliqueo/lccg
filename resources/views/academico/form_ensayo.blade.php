{!! Form::open(['route' => 'academico.store_ensayos', 'method'=>'POST', 'class'=>'ui form animated fadeIn']) !!}


		<div class="ui segment raised secondary">

			<table class="ui celled table">
				<thead>
					<tr>
                        <td style="display: none;">
                            {!! Form::text('ensayo[tipo_id]', $tipo->ten_id, ['placeholder'=>'', 'class'=>'disabled']) !!}
                            
                        </td>
                        <th>Fecha</th>
                        <td>
                            {!! Form::date('ensayo[ens_fecha]', null, ['placeholder'=>'']) !!}
                            
                        </td>
						<th>Materia</th>
						<td>
    <select class="ui fluid search dropdown" name="ensayo[materia_id]">
        @foreach ($tipo->materias as $materia)
            <option value="{{ $materia->mens_id }}">{{ $materia->mens_nombre }}</option>
        @endforeach
    </select>

                        </td>
						<th>Cursos</th>
						<td>{!! Form::text('ensayo[ens_grado_curso]', null, ['placeholder'=>'']) !!}</td>
					</tr>
				</thead>
			</table>
					

		</div>


<div class="ui segment raised secondary">

<div class="segment ui tertiary raised">
    <div class="ui inverted ribbon label large teal">
        <i class="icon student"></i> Agregar Alumno
    </div>
    <table class="table celled ui small">
        <thead>
            <tr>
                <th>Rut</th>
                <th>N° Matricula</th>
                <th>Nombre</th>
                <th>Curso</th>
                <th>Comuna</th>
                <th>Estado</th>
                <th>Puntaje</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="td_search" id="alu_id" style="display: none;"></td>
                <td class="td_search" id="alu_rut" style="display: none;"></td>
                <td>
                    <div class="ui input rut_alumno">
                        <input type="text" name="rut" id="rut_alumno" class="input_search">
                    </div>
                </td>
                <td class="td_search" id="alu_numero"></td>
                <td class="td_search" id="alu_nombre"></td>
                <td class="td_search" id="alu_curso"></td>
                <td class="td_search" id="alu_comuna"></td>
                <td class="td_search" id="alu_estado"></td>
                <td>
                    <div class="ui input puntaje">
                        <input type="number" name="puntaje" id="puntaje" min="0" class="input_search">
                    </div>
                </td>
                <td class="collapsing">
                    <a class="ui disabled button small circular teal icon" id="add_alumno" cont="1"><i class="icon plus"></i></a>
                </td>
            </tr>
        </tbody>
    </table>
    
</div>

	<table class="table ui celled navy2">
		<thead>
			<tr>
				<th>N° Matricula</th>
				<th>Rut</th>
				<th>Nombre</th>
				<th>Curso</th>
				<th>Puntaje</th>
				<th></th>
			</tr>
		</thead>
		<tbody id="input_alumnos">
		</tbody>
	</table>
    <div class="text-center">
        <a class="ui button teal" id="guardar_ensayo">Guardar</a>
    </div>
</div>


{!! Form::close() !!}


<script type="text/javascript">
    $('#rut_alumno').autocomplete({
         source : function( request, response ) {
         $.ajax({
                url: '{{ route('autocomplete.search_matricula') }}',
                type: 'post',
                dataType: "json",
                data: {_token:token, rut: request.term, curso:$('#curso').val() },
                success: function(data) {
                            response($.map(data, function(item) {
                                        return {
                                                label: item.rut,
                                                matricula: item.matricula,
                                                nombre: item.nombre,
                                                estado: item.estado,
                                                comuna: item.comuna,
                                                rut: item.rut,
                                                numero: item.numero,
                                                curso: item.curso,
                                                }
                                    }))
                        }
                    })
            },
            select: function(event, ui) {

                $('#alu_numero').html(ui.item.numero);
                $('#alu_nombre').html(ui.item.nombre);
                $('#alu_rut').html(ui.item.rut);
                $('#alu_comuna').html(ui.item.comuna);
                $('#alu_id').html(ui.item.matricula);
                $('#alu_estado').html(ui.item.estado);
                $('#alu_curso').html(ui.item.curso);
                $('#info_alumno').show();
                $('#info_inputs').hide();

                var num = $('#rut_alumno').val();
                $('#info_inputs').html(num);
            },
                   
    })
    $('#puntaje').on('change', function(){
    	var puntaje = $(this).val();
    	if(puntaje > 0){
    		$('#add_alumno').removeClass('disabled');
    	}else{
    		$('#add_alumno').addClass('disabled');
    	}
    })

    $('#add_alumno').on('click', function(){
        var mat = $('#alu_id').text();
        var puntaje = $('#puntaje').val();
        var numero = $('#alu_numero').text();
        var nombre = $('#alu_nombre').text();
        var rut = $('#alu_rut').text();
        var curso = $('#alu_curso').text();

        var i = $('#input_alumnos tr').length + 1;
        var count = $('#add_alumno').attr('cont');

        $('<tr class="animated fadeInDown"><td style="display:none;"><input class="form-control disabled" name="alumno['+count+i+'][matricula_id]" type="text" value="'+mat+'" style="display:none;"></td><td>'+numero+'</td><td>'+rut+'</td><td>'+nombre+'</td><td>'+curso+'</td><td class="warning"><input class="form-control disabled" name="alumno['+count+i+'][puntaje]" type="text" value="'+puntaje+'"></td><td class="collapsing"><a class="ui button small negative circular icon" id="rem_trow"><i class="icon remove"></i></a></td></tr>').appendTo('#input_alumnos');
        $(this).addClass('disabled');
        $('.td_search').text('');
        $('.input_alumnos').val('');
    })



    $('#guardar_ensayo').on('click', function(){
        $.ajax({
            url: '{{ route('academico.store_ensayos') }}',
            type:'post',
            data:$('form').serialize(),
            success: function(response){
                $('#body_ensayo').html(response);
            }
        })
    })
$(function() {

        $(document).on('click', '#rem_trow', function() { 
            $count = $('#add_alumno').attr('cont');
            $count++;
                    document.getElementById("add_alumno").setAttribute('cont', $count)
                    $(this).parents('tr').remove();
                return false;

        });
})


/*
    $('#rem_trow').on('click', function(){
        $count = $('#add_alumno').attr('cont');
        $count++;
        $('#add_alumno').attr('cont', $count);
        $(this).parents('tr').remove();
    })*/
</script>



