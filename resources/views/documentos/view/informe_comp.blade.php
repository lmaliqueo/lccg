{!! Form::open(['route' => 'documentos.print.informe_comportamiento', 'method'=>'POST', 'class'=>'ui form']) !!}

        {!! Form::hidden('mat_id', $matricula->mat_id, null) !!}


<div class="segment ui">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon student"></i>
        Alumno
    </h4>
    <a class="ui red right corner label cancelar_inf">
        <i class="remove icon"></i>
    </a>

    <table class="table ui celled small">
    	<thead>
    		<tr>
    			<th style="width: 20%">Rut</th>
    			<td style="width: 30%">{{ $matricula->alumno_rut }}</td>
    			<th style="width: 20%">Nombre</th>
    			<td style="width: 30%">{{ $matricula->alumno->nombreCompleto() }}</td>
    		</tr>
    		<tr>
    			<th>Periodo</th>
    			<td>{{ $matricula->periodo->pac_ano }}</td>
    			<th>Curso</th>
    			<td>{{ $matricula->curso->first()->nombreCurso() }}</td>
    		</tr>
    		<tr>
    			
    		</tr>
    	</thead>
    </table>
</div>


<div class="ui secondary segment animated fadeIn form_pauta">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon legal"></i>
        Comportamiento
    </h4>
<div class="field text-center">
	<button class="ui button circular labeled icon teal"><i class="print icon"></i> Imprimir Informe</button>
</div>
	<table class="ui table celled">
		@foreach ($pauta as $count => $grupo_pauta)
			<thead>
				<tr>
					<th>{{ $count+1 }}.- {{ $grupo_pauta->gp_descripcion }}</th>
					<th>Conceptos</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($grupo_pauta->detalles as $i => $detalles)
					<tr>
						<td>{{ $count+1 }}.{{ $i+1 }}.- {{ $detalles->dp_descripcion }}</td>
						<td>
							@if ($matricula->detallesConceptos != '[]')
								@foreach ($matricula->conceptos as $conceptos)
									@if ($conceptos->pivot->detallepauta_id == $detalles->dp_id)
										{{ $conceptos->con_nombre }}
										@break
									@endif
								@endforeach
							@endif
						</td>
					</tr>
				@endforeach
			</tbody>
		@endforeach
	</table>
</div>




{!! Form::close() !!}
