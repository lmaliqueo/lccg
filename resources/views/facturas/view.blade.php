<div class="segment ui raised">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon dollar"></i>
        Factura
    </h4>
	<table class="table ui celled">
		<thead>
			<tr>
				<th style="width: 25%">Numero Factura</th>
				<td style="width: 25%">{{ $factura->fac_id }}</td>
				<th style="width: 25%">Fecha</th>
				<td style="width: 25%">{{ $factura->fac_fecha }}</td>
			</tr>
			<tr>
				<th>Numero OC</th>
				<td>{{ $factura->orden->oc_numero }}</td>
				<th>Costo</th>
				<td><i class="icon dollar"></i>{{ $factura->fac_costo_total }}</td>
			</tr>
		</thead>
	</table>
	<div class="segment ui secondary raised">
	    <h4 class="ui horizontal divider header text-navy2">
	        <i class="icon user outline"></i>
	        Responsable
	    </h4>
		<table class="table ui celled small">
			<thead>
				<tr>
					<th>Rut</th>
					<th>Nombre</th>
					<th>Cargo</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>{{ $factura->responsable->persona_rut }}</td>
					<td>{{ $factura->responsable->persona->nombreCompleto() }}</td>
					<td>{{ $factura->responsable->cargo->ca_nombre }}</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

<div class="segment ui raised">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon list"></i>
        Lineas de Recibo
    </h4>
	<table class="ui celled table">
		<thead>
			<tr>
				<th>Item</th>
				<th>Artículo</th>
				<th>Cantidad</th>
				<th>Costo</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($factura->recibos as $recibo)
				<tr>
					<td>{{ $recibo->linea->articulo_item }}</td>
					<td>{{ $recibo->linea->articulo->art_nombre }}</td>
					<td>{{ $recibo->rec_cantidad }}</td>
					<td><i class="icon dollar"></i>{{ $recibo->rec_costo }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>