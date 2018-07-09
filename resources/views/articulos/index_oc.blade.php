@extends('admin.template.main')

@section('title', 'Linea OC Articulos')

@section('content')


	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="cubes icon"></i>
					<i class="corner yellow list icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
		        Lineas de Ordenes de Compra
			</span>
        </h2>
        <p>
            {{-- <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('articulos.index') }}"><i class="arrow left icon"></i> Volver</a> --}}
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('articulos.index') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>

<div class="segment ui secondary raised">
<div class="ui accordion">
	<div class="{{ ($request->all() != null) ? 'active':'' }} title no-padding">
		<h5 class="ui center aligned header text-navy2">
		    <i class="icon filter"></i>
		    Filtrar
		</h5>
	</div>
	<div class="{{ ($request->all() != null) ? 'active':'' }} content">
	{!! Form::open(['route' => 'ordencompra.index', 'method'=>'GET', 'class'=>'ui form small']) !!}
	<table class="table ui">
		<thead>
			<tr>
				<th style="width: 15%">Fecha</th>
				<td style="width: 35%">
		<div class="inline fields no-margin">
			<div class="field">
				<input type="date" name="fecha_ini" value="{{ isset($request->fecha_ini) ? $request->fecha_ini : '' }}" placeholder="" max="{{ date('Y-m-d') }}">
			</div>
			<label>hasta</label>
			<div class="field">
				<input type="date" name="fecha_fin" value="{{ isset($request->fecha_fin) ? $request->fecha_fin : '' }}" placeholder="" max="{{ date('Y-m-d') }}">
			</div>
		</div>
					
				</td>
				<th style="width: 15%">Articulos</th>
				<td style="width: 35%">
			<div class="field">
                {!! Form::select('items[]', $articulos, (isset($request->items) ? $request->items : ''), ['class'=>'ui fluid multiple selection dropdown','placeholder'=>'', 'multiple']) !!}
			</div>
					
				</td>
			</tr>
		</thead>
	</table>
		<div class="text-center">
			<button class="ui button">Buscar</button>
		</div>
			
	{!! Form::close() !!}
	</div>
</div>
</div>

<div class="segment raised ui">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon list"></i>
        Lineas de Orden de Compra
    </h4>




	<table class="ui table celled">
		<thead>
			<tr>
				<th>ID</th>
				<th>Item</th>
				<th>Nombre</th>
				<th>Tipo</th>
				<th class="collapsing">N° OC</th>
				<th>Fecha</th>
				<th>Cantidad</th>
				<th>Costo</th>
			</tr>
		</thead>
		<tbody>
		@foreach ($linea_articulos as $item)
			<tr>
				<td class="collapsing">{{ $item->lart_id }}</td>
				<td>{{ $item->articulo_item }}</td>
				<td>{{ $item->articulo->art_nombre }}</td>
				<td>{{ $item->articulo->tipo->tart_nombre }}</td>
				<td class="center aligned">{{ $item->ordenCompra->oc_numero }}</td>
				<td class="collapsing">{{ $item->ordenCompra->oc_fecha }}</td>
				<td class="collapsing center aligned">{{ $item->lart_cantidad }}</td>
				<td class="collapsing"><i class="icon dollar"></i>{{ $item->lart_costo }}</td>
			</tr>
		@endforeach
		</tbody>
		<tfoot>
			<tr>
				<th colspan="8">
					{{ $linea_articulos->appends(['request'=>$request])->links() }}
				</th>
			</tr>
			
		</tfoot>
	</table>
	
</div>



<script type="text/javascript">
	$(document).on('change', 'input[name="fecha_ini"]', function(){
		var val = $(this).val()
		if(val != ''){
			$('input[name="fecha_fin"]').attr('min', val)
		}else{
			$('input[name="fecha_fin"]').removeAttr('min')
		}
	})
</script>


@endsection
