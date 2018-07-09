{!! Form::open(['route' => 'documentos.print.inf_notas_parciales', 'method'=>'POST', 'class'=>'ui form']) !!}

        {!! Form::hidden('mat_id', $matricula->mat_id, null) !!}

		@if (!isset($semestre))
	        {!! Form::hidden('periodo_id', $matricula->periodo_id, null) !!}
		@else
	        {!! Form::hidden('sem_id', $semestre->sem_id, null) !!}
		@endif


<div class="segment ui raised">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon student"></i>
        Alumno
    </h4>
    <a class="ui red right corner label cancelar_view">
        <i class="remove icon"></i>
    </a>
	<table class="table ui celled">
		<thead>
			<tr>
				<th style="width: 25%">Rut</th>
				<td style="width: 25%">{{ $matricula->alumno_rut }}</td>
				<th style="width: 25%">Nombre</th>
				<td style="width: 25%">{{ $matricula->alumno->nombreCompleto() }}</td>
			</tr>
			<tr>
				<th>Curso</th>
				<td>{{ $matricula->curso->first()->nombreCurso() }}</td>
				@if (isset($semestre))
					<th>Semestre</th>
					<td>{{ strtoupper($semestre->sem_palabras()) }} SEMESTRE</td>
				@else
					<th>Año</th>
					<td>{{ $matricula->periodo->pac_ano }}</td>
				@endif
			</tr>
		</thead>
	</table>
</div>

<div class="segment ui raised">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon table"></i>
        Notas
    </h4>
	<table class="table ui celled small compact">
		<thead>
			<tr>
				<th>Asignatura</th>
				@if (isset($semestre))
					<th colspan="12" class="center aligned">Notas Parciales</th>
	            	<th class="center aligned collapsing">Promedio</th>
	            @else
	            	@foreach ($matricula->periodo->semestres as $sem)
						<th colspan="12" class="center aligned">{{ strtoupper($sem->sem_palabras()) }} SEMESTRE</th>
		            	<th class="center aligned">Prom. {{ $sem->sem_numero }}°SEM</th>
	            	@endforeach
	            	<th class="center aligned">Prom. Final</th>
				@endif
			</tr>
		</thead>
		<tbody>
		            	@php
		            		$id = 0;
		            	@endphp
	        @foreach ($matricula->curso->first()->clases as $clases)
	            <tr>
	                <td class="">{{ $clases->asignatura->asig_nombre }}</td>
	                @if (isset($semestre))
		                @php
		                    $notas = $clases->notas->where('semestre_id', $semestre->sem_id)->where('matricula_id', $matricula->mat_id)->first();
		                @endphp
		                @if ($notas != null)
		            		@for ($i = 1; $i < 13; $i++)
		            			<td class="center aligned  collapsing">{{ (strlen($notas['not_nota'.$i]) == 1) ? $notas['not_nota'.$i].'.0': $notas['not_nota'.$i] }}</td>
		            		@endfor
		                    <td class="center aligned collapsing">{{ $notas->not_promedio }}</td>
		                @else
		                    @for ($i = 1; $i <= 13; $i++)
		                        <td></td>
		                    @endfor
		                @endif
		            @else
		            	@foreach ($matricula->periodo->semestres as $sem_notas)
		            		@php
		                    	$notas = $clases->notas->where('semestre_id', $sem_notas->sem_id)->where('matricula_id', $matricula->mat_id)->first();
		            		@endphp
			                @if ($notas != null)
			            		@for ($i = 1; $i < 13; $i++)
			            			<td class="center aligned  collapsing">{{ (strlen($notas['not_nota'.$i]) == 1) ? $notas['not_nota'.$i].'.0': $notas['not_nota'.$i] }}</td>
			            		@endfor
			                    <td class="center aligned collapsing"><strong>{{ $notas->not_promedio }}</strong></td>
			                @else
			                    @for ($i = 1; $i <= 13; $i++)
			                        <td></td>
			                    @endfor
			                @endif
		            	@endforeach
		            	@php
		            		$prom = $clases->notas->where('matricula_id', $matricula->mat_id)->where('not_promedio', '<>', null)->avg('not_promedio');
		            	@endphp
	                    <td class="center aligned collapsing warning"><strong>{{ $prom }}</strong></td>
	                @endif
	            </tr>
	        @endforeach
		</tbody>
	</table>
</div>


<div class="field text-center">
	<button class="ui button circular labeled icon teal"><i class="print icon"></i> Imprimir Informe</button>
</div>



{!! Form::close() !!}
