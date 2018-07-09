@extends('admin.template.main')

@section('title', 'Materias ensayos')

@section('content')

	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="pencil icon"></i>
					<i class="corner blue settings icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #00B5AD;">
		        Ensayos
			</span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('parametros.index') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>




<div class="ui styled fluid accordion margin-bottom accordion_options">
		  <div class="title">
		    <i class="dropdown icon"></i>
		    Materias
		  </div>
	<div class="content">
    <a id="modalButton" class="ui button teal small labeled icon" header="Nueva Materia" url="{{ route('parametros.create.materia_ensayo') }}"><i class="icon add"></i> Agregar Materia</a>
		<table class=" ui table celled small">
			<thead>
				<tr>
					<th>ID</th>
					<th>Materia</th>
					<th>Ensayos</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($materias as $materia)
					<tr>
						<td>{{ $materia->mens_id }}</td>
						<td>{{ $materia->mens_nombre }}</td>
						<td>
							@foreach ($materia->tipoEnsayos as $tipo)
								<a class="ui label blue circular">{{ $tipo->ten_tipo }}</a>
							@endforeach
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
<div class="ui segment raised secondary">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon pencil"></i>
        Ensayos
    </h4>
	<table class="ui table structured">
		<thead>
			<tr>
				<th>Periodo</th>
				<th>Tipo Ensayo</th>
				<th>Materia</th>
				<th>Fecha</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($ensayos as $ensayo)
				<tr>
					<td>{{ $ensayo->periodo->pac_ano }}</td>
					<td>{{ $ensayo->tipo->ten_tipo }}</td>
					<td>{{ $ensayo->materia->mens_nombre }}</td>
					<td>{{ $ensayo->ens_fecha }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>

@endsection
