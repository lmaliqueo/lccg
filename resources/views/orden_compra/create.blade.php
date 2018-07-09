@extends('admin.template.main')

@section('title', 'Nuevo Orden de Compras')

@section('content')


	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="clipboard list icon"></i>
					<i class="corner yellow add icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
		        Crear Orden de Compra
			</span>
        </h2>
        <p>
            {{-- <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('articulos.index') }}"><i class="arrow left icon"></i> Volver</a> --}}
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('orden_compra.index') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>




	{!! Form::open(['route' => 'orden_compra.store', 'method'=>'POST', 'class'=>'ui form', 'id'=>'form']) !!}



	<div class="ui error message">
		<i class="close icon"></i>
		<div class="header">
			Error en el formulario
		</div>
		<ul class="list list_error">
		</ul>
	</div>

<div class="ui four top attached steps">
{{--   <div class="active step 1" id="step1">
      <i class="file icon " id="icon_step_1"></i>
      <div class="content">
        <div class="title">Orden de Compra</div>
        <div class="description">Datos de la orden</div>
      </div>
    </div>
   --}}
	<div class="active step 1" id="step1">
		<i class="shipping icon " id="icon_step_1"></i>
		<div class="content">
			<div class="title">Proveedor</div>
			<div class="description">Datos del Proveedor</div>
		</div>
	</div>
	<div class="disabled step 2" id="step2">
		<i class="cubes icon " id="icon_step_2"></i>
		<div class="content">
			<div class="title">Articulos</div>
			<div class="description">Datos de Apoderado</div>
		</div>
	</div>
	<div class="disabled step 3" id="step3">
		<i class="clipboard list icon " id="icon_step_3"></i>
		<div class="content">
			<div class="title">Orden de Compra</div>
			<div class="description">Datos de matricula</div>
		</div>
	</div>
</div>
{{-- <div class="ui attached segment animated fadeIn" id="step_1">
		<div class="field">
			{!! Form::label('orden_compra[oc_numero]', 'Numero OC') !!}
				
		</div>
		<div class="field">
			{!! Form::label('orden_compra[oc_fecha]', 'Fecha') !!}
				
		</div>
		<div class="field">
			{!! Form::label('orden_compra[oc_costo]', 'Costo Total') !!}
				
		</div>
		<div class="text-right">
			<a class="ui button blue button_next" posicion="1">Siguiente</a>
			
		</div>

</div>
 --}}
<div class="ui attached segment animated fadeIn secondary" id="step_1">
	<div class="segment raised ui">
	    <h4 class="ui horizontal divider header text-navy2">
	        <i class="icon shipping"></i>
	        Proveedor
	    </h4>
		<div class="field required">
			{!! Form::label('proveedor[prov_razon_social]', 'Razon social') !!}
			<div class="ui search fluid category focus proveedor">
				<div class="ui icon input">
					<input class="prompt proveedor" type="text" placeholder="" autocomplete="off" name="proveedor[prov_razon_social]">
					<i class="icon inverted red circular remove link icon_remove" id="remove_prov" style="display: none;"></i>
				</div>
			</div>
			{!! Form::hidden('proveedor[old_proveedor]', null, ['placeholder'=>'', 'class'=>'proveedor']) !!}
		</div>
		<div class="field required">
			{!! Form::label('proveedor[comuna_id]', 'Comuna') !!}
			{!! Form::select('proveedor[comuna_id]', $comunas, null, ['placeholder'=>'', 'class'=>'ui search dropdown proveedor']) !!}
		</div>
		<div class="field required">
			{!! Form::label('proveedor[prov_direccion]', 'Direccion') !!}
			{!! Form::text('proveedor[prov_direccion]', null, ['placeholder'=>'', 'class'=>'proveedor']) !!}
		</div>
		<div class="field required">
			{!! Form::label('proveedor[prov_contacto]', 'Contacto') !!}
			{!! Form::text('proveedor[prov_contacto]', null, ['placeholder'=>'', 'class'=>'proveedor', 'tipo-input'=>'number']) !!}
		</div>
	</div>

	<div class="text-right">
		<a class="ui button blue button_next" posicion="1" validate="{{ route('validate.validate_proveedor') }}">Siguiente</a>
		
	</div>

