<!DOCTYPE html>
<html>
<head>
	<title>INFORME DE NOTAS POR CURSO</title>
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

@foreach ($curso->listaAlumnos as $cont_mat => $matricula)
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
	                <img style="width: 50px;padding-right: 30px;" src="{{ asset('img/') }}/{{ $matricula->periodo->liceo->lic_logo }}">
	            </td>
	        </tr>
	    </thead>
	</table>
	<br>
	<div class="text-center margin-bottom">
	    <h3 class="header ui no-margin">INFORME DE NOTAS PARCIALES</h3>
	    <h5 class="header ui no-margin">{{ strtoupper($semestre->sem_palabras()) }} SEMESTRE - AÑO {{ $semestre->periodo->pac_ano }}</h5>
	    
	</div>
	<br>
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



	<table class="table ui celled compact small structured" style="width: 96%">
	    <thead>
	        <tr>
	            <th class="center aligned" style="font-size: 12px;">ASIGNATURA</th>
	            <th colspan="12" class="center aligned" style="font-size: 12px;">NOTAS PARCIALES {{ $semestre->sem_numero }}° SEMESTRE</th>
	            <th class="center aligned" style="font-size: 9px;">Promedio {{ $semestre->sem_palabras() }} Semestre</th>
	        </tr>
	    </thead>
	    <tbody style="font-size: 13px;">
	        @foreach ($matricula->curso->first()->clases as $clases)
	            <tr>
	                <td class="collapsing">{{ $clases->asignatura->asig_nombre }}</td>
	                @php
	                    $notas = $clases->notas->where('semestre_id', $semestre->sem_id)->where('matricula_id', $matricula->mat_id)->first();
	                @endphp
	                @if ($notas != null)
	                    <td class="center aligned collapsing">{{ (strlen($notas->not_nota1) == 1) ? $notas->not_nota1.'.0': $notas->not_nota1 }}</td>
	                    <td class="center aligned collapsing">{{ (strlen($notas->not_nota2) == 1) ? $notas->not_nota2.'.0': $notas->not_nota2 }}</td>
	                    <td class="center aligned collapsing">{{ (strlen($notas->not_nota3) == 1) ? $notas->not_nota3.'.0': $notas->not_nota3 }}</td>
	                    <td class="center aligned collapsing">{{ (strlen($notas->not_nota4) == 1) ? $notas->not_nota4.'.0': $notas->not_nota4 }}</td>
	                    <td class="center aligned collapsing">{{ (strlen($notas->not_nota5) == 1) ? $notas->not_nota5.'.0': $notas->not_nota5 }}</td>
	                    <td class="center aligned collapsing">{{ (strlen($notas->not_nota6) == 1) ? $notas->not_nota6.'.0': $notas->not_nota6 }}</td>
	                    <td class="center aligned collapsing">{{ (strlen($notas->not_nota7) == 1) ? $notas->not_nota7.'.0': $notas->not_nota7 }}</td>
	                    <td class="center aligned collapsing">{{ (strlen($notas->not_nota8) == 1) ? $notas->not_nota8.'.0': $notas->not_nota8 }}</td>
	                    <td class="center aligned collapsing">{{ (strlen($notas->not_nota9) == 1) ? $notas->not_nota9.'.0': $notas->not_nota9 }}</td>
	                    <td class="center aligned collapsing">{{ (strlen($notas->not_nota10) == 1) ? $notas->not_nota10.'.0': $notas->not_nota10 }}</td>
	                    <td class="center aligned collapsing">{{ (strlen($notas->not_nota11) == 1) ? $notas->not_nota11.'.0': $notas->not_nota11 }}</td>
	                    <td class="center aligned collapsing">{{ (strlen($notas->not_nota12) == 1) ? $notas->not_nota12.'.0': $notas->not_nota12 }}</td>
	                    <td class="center aligned collapsing">{{ $notas->not_promedio }}</td>
	                @else
	                    @for ($i = 1; $i <= 13; $i++)
	                        <td></td>
	                    @endfor
	                @endif
	            </tr>
	        @endforeach
	    </tbody>
	    <tfoot>
	        <tr>
	            <th colspan="13" style="font-size: 12px;"><strong>PROMEDIO</strong></th>
	            <th class="center aligned"><b>{{ $matricula->prom_sem($semestre->sem_id) }}</b></th>
	        </tr>
	    </tfoot>
	</table>
	<br>

	<p style="font-size: 13px;line-height: 1.5em;"><strong>Observaciones: </strong>______________________________________________________________________________________<br>
	____________________________________________________________________________________________________<br>
	____________________________________________________________________________________________________</p>
	<br><br><br>


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
	<br>


	<p style="font-size: 14px;line-height: 1.5em;">
	    LOTA, <strong><ins>{{ date('d') }}</ins></strong> de <strong><ins>{{ date('M') }}</ins></strong> de <strong><ins>{{ date('Y') }}</ins></strong>.-/
	</p>
	@if ($cont_mat < $curso->listaAlumnos->count()-1)
		<div class="page-break"></div>
	@endif
@endforeach

</body>
</html>