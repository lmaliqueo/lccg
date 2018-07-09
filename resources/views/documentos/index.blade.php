@extends('admin.template.main')

@section('title', 'Documentos')

@section('content')


<h2 class="ui center aligned icon header text-navy2" >
    <i class="circular file alternate  outline icon"></i>
        <span style="border-bottom: 5px solid #FCDD13;">
        Documentos
          
        </span>
    </h2>
<br>
<div class="ui four column centered grid" style="margin: 30px;">
    <div class="column center aligned">
        <a href="{{ route('documentos.cert_alu_reg') }}">
            <h3 class="ui icon grey header no-margin button_pulse">
                <i class=" student icon"></i>
                <div class="content">
                    Certificado de Alumno Regular

                    <div class="sub header">Generar certificado de alumno regular</div>
                </div>
            </h3>

        </a>
    </div>
    <div class="column center aligned">
        <a href="{{ route('documentos.informe_comportamiento') }}">
            <h3 class="ui icon grey header no-margin button_pulse">
                <i class=" legal icon"></i>
                <div class="content">
                    Informe del Comportamiento Escolar

                    <div class="sub header">Generar informe del comportamiento escolar de un alumno</div>
                </div>
            </h3>

        </a>
    </div>
    <div class="column center aligned">
        <a href="{{ route('documentos.cert_estudios') }}">
            <h3 class="ui icon grey header no-margin button_pulse">
                <i class=" book icon"></i>
                <div class="content">
                    Certificado Anual de Estudios

                    <div class="sub header">Generar certificado anual de estudios de un alumno</div>
                </div>
            </h3>

        </a>
    </div>
    <div class="column center aligned">
        <a href="{{ route('documentos.inf_notas_parciales') }}">
            <h3 class="ui icon grey header no-margin button_pulse">
                <i class=" table icon"></i>
                <div class="content">
                    Informe de Notas Parciales

                    <div class="sub header">Generar informe de notas parciales de un alumno</div>
                </div>
            </h3>

        </a>
    </div>
    <div class="column center aligned">
        <a href="{{ route('documentos.notas_curso') }}">
            <h3 class="ui icon grey header no-margin button_pulse">
                <i class=" edit outline icon"></i>
                <div class="content">
                    Informes de Notas por Curso

                    <div class="sub header">Generar informe de notas por curso</div>
                </div>
            </h3>

        </a>
    </div>
    <div class="column center aligned">
        <a href="{{ route('documentos.informe_asis') }}">
            <h3 class="ui icon grey header no-margin button_pulse">
                <i class=" calendar alternate outline icon"></i>
                <div class="content">
                    Informes de Asistencias por Curso

                    <div class="sub header">Generar documento de asistencias por curso</div>
                </div>
            </h3>
        </a>
    </div>
{{-- 
    <div class="column center aligned">
        <a href="{{ route('documentos.calendario_adm') }}">
            <h3 class="ui icon grey header no-margin button_pulse">
                <i class=" sign in icon"></i>
                <div class="content">
                    Calendario de Admisión

                    <div class="sub header">Generar nueva asignatura para el plan académico</div>
                </div>
            </h3>

        </a>
    </div>
     --}}
    <div class="column center aligned">
        <a href="{{ route('documentos.orden_compra') }}">
            <h3 class="ui icon grey header no-margin button_pulse">
                <i class=" clipboard list icon"></i>
                <div class="content">
                    Orden de Compra

                    <div class="sub header">Imprimir una orden de compra</div>
                </div>
            </h3>

        </a>
    </div>
    <div class="column center aligned">
        <a href="{{ route('documentos.facturas') }}">
            <h3 class="ui icon grey header no-margin button_pulse">
                <i class=" dollar icon"></i>
                <div class="content">
                    Factura

                    <div class="sub header">Imprimir una factura</div>
                </div>
            </h3>

        </a>
    </div>
</div>
	


@endsection
