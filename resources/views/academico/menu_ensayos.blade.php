@extends('admin.template.main')

@section('title', 'Ensayos')

@section('content')


	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="book icon"></i>
					<i class="corner teal checkmark box icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #00B5AD;" class="titulo_view animated fadeIn">
		        Ensayos PSU
			</span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('academico.index') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>

<div id="info_inputs">
    <div class="ui segment raised secondary animated fadeIn">
        <table class="ui table collapsing">
            <thead>
                <tr>
                    <th>Periodo</th>
                    <td class="collapsing">
                            <div class="ui selection dropdown">
                                <input type="hidden" name="periodo" id="periodo">
                                    <i class="dropdown icon"></i>
                                <div class="default text">Periodo</div>
                                <div class="menu">
                                    @foreach ($periodos as $periodo)
                                        <div class="item" data-value="{{ $periodo->pac_id }}">{{ $periodo->pac_ano }}</div>
                                    @endforeach
                                </div>
                            </div>
                    </td>
                    {{-- 
                    <th>Tipo Ensayo</th>
                    <td class="collapsing">
                        <div class="ui selection dropdown menu_ensayos">
                            <input type="hidden" name="ensayo" id="ensayo">
                                <i class="dropdown icon"></i>
                            <div class="default text"></div>
                            <div class="menu menu_ensayos">
                                @foreach ($tipos as $tipo)
                                    <div class="item" data-value="{{ $tipo->ten_id }}">{{ $tipo->ten_tipo }}</div>
                                @endforeach
                            </div>
                        </div>
                    </td>
                     --}}
                </tr>
            </thead>
        </table>
        
    </div>
    
</div>




<div class="segment ui raised">
    <table class="table ui celled">
        <thead>
            <tr>
                <th>ID</th>
                <th>Periodo</th>
                <th>Materia</th>
                <th>Fecha</th>
                <th>Cursos</th>
                <th>Cantidad Alumnos</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pruebas_simces as $simce)
                <tr>
                    <td>{{ $simce->ens_id }}</td>
                    <td>{{ $simce->periodo->pac_ano }}</td>
                    <td>{{ $simce->materia->mens_nombre }}</td>
                    <td>{{ $simce->ens_fecha }}</td>
                    <td>{{ $simce->ens_grado_curso }}</td>
                    <td>{{ $simce->matriculas->count() }}</td>
                    <td class="collapsing">
                        <a class="ui button circular teal icon modalButton" url="{{ route('ensayos.simce.view', ['id'=>$simce->ens_id]) }}" header="SIMCE: {{ $simce->materia->mens_nombre }} - {{ $simce->ens_fecha }}"><i class="list icon"></i></a>
                        <a class="ui button circular blue icon"><i class="pencil icon"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>



<div id="body_ensayo" class="animated fadeInUp" style="display: none;"></div>



<script type="text/javascript">
    var token = $('meta[name="csrf-token"]').attr('content');



    $('.menu_ensayos').on('change', function(){
        var tipo = $('#ensayo').val();
        var periodo = $('#periodo').val();
        $.ajax({
            url: '{{ route('academico.admin_ensayos') }}',
            type: 'post',
            data: {_token:token, tipo:tipo, periodo:periodo},
            success: function(response){
                $('#body_ensayo').html(response);
                $('#body_ensayo').show();
                $('#info_inputs').hide();
            }
        })
    })











{{-- ##################################################### --}}
    $('.buscar_curso').on('change', function(){
        $('.dropdown_cursos').removeClass('disabled');
        var ensayo = $(this).val();
        var periodo = $('#periodo').attr('value');
        $.ajax({
            url: '{{ route('ajax.search_ensayo_cursos') }}',
            type: 'post',
            dataType: 'json',
            data: {_token:token, ensayo:ensayo, periodo:periodo},
            success: function(response){
                $('.menu_cursos').html(response);
            }
        })
    })


    $('.dropdown_cursos').on('change', function(){
        $('.rut_alumno').removeClass('disabled');
    })
    $('.open_form').on('click', function(){
        $(this).hide();
        var mat = $('#alu_id').text();
        var ensayo = $('#ensayo').val();
        $.ajax({
            url: '{{ route('academico.form_ensayos') }}',
            type: 'post',
            data: {_token:token, mat_id:mat, ensayo:ensayo},
            success: function(response){
                $('#body_ensayo').html(response);
                $('#body_ensayo').show();
            }
        })
    })


</script>

@endsection
