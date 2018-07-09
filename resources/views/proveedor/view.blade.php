<div class="segment ui raised">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon shipping"></i>
        Proveedor
    </h4>
	<table class="table ui celled">
		<thead>
			<tr>
				<th style="width: 25%">Razón social</th>
				<td style="width: 25%">{{ $proveedor->prov_razon_social }}</td>
				<th style="width: 25%">Comuna</th>
				<td style="width: 25%">{{ $proveedor->comuna->com_nombre }}</td>
			</tr>
			<tr>
				<th>Dirección</th>
				<td>{{ $proveedor->prov_direccion }}</td>
				<th>Contacto</th>
				<td>{{ $proveedor->prov_contacto }}</td>
			</tr>
		</thead>
	</table>
</div>

<div class="segment ui raised">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon clipboard list"></i>
        Ordenes de Compra
    </h4>
	<table class="table ui celled">
		<thead>
			<tr>
				<th>ID</th>
				<th>Numero OC</th>
				<th>Estado</th>
				<th>Fecha</th>
				<th>Costo</th>
				<th>Cant. Artículos</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($proveedor->ordenCompras as $orden)
				<tr>
					<td>{{ $orden->oc_id }}</td>
					<td>{{ $orden->oc_numero }}</td>
					<td>{{ $orden->estado() }}</td>
					<td>{{ $orden->oc_fecha }}</td>
					<td><i class="icon dollar"></i>{{ $orden->oc_costo }}</td>
					<td>{{ $orden->lineasArticulos->count() }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>