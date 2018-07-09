@extends('admin.template.main')

@section('title', 'Facturas')

@section('content')

	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="cubes icon"></i>
					<i class="corner yellow dollar icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
		        Facturas
			</span>
        </h2>
        <p>
            {{-- <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('articulos.index') }}"><i class="arrow left icon"></i> Volver</a> --}}
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('articulos.index') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>

<div class="segment raised ui">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon dollar"></i>
        Facturas
    </h4>
	{!! Form::open(['route' => 'facturas.index', 'method'=>'GET', 'class'=>'ui form']) !!}
			<div class="ui action input">
				<input type="text" name="s" value="{{ isset($s) ? $s : '' }}" placeholder="N°, Responsable o N° OC">
				<button class="ui button">Buscar</button>
			</div>
			
	{!! Form::close() !!}
	<table class="table ui celled">
		<thead>
			<tr>
				<th>N°</th>
				<th>Responsable</th>
				<th>N° OC</th>
				<th>Proveedor</th>
				<th>Fecha</th>
				<th>Costo Total</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($facturas as $factura)
				<tr data-tr="{{ $factura->fac_id }}">
					<td>{{ $factura->fac_numero }}</td>
					<td>{{ $factura->responsable->persona_rut }}</td>
					<td>{{ $factura->orden->oc_numero }}</td>
					<td>{{ $factura->orden->proveedor->prov_razon_social }}</td>
					<td>{{ $factura->fac_fecha }}</td>
					<td><i class="icon dollar"></i>{{ $factura->fac_costo_total }}</td>
					<td class="collapsing">
						<button class="ui button icon small teal circular modalButton" header="Factura N° {{ $factura->fac_numero }}" url="{{ route('facturas.show', $factura->fac_id) }}"><i class="icon eye"></i></button>
						<a class="button ui blue icon small circular" href="{{ route('facturas.edit', $factura->fac_id) }}"><i class="icon pencil"></i></a>
    					<a class="button ui small red icon circular btn-borrar" data-mens_info="Se eliminarán los recibos relacionados a esta factura" data-id="{{ $factura->fac_id }}" data-ruta="{{ route('factura.delete_factura') }}"><i class="icon trash"></i></a>
					</td>
				</tr>
			@endforeach
		</tbody>
		<tfoot>
			<tr>
				<th colspan="7">
					{{ $facturas->appends(['s'=>$s])->links() }}
				</th>
			</tr>
		</tfoot>
	</table>
</div>




@endsection
