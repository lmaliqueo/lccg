@extends('admin.template.main')

@section('title', 'Proveedores')

@section('content')


	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="shipping icon"></i>
					<i class="corner yellow settings icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
		        Administrar Proveedores
			</span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('parametros.index') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>


<div class="ui segment raised secondary">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon shipping"></i>
        Proveedores
    </h4>

    <table class="table ui celled">
        <thead>
            <tr>
                <th>ID</th>
                <th>Razon Social</th>
                <th>Comuna</th>
                <th>Dirección</th>
                <th>Contacto</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proveedores as $proveedor)
                <tr data-tr="{{ $proveedor->prov_id }}">
                    <td>{{ $proveedor->prov_id }}</td>
                    <td>{{ $proveedor->prov_razon_social }}</td>
                    <td>{{ $proveedor->comuna->com_nombre }}</td>
                    <td>{{ $proveedor->prov_direccion }}</td>
                    <td>{{ $proveedor->prov_contacto }}</td>
                    <td class="collapsing">
                        <a class="button ui small icon circular twitter modalButton" header="Proveedor #{{ $proveedor->prov_id }}" url="{{ route('proveedores.show', $proveedor->prov_id) }}"><i class="icon eye"></i></a>
                        <a class="button ui small icon circular blue modalButton" header="Actualizar Proveedor #{{ $proveedor->prov_id }}" url="{{ route('proveedores.edit', $proveedor->prov_id) }}"><i class="icon pencil"></i></a>
                        @if ($proveedor->ordenCompras == '[]')
                            <a class="button ui small icon circular red btn-borrar" data-mens_info="El proveedor no se relaciona con ninguna orden de compra registrada" data-id="{{ $proveedor->prov_id }}" data-ruta="{{ route('proveedor.delete_prov') }}"><i class="icon trash"></i></a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>


@endsection
