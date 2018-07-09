<html>
<head>
<title>HTML Reference</title>
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
            <td style="width: 40%;font-size: 11px;" class="center aligned">
                <strong>REPÚBLICA DE CHILE</strong><br>
                MINISTERIO DE EDUCACIÓN PÚBLICA <br>
                SECRETARÍA MINISTERIAL DE EDUCACIÓN <br>
                VIII REGIÓN DEL BÍO BÍO <br>
                CONCEPCIÓN
                
            </td>
            <td style="width: 30%;" class="center aligned">
        <img style="width: 50px;padding-right: 30px;" src="{{ asset('img/') }}/{{ $matricula->periodo->liceo->lic_logo }}">
            </td>
            <td style="width: 15%;font-size: 11px;" class="collapsing top aligned">
                REGION <br>
                PROVINCIA <br>
                COMUNA <br>
                AÑO ESCOLAR 
            </td>
            <td style="width: 15%;font-size: 11px;" class="collapsing top aligned">
                : OCTAVA <br>
                : CONCEPCIÓN <br>
                : LOTA <br>
                : {{ $matricula->periodo->pac_ano }} 
            </td>
        </tr>
    </thead>
</table>



<div style="text-align: center">
    <h2 style="margin: 0;">CERTIFICADO ANUAL DE ESTUDIOS</h2>
    <h4 style="margin: 0;">EDUCACIÓN MEDIA <br>
        LICEO CARLOS COUSIÑO GOYENECHEA {{ $matricula->periodo->liceo->num_lic() }} LOTA</h4>
</div>
    <table class="center-div" style="font-size: 12px" style="width: 100%">
        <thead>
            <tr style="padding: 0;border:0;">
                <td style="padding: 0;border:0;">Decreto Plan de Estudios</td>
                <td style="padding: 0;border:0;">:</td>
                <td style="text-align: center;padding: 0;border:0;">{{ $matricula->curso->first()->planEstudio->decreto_plan() }}</td>
            </tr>
            <tr style="padding: 0;border:0;">
                <td style="padding: 0;border:0;">Decreto Evaluación</td>
                <td style="padding: 0;border:0;">:</td>
                <td style="text-align: center;padding: 0;border:0;">{{ $matricula->curso->first()->planEstudio->decreto_eval() }}</td>
            </tr>
            <tr style="padding: 0;border:0;">
                <td style="padding: 0;border:0;">Decreto Cooperador</td>
                <td style="padding: 0;border:0;">:</td>
                <td style="text-align: center;padding: 0;border:0;">{{ $matricula->periodo->liceo->decreto_coop() }}</td>
            </tr>
            <tr style="padding: 0;border:0;">
                <td style="padding: 0;border:0;">Rol Base de Datos</td>
                <td style="padding: 0;border:0;">:</td>
                <td style="text-align: center;padding: 0;border:0;">{{ $matricula->periodo->liceo->lic_rol_base_datos }}</td>
            </tr>
        </thead>
    </table>
    
{{-- 
<div class="segment ui" style="padding: 1px">
    <table class="table ui small" style="border: 0px;">
        <thead>
            <tr>
                <td  style="background: white; border-top: 0px" class="collapsing">Nombre</td>
                <th style="background: white; border-bottom: 0px" class="collapsing">: {{ $matricula->alumno->nombreCompleto() }}</th>
                <td  style="background: white; border-top: 0px;padding-left: 20px">Rut</td>
                <th style="background: white; border-bottom: 0px" colspan="3">: {{ $matricula->alumno_rut }}</th>
            </tr>
            <tr>
                <td style="background: white; border-top: 0px" >Curso</td>
                <th style="background: white; border-bottom: 0px">: {{ $matricula->curso->first()->parametros->nombre_palabras() }}</th>
                <td style="background: white; border-top: 0px;padding-left: 20px" class="collapsing">matricula</td>
                <th style="background: white; border-bottom: 0px">: {{ $semestre->sem_numero }}°</th>
                <td style="background: white; border-top: 0px" class="right aligned">Año</td>
                <th style="background: white; border-bottom: 0px">: {{ $semestre->periodo->pac_ano }}</th>
            </tr>
        </thead>
    </table>
</div>
 --}}
