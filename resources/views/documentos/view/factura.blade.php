{!! Form::open(['route' => 'documentos.print.factura', 'method'=>'POST', 'class'=>'ui form']) !!}

        {!! Form::hidden('fac_id', $factura->fac_id, null) !!}




<div class="segment ui raised">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon dollar"></i>
        Factura
    </h4>
    <a class="ui red right corner label cancelar_oc">
        <i class="remove icon"></i>
    </a>
	<table class="ui table">
		<thead>
			<tr>
				<th style="width: 25%">N° Factura</th>
				<td style="width: 25%">{{ $factura->fac_numero }}</td>
				<th style="width: 25%">Fecha</th>
				<td style="width: 25%">{{ $factura->fac_fecha }}</td>
			</tr>
			<tr>
				<th>N° de Orden</th>
				<td>{{ $factura->orden->oc_numero }}</td>
				<th>Responsable</th>
				<td>{{ $factura->responsable->persona->nombreCompleto() }}</td>
			</tr>
		</thead>
	</table>

</div>
<div class="segment ui raised">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon list tasks"></i>
        Lineas de recepción
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
			@foreach ($factura->recibos as $recibo)
				<tr>
					<td>{{ $recibo->linea->articulo_item }}</td>
					<td>{{ $recibo->linea->articulo->art_nombre }}</td>
					<td>{{ $recibo->linea->articulo->tipo->tart_nombre }}</td>
					<td>{{ $recibo->linea->articulo->art_descripcion }}</td>
					<td>{{ $recibo->rec_cantidad }}</td>
					<td><i class="icon dollar"></i>{{ $recibo->rec_costo }}</td>
				</tr>
			@endforeach
		</tbody>
		<tfoot>
			<tr>
				<th colspan="5" class="right aligned">Total</th>
				<th><i class="icon dollar"></i>{{ $factura->fac_costo_total }}</th>
			</tr>
		</tfoot>
	</table>
</div>
<div class="text-center">
	<button class="ui button circular labeled icon teal"><i class="print icon"></i> Imprimir Factura</button>
</div>


{!! Form::close() !!}
