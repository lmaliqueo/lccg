@extends('admin.template.main')

@section('title', 'Informe de Notas Parciales')

@section('content')


    <p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
                    <i class="file alternate outline icon"></i>
                    <i class="corner blue table icon"></i>
                </i>
            </span>
            <span style="border-bottom: 4px solid #2185D0;">
                Informe de Notas Parciales
            </span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('documentos.index') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
    </p>
        <div class="ui form">
            
        <div class="segment raised ui info_inputs animated fadeIn">
            <h4 class="ui horizontal divider header text-navy2">
                <i class="icon edit outline"></i>
                Curso
            </h4>
        <table class="ui celled table small">
            <thead>
                <tr>
                    <th style="width: 25%">Periodo</th>
                    <td style="width: 25%">
                            <div class="ui selection dropdown buscar_curso">
                                <input type="hidden" name="periodo" id="periodo" value="{{ $periodos->where('pac_estado', 1)->first()->pac_id }}">
                                    <i class="dropdown icon"></i>
                                <div class="default text">Periodo</div>
                                <div class="menu">
                                    @foreach ($periodos as $periodo)
                                        <div class="item {{ ($periodo->pac_estado == 1) ? 'active':'' }}" data-value="{{ $periodo->pac_id }}">{{ $periodo->pac_ano }}</div>
                                    @endforeach
                                </div>
                            </div>
                    </td>
                    <th style="width: 25%">Curso</th>
                    <td style="width: 25%">
                            <div class="ui search selection dropdown curso">
                                <input type="hidden" name="curso" id="curso">
                                    <i class="dropdown icon"></i>
                                <div class="default text"></div>
                                <div class="menu menu_cursos">
                                    @foreach ($periodos->where('pac_estado', 1)->first()->cursos->where('cu_tipo', 1) as $curso)
                                        <div class="item" data-value="{{ $curso->cu_id }}">{{ $curso->nombreCurso() }}</div>
                                    @endforeach
                                </div>
                            </div>
                    </td>
                </tr>
            </thead>
        </table>





{{-- 
            <table class="table ui celled small">
                <thead>
                    <tr>
                        <th style="width: 25%">Periodo</th>
                        <td style="width: 25%">{{ $periodo->pac_ano }}</td>
                        <th style="width: 25%">Buscar Curso</th>
                        <td style="width: 25%">
                            <div class="ui selection dropdown search curso">
                                <input type="hidden" name="curso_id" id="curso">
                                    <i class="dropdown icon"></i>
                                <div class="default text">Curso</div>
                                <div class="menu">
                                    @foreach ($periodo->cursos->where('cu_tipo', 1) as $curso)
                                        <div class="item" data-value="{{ $curso->cu_id }}">{{ $curso->nombreCurso() }}</div>
                                    @endforeach
                                </div>
                            </div>

                            
                        </td>
                    </tr>
                </thead>
            </table>
 --}}


        </div>
        

        </div>



<div class="animated fadeIn" id="content_lista" style="display: none;"></div>

<div class="animated fadeIn" id="view_alu" style="display: none;"></div>





<script type="text/javascript">
    
    var token = $('meta[name="csrf-token"]').attr('content');


    $('.buscar_curso').on('change', function(){
        $('.accordion_options').addClass('hide');
        var periodo = $('#periodo').val();
        if(periodo != '')
        {
            $.ajax({
                url: '{{ route('ajax.buscar_curso') }}',
                type: 'post',
                dataType: "JSON",
                data: {_token:token, periodo:periodo/*, nivel:nivel, letra:letra*/ },
                success: function(response) {
                    $('.menu_cursos').html(response);
                    $('.dropdown_cursos').removeClass('disabled');
                }
            });

        }else{
            //$('.curso_tr').removeClass('positive warning')
        }
    });




$('.dropdown.curso').on('change', function(){
    var id = $(this).children('input').val();
    console.log(id);
    if(id != ''){
        $.ajax({
            url: "{{ route('documentos.list_alu') }}",
            type: 'post',
            data: {_token:token, id:id, tipo_inf:'notas'},
            success: function(response){
                $('#content_lista').html(response).show();
                $('.info_inputs').hide();
            }
        })
    }
})

$(document).on('click', '.view_notas', function(){
    var id = $(this).attr('data-mat')
    var sem = $(this).attr('data-sem')
    $.ajax({
        url: "{{ route('documentos.view.notas_parciales') }}",
        type: 'post',
        data:{_token:token, id:id, sem:sem},
        success: function(response){
            $('#content_lista').hide();
            $('#view_alu').html(response).show();
        }
    })
})


    $(document).on('click', '.cancelar_button', function(){
        $('.info_inputs').show();
        $('#content_lista').hide();
        $('.ins_inputs').hide()
        $('.dropdown.curso').dropdown('clear');
    })

    $(document).on('click', '.cancelar_view', function(){
        $('#content_lista').show();
        $('#view_alu').hide().html('');
    })









</script>










@endsection
