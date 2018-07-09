<!DOCTYPE html>
<html>
<head>
	<title>INFORME DEL COMPORTAMIENTO ESCOLAR</title>
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
    width: 60%;
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
<table class="ui table very compact" style="border: 0; margin-bottom: 10px;">
    <thead>
        <tr>
            <td style="width: 40%;font-size: 10px;border-bottom: 1px solid black" class="center aligned">
                <strong style="font-size: 13px;">REPÚBLICA DE CHILE</strong><br>
                MINISTERIO DE EDUCACIÓN PÚBLICA <br>
                SECRETARÍA MINISTERIAL DE EDUCACIÓN <br>
                VIII REGIÓN DEL BÍO BÍO <br>
                CONCEPCIÓN
                
            </td>
            <td style="width: 30%;" class="center aligned">
        <img style="width: 50px;padding-right: 30px;" src="{{ asset('img/') }}/{{ $matricula->periodo->liceo->lic_logo }}">
            </td>
            <td style="width: 15%;font-size: 10px;border-bottom: 1px solid black" class="collapsing top aligned">
                REGION <br>
                PROVINCIA <br>
                COMUNA <br>
                AÑO ESCOLAR 
            </td>
            <td style="width: 15%;font-size: 10px;border-bottom: 1px solid black" class="collapsing top aligned">
                : OCTAVA <br>
                : CONCEPCIÓN <br>
                : LOTA <br>
                : {{ $matricula->periodo->pac_ano }} 
            </td>
        </tr>
    </thead>
</table>


<h3 class="header center aligned ui" style="margin-bottom: 10px">INFORME DEL COMPORTAMIENTO ESTUDIANTIL</h3>


<table style="font-size: 13px;margin-bottom: 5px">
	<thead>
		<tr style="padding: 0;border:0;margin:0;">
			<td style="padding: 0;border:0;margin:0;">&nbsp;&nbsp;Alumno(a)</td>
			<th style="padding: 0;border:0;margin:0;">&nbsp;&nbsp;:&nbsp;{{ $matricula->alumno->nombreCompleto() }}</th>
		</tr>
		<tr style="padding: 0;border:0;margin:0;">
			<td style="padding: 0;border:0;margin:0;">&nbsp;&nbsp;Curso</td>
			<th style="padding: 0;border:0;margin:0;">&nbsp;&nbsp;:&nbsp;{{ $matricula->curso->first()->nombreCurso() }}</th>
		</tr>
		<tr style="padding: 0;border:0;margin:0;">
			<td style="padding: 0;border:0;margin:0;">&nbsp;&nbsp;Establecimiento</td>
			<th style="padding: 0;border:0;margin:0;">&nbsp;&nbsp;:&nbsp;Liceo {{ $matricula->periodo->liceo->lic_nombre }}</th>
		</tr>
		<tr style="padding: 0;border:0;margin:0;">
			<td style="padding: 0;border:0;margin:0;">&nbsp;&nbsp;Profesor(a) Jefe</td>
			<th style="padding: 0;border:0;margin:0;">&nbsp;&nbsp;:&nbsp;{{ $matricula->curso->first()->profesorJefe->persona->nombreCompleto() }}</th>
		</tr>
	</thead>
</table>
<p style="font-size: 12px;margin-bottom: 10px;line-height: 1.0em;">El presente informe resume el progreso alcanzado por su pupilo durante el presente año, en algunas áreas de su desarrollo, las que han sido evaluadas por sus profesores considerando su edad y nivel escolar</p>

<table class="ui table celled very compact structured small no-margin" style="font-size: 12px;">
	@foreach ($pauta as $count => $grupo_pauta)
		<thead>
			<tr>
				<th style="padding: 3px">{{ $count+1 }}.- {{ $grupo_pauta->gp_descripcion }}</th>
				<th style="padding: 3px" class="center aligned">{{ ($count == 0) ? 'CONCEPTO':'' }}</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($grupo_pauta->detalles as $i => $detalles)
				<tr>
					<td style="padding-left: 15px;padding-bottom: 2px">{{ $count+1 }}.{{ $i+1 }}.- {{ $detalles->dp_descripcion }}</td>
					<td class="collapsing center aligned" style="font-size: 11px;padding-bottom: 2px">
						@if ($matricula->detallesConceptos != '[]')
							@foreach ($matricula->conceptos as $con)
								@if ($con->pivot->detallepauta_id == $detalles->dp_id)
									{{ $con->con_nombre }}
									@break
								@endif
							@endforeach
						@endif
					</td>
				</tr>
			@endforeach
		</tbody>
	@endforeach
</table>
<br>

<p style="font-size: 12px;"><b>Test aplicados y sus resultados:</b> ________________________________________________________________________________</p>

<p style="font-size: 12px;"><b>Observaciones:</b> ______________________________________________________________________________________________</p>



    <table class="center-div" style="font-size: 10px" style="width: 100%">
    	<thead>
    		<tr>
    			<th colspan="2" class="text-center"><ins>ESCALA CONCEPTUAL</ins></th>
    		</tr>
    	</thead>
        <tbody>
        	@foreach ($conceptos as $concepto)
	            <tr style="padding: 0;border:0;">
	                <td style="padding: 0;border:0;">{{ $concepto->con_nombre }}</td>
	                <td style="padding: 0;border:0;width: 100%">&nbsp;&nbsp;&nbsp;= {{ $concepto->con_descripcion }}</td>
	            </tr>
        	@endforeach
        </tbody>
    </table>

<br>
<table class="table ui" style="font-size: 11px;border: 0;">
    <thead>
        <tr>
            <td style="width: 33%;line-height: 1.5em;" class="center aligned">___________________________________ <br>
                {{-- strtoupper($matricula->curso->first()->profesorJefe->persona->nombreCompleto()) <br>--}}
            PROFESOR JEFE</td>
            <td style="width: 33%;line-height: 1.5em;" class="center aligned">___________________________________ <br>
                {{-- CRISTIAN RODRIGO RIVAS MONTES <br> --}}
            ORIENTADORA</td>
            <td style="width: 33%;line-height: 1.5em;" class="center aligned">___________________________________ <br>
                {{-- CRISTIAN RODRIGO RIVAS MONTES <br> --}}
            DIRECTOR</td>
        </tr>
    </thead>
</table>

<p style="font-size: 12px;margin: 0;" class="text-center">
    LOTA, <strong><ins>{{ date('d') }}</ins></strong> de <strong><ins>{{ date('M') }}</ins></strong> de <strong><ins>{{ date('Y') }}</ins></strong>.-/
</p>




</body>
</html>