<p style="font-size: 13px;line-height: 1.5em;">
    Don(a): <u><strong>{{ $matricula->alumno->nombreCompleto() }}</strong></u><br>
    Alumno(a) del <b>{{ $matricula->curso->first()->parametros->nombre_palabras() }}</b> de Enseñanza Media Humanistico, de acuerdo a las disposiciones reglamentarias en vigencia, ha obtenido los resultados que a continuación se indican.
</p>

<table class="ui table compact structured celled small" style="width: 100%;font-size: 13px;">
    <thead style="font-size: 12px;">
        <tr>
            <th rowspan="2" class="center aligned">ÁREA</th>
            <th rowspan="2" class="center aligned">SUBSECTORES</th>
            <th colspan="2" class="center aligned">CALIFICACIÓN FINAL</th>
        </tr>
        <tr>
            <th class="center aligned collapsing">CIFRAS</th>
            <th class="center aligned">EN PALABRAS</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($plan_comun as $cont_com => $clases)
            <tr>
                @if ($cont_com == 0)
                    <td style="font-size: 11px;" rowspan="{{ $plan_comun->count() }}" class="collapsing"><p class="verticalText no-margin"><strong>Plan Comun</strong></p></td>
                @endif
                <td>{{ $clases->asignatura->asig_nombre }}</td>
                <td class="center aligned">
                    {{ $matricula->prom_not_clase($clases->cla_id) }}
                </td>
                <td></td>
            </tr>
        @endforeach
        @foreach ($plan_electivo as $cont_ele => $clases)
            <tr>
                @if ($cont_ele == 0)
                    <td style="font-size: 11px;" rowspan="{{ $plan_electivo->count() }}" class="collapsing"><p class="verticalText no-margin"><strong style="padding-left: 5px;padding-right: 5px;">PLAN ELECTIVO</strong></p></td>
                @endif
                <td>{{ $clases->asignatura->asig_nombre }}</td>
                <td class="center aligned">
                    {{ $matricula->prom_not_clase($clases->cla_id) }}
                </td>
                <td></td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th style="font-size: 11px;" rowspan="3" class="collapsing"><p class="verticalText no-margin"><strong>Resumen</strong></p></th>
            <th class="collapsing">Promedio General de Calificaciones</th>
            <th class="center aligned">{{ $matricula->mat_prom_general }}</th>
            <th></th>
        </tr>
        <tr>
            <th>Religion (Optativo)</th>
            <th class="center aligned">
                {{ ($religion != null) ? $matricula->prom_not_clase($religion->cla_id):'' }}
            </th>
            <th></th>
        </tr>
        <tr>
            <th>Procentaje de Asistencia (%)</th>
            <th class="center aligned">{{ $matricula->prom_asis_anual() }} %</th>
            <th></th>
        </tr>
    </tfoot>
</table>




<p style="font-size: 13px;line-height: 1.5em;"><strong>Observaciones: </strong>_______________________________________________________________________________<br>
_____________________________________________________________________________________________</p>
<br><br>


<table class="table ui" style="font-size: 14px;border: 0;">
    <thead>
        <tr>
            <td style="width: 50%" class="center aligned">___________________________________ <br>
                {{ strtoupper($matricula->curso->first()->profesorJefe->persona->nombreCompleto()) }}<br>
            PROFESOR JEFE</td>
            <td style="width: 50%" class="center aligned">___________________________________ <br>
                CRISTIAN RODRIGO RIVAS MONTES <br>
            DIRECTOR</td>
        </tr>
    </thead>
</table>
<br>
<p style="font-size: 14px;line-height: 1.5em;">
    LOTA, <strong><ins>{{ date('d') }}</ins></strong> de <strong><ins>{{ date('M') }}</ins></strong> de <strong><ins>{{ date('Y') }}</ins></strong>.-/
</p>


</body>

</html>
