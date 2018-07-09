    		{!! Form::open(['route' => ['periodo.update', $periodo], 'method'=>'PUT', 'class'=>'ui form']) !!}

				<div class="field">
					{!! Form::label('periodo[pac_ano]', 'Año Periodo Académico') !!}
					{!! Form::text('periodo[pac_ano]', $periodo->pac_ano, ['placeholder'=>'', 'readonly']) !!}
				</div>

				<div class="field">
					{!! Form::label('periodo[pac_fecha_inicio]', 'Fecha Inicio') !!}
					{!! Form::date('periodo[pac_fecha_inicio]', $periodo->pac_fecha_inicio, ['placeholder'=>'', 'max'=>$periodo->pac_ano.'-12-31', 'min'=>$periodo->pac_ano.'-01-01']) !!}
				</div>
				<div class="field">
					{!! Form::label('periodo[pac_fecha_termino]', 'Fecha Término') !!}
					{!! Form::date('periodo[pac_fecha_termino]', $periodo->pac_fecha_termino, ['placeholder'=>'', 'max'=>$periodo->pac_ano.'-12-31', 'min'=>$periodo->pac_fecha_inicio]) !!}
				</div>
		<div class="ui grid two column">
				@foreach ($periodo->semestres as $semestre)
				<div class="column">
					<div class="segment raised"></div>
				<table class="table celled ui">
					<thead>
						<tr>
							<th>Semestre</th>
							<td>{{ $semestre->sem_numero }}</td>
						</tr>
						<tr>
							<th>Fecha Inicio</th>
							<td>
								<div class="field">
					{!! Form::date('semestre['.$semestre->sem_numero.'][sem_fecha_inicio]', $semestre->sem_fecha_inicio, ['min'=>($semestre->sem_numero == 2) ? $periodo->semestres[0]->sem_fecha_termino:$periodo->pac_ano.'-01-01', 'max'=>$periodo->pac_ano.'-12-31']) !!}
					{!! Form::hidden('semestre['.$semestre->sem_numero.'][sem_id]', $semestre->sem_id, null) !!}
									
								</div>
							</td>
						</tr>
						<tr>
							<th>Fecha Término</th>
							<td>
								<div class="field">
					{!! Form::date('semestre['.$semestre->sem_numero.'][sem_fecha_termino]', $semestre->sem_fecha_termino, ['placeholder'=>'', 'max'=>$periodo->pac_fecha_termino, 'min'=>$semestre->sem_fecha_inicio]) !!}
									
								</div>
							</td>
						</tr>
					</thead>
				</table>
				</div>
				@endforeach
			
		</div>

<br>
                <div class="actions text-right">

                    <div class="ui negative button" data-value="Cancel" name="Cancel">
                        Cancelar
                    </div>
					{!! Form::submit('Guardar', ['class'=>'ui button teal']) !!}

                </div>


			{!! Form::close() !!}



<script type="text/javascript">

	$('input[name="semestre[1][sem_fecha_termino]"]').on('change', function(){
		var val = $(this).val()
		if(val != ''){
			$('input[name="semestre[2][sem_fecha_inicio]"]').attr('min', val)
		}
	})

 	$('.dropdown').dropdown();

</script>