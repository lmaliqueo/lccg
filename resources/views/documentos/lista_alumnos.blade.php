<div class="segment ui raised">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon edit outline"></i>
        Curso
    </h4>
    <a class="ui red right corner label cancelar_button">
        <i class="remove icon"></i>
    </a>
    <table class="table ui small">
    	<thead>
    		<tr>
    			<th style="width: 20%">Curso</th>
    			<td style="width: 30%">{{ $curso->nombreCurso() }}</td>
    			<th style="width: 20%">Profesor Jefe</th>
    			<td style="width: 30%">{{ $curso->profesorJefe->persona->nombreCompleto() }}</td>
    		</tr>
    		<tr>
    			<th>Aula</th>
    			<td>{{ $curso->aula->aul_numero }}</td>
    			<th>Periodo</th>
    			<td>{{ $curso->periodo->pac_ano }}</td>
    		</tr>
    		<tr>
    			<th>Decreto Plan de Estudio</th>
    			<td>{{ $curso->planEstudio->decreto_plan() }}</td>
    			<th>Decreto Evaluación</th>
    			<td>{{ $curso->planEstudio->decreto_eval() }}</td>
    		</tr>
    	</thead>
    </table>
</div>
@if (($tipo_inf == 'curso') || ($tipo_inf == 'asis_cur'))
    @if ($tipo_inf == 'curso')
        {!! Form::open(['route' => 'documentos.print.inf_notas_curso', 'method'=>'POST', 'class'=>'ui form']) !!}
    @else
        {!! Form::open(['route' => 'documentos.print.inf_asis_curso', 'method'=>'POST', 'class'=>'ui form']) !!}

    @endif

            {!! Form::hidden('curso', $curso->cu_id, null) !!}
            <div class="text-center">
                <div class="ui action input">
                    <div class="ui selection dropdown">
                        <input type="hidden" name="semestre" id="semestre">
                            <i class="dropdown icon"></i>
                        <div class="default text">--Seleccionar Periodo--</div>
                        <div class="menu">
                            @foreach ($curso->periodo->semestres as $semestre)
                                <div class="item" data-value="{{ $semestre->sem_id }}">{{ $semestre->sem_palabras() }} Semestre</div>
                            @endforeach
                        </div>
                    </div>
                    <button class="ui button teal icon labeled disabled"><i class="icon edit"></i> Imprimir Informes</button>
                </div>
                
            </div>
    {!! Form::close() !!}
    <div class="segment ui raised">
        <h4 class="ui horizontal divider header text-navy2">
            <i class="icon student"></i>
            Alumnos
        </h4>
        <table class="table ui celled">
            <thead>
                <tr>
                    <th class="center aligned">N°</th>
                    <th>RUN</th>
                    <th>Nombre</th>
                    <th class="collapsing">Sexo</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($curso->listaAlumnos()->orderBy('mat_posicion_lista')->get() as $alumno)
                    <tr>
                        <td class="center aligned">{{ $alumno->mat_posicion_lista }}</td>
                        <td>{{ $alumno->alumno_rut }}</td>
                        <td>{{ $alumno->alumno->nombreCompleto() }}</td>
                        <td class="center aligned">{{ $alumno->alumno->letra_sexo() }}</td>
                        <td class="center aligned">{{ $alumno->estado() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@else
    <div class="segment ui raised">
        <h4 class="ui horizontal divider header text-navy2">
            <i class="icon student"></i>
            Alumnos
        </h4>
        <table class="table ui celled">
            <thead>
                <tr>
                    <th class="center aligned">N°</th>
                    <th>RUN</th>
                    <th>Nombre</th>
                    <th class="collapsing">Sexo</th>
                    <th>Estado</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($curso->listaAlumnos()->orderBy('mat_posicion_lista')->get() as $alumno)
                    <tr>
                        <td class="center aligned">{{ $alumno->mat_posicion_lista }}</td>
                        <td>{{ $alumno->alumno_rut }}</td>
                        <td>{{ $alumno->alumno->nombreCompleto() }}</td>
                        <td class="center aligned">{{ $alumno->alumno->letra_sexo() }}</td>
                        <td class="center aligned">{{ $alumno->estado() }}</td>
                        <td class="collapsing">
                            @if ($tipo_inf == 'notas')
                                @foreach ($curso->periodo->semestres()->orderBy('sem_numero', 'ASC')->get() as $semestre)
                                    <a class="view_notas button ui icon small circular {{ ($semestre->sem_estado == 1) ? 'blue':'' }} {{ ($semestre->sem_estado == 2) ? 'green':'' }}" data-tooltip="{{ $semestre->sem_numero }}° Semestre" data-inverted data-mat="{{ $alumno->mat_id }}" data-sem="{{ $semestre->sem_id }}"><i class="file alternate icon"></i></a>
                                @endforeach
                                <a class="view_notas button ui icon small circular {{ ($alumno->periodo->pac_estado == 1) ? 'blue':'' }} {{ ($alumno->periodo->pac_estado == 2) ? 'green':'' }}" data-tooltip="Año {{ $alumno->periodo->pac_ano }}" data-inverted data-mat="{{ $alumno->mat_id }}" data-sem="anual"><i class="file alternate icon"></i></a>
                            @elseif($tipo_inf == 'comp')
                                <a class="button ui small circular icon view_comp {{ ($alumno->conceptos->count()) ? 'teal':'disabled' }}" data-mat="{{ $alumno->mat_id }}"><i class="file icon"></i></a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endif


<script type="text/javascript">
    $('.dropdown').dropdown();

    $('input[name="semestre"]').on('change', function(){
        var val = $(this).val();
        if(val != ''){
            $('.ui.action.input').children('button').removeClass('disabled')
        }else{
            $('.ui.action.input').children('button').addClass('disabled')
        }
    })


</script>