</div>
<div class="ui attached segment hide animated fadeIn secondary" id="step_2">
	<div class="segment ui raised">
	    <h4 class="ui horizontal divider header text-navy2">
	        <i class="icon list"></i>
	        Articulos
	    </h4>
		<div class="field" id="field_al_rut">
			{!! Form::label('items', 'Agregar Articulo') !!}
			<div class="ui search fluid category focus articulos">
				<div class="ui icon input">
					<i class="add icon"></i>
					<input class="prompt" type="text" placeholder="" autocomplete="off" name="agregar_articulos">
				</div>
			</div>
		</div>
		 <table class="ui table celled selectable">
			<thead>
				<tr>
					<th class="collapsing"><span style="padding-left: 20px; padding-right: 20px">Item Articulo</span></th>
					<th>Nombre</th>
					<th>Tipo</th>
					<th>Descripcion</th>
					<th>Costo</th>
					<th>Cantidad</th>
					<th></th>
				</tr>
			</thead>
			<tbody id="p_scents">
			</tbody>
		</table>
	</div>
	<div class="text-right">
		<a class="ui button basic button_after" posicion="2">Anterior</a>
		<a class="ui button blue button_next disabled" posicion="2" >Siguiente</a>
	</div>
</div>

<div class="ui attached segment hide animated fadeIn secondary" id="step_3">

	<div class="segment ui raised">
	    <h4 class="ui horizontal divider header text-navy2">
	        <i class="icon file text outline"></i>
	        Orden de Compra
	    </h4>
		<table class="table ui celled">
			<thead>
				<tr>
					<th style="width: 25%">Numero de Orden</th>
					<td style="width: 25%">
						<div class="ui labeled input">
							<label for="amount" class="ui label">#</label>
							{!! Form::number('orden_compra[oc_numero]', $num_oc, ['placheholder'=>'', 'min'=>1, 'required']) !!}
						</div>
					</td>
					<th style="width: 25%">Costo Total</th>
					<td style="width: 25%">
						<div class="ui labeled input">
							<label for="amount" class="ui label">$</label>
							{!! Form::text('orden_compra[oc_costo]', 0, ['placheholder'=>'', 'readonly']) !!}
						</div>
					</td>
				</tr>
				<tr>
					<th>Fecha</th>
					<td colspan="3">
						{!! Form::date('orden_compra[oc_fecha]', null, ['placheholder'=>'', 'max'=>date('Y-m-d'), 'required']) !!}
					</td>
				</tr>
			</thead>
		</table>
	</div>

	<div class="segment ui raised">
	    <h4 class="ui horizontal divider header text-navy2">
	        <i class="icon shipping"></i>
	        Proveedor
	    </h4>
		<table class="table ui celled">
			<thead>
				<tr>
					<th style="width: 25%">Razon Social</th>
					<td style="width: 25%" data-td="prov_razon_social"></td>
					<th style="width: 25%">Comuna</th>
					<td style="width: 25%" data-td="comuna_id"></td>
				</tr>
				<tr>
					<th>Dirección</th>
					<td data-td="prov_direccion"></td>
					<th>Contacto</th>
					<td data-td="prov_contacto"></td>
				</tr>
			</thead>
		</table>
	</div>

	<div class="segment ui raised">
	    <h4 class="ui horizontal divider header text-navy2">
	        <i class="icon list"></i>
	        Articulos
	    </h4>
		<table class="ui table celled">
			<thead>
				<tr>
					<th class="collapsing">Item Articulo</th>
					<th>Nombre</th>
					<th>Tipo</th>
					<th>Descripcion</th>
					<th>Costo</th>
					<th>Cantidad</th>
				</tr>
			</thead>
			<tbody id="ficha_items">
				{{-- 
				<tr>
					<td>{!! Form::number('item[1][item]', null, ['class'=>'form-control']) !!}</td>
					<td></td>
					<td></td>
					<td></td>
					<td>{!! Form::text('item[1][cantidad]', null, ['class'=>'form-control']) !!}</td>
					<td class="collapsing"><a class="ui button small negative" id="rem_trow">quitar</a></td>
				</tr> --}}
			</tbody>
		</table>
	</div>



	<div class="text-center">
		<a class="ui button basic button_after" posicion="3">Anterior</a>
		{!! Form::submit('Guardar', ['class'=>'ui button teal']) !!}
	</div>

</div>




	{!! Form::close() !!}
<div style="padding-bottom: 100px;"></div>

<script type="text/javascript">
	/**/ 
