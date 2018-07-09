<!DOCTYPE html>
<html>
<head>
	<title>CALENDARIO DE ADMISIÓN</title>
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
                    <img style="width: 50px;padding-right: 30px;" src="{{ asset('img/') }}/{{ $periodo->liceo->lic_logo }}">
                </td>
            </tr>
        </thead>
    </table>

</body>
</html>