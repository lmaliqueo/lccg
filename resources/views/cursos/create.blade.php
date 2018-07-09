@extends('admin.template.main')

@section('title', 'Crear Curso')

@section('content')

	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="edit outline icon"></i>
					<i class="corner yellow add icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
		        Nuevo Curso
			</span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('cursos.index') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>

@if ($errors->any())
	<div class="ui error message">
		<i class="close icon"></i>
		<div class="header">
		Error en el formulario
		</div>
		<ul class="list list_error">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
		</ul>
	</div>
@endif

<div class="ui info visible message">
    <p><i class="icon info circle"></i> Los campos marcados con <span class="text-red">*</span> son obligatorios</p>
</div>

<div class="ui segment raised">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon edit"></i>
        Curso
    </h4>
	{!! Form::open(['route' => 'cursos.store', 'method'=>'POST', 'class'=>'ui form']) !!}

		<div class="field {{ ($errors->has('periodo_id')) ? 'error':'' }} ">
			{!! Form::label('periodo', 'Periodo') !!}
			{!! Form::select('periodo', $periodo_actual, null, ['class'=>'ui fluid search dropdown disabled', 'readonly'=>true]) !!}
			{!! Form::hidden('periodo_id', $per_id->pac_id, null) !!}
		</div>

		<div class="two fields required {{ ($errors->has('parametro_id')) ? 'error':'' }}">
			<div class="field">
				{!! Form::label('parametro_curso', 'Grado') !!}
				{!! Form::select('parametro_grado', [1=>'1°', 2=>'2°', 3=>'3°', 4=>'4°'], null, ['class'=>'ui fluid search dropdown selection required', 'placeholder'=>'', 'id'=>'grado', ]) !!}
				
			</div>
			<div class="field">
				{!! Form::label('parametro_id', 'Letra') !!}

				<div class="ui selection dropdown dropdown_param disabled required">
					<input type="hidden" name="parametro_id" required>
						<i class="dropdown icon"></i>
					<div class="default text"></div>
					<div class="menu menu_param">
					</div>
				</div>

			</div>
		</div>

		<div class="fields two">
			<div class="field required {{ ($errors->has('plan_estudio_id')) ? 'error':'' }}">
				{!! Form::label('plan_estudio_id', 'Plan de Estudio') !!}

				<div class="ui selection dropdown dropdown_planes disabled" required>
					<input type="hidden" name="plan_estudio_id" required>
						<i class="dropdown icon"></i>
					<div class="default text"></div>
					<div class="menu menu_planes">
					</div>
				</div>

			</div>

			<div class="field">
				{!! Form::label('aula_id', 'Aula') !!}
				{!! Form::select('aula_id', $aulas, null, ['class'=>'ui fluid search dropdown selection', 'placeholder'=>'']) !!}
			</div>
			
		</div>

		<div class="segment ui secondary">
		    <h4 class="ui horizontal divider header text-navy2">
		        <i class="icon male"></i>
		        Profesor
		    </h4>
			<div class="fields two required">
				<div class="field">
					{!! Form::label('profesor_id', 'Rut') !!}
					{!! Form::hidden('profesor_id', null, null) !!}
					<div class="ui search fluid category focus proveedor" data-tipo="rut">
						<div class="ui icon input">
							<input class="prompt proveedor" type="text" placeholder="Buscar Profesor" autocomplete="off" name="rut_profesor" required>
							<i class="search icon"></i>
						</div>
					</div>
				</div>
				<div class="field">
					{!! Form::label('nombres_prof', 'Nombre') !!}
					<div class="ui search fluid category focus proveedor" data-tipo="nom">
						<div class="ui icon input">
							<input class="prompt proveedor" type="text" placeholder="Buscar Profesor" autocomplete="off" name="nom_profesor" required>
							<i class="search icon"></i>
						</div>
					</div>
				</div>
			</div>
		</div>




		<div class="field">
			{!! Form::submit('Guardar', ['class'=>'ui button teal']) !!}
		</div>


	{!! Form::close() !!}
</div>


<script type="text/javascript">

	var token = $('meta[name="csrf-token"]').attr('content');


$('.ui.search').search({

    cache		  : false,
    minCharacters : 1,
    showNoResults : true,
    apiSettings   : {
        responseAsync: function (settings, callback) {

        	var tipo = $(this).attr('data-tipo');
	    	var items = [];


                    var result;
                    var response = {
                        success: true   // docs say you need to return success: true
                    }
            $.ajax({
                url: '{{ route('autocomplete.search_profesor') }}',
                type: "post",
                //dataType: "json",
                data:{
                	_token:token, rut:settings.urlData.query, prof_jefe:1, tipo:tipo
                },
                success: function(ret){
                	$('#prob').html(ret)
                    result = ret;
                },
                complete: function(){
			        var
			          response = {
			            results : {}
			          }
			        ;

                    response.results = result;
                    callback (response);  // Important to call the callback!


                }
            })
        },
    },
    fields: {
		//results : 'results',
		title   : 'title',
		description : 'description',
		//price: 'comuna',
    },
    onSelect: function(result, response){
    	if(result.tipo == 'rut'){
    		$('input[name="nom_profesor"]').val(result.description)
    	}else{
    		$('input[name="rut_profesor"]').val(result.description)
    	}
    	$('input[name="profesor_id"]').val(result.prof_id)
    }
});


	$('#grado').on('change', function(){
		var grado = $(this).val();

		    $.ajax({
		        url: '{{ route('curso.ajax.buscar_param') }}',
		        type: 'post',
		        dataType: "JSON",
		        data: {_token:token, grado:grado/*, nivel:nivel, letra:letra*/ },
		        success: function(response) {
		        	//$('.dropdown_semestres').removeClass('disabled');
		        	if(response.data != ''){
			        	$('.menu_param').html(response.data);
				    	$('.dropdown_param').removeClass('disabled').dropdown('clear');
		        	}else{
				    	$('.dropdown_param').addClass('disabled').dropdown('clear');
		        	}
		        	if(response.planes != ''){
			        	$('.menu_planes').html(response.planes);
				    	$('.dropdown_planes').removeClass('disabled').dropdown('clear');
		        	}else{
				    	$('.dropdown_planes').addClass('disabled').dropdown('clear');
		        	}
		        	//$('.curso_tr').addClass('positive').removeClass('warning')
		        }
		    });
	})



</script>



@endsection
