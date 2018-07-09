<!DOCTYPE html>
<html>
<head>
	<title>INFORME DE NOTAS FINAL</title>
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
.page-break {
    page-break-after: always;
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
                    <img style="width: 50px;padding-right: 30px;" src="{{ asset('img/') }}/{{ $semestre->periodo->liceo->lic_logo }}">
                </td>
            </tr>
        </thead>
    </table>

    <table class="ui table very compact no-margin" style="border: 0;">
        <thead>
            <tr>
                <td style="width: 35%;font-size: 14px;"><strong>{{ strtoupper($curso->profesorJefe->persona->nombreCorto()) }}<br>
                    {{ $curso->nombreCurso() }}</strong></td>
                <td style="width: 35%" class="collapsing right aligned"><h5 class="header ui no-margin">INFORME DE NOTAS FINAL</h5></td>
                <td style="width: 30%"></td>
                
            </tr>
            
        </thead>
    </table>
    <table class="table ui compact small structured celled" style="width: 75%">
        <thead style="font-size: 10px;">
            <tr>
                <th>N°</th>
                <th class="center aligned">NOMBRE</th>
                @foreach ($curso->clases as $clase)
                    <th style="font-size: 9px;">{{ $clase->asignatura->asig_nombre }}</th>
                @endforeach
                <th>PROMEDIO</th>
                
            </tr>
        </thead>
        <tbody style="font-size: 10px;">
            @foreach ($curso->listaAlumnos()->orderBy('mat_posicion_lista', 'ASC')->get() as $alumno)
            <tr>
                <td class="collapsing center aligned">{{ $alumno->mat_posicion_lista }}</td>
                <td class="">{{ strtoupper($alumno->alumno->nombreCompletoB()) }}</td>
                @foreach ($curso->clases as $clase)
                    <td class="collapsing center aligned">{{ $alumno->prom_clase_sem($clase->cla_id, $semestre->sem_id) }}</td>
                @endforeach
                <td class="collapsing center aligned active"><b>{{ $alumno->mat_prom_general }}</b></td>

            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>