@extends('admin.template.main')

@section('title', 'Ensayos')

@section('content')


	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="book icon"></i>
					<i class="corner yellow circle check outline icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;" class="titulo_view animated fadeIn">
		        Ensayos PSU
			</span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('academico.index') }}"><i class="arrow left icon"></i> Volver</a>
            <span class="pull-right">
                <a class="button labeled icon ui teal small" href="{{ route('ensayos.psu.create') }}"><i class="plus icon"></i> Registrar Resultados</a>
                
            </span>
        </p>
	</p>


{{-- 
<div class="grid ui two column">
    <div class="column">
        <table class="ui table collapsing small">
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
                </tr>
            </thead>
        </table>
        
    </div>
</div>
 --}}

<div class="segment ui raised">


    <table class="table ui celled">
        <h4 class="ui horizontal divider header text-navy2">
            <i class="icon file alternate outline"></i>
            Ensayos PSU
        </h4>
        <thead>
            <tr>
                <th>ID</th>
                <th>Periodo</th>
                <th>Materia</th>
                <th>Fecha</th>
                <th>Cantidad Alumnos</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ensayos as $psu)
                <tr data-tr="{{ $psu->ens_id }}">
                    <td>{{ $psu->ens_id }}</td>
                    <td>{{ $psu->periodo->pac_ano }}</td>
                    <td>{{ $psu->materia->mens_nombre }}</td>
                    <td>{{ $psu->ens_fecha }}</td>
                    <td>{{ $psu->matriculas->count() }}</td>
                    <td class="collapsing">
                        <a class="ui button small circular teal icon modalButton" url="{{ route('ensayos.psu.view', ['id'=>$psu->ens_id]) }}" header="PSU: {{ $psu->materia->mens_nombre }} - {{ $psu->ens_fecha }}"><i class="eye icon"></i></a>
                        <a class="ui button small circular blue icon" href="{{ route('ensayos.psu.edit', $psu->ens_id) }}"><i class="pencil icon"></i></a>
                        <button data-ruta="{{ route('ensayos.delete') }}" data-mens_info="se borrara todos los puntajes de los alumnos relacinado a este ensayo" data-id="{{ $psu->ens_id }}" class="ui button small icon red circular btn-borrar"><i class="trash icon"></i></button>
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
