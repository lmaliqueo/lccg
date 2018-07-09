<html>

<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=Generator content="Microsoft Word 15 (filtered)">
<style>
<!--
 /* Font Definitions */
 @font-face
	{font-family:"Cambria Math";
	panose-1:2 4 5 3 5 4 6 3 2 4;}
@font-face
	{font-family:Calibri;
	panose-1:2 15 5 2 2 2 4 3 2 4;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:8.0pt;
	margin-left:0cm;
	line-height:107%;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";}
.MsoChpDefault
	{font-family:"Calibri","sans-serif";}
.MsoPapDefault
	{margin-bottom:8.0pt;
	line-height:107%;}
@page WordSection1
	{size:612.0pt 792.0pt;
	margin:70.85pt 3.0cm 70.85pt 3.0cm;}
div.WordSection1
	{page:WordSection1;}
-->
</style>

</head>

<body lang=ES-CL>
<br>
<div class=WordSection1>

<table class=MsoTable15Plain4 border=0 cellspacing=0 cellpadding=0 align=left
 width=654 style='width:490.2pt;border-collapse:collapse;margin-left:4.8pt;
 margin-right:4.8pt'>
 <tr style='height:91.65pt'>
  <td width=280 valign=top style='width:210.1pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:91.65pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:10.0pt'><b>REPUBLICA
  DE CHILE</b><br>
  ILUSTRE MUNICIPALIDAD DE LOTA<br>
  <b>DEPTO. DE EDUCACIÓN MUNICIPAL<br>
  LICEO POLIVALENTE</b><br>
  <u style="text-transform: uppercase;">“{{ $matricula->periodo->liceo->lic_nombre }}”<br>
  </u>SECRETARIA - DIRECCIÓN</span></p>
  </td>
  <td width=373 valign=top style='width:280.1pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:91.65pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'>                                                            
  <img width=76 height=98
  src="{{ asset('img/') }}/{{ $matricula->periodo->liceo->lic_logo }}" style="padding-top: 20px; padding-right: 20px;"></p>
  </td>
 </tr>
 <tr style='height:17.05pt'>
  <td width=280 valign=top style='width:210.1pt;background:#F2F2F2;padding:
  0cm 5.4pt 0cm 5.4pt;height:17.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b>&nbsp;</b></p>
  </td>
  <td width=373 valign=top style='width:280.1pt;background:#F2F2F2;padding:
  0cm 5.4pt 0cm 5.4pt;height:17.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b>Decreto Cooperador      &nbsp;N° {{ $matricula->periodo->liceo->lic_numero_resol_rec_ofic }}/81 &nbsp;</b></p>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b>Rol Base de Datos          N°
  004951-4</b></p>
  </td>
 </tr>
</table>
<p class=MsoNormal>&nbsp;</p>

<p class=MsoNormal>&nbsp;</p>

<p class=MsoNormal>&nbsp;</p>

<p class=MsoNormal align=center style='text-align:center'><b><u><span
style='font-size:16.0pt;line-height:107%'>CERTIFICADO DE ALUMNO REGULAR</span></u></b></p>

<p class=MsoNormal style='text-align:justify'><span style='font-size:12.0pt;
line-height:107%'>&nbsp;</span></p>
<br><br>
<p class=MsoNormal style='text-indent:35.4pt;line-height:150%'><span
style='font-size:12.0pt;line-height:150%'>El que suscribe, Director del Liceo
Polivalente “{{ $matricula->periodo->liceo->lic_nombre }}” {{ $matricula->periodo->liceo->num_lic() }} de Lota, certifica que Don (a): <strong><ins>{{ $matricula->alumno->nombreCompleto() }}</ins></strong>, es alumno (a) regular de este establecimiento educacional, donde
cursa el <strong><ins>{{ $matricula->curso->first()->parametros->pcur_grado }}</ins></strong> Año <strong><ins>“{{ $matricula->curso->first()->parametros->pcur_letra }}”</ins></strong>, según consta en el Libro de Registro General de
Matrícula con el N°<strong><ins>{{ $matricula->mat_numero }}</ins></strong> de fecha <strong><ins>{{ $matricula->mat_fecha_ingreso }}</ins></strong>, Año escolar <strong><ins>{{ $matricula->periodo->pac_ano }}</ins></strong>, de
la Enseñanza Media.</span></p>

<p class=MsoNormal style='line-height:150%'><span style='font-size:12.0pt;
line-height:150%'>Observaciones:
<ins>{{ $obs }}</ins></span></p>

<p class=MsoNormal style='line-height:150%'><span style='font-size:12.0pt;
line-height:150%'>                                                                                                                                                                                 </span></p>

<p class=MsoNormal style='line-height:150%'><span style='font-size:12.0pt;
line-height:150%'>Se entiende el presente certificado a solicitud expresa del
(de la) interesado (a) para los efectos de ser presentado en:
____________________________________________________________</span></p>

<p class=MsoNormal style='line-height:150%'><span style='font-size:12.0pt;
line-height:150%'>&nbsp;</span></p>

<p class=MsoNormal><span style='font-size:12.0pt;line-height:107%'>&nbsp;</span></p>

<p class=MsoNormal><span style='font-size:12.0pt;line-height:107%'>&nbsp;</span></p>
<br><br>
<br><br>
<br><br>
<br>
<table class=MsoTable15Plain4 border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse'>
 <tr style='height:47.25pt'>
  <td width=294 valign=top style='width:220.7pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:47.25pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:12.0pt'>&nbsp;</span></b></p>
  </td>
  <td width=294 valign=top style='width:220.7pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:47.25pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:12.0pt'>CRISTIAN
  RODRIGO RIVAS MONTES<br>
  DIRECTOR</span></b></p>
  </td>
 </tr>
 <tr>
  <td width=294 valign=top style='width:220.7pt;background:#F2F2F2;padding:
  0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt'>LOTA, <strong><ins>{{ date('d') }}</ins></strong> de <strong><ins>{{ date('M') }}</ins></strong> de <strong><ins>{{ date('Y') }}</ins></strong>.-/</span></p>
  </td>
  <td width=294 valign=top style='width:220.7pt;background:#F2F2F2;padding:
  0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:12.0pt'>&nbsp;</span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal>&nbsp;</p>

</div>

</body>

</html>


{{-- 
<!DOCTYPE html>
<html>
<head>
	<title>Certificado de Alumno Regular</title>
	<link rel="stylesheet" type="text/css" href="plugins/semantic/components/image.css">
	<link rel="stylesheet" type="text/css" href="plugins/semantic/components/container.css">
</head>

<style type="text/css">
	table{
		width: 100%;
	}
	td{
		width: 50%;
	}
</style>

<body>

<em>{{ date('Y-m-d') }}</em>
<hr>

<div class="ui container">
	<div style="text-align: right;">
	</div>
<table width="100%">
	<tr>
		<td width="20%"><img style="width: 80px" src="{{ asset('img/') }}/{{ $matricula->periodo->liceo->lic_logo }}"></td>
		<td width="80%">
			<h2>{{ $matricula->periodo->liceo->lic_nombre }}</h2>
			<p>{{ $matricula->periodo->liceo->lic_direccion.' - Rbd:'.$matricula->periodo->liceo->lic_rol_base_datos }}</p>
		</td>
	</tr>
</table>


	<br>
	<br>
	<div>
		<p>Decreto Cooperador N°: <br>
		Rol Base de Datos  N°: </p>
	</div>
	<div style="text-align: center">
		<h2>Certificado de Alumno Regular</h2>
	</div>
	<div>
		<p>El que suscribe. Director del Liceo Polivalente "{{ $matricula->periodo->liceo->lic_nombre }}" {{ $matricula->periodo->liceo->lic_numero }} de Lota. certifica que Don (a): <strong>{{ $matricula->alumno->nombreCompleto() }}</strong> es alumno (a) regular de este establecimiento educacional. donde cursa el {{ $matricula->curso->first()->parametros->pcur_grado }} año "{{ $matricula->curso->first()->parametros->pcur_letra }}", según consta en el Libro de Registro General de Matricula con el N° {{ $matricula->mat_numero }} de fecha {{ $matricula->mat_fecha_ingreso }}, Año Escolar {{ $matricula->periodo->pac_ano }}, de la Enseñanza Media
		<br>
		 Rut numero <strong>{{ $matricula->alumno_rut }}</strong></p>
	</div>
	<table width="100%">
		<tr>
			<td width="50%"><p>Inscrito con el N°: {{ $matricula->mat_numero }}</p></td>
			<td width="50%"><p>Del registro año: {{ $matricula->periodo->pac_ano }}</p></td>
		</tr>
	</table>
	<br>
	<br>
	<div>
		<p>Asiste regularmente a este establecimiento educacional, cursando actualmente :</p>
		<h4>{{ $matricula->curso->first()->nombreCurso() }}</h4>
	</div>
	
</div>
</body>
</html>

 --}}
