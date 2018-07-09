
<div class="segment ui raised secondary">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon clipboard list"></i>
        Orden de Compra
    </h4>
	<table class="table ui celled">
		<thead>
			<tr>
				<th style="width: 25%">Numero</th>
				<td style="width: 25%">{{ $orden->oc_numero }}</td>
				<th style="width: 25%">Fecha</th>
				<td style="width: 25%">{{ $orden->oc_fecha }}</td>
			</tr>
			<tr>
				<th>Estado</th>
				<td><label class="label ui {{ ($orden->oc_estado == 1) ? 'green':'' }}">{{ $orden->estado() }}</label></td>
				<th>Costo Estimado</th>
				<td><i class="icon dollar"></i>{{ $orden->oc_costo }}</td>
			</tr>
		</thead>
	</table>
	<table class="table ui celled">
		<thead>
			<tr>
				<th style="width: 25%">Proveedor</th>
				<td style="width: 25%">{{ $orden->proveedor->prov_razon_social }}</td>
				<th style="width: 25%">Costo Total</th>
				<td style="width: 25%"><i class="icon dollar"></i>{{ $orden->costo_total() }}</td>
			</tr>
		</thead>
	</table>
	
</div>

<div class="ui raised secondary segment">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon list"></i>
        Lineas de Ordenes
    </h4>
	<table class="table ui celled">
		<thead>
			<tr>
				<th>Item</th>
				<th>Artículo</th>
				<th>Cantidad</th>
				<th>Costo</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($orden->lineasArticulos as $linea)
				<tr>
					<td>{{ $linea->articulo->art_item }}</td>
					<td>{{ $linea->articulo->art_nombre }}</td>
					<td>{{ $linea->lart_cantidad }}</td>
					<td><i class="icon dollar"></i>{{ $linea->lart_costo }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	
</div>
