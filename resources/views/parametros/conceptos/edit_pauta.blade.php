
@extends('admin.template.main')

@section('title', 'Actualizar Conceptos')

@section('content')


	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="file text outline icon"></i>
					<i class="corner blue pencil icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #2185D0;">
		        Actualizar Pauta
			</span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('parametros.view.pauta_comportamiento') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>



<div class="ui segment">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon file text outline"></i>
        Pauta Conceptos
    </h4>
	<div class="ui styled fluid accordion">
		@foreach ($grupo_pauta as $count => $grupo)
			<div class="title">
				<i class="dropdown icon"></i>
				<b>{{ $count+1 }}.- {{ $grupo->gp_descripcion }}</b>
				<span class="pull-right">
					
				</span>
			</div>
			<div class="content secondary ui segment basic">
				<a class="button ui blue small modalButton circular labeled icon" header="Actualizar Grupo Pauta #{{ $count+1 }}" url="{{ route('parametros.edit.grupo_pauta', $grupo->gp_id) }}" style="margin-top: 10px"><i class="icon pencil"></i> Modificar Grupo {{ $count+1 }}</a>
				<table class="table celled ui">
					<thead>
						<tr>
							<th colspan="2" class="center aligned">Detalles Pauta</th>
						</tr>
					</thead>
					<tbody class="tbody_detalles" tr="{{ $grupo->gp_id }}">
						@foreach ($grupo->detalles as $i => $detalle)
							<tr>
								<td style="padding-left: 30px">{{ $count+1 }}.{{ $i+1 }}.- {{ $detalle->dp_descripcion }}</td>
								<td class="collapsing">
									<a class="button ui blue small modalButton circular icon" header="Actualizar Detalle Pauta #{{ ($count+1).'.'.($i+1) }}" url="{{ route('parametros.edit.detalle_pauta', $detalle->dp_id) }}"><i class="icon pencil"></i></a>
								</td>
							</tr>
						@endforeach
					</tbody>
					
				</table>
			</div>
		@endforeach
	</div>
</div>


<div class="ui segment raised">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon legal"></i>
        Conceptos
    </h4>
	<table class="ui table celled selectable small">
	    <thead>
	        <tr>
	            <th>ID</th>
	            <th>Nombre</th>
	            <th>Descripción</th>
	            <th></th>
	        </tr>
	    </thead>
	    <tbody>
	        @foreach ($conceptos as $concepto)
	            <tr>
	                <td>{{ $concepto->con_id }}</td>
	                <td>{{ $concepto->con_nombre }}</td>
	                <td>{{ $concepto->con_descripcion }}</td>
	                <td class="collapsing">
	                	<a class="button blue icon mini circular ui modalButton" header="Actualizar Concepto #{{ $concepto->con_id }}" url="{{ route('parametros.edit.conceptos', $concepto->con_id) }}"><i class="icon pencil"></i></a>
	                </td>
	            </tr>
	        @endforeach
	    </tbody>
	</table>

</div>


<script type="text/javascript">
	
</script>



@endsection
