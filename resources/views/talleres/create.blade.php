@extends('admin.template.main')

@section('title', 'Crear Taller')

@section('content')

	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="edit icon"></i>
					<i class="corner yellow add icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
		        Nuevo Taller
			</span>
        </h2>
        <p>
            {{-- <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('talleres.index') }}"><i class="arrow left icon"></i> Volver</a> --}}
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('talleres.admin') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>

<div class="segment ui raised">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon cut"></i>
        Taller
    </h4>
			{!! Form::open(['route' => 'talleres.store', 'method'=>'POST', 'class'=>'ui form']) !!}

				<div class="field">
					{!! Form::label('periodo_id', 'Periodo') !!}
					{!! Form::select('periodo_id', $periodo_actual, null, ['class'=>'ui fluid search dropdown disabled']) !!}
				</div>

				<div class="field">
					{!! Form::label('taller_id', 'Taller') !!}
					{!! Form::select('taller_id', $talleres, null, ['class'=>'ui fluid search dropdown selection', 'placeholder'=>'']) !!}
				</div>

				<div class="field">
					{!! Form::label('aula_id', 'Aula') !!}
					{!! Form::select('aula_id', $aulas, null, ['class'=>'ui fluid search dropdown selection', 'placeholder'=>'']) !!}
				</div>
			<div class="segment secondary ui">
			    <h4 class="ui horizontal divider header text-navy2">
			        <i class="icon male"></i>
			        Profesor
			    </h4>
				<div class="fields two">
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


	    	var items = [];

	    	var tipo = $(this).attr('data-tipo');
                    var result;
                    var response = {
                        success: true   // docs say you need to return success: true
                    }
            $.ajax({
                url: '{{ route('autocomplete.search_profesor') }}',
                type: "post",
                //dataType: "json",
                data:{
                	_token:token, rut:settings.urlData.query, prof_taller:1, tipo:tipo
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
/*
    	$.each(result, function(index, value){
    		$('input[name="'+index+'"]').val(value);
    	})*/
    		$('input[name="profesor_id"]').val(result.prof_id);
    }
});


</script>



@endsection