$(function() {
    var scntDiv = $('#p_scents');
    var i = $('#p_scents tr').length + 1;
    {{-- 
        $(document).on('click', '#add_trow', function() {
    		var count = $('#add_trow').attr('cont');
            $('<tr class="animated fadeInDown"><td><input class="form-control" name="item['+count+i+'][item]" type="number"></td><td></td><td></td><td></td><td><input class="form-control" name="item['+count+i+'][cantidad]" type="text"></td><td class="collapsing"><a class="ui button small negative" id="rem_trow">quitar</a></td></tr>').appendTo(scntDiv);
            i++;
            return false;
        });
        --}}
        $(document).on('click', '#rem_trow', function() { 
        	var tr = $(this).attr('tr_item');
        	$(this).parent().parent('tr').remove();
        	$('.tr_ficha_'+tr).remove();
        	{{-- 
        		$count = $('#add_trow').attr('cont');
        		$count++;
                if( i > 2 ) {
                	document.getElementById("add_trow").setAttribute('cont', $count)
                        $(this).parents('tr').remove();
                        i
                } --}}
                console.log(i)
			var cont = $('#p_scents tr').length;
            if(cont <= 0){
	    		$('a[posicion="2"]').addClass('disabled')
            }



                return false;
        });


    $(document).on('change', '.form-item', function() { 
		var tipo = $(this).attr('data-tipo');
		var item = $(this).parent().parent('tr').attr('tr_item');
		var val = $(this).val();
		var costo_total = 0;
		if(item == undefined){
			var item = $(this).parent().parent().parent('tr').attr('tr_item');
		}
		if(tipo == 'costo'){
			$.each($('input[data-tipo="costo"]'), function(index, value){
				costo_total += parseInt($(value).val());
			})
			$('input[name="orden_compra[oc_costo]"]').val(costo_total)
		}
		$('td[data-td="'+tipo+'_'+item+'"]').text(val);

	})
})

	var token = $('meta[name="csrf-token"]').attr('content');

	$(document).on('click', '.button_next', function(e){
		var posicion = $(this).attr('posicion');
		var actual = posicion;
		posicion++;
		var ruta = $(this).attr('validate');
		if(ruta != undefined){
			$.ajax({
				url: ruta,
				type:'post',
				dataType: 'json',
				data:$('form').serialize(),
				success: function(response){

					if(response.success == 1){

						$.each(response.data, function(index, value){
							console.log(value+'--'+index)
							if(index != 'comuna_id'){
								$('td[data-td="'+index+'"]').text(value);
							}else{
								var com= $('.dropdown').children('.text').text()
								$('td[data-td="'+index+'"]').text(com);
							}
						})


						step_actual = document.getElementsByClassName(actual);
						$(step_actual).addClass('completed').removeClass('active');

				    	step_siguiente = document.getElementsByClassName(posicion);
				    	$(step_siguiente).removeClass('disabled').addClass('active');


				    	segment_actual = document.getElementById('step_'+actual);
				    	$(segment_actual).addClass('hide');

				    	segment_siguiente = document.getElementById('step_'+posicion);
				    	//$(segment_siguiente).removeClass('hide');
				    	$('#step_'+posicion).removeClass('hide');

				    	$('.ui.form').removeClass('error')
				    	$('.field.error').removeClass('error');
					}else{
						if(response.tipo == 'prov'){
							$.each(response.errors, function(index, value){
				    			$('<li>'+value+'</li>').appendTo('.list_error')
								$('label[for="proveedor['+index+']"]').parent('.field').addClass('error');
							})
						}
				    	$('.ui.form').addClass('error')
				    	$('.error.message').removeClass('hidden')
					}

				}
			})
		}else{
			var error = 0;
			$.each($('.form-item'), function(index, value){
				if(!$(value)[0].checkValidity()){
					$(value)[0].reportValidity();
					console.log($(value)[0].validationMessage);
					error++;
				}
			})
			if(!error){
				$('.'+actual).addClass('completed').removeClass('active');
				$('.'+posicion).removeClass('disabled').addClass('active');
		    	$('#step_'+actual).addClass('hide');

		    	$('#step_'+posicion).removeClass('hide');

		    	if(posicion == $('.step').length){
		    		$.each($('input'), function(index, value){
		    			td = $(value).attr('name')
		    			if(td == undefined){
		    				td = $(value).parent('.dropdown').children('.text').text()
		    			}
		    		})
		    	}

			}
		}




	})
	$('.button_after').on('click', function(){
		var posicion = $(this).attr('posicion');
		var actual = posicion;
		posicion--;

		step_actual = document.getElementsByClassName(actual);
		$(step_actual).removeClass('active').addClass('disabled');

    	step_anterior = document.getElementsByClassName(posicion);
    	$(step_anterior).removeClass('completed').addClass('active');


    	segment_actual = document.getElementById('step_'+actual);
    	$(segment_actual).addClass('hide');

    	//segment_anterior = document.getElementById('step_'+posicion);
    	$('#step_'+posicion).removeClass('hide');


	})


