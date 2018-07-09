			{!! Form::open(['route' => 'periodo.store_semestre', 'method'=>'POST', 'class'=>'ui form']) !!}

			<table class="ui table celled">
				<thead>
					<tr>
						<th>Periodo</th>
						<td>{{ $periodo->pac_ano }}</td>
					</tr>
					<tr>
						<th>Semestre</th>
						<td>{{ $cant_sem }}°</td>
					</tr>
				</thead>
			</table>

							{!! Form::hidden('periodo_id', $periodo->pac_id, ['placeholder'=>'', 'maxlength'=>5]) !!}
							{!! Form::hidden('sem_numero', $cant_sem, ['placeholder'=>'', 'maxlength'=>5]) !!}

				<div class=" two fields">
					<div class="field">
						{!! Form::label('sem_fecha_inicio', 'Fecha Inicio') !!}
							{!! Form::date('sem_fecha_inicio', null, ['placeholder'=>'', 'maxlength'=>5]) !!}

					</div>
					<div class="field">
						{!! Form::label('sem_fecha_termino', 'Fecha Término') !!}
							{!! Form::date('sem_fecha_termino', null, ['placeholder'=>'', 'maxlength'=>5]) !!}

					</div>
				</div>

                <div class="actions text-right">

                    <div class="ui negative button" data-value="Cancel" name="Cancel">
                        Cancelar
                    </div>
					{!! Form::submit('Guardar', ['class'=>'ui button teal']) !!}

                </div>

			{!! Form::close() !!}
