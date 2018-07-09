@extends('admin.template.main')

@section('title', 'Articulos')

@section('content')


<h2 class="ui center aligned icon header text-navy2" >
    <i class="circular cubes icon"></i>
    <span style="border-bottom: 5px solid #FCDD13;">
    Inventario
      
    </span>
</h2>
<br>
<div class="ui four column centered grid" style="margin: 30px;">
    @if (Auth::user()->administrador())
        <div class="column center aligned">
            <a href="{{ route('articulos.create') }}">

                <h3 class="ui icon grey header no-margin button_pulse">
                    <i class=" add icon"></i>
                    <div class="content">
                        Ingresar Articulo
                        <div class="sub header">Ingresar nuevo articulo al inventario</div>
                    </div>
                </h3>
            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('articulos.admin') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" settings icon"></i>
                    <div class="content">
                        Administrar Articulos
                        <div class="sub header">Ver, eliminar y modificar artículos registrados en el sistema</div>
                    </div>
                </h3>
            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('ordencompra.index') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" list icon"></i>
                    <div class="content">
                        Lineas de Ordenes de Compra
                        <div class="sub header">Ver las lineas de ordenes de compra registrados</div>
                    </div>
                </h3>
            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('recibo.list') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" list tasks icon"></i>
                    <div class="content">
                        Lineas de Recepción
                        <div class="sub header">Ver las lineas de recepción registrados en el sistema</div>
                    </div>
                </h3>
            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('orden_compra.index') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" clipboard list icon"></i>
                    <div class="content">
                        Orden de Compra
                        <div class="sub header">Crear, ver, modificar y eliminar ordenes de compra</div>
                    </div>
                </h3>
            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('articulos.recibo_articulos') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" dolly icon"></i>
                    <div class="content">
                        Registrar Recepción de Artículos
                        <div class="sub header">Registrar en el sistema una recepción de artículos</div>
                    </div>
                </h3>
            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('facturas.index') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" dollar icon"></i>
                    <div class="content">
                        Facturas
                        <div class="sub header">Ver, modificar y eliminar facturas registradas en el sistema</div>
                    </div>
                </h3>
            </a>
        </div>
    @endif
    @if (Auth::user()->jefeUtp())
        <div class="column center aligned">
            <a href="{{ route('articulos.admin') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" settings icon"></i>
                    <div class="content">
                        Administrar Articulos
                        <div class="sub header">Ver, eliminar y modificar artículos registrados en el sistema</div>
                    </div>
                </h3>
            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('ordencompra.index') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" list icon"></i>
                    <div class="content">
                        Lineas de Ordenes de Compra
                        <div class="sub header">Ver las lineas de ordenes de compra registrados</div>
                    </div>
                </h3>
            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('recibo.list') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" list tasks icon"></i>
                    <div class="content">
                        Lineas de Recepción
                        <div class="sub header">Ver las lineas de recepción registrados en el sistema</div>
                    </div>
                </h3>
            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('orden_compra.index') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" clipboard list icon"></i>
                    <div class="content">
                        Orden de Compra
                        <div class="sub header">Crear, ver, modificar y eliminar ordenes de compra</div>
                    </div>
                </h3>
            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('articulos.recibo_articulos') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" dolly icon"></i>
                    <div class="content">
                        Registrar Recepción de Artículos
                        <div class="sub header">Registrar en el sistema una recepción de artículos</div>
                    </div>
                </h3>
            </a>
        </div>
        <div class="column center aligned">
            <a href="{{ route('facturas.index') }}">
                <h3 class="ui icon grey header no-margin button_pulse text-navy2">
                    <i class=" dollar icon"></i>
                    <div class="content">
                        Facturas
                        <div class="sub header">Ver, modificar y eliminar facturas registradas en el sistema</div>
                    </div>
                </h3>
            </a>
        </div>
    @endif
</div>



@endsection
