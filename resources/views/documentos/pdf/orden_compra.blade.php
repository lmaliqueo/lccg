<!DOCTYPE html>
<html>
<head>
	<title>ORDEN DE COMPRA</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semantic-2.3/components/table.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semantic-2.3/components/container.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semantic-2.3/components/header.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semantic-2.3/components/segment.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semantic-2.3/components/grid.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semantic-2.3/components/image.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semantic-2.3/components/icon.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css')}}">
</head>
<style type="text/css">
    body {
        font-family: 'Lato', 'Helvetica Neue', Arial, Helvetica, sans-serif;
        background-color: white;
    }
.center-div {
    margin: auto;
    width: 50%;
    padding: 10px;
}


</style>
<body>
<table class="ui table very compact no-margin" style="border: 0;">
    <thead>
        <tr>
            <td style="width: 40%;font-size: 11px;" class="center aligned">
                LICEO CARLOS COUSIÑO GOYENECHEA<br>
                UNIDAD TÉCNICO PEDAGÓGICA<br>
                DEPARTAMENTO DE EVALUACIÓN<br>
                mca
            </td>
            <td style="width: 60%;font-size: 11px;" class="collapsing right aligned">
                <img style="width: 50px;padding-right: 30px;" src="{{ asset('img/') }}/{{ $liceo->lic_logo }}">
            </td>
        </tr>
    </thead>
</table>
<br>

    <h3 class="header ui center aligned">ORDEN DE COMPRA</h3>


<br>

<div class="segment ui raised" style="padding: 10px;">
	<table style="width: 100%;font-size: 13px">
		<thead>
			<tr>
				<td style="width: 15%">N° Orden</td>
				<th style="width: 35%">: {{ $orden->oc_numero }}</th>
				<td style="width: 15%">Fecha</td>
				<th style="width: 35%">: {{ $orden->oc_fecha }}</th>
			</tr>
			<tr>
				<td>Proveedor</td>
				<th>: {{ $orden->proveedor->prov_razon_social }}</th>
				<td>Estado</td>
				<th>: {{ $orden->estado() }}</th>
			</tr>
		</thead>
	</table>

</div>
<br>
	<table class="table ui celled small" style="font-size: 13px">
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
					<td>$ {{ $linea->lart_costo }}</td>
				</tr>
			@endforeach
		</tbody>
		<tfoot>
			<tr>
				<th colspan="5" class="right aligned"><b>Total</b></th>
				<th><b>$ {{ $orden->oc_costo }}</b></th>
			</tr>
		</tfoot>
	</table>

<br><br>

<p style="font-size: 14px;line-height: 1.5em;">
    LOTA, <strong><ins>{{ date('d') }}</ins></strong> de <strong><ins>{{ date('M') }}</ins></strong> de <strong><ins>{{ date('Y') }}</ins></strong>.-/
</p>


</body>
</html>