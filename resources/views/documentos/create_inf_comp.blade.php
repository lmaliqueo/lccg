@extends('admin.template.main')

@section('title', 'Informe del Comportamiento Escolar')

@section('content')


	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="file alternate outline icon"></i>
					<i class="corner blue legal icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #2185D0;">
		        Informe del Comportamiento Escolar
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
        </div>
        

        </div>


<div class="animated fadeIn" id="content_lista" style="display: none;"></div>
    
<div id="body_inf" class="animated fadeIn" style="display: none;">
</div>



<script type="text/javascript">
    
$('.dropdown.curso').on('change', function(){
    var id = $(this).children('input').val();
    console.log(id);
    if(id != ''){
        $.ajax({
            url: "{{ route('documentos.list_alu') }}",
            type: 'post',
            data: {_token:token, id:id, tipo_inf:'comp'},
            success: function(response){
                $('#content_lista').html(response).show();
                $('.info_inputs').hide();
            }
        })
    }
})



    $(document).on('click', '.cancelar_button', function(){
        $('.info_inputs').show();
        $('#content_lista').hide();
        $('.dropdown.curso').dropdown('clear');
    })

    $(document).on('click', '.cancelar_inf', function(){
        $('#content_lista').show();
        $('#body_inf').hide();
    })

    $(document).on('click', '.view_comp', function(){
        var mat = $(this).attr('data-mat');
        $.ajax({
            url: "{{ route('documentos.view.informe_comportamiento') }}",
            type: 'post',
            data: {_token:token, mat:mat},
            success: function(response){
                $('#content_lista').hide();
                $('#body_inf').html(response).show();
            }
        })
    })



</script>


@endsection
