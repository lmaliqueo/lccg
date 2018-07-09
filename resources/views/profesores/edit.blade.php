@extends('admin.template.main')

@section('title', 'Modificar Profesor')

@section('content')

	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="male icon"></i>
					<i class="corner yellow pencil icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
		        Modificar Profesor - #{{ $profesor->pers_id }}
			</span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('profesores.admin') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>

    @if (count($errors) > 0)
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

<div class="segment ui raised">
            {!! Form::open(['route' => ['profesores.update', $profesor], 'method'=>'PUT', 'class'=>'ui form']) !!}
                <div class="field {{ ($errors->has('pe_rut')) ? 'error':'' }} required">
                    {!! Form::label('persona[pe_rut]', 'Rut') !!}
                    {!! Form::text('persona[pe_rut]', $profesor->persona_rut, ['placeholder'=>'', 'tipo-input'=>'rut']) !!}
                </div>
                <div class="fields">
                    <div class="eight wide field {{ ($errors->has('pe_nombres')) ? 'error':'' }}">
                        {!! Form::label('persona[pe_nombres]', 'Nombre') !!}
                        {!! Form::text('persona[pe_nombres]', $profesor->persona->pe_nombres, ['placeholder'=>'']) !!}
                        
                    </div>
                    <div class="four wide field {{ ($errors->has('pe_apellido_pat')) ? 'error':'' }}">
                        {!! Form::label('persona[pe_apellido_pat]', 'Apellido Paterno') !!}
                        {!! Form::text('persona[pe_apellido_pat]', $profesor->persona->pe_apellido_pat, ['placeholder'=>'']) !!}
                    </div>
                    <div class="four wide field {{ ($errors->has('pe_apellido_mat')) ? 'error':'' }}">
                        {!! Form::label('persona[pe_apellido_mat]', 'Apellido Materno') !!}
                        {!! Form::text('persona[pe_apellido_mat]', $profesor->persona->pe_apellido_mat, ['placeholder'=>'']) !!}
                    </div>
                </div>
                <div class="field {{ ($errors->has('pe_contacto')) ? 'error':'' }}">
                    {!! Form::label('persona[pe_contacto]', 'Contacto') !!}
                    {!! Form::text('persona[pe_contacto]', $profesor->persona->pe_contacto, ['placeholder'=>'', 'tipo-input'=>'number']) !!}
                </div>
            
                <div class="field {{ ($errors->has('especialidad')) ? 'error':'' }} required">
                    {!! Form::label('profesor[especialidad]', 'Especialidad') !!}
                    {!! Form::select('profesor[especialidad][]', $asignaturas, $profesor->especialidad->pluck('asig_id')->toArray(), ['class'=>'ui fluid multiple selection dropdown','placeholder'=>'', 'multiple']) !!}
                </div>

                <div class="field {{ ($errors->has('institucion')) ? 'error':'' }} required"">
                    {!! Form::label('profesor[institucion]', 'Institución') !!}

                    <div class="ui search fluid category focus" ruta_search="{{ route('autocomplete.search_inst') }}" tipo_search="inst" name_input="inst">
                        <div class="ui icon input">
                            <input class="prompt inst input block" type="text" placeholder="" autocomplete="off" name="profesor[nombre_inst]" value="{{ $profesor->institucion->inst_nombre }}" readonly="">
                            <i class="search icon inverted red circular remove link icon_search icon_remove" id="icon_search_cole_ant" style="" value="inst"></i>
                        </div>
                    </div>

{{-- 
                    {!! Form::text('profesor[institucion]', $profesor->institucion->inst_nombre, ['class'=>'']) !!}
 --}}
                    {!! Form::hidden('profesor[institucion_id]', $profesor->institucion_id, ['class'=>'']) !!}
                </div>
            
                <div class="field">
                    {!! Form::submit('Guardar', ['class'=>'ui button teal']) !!}
                </div>


            {!! Form::close() !!}

</div>
<script type="text/javascript">

$('.icon_remove').on('click', function(){
    $(this).parent('.input').children('input').removeAttr('readonly').val('');
    $('input[name="profesor[institucion_id]"]').val('')
    $(this).hide()
})



$('.ui.search').search({
    minCharacters : 1,
    showNoResults : false,
    apiSettings   : {
        responseAsync: function (settings, callback) {

            var ruta = $(this).attr('ruta_search');
            var tipo = $(this).attr('tipo_search');
            var result;
            var response = {
                success: true   // docs say you need to return success: true
            }
            $.ajax({
                url: ruta,
                type: "post",
                dataType: "json",
                data:{
                    _token:token, nombre:settings.urlData.query, tipo:tipo
                },
                success: function(ret){
                    result = ret;
                },
                complete: function(){
                    response.results = result;
                    callback (response);  // Important to call the callback!
                }
            })
        },
    },
    fields: {
        //results : 'items',
        title   : 'nombre',
        //description : 'nombre_comp',
    },
    onSelect: function(result, response){
        $('input[name="profesor[nombre_inst]"]').attr('readonly', '')
        $('input[name="profesor[institucion_id]"]').val(result.id)
        $(this).children('.ui.icon.input').children('.icon_remove').show();
    }
});

</script>


@endsection
