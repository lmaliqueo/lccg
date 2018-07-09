<div class="ui segment raised secondary">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon edit outline"></i>
        Curso
    </h4>
    <a class="ui red right corner label cancelar_button">
        <i class="remove icon"></i>
    </a>
    <table class="ui celled table">
    	<thead>
    		<tr>
    			<th style="width: 20%">Curso</th>
    			<td style="width: 30%">{{ $curso->nombreCurso() }}</td>
    			<th style="width: 20%">Profesor Jefe</th>
    			<td style="width: 30%">{{ $curso->profesorJefe->persona->nombreCompleto() }}</td>
    		</tr>
    		<tr>
    			<th>Decreto Plan de Estudio</th>
    			<td>{{ $curso->planEstudio->decreto_plan() }}</td>
    			<th>Decreto Evaluación</th>
    			<td>{{ $curso->planEstudio->decreto_eval() }}</td>
    		</tr>
    		<tr>
    			<th>Aula</th>
    			<td>{{ ($curso->aula_id != null) ? $curso->aula->aul_numero:'Sin Aula' }}</td>
    			<th>Cantidad de Alumnos</th>
    			<td>{{ $curso->listaAlumnos->count() }}</td>
    		</tr>
    	</thead>
    </table>
</div>


<div id="content_list">
    <div class="segment ui raised animated fadeIn">
        <h4 class="ui horizontal divider header text-navy2">
            <i class="icon list ol"></i>
            Lista Alumnos
        </h4>
        <a class="button ui small circular blue icon labeled" id="edit_list"><i class="icon pencil"></i> Editar Lista</a>
        <table class="table ui celled" id="lista_alu">
            <thead>
                <th>N°</th>
                <th>Fecha Ingreso</th>
                <th>Fecha Retiro</th>
                <th>Rut</th>
                <th>Nombre</th>
                <th class="collapsing">Sexo</th>
                <th>Estado</th>
                <th>Comuna</th>
            </thead>
            <tbody>
                @foreach ($curso->listaAlumnos()->orderBy('mat_posicion_lista', 'ASC')->get() as $count => $alumno)
                    <tr>
                        <td>{{ $alumno->mat_posicion_lista }}</td>
                        <td>{{ $alumno->mat_fecha_ingreso }}</td>
                        <td>{{ $alumno->mat_fecha_retiro }}</td>
                        <td>{{ $alumno->alumno_rut }}</td>
                        <td>{{ $alumno->alumno->nombreCompleto() }}</td>
                        <td class="center aligned">{{ $alumno->alumno->letra_sexo() }}</td>
                        <td class="center aligned"><label class="label ui {{ $alumno->color_estado() }}">{{ $alumno->estado() }}</label></td>
                        <td>{{ $alumno->alumno->comuna->com_nombre }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>    



<script type="text/javascript">
    var token = $('meta[name="csrf-token"]').attr('content');
    $('.mov_button').mouseenter(function(){
        $(this).addClass('blue')
    })
    $('.mov_button').mouseleave(function(){
        $(this).removeClass('blue')
    })



    $('.cancelar_button').on('click', function(){
        $('#input_info').show();
        $('#info_list').hide().html('');
        $('.buscar_curso').dropdown('clear')
    })


    $('#edit_list').on('click', function(){
        var id = $('#curso').val();
        $.ajax({
            url : "{{ route('curso.edit_lista') }}",
            type: 'post',
            data: {_token:token, id:id},
            success: function(response){
                $('#content_list').html(response);
            }
        })
    })




</script>