

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









<div id="content_horario">
    <div class="segment ui raised animated fadeIn">
        <h4 class="ui horizontal divider header text-navy2">
            <i class="icon calendar alternate outline"></i>
            Horario
        </h4>
        <a class="circular button ui small blue labeled icon" id="edit_horario"><i class="icon pencil"></i> Modificar Horario</a>
        <table class="ui definition celled table">
            <thead>
                <tr>
                    <th class="collapsing">Horas</th>
                    @foreach ($dias as $dia)
                        <th>{{ $dia->di_nombre }}</th>
                    @endforeach
{{--
                    @for ($i = 1; $i <= 5 ; $i++)
                        <th>{{ $dias[$i] }}</th>
                    @endfor
                    --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($curso->periodo->horas as $horas)
                    <tr>
                        <td class="center aligned">{{ $horas->hors_numero }}</td>
                        @foreach ($dias as $dia)
                            @php
                                $horario = $horarios->where('hora_id', $horas->hors_id)->where('dia_id', $dia->di_id)->first();
                            @endphp
                            @if ($horario != null)
                                <td class="center aligned">{{ $horario->clases->asignatura->asig_nombre }}</td>
                            @else
                                <td></td>
                            @endif
                        @endforeach
                        {{-- 
                        @for ($i = 1; $i <= 5 ; $i++)
                        @php
                          $horario = $horas->horarios->whereIn('clases_id', $clases->pluck('cla_id'))->where('hor_dia', $dias[$i]);
                        @endphp
                        @if ($horario != '[]')
                        @foreach ($horario as $horario)
                            <td class="center aligned">{{ $horario->clases->asignatura->asig_nombre }}</td>
                        @endforeach
                        @else
                            <td></td>
                        @endif
                        @endfor --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  
</div>

<script type="text/javascript">
var token = $('meta[name="csrf-token"]').attr('content');

$('#edit_horario').on('click', function(){
    var id = $('#curso').val();
    $.ajax({
        url : "{{ route('curso.create_horario') }}",
        type: 'post',
        data: {_token:token, id:id},
        success: function(response){
            $('#content_horario').html(response)
        }
    })
})

    $('.cancelar_button').on('click', function(){
        $('#input_info').show();
        $('#horario_body').hide().html('');
        $('.dropdown_cursos').dropdown('clear')
    })




</script>
