@extends('admin.template.main')

@section('title', 'Certificado de Notas')

@section('content')


	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="file alternate outline icon"></i>
					<i class="corner blue book icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #2185D0;">
		        Certificado de Notas
			</span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('documentos.index') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>

        <div class="segment ui info_inputs animated fadeIn">
            <h4 class="ui horizontal divider header text-navy2">
                <i class="icon student"></i>
                Alumno
            </h4>
            {!! Form::open(['route' => 'documentos.print.cert_estudios', 'method'=>'POST', 'class'=>'ui form']) !!}

                    <div class="field">
                        <div class="ui selection dropdown periodo">
                            <input type="hidden" name="periodo_id" id="periodo">
                                <i class="dropdown icon"></i>
                            <div class="default text">Periodo</div>
                            <div class="menu">
                                @foreach ($periodos as $periodo)
                                    <div class="item" data-value="{{ $periodo->pac_id }}">{{ $periodo->pac_ano }}</div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                    {!! Form::hidden('periodo', null, null) !!}
        </div>

        <div class="text-center">
            <button class="ui button teal icon labeled"><i class="icon print"></i> Imprimir Documento</button>
        </div>


            {!! Form::close() !!}





<script type="text/javascript">
    
    var token = $('meta[name="csrf-token"]').attr('content');


    $('.periodo').on('change', function(){
        $('.accordion_options').addClass('hide');
        var periodo = $('#periodo').val();
        /*var nivel = $('#nivel').val();
        var letra = $('#letra').val();
        if(periodo != '' && nivel != '' && letra != '')*/
        if(periodo != '')
        {
            $('.ui.search').children().children('input').removeAttr('readonly');

        }else{
            //$('.curso_tr').removeClass('positive warning')
        }
    });


$('.dropdown_semestres').on('change', function(){
    $('.ui.search').children().children('input').removeAttr('readonly');
    var periodo = $(this).children('.text').text();
    console.log(periodo)
    $('td[data-alu="periodo"]').text(periodo);
})

    $('.cancelar_button').on('click', function(){
        $('.info_inputs').show();
        $('.info_matricula').hide();
        $('#content_taller').hide()
        $('.ins_inputs').hide()
        $('input[name="matricula[mat_id]"]').val('');
        $('input[name="alumno[nombre]"]').val('');
        $('input[name="mat_id"]').val('')
        $('#mensajes').hide().html('');
    })










</script>










@endsection
