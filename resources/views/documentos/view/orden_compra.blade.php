{!! Form::open(['route' => 'documentos.print.orden_compra', 'method'=>'POST', 'class'=>'ui form']) !!}

        {!! Form::hidden('oc_id', $orden->oc_id, null) !!}




<div class="segment ui raised">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon clipboard list"></i>
        Orden de Compra
    </h4>
    <a class="ui red right corner label cancelar_oc">
        <i class="remove icon"></i>
    </a>
	<table class="ui table">
		<thead>
			<tr>
				<th style="width: 25%">N° Orden</th>
				<td style="width: 25%">{{ $orden->oc_numero }}</td>
				<th style="width: 25%">Fecha</th>
				<td style="width: 25%">{{ $orden->oc_fecha }}</td>
			</tr>
			<tr>
				<th>Proveedor</th>
				<td>{{ $orden->proveedor->prov_razon_social }}</td>
				<th>Estado</th>
				<td>{{ $orden->estado() }}</td>
			</tr>
		</thead>
	</table>

</div>
<div class="segment ui raised">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon list"></i>
        Lineas de artículos
    </h4>
	<table class="table ui celled">
		<thead>
			<tr>
				<th>Item</th>
				<th>Artículo</th>
				<th>Tipo</th>
				<th>Descripción</th>
				<th>Cantidad</th>
				<th>Costo</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($orden->lineasArticulos as $linea)
				<tr>
					<td>{{ $linea->articulo_item }}</td>
					<td>{{ $linea->articulo->art_nombre }}</td>
					<td>{{ $linea->articulo->tipo->tart_nombre }}</td>
					<td>{{ $linea->articulo->art_descripcion }}</td>
					<td>{{ $linea->lart_cantidad }}</td>
					<td><i class="icon dollar"></i>{{ $linea->lart_costo }}</td>
				</tr>
			@endforeach
		</tbody>
		<tfoot>
			<tr>
				<th colspan="5" class="right aligned">Total</th>
				<th><i class="icon dollar"></i>{{ $orden->oc_costo }}</th>
			</tr>
		</tfoot>
	</table>
</div>
<div class="text-center">
	<button class="ui button circular labeled icon teal"><i class="print icon"></i> Imprimir Orden de Compra</button>
</div>


{!! Form::close() !!}
