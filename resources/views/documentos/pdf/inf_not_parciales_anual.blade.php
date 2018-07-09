<!DOCTYPE html>
<html>
<head>
	<title>INFORME DE NOTAS PARCIALES</title>
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
            <td style="width: 25%;font-size: 11px;" class="center aligned">
                LICEO CARLOS COUSIÑO GOYENECHEA<br>
                UNIDAD TÉCNICO PEDAGÓGICA<br>
                DEPARTAMENTO DE EVALUACIÓN<br>
                mca
            </td>
            <td style="width: 75%;font-size: 11px;" class="collapsing right aligned">
                <img style="width: 50px;padding-right: 30px;" src="{{ asset('img/') }}/{{ $matricula->periodo->liceo->lic_logo }}">
            </td>
        </tr>
    </thead>
</table>
<div class="text-center margin-bottom">
    <h3 class="header ui no-margin">INFORME DE NOTAS PARCIALES</h3>
    <h5 class="header ui no-margin">AÑO {{ $matricula->periodo->pac_ano }}</h5>
    
</div>
<table style="font-size: 13px;line-height: 1.5em;">
    <thead>
        <tr>
            <td>Alumno(a):</td>
            <th>{{ $matricula->alumno->nombreCompletoB() }}</th>
        </tr>
        <tr>
            <td>Curso:</td>
            <th>{{ $matricula->curso->first()->nombreCurso() }}</th>
        </tr>
    </thead>
</table>



<table class="table ui celled compact small structured" style="width: 91%">
    <thead>
        <tr style="font-size: 11px;">
            <th class="center aligned" style="font-size: 10px;">ASIGNATURA</th>
            @foreach ($matricula->periodo->semestres as $sem)
                <th colspan="12" class="center aligned">{{ strtoupper($sem->sem_palabras()) }} SEMESTRE</th>
                <th class="center aligned" style="font-size: 10px;">Prom. {{ $sem->sem_numero }}°SEM</th>
            @endforeach
            <th class="center aligned" style="font-size: 10px;">Prom. Final</th>
        </tr>
    </thead>
    <tbody style="font-size: 12px;">
        @foreach ($matricula->curso->first()->clases as $clases)
            <tr>
                <td class="collapsing">{{ $clases->asignatura->asig_nombre }}</td>
                @foreach ($matricula->periodo->semestres as $sem_notas)
                    @php
                        $notas = $clases->notas->where('semestre_id', $sem_notas->sem_id)->where('matricula_id', $matricula->mat_id)->first();
                    @endphp
                    @if ($notas != null)
                        @for ($i = 1; $i < 13; $i++)
                            <td class="center aligned  collapsing">{{ (strlen($notas['not_nota'.$i]) == 1) ? $notas['not_nota'.$i].'.0': $notas['not_nota'.$i] }}</td>
                        @endfor
                        <td class="center aligned collapsing warning"><strong>{{ $notas->not_promedio }}</strong></td>
                    @else
                        @for ($i = 1; $i <= 12; $i++)
                            <td></td>
                        @endfor
                        <td class="warning"></td>
                    @endif

                @endforeach
                @php
                    $prom = $clases->notas->where('matricula_id', $matricula->mat_id)->where('not_promedio', '<>', null)->avg('not_promedio');
                    $prom = round($prom,1);
                @endphp
                @if ($prom)
                    <td class="center aligned collapsing active"><strong>{{ (strlen($prom) == 1) ? $prom.'.0':$prom }}</strong></td>
                @else
                    <td class="active"></td>
                @endif
            </tr>
        @endforeach
    </tbody>
    <tfoot style="font-size: 11px;">
        <tr>
            <th colspan="27" style="font-size: 12px;"><strong>PROMEDIO</strong></th>
            <th class="center aligned"><b>{{ $matricula->mat_prom_general }}</b></th>
        </tr>
    </tfoot>
</table>

<p style="font-size: 13px;line-height: 1.5em;"><strong>Observaciones: </strong>_______________________________________________________________________________________________________________________<br>
_____________________________________________________________________________________________________________________________________</p>
<br><br>


<table class="table ui" style="font-size: 14px;border: 0;">
    <thead>
        <tr>
            <td style="width: 50%" class="center aligned"></td>
            <td style="width: 50%" class="center aligned">___________________________________ <br>
                {{ strtoupper($matricula->curso->first()->profesorJefe->persona->nombreCompleto()) }}<br>
            PROFESOR(A) JEFE</td>
        </tr>
    </thead>
</table>

<span style="font-size: 14px;line-height: 1.5em;">
    LOTA, <strong><ins>{{ date('d') }}</ins></strong> de <strong><ins>{{ date('M') }}</ins></strong> de <strong><ins>{{ date('Y') }}</ins></strong>.-/
</span>

</body>
</html>