{!! Form::open(['class'=>'ui mini form', 'id'=>'form_list']) !!}


    <div class="segment ui raised animated fadeIn">
        <h4 class="ui horizontal divider header text-navy2">
            <i class="icon list ol"></i>
            Lista Alumnos
        </h4>
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
                        <td>
                            <div class="field">
                                <input type="text" class="input_pos" name="mat[{{ $count }}][posicion]" value="{{ $alumno->mat_posicion_lista }}"  val_ant="{{ $alumno->mat_posicion_lista }}" size="4">
                                <input type="hidden" name="mat[{{ $count }}][mat_id]" value="{{ $alumno->mat_id }}" >
                                
                            </div>
                        </td>
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
        <div class="field text-center">
            <a class="button ui small labeled teal icon" id="save_list"><i class="save icon"></i> Guardar</a>
            <a class="button ui small labeled red icon" id="cancel_edit"><i class="cancel icon"></i> Cancelar</a>
        </div>
    </div>


{!! Form::close() !!}


<script type="text/javascript">
    
$(document).ready(function(){


    $(document).on('change', '.input_pos', function(){
        var tr = $(this).val();
        var val_ant = $(this).attr('val_ant')

            $('tr.warning').removeClass('warning');
            $(this).parents('tr').addClass('warning')
            var row = $(this).parents("tr");
            var tabla = document.getElementById("lista_alu"); 
            var trs = tabla.getElementsByTagName("tr");
            if(val_ant <= tr){
                row.insertAfter(trs[tr]);
            }else{
                row.insertBefore(trs[tr]);
            }
            $.each($('.input_pos'), function(index, value){
                $(value).val(index+1)
                $(value).attr('val_ant', index+1)
            })
    });

}); 
    $('#cancel_edit').on('click', function(){
        var id = $('#curso').val()
        if(id != ''){
            $.ajax({
                url : '{{ route('curso.view_lista') }}',
                type: 'post',
                data: {_token:token, id:id},
                success: function(data){
                    $('#info_list').html(data).show();
                    $('#input_info').hide();
                }
            })
        }
    })
$('#save_list').on('click', function(){
    $.ajax({
        url:"{{ route('curso.store_list_alu') }}",
        type: 'post',
        data: $('#form_list').serialize(),
        dataType: 'json',
        success: function(response){
            if(response == 1){
                var id = $('#curso').val()
                if(id != ''){
                    $.ajax({
                        url : '{{ route('curso.view_lista') }}',
                        type: 'post',
                        data: {_token:token, id:id},
                        success: function(data){
                            swal({
                                title: "Lista de alumnos editada",
                                timer: 1200,
                                type: "success",
                                showConfirmButton:false,
                            });
                            $('#info_list').html(data).show();
                            $('#input_info').hide();
                        }
                    })
                }
            }
        }
    })

})
{{--
    $(".btn_up,.btn_down").click(function(){
        var row = $(this).parents("tr:first");
        var tr = row.children('td').children('.input_pos').val();
        var cont = tr;
        if ($(this).is(".btn_up")) {
            cont--;
            row.children('td').children('.input_pos').val(cont)
            console.log(cont)
            row.prev().children('td').children('.input_pos').val(tr)
            row.insertBefore(row.prev());
        } else {
            cont++;
            row.children('td').children('.input_pos').val(cont)
            console.log(cont)
            row.next().children('td').children('.input_pos').val(tr)
            row.insertAfter(row.next());
        }
    });
--}}



    



</script>