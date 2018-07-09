@extends('admin.template.main')

@section('title', 'Liceo')

@section('content')


	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
                    <i class="university icon"></i>
                    <i class="corner yellow settings icon"></i>
                </i>
            </span>
            <span style="border-bottom: 4px solid #FCDD13;">
                Ver Liceo
            </span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('parametros.index') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
                
	</p>
<div class="segment ui raised">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon university"></i>
        Liceo
    </h4>
    <div class="grid ui two columns center aligned">
        <div class="column">

            <h2 class="ui center aligned header">
                <img class="ui image no-margin" src="{{ asset('img/') }}/{{ $liceo->lic_logo }}">
                <div class="content">
                    {{ $liceo->lic_nombre }}
                    <div class="sub header">{{ $liceo->num_lic() }}</div>
                </div>
            </h2>

        </div>
    </div>


    <a class="button ui small icon labeled bg-light-blue" href="{{ route('parametros.edite.liceo') }}"><i class="icon pencil"></i> Modificar</a>


    <table class="table ui celled">
        <thead>
            <tr>
                <th style="width: 50%">Rol Base de Datos</th>
                <td style="width: 50%">{{ $liceo->lic_rol_base_datos }}</td>
            </tr>
            <tr>
                <th>Nombre del Liceo</th>
                <td>{{ $liceo->lic_nombre }}</td>
            </tr>
            <tr>
                <th>Fecha de Resolución de Rec. Oficial</th>
                <td>{{ $liceo->lic_fecha_resol_rec_ofic }}</td>
            </tr>
            <tr>
                <th>Numero de Resolución de Rec. Oficial</th>
                <td>{{ $liceo->lic_numero_resol_rec_ofic }}</td>
            </tr>
            <tr>
                <th>Numero</th>
                <td>{{ $liceo->lic_numero }}</td>
            </tr>
            <tr>
                <th>Letra</th>
                <td>{{ $liceo->lic_letra }}</td>
            </tr>
            <tr>
                <th>Dirección</th>
                <td>{{ $liceo->lic_direccion }}</td>
            </tr>
            <tr>
                <th>Jornada Clases</th>
                <td>{{ $liceo->lic_jornada }}</td>
            </tr>
            <tr>
                <th>Cantidad de Semestres</th>
                <td>{{ $liceo->lic_semestres }}</td>
            </tr>
        </thead>
    </table>
</div>


@endsection
