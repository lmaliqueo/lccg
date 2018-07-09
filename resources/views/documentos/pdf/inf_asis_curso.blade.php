<!DOCTYPE html>
<html>
<head>
	<title>INFORME DE ASISNTECIAS POR CURSO</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semantic-2.3/components/table.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semantic-2.3/components/container.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semantic-2.3/components/header.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semantic-2.3/components/segment.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semantic-2.3/components/grid.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semantic-2.3/components/image.css')}}">
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

    .verticalText {
    -webkit-transform: rotate(-90deg);
    -moz-transform: rotate(-90deg);
    }
    .table_raw th{
        border: 1px solid black;
    }
    .table_raw td{
        border: 1px solid black;
    }

</style>
<body>
<table class="ui table very compact no-margin" style="border: 0;">
    <thead>
        <tr>
            <td style="width: 35%;font-size: 11px;" class="center aligned">
                LICEO CARLOS COUSIÑO GOYENECHEA<br>
                UNIDAD TÉCNICO PEDAGÓGICA<br>
                DEPARTAMENTO DE EVALUACIÓN<br>
                mca
            </td>
            <td style="width: 65%;font-size: 11px;" class="collapsing right aligned">
                <img style="width: 50px;padding-right: 30px;" src="{{ asset('img/') }}/{{ $semestre->periodo->liceo->lic_logo }}">
            </td>
        </tr>
    </thead>
</table>
<div class="text-center margin-bottom">
    <h3 class="header ui no-margin" style="font-size: 16px;">ASISTENCIA SEMESTRAL AÑO ESCOLAR {{ $semestre->periodo->pac_ano }}</h3>
    
</div>
<table style="font-size: 13px;line-height: 1.5em;">
    <thead>
        <tr>
            <td>Profesor Jefe:</td>
            <th>{{ $curso->profesorJefe->persona->nombreCompleto() }}</th>
        </tr>
        <tr>
            <td>Curso:</td>
            <th>{{ $curso->nombreCurso() }}</th>
        </tr>
    </thead>
</table>

<table class="table ui celled small structured compact" style="width: 80%;">
    <thead style="font-size: 10px;">
        <tr>
            <th rowspan="3">N°</th>
            <th rowspan="3" class="center aligned">NOMBRE</th>
            <th colspan="{{ $cont+4 }}" class="center aligned">{{ strtoupper($semestre->sem_palabras()) }} SEMESTRE</th>
        </tr>
        <tr>
            @foreach ($meses_asis as $mes)
                <th class="center aligned">{{ strtoupper($mes['mes']) }}</th>
            @endforeach
            <th colspan="4" class="center aligned">RESUMEN TOTAL HRS. SEMESTRALES</th>
        </tr>
        <tr style="font-size: 10px;">
            @for ($i = 0; $i < $cont; $i++)
                <th class="center aligned">Inasist.</th>
            @endfor
            <th class="collapsing">T. ASIS.</th>
            <th class="collapsing">T. INAS.</th>
            <th class="collapsing">% ASIS.</th>
            <th class="collapsing">% INAS.</th>
        </tr>
    </thead>
    <tbody style="font-size: 10px;">
        @foreach ($curso->listaAlumnos()->orderBy('mat_posicion_lista', 'ASC')->get() as $alumno)
            <tr>
                <td class="collapsing">{{ $alumno->mat_posicion_lista }}</td>
                <td class="">{{ strtoupper($alumno->alumno->nombreCompletoB()) }}</td>
                @foreach ($meses_asis as $mes)
                    @php
                        $cant = $alumno->diaClases()->where('semestre_id', $semestre->sem_id)->whereMonth('dc_fecha', $mes['num'])->wherePivot('ala_estado', 0)->count();
                    @endphp
                    <td class="collapsing center aligned">{{ $cant }}</td>
                @endforeach
                <td class="center aligned"><b>{{ $alumno->diaClases()->where('semestre_id', $semestre->sem_id)->wherePivot('ala_estado', 1)->count() }}</b></td>
                <td class="center aligned"><b>{{ $alumno->diaClases()->where('semestre_id', $semestre->sem_id)->wherePivot('ala_estado', 0)->count() }}</b></td>
                <td class="center aligned"><b>{{ $alumno->prom_asis_sem($semestre->sem_id).' %' }}</b></td>
                <td class="center aligned"><b>{{ $alumno->prom_inasis_sem($semestre->sem_id) }}</b></td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>