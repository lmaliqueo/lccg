

<div class="segment ui raised">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon user"></i>
        Datos Personales
    </h4>

    <table class="table ui celled">
    	<thead>
	    	<tr>
	    		<th style="width: 20%">Nombre</th>
	    		<td style="width: 30%">{{ $profesor->persona->nombreCompleto() }}</td>
	    		<th style="width: 20%">Rut</th>
	    		<td style="width: 30%">{{ $profesor->persona_rut }}</td>
	    	</tr>
	    	<tr>
	    		<th>Contacto</th>
	    		<td>{{ $profesor->persona->pe_contacto }}</td>
	    		<th>Especialidades</th>
	    		<td>
                    @foreach ($profesor->especialidad as $asignaturas)
                        <label class="ui label teal">{{ $asignaturas->asig_nombre }}</label>
                    @endforeach
	    		</td>
	    	</tr>
    	</thead>
    </table>
</div>


<div class="ui top attached menu">
    @foreach ($periodos as $periodo)
        <a class="item {{ ($periodo->pac_estado == 1) ? 'active':'' }}" data-tab="{{ $periodo->pac_ano }}">{{ $periodo->pac_ano }}</a>
    @endforeach
</div>
@foreach ($periodos as $periodo)
    <div class="ui bottom attached segment animated fadeIn tab  {{ ($periodo->pac_estado == 1) ? 'active':'' }}">
        <div class="segment ui raised">
            <h4 class="ui horizontal divider header text-navy2">
                <i class="icon edit outline"></i>
                Cursos Profesor Jefe
            </h4>

            <table class="table ui celled">
                <thead>
                    <tr>
                        <th style="width: 25%">Curso</th>
                        <th style="width: 25%">Periodo</th>
                        <th style="width: 25%">Cant. Alumnos</th>
                        <th style="width: 25%">Promedio</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $curso = $profesor->cursos->where('periodo_id', $periodo->pac_id)->where('cu_tipo', 1);
                    @endphp
                    @foreach ($curso as $curso)
                        <tr>
                            <td>{{ $curso->nombreCurso() }}</td>
                            <td>{{ $curso->periodo->pac_ano }}</td>
                            <td>{{ $curso->listaAlumnos->count() }}</td>
                            <td>{{ $curso->prom_curso() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="segment ui raised">
            <h4 class="ui horizontal divider header text-navy2">
                <i class="icon copy"></i>
                Clases
            </h4>

            <table class="table ui celled structured">
                <thead>
                    <tr>
                        <th style="width: 65%" rowspan="2" class="center aligned">Asignatura</th>
                        <th style="width: 65%" rowspan="2">Periodo</th>
                        <th style="width: 35%" colspan="3" class="center aligned">Notas</th>
                    </tr>
                    <tr>
                        <th class="collapsing">Sem 1</th>
                        <th class="collapsing">Sem 2</th>
                        <th class="collapsing">Prom</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($profesor->clases->whereIn('curso_id', $curso->pluck('cu_id')) as $clase)
                        <tr>
                            <td>{{ $clase->asignatura->asig_nombre }}</td>
                            <td>{{ $clase->curso->periodo->pac_ano }}</td>
                            @php
                                $sem1 = $clase->curso->periodo->semestres->where('sem_numero', 1)->first();
                                $sem2 = $clase->curso->periodo->semestres->where('sem_numero', 2)->first();
                                $color1 = null;
                                $color2 = null;
                                if($sem1 != null ){
                                    $color1 = ($sem1->sem_estado == 2) ? 'positive':null;
                                }
                                if($sem2 != null ){
                                    $color2 = ($sem2->sem_estado == 2) ? 'positive':null;
                                }
                            @endphp
                            <td class="center aligned {{ $color1 }}">{{ ($sem1 != null) ? round($clase->notas->where('semestre_id', $sem1->sem_id)->avg('not_promedio'), 1):'-' }}</td>
                            <td class="center aligned {{ $color2 }}">{{ ($sem2 != null) ? round($clase->notas->where('semestre_id', $sem2->sem_id)->avg('not_promedio'), 1):'-' }}</td>
                            <td class="center aligned warning">{{ round($clase->notas->avg('not_promedio'), 1) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>        
    </div>
@endforeach

