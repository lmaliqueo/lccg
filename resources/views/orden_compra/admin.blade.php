@extends('admin.template.main')

@section('title', 'Ordenes de Compra')

@section('content')

	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="cubes icon"></i>
					<i class="corner yellow clipboard list icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
		        Administrar Ordenes de Compra
			</span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('articulos.index') }}"><i class="arrow left icon"></i> Volver</a>
            <span class="pull-right">
                <a class="button ui icon labeled teal small" href="{{ route('orden_compra.create') }}"><i class="add icon"></i> Crear Orden de Compra</a>
                
            </span>
        </p>
	</p>


<div class="segment raised ui">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon clipboard list"></i>
        Ordenes de Compra
    </h4>
    <table class="table ui celled">
    	<thead>
    		<tr>
    			<th>Nunero</th>
    			<th>Estado</th>
    			<th>Proveedor</th>
                <th>Fecha</th>
    			<th>Costo Estimado</th>
    			<th></th>
    		</tr>
    	</thead>
    	<tbody>
    		@foreach ($ordenes_compra as $orden)
    			<tr data-tr="{{ $orden->oc_id }}">
    				<td>{{ $orden->oc_numero }}</td>
    				<td><label class="label ui {{ ($orden->oc_estado == 1) ? 'green':'' }}">{{ $orden->estado() }}</label></td>
    				<td>{{ $orden->proveedor->prov_razon_social }}</td>
                    <td>{{ $orden->oc_fecha }}</td>
    				<td><i class="icon dollar"></i> {{ $orden->oc_costo }}</td>
    				<td class="collapsing">
    					<a class="button ui small twitter icon circular modalButton" header="Orden de Compra N°{{ $orden->oc_numero }}" url="{{ route('orden_compra.show', $orden->oc_id) }}"><i class="icon eye"></i></a>
    					<a class="button ui small blue icon circular" href="{{ route('orden_compra.edit', $orden->oc_id) }}"><i class="icon pencil alternate"></i></a>
    					<a class="button ui small red icon circular btn-borrar" data-mens_info="Se eliminarán los recibos relacionados a esta orden" data-id="{{ $orden->oc_id }}" data-ruta="{{ route('orden_compra.delete_orden') }}"><i class="icon trash"></i></a>
    				</td>
    			</tr>
    		@endforeach
    	</tbody>
    </table>
</div>
	


@endsection
