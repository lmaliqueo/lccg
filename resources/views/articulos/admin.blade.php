@extends('admin.template.main')

@section('title', 'Articulos')

@section('content')

	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="cubes icon"></i>
					<i class="corner yellow settings icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
		        Administrar Articulos
			</span>
        </h2>
        <p>
            {{-- <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('articulos.index') }}"><i class="arrow left icon"></i> Volver</a> --}}
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('articulos.index') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>
<div class="segment raised ui">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon cubes"></i>
        Articulos
    </h4>
	{!! Form::open(['route' => 'articulos.admin', 'method'=>'GET', 'class'=>'ui form']) !!}
			<div class="ui action input">
				<input type="text" name="s" value="{{ isset($s) ? $s : '' }}" placeholder="Item, nombre, descripción o tipo">
				<button class="ui button">Buscar</button>
			</div>
			
	{!! Form::close() !!}
	<table class="ui celled table selectable structured">
		<thead>
			<tr>
				<th rowspan="2">Item</th>
				<th rowspan="2">Nombre</th>
				<th rowspan="2">Tipo</th>
				<th rowspan="2">Descripción</th>
				<th colspan="3" class="center aligned">Cantidad</th>
				<th rowspan="2"></th>
			</tr>
			<tr>
				<th class="collapsing">Alta</th>
				<th class="collapsing">Baja</th>
				<th class="collapsing">Total</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($articulos as $articulo)
				<tr>
					<td>{{ $articulo->art_item }}</td>
					<td>{{ $articulo->art_nombre }}</td>
					<td>{{ $articulo->tipo->tart_nombre }}</td>
					<td>{{ $articulo->art_descripcion }}</td>
					<td class="center aligned">{{ $articulo->art_cantidad_alta }}</td>
					<td class="center aligned">{{ $articulo->art_cantidad_baja }}</td>
					<td class="center aligned">{{ $articulo->art_cantidad_total }}</td>
					<td class="collapsing">
						<a class="ui blue icon button small circular" href="{{ route('articulos.edit', $articulo->art_item) }}" data-tooltip="Asignar Alumnos"><i class="pencil icon"></i></a>
					</td>
				</tr>
			@endforeach
		</tbody>
		<tfoot>
			<tr>
				<th colspan="8">
					{{ $articulos->appends(['s'=>$s])->links() }}
				</th>
			</tr>
		</tfoot>
	</table>
	
</div>

	


@endsection