$('.ui.search.articulos').search({

    //type          : 'category',
    cache		  : false,
    minCharacters : 1,
    //showNoResults : false,
    apiSettings   : {
        responseAsync: function (settings, callback) {


	    	var items = [];

	    	if($('.item_art') != ''){
		    	$.each($('.item_art'), function(index, value){
		    		items.push(value.value);
			    	//console.log(items)

		    	})

	    	}


                    var result;
                    var response = {
                        success: true   // docs say you need to return success: true
                    }
            $.ajax({
                url: '{{ route('autocomplete.search_articles') }}',
                type: "post",
                dataType: "json",
                data:{
                	_token:token, item:settings.urlData.query, items:items
                },
                success: function(ret){
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
		title   : 'item',
		description : 'nombre',
		price: 'tipo',
    },
    onSelect: function(result, response){


    var scntDiv = $('#p_scents');
    var item_ficha = $('#ficha_items')
    var tr = '<tr tr_item="'+result.model.art_item+'" class="animated fadeInDown"><td>'+result.model.art_item+'<input class="form-control item_art" name="item['+result.model.art_item+'][item]" type="hidden" value="'+result.model.art_item+'"></td><td>'+result.model.art_nombre+'</td><td>'+result.tipo+'</td><td>'+result.model.art_descripcion+'</td><td><div class="ui labeled input"><label for="amount" class="ui label">$</label><input class="form-item" data-tipo="costo" name="item['+result.model.art_item+'][costo]" type="number" value="0" min="0"></div></td><td><input class="form-item" name="item['+result.model.art_item+'][cantidad]" data-tipo="cantidad" type="number" value="1" min="1"></td><td class="collapsing"><a class="ui button small negative circular icon" id="rem_trow" tr_item="'+result.model.art_item+'"><i class="icon remove"></i></a></td></tr>';

    var tr_ficha = '<tr class="tr_ficha_'+result.model.art_item+'"><td>'+result.model.art_item+'<input class="form-control item_art" name="item['+result.model.art_item+'][item]" type="hidden" value="'+result.model.art_item+'"></td><td>'+result.model.art_nombre+'</td><td>'+result.tipo+'</td><td>'+result.model.art_descripcion+'</td><td data-td="costo_'+result.model.art_item+'">0</div></td><td data-td="cantidad_'+result.model.art_item+'">1</td></tr>';

    	$('a[posicion="2"]').removeClass('disabled')
    
            $(tr).appendTo(scntDiv);
            $(tr_ficha).appendTo(item_ficha);
    }
});



$('.ui.search.proveedor').search({

    cache		  : false,
    minCharacters : 1,
    showNoResults : false,
    apiSettings   : {
        responseAsync: function (settings, callback) {


	    	var items = [];


                    var result;
                    var response = {
                        success: true   // docs say you need to return success: true
                    }
            $.ajax({
                url: '{{ route('autocomplete.search_proveedor') }}',
                type: "post",
                dataType: "json",
                data:{
                	_token:token, razon:settings.urlData.query
                },
                success: function(ret){
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
		title   : 'nombre',
		description : 'descripcion',
		price: 'comuna',
    },
    onSelect: function(result, response){

    	$.each(result.model, function(index, value){
    		$('input[name="proveedor['+index+']"]').val(value);
    	})
    	$('#remove_prov').show();
    		$('.ui.dropdown.proveedor').dropdown('set selected', result.model.comuna_id);
	    	$('input[name="proveedor[prov_razon_social]"]').attr('readonly', 'true')
	    	$('input[name="proveedor[old_proveedor]"]').val(result.model.prov_id)

    }
});


$('.icon_remove').on('click', function(){
	$('.proveedor').val('');
	$('.ui.dropdown.proveedor').dropdown('clear')
	$(this).hide()
	$('input[name="proveedor[prov_razon_social]"]').removeAttr('readonly')
})


	
</script>


@endsection
