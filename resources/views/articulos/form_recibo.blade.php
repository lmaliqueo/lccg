



	@if ($ordencompra->oc_estado != 1)
		{!! Form::open(['route' => 'recibo.store', 'method'=>'POST', 'class'=>'ui form']) !!}

	@else

	<div class="ui success message">
		<div class="header">Orden Finalizado</div>
		<p>La orden seleccionada no tiene lineas de ordenes pendientes</p>
	</div>

	@endif



<div class="ui raised segment">

    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon clipboard list"></i>
        Orden de Compra
    </h4>
	<a class="ui red right corner label" id="back_btn">
		<i class="remove icon"></i>
	</a>

	<table class="ui celled table">
		<thead>
			<tr>
				<th>N° Orden</th>
				<th>Proveedor</th>
				<th>Estado</th>
				<th>Fecha Orden</th>
				<th>Costo Estimado</th>
				@if ($ordencompra->oc_estado == 1)
					<th>Costo Total</th>
				@endif
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					{{ $ordencompra->oc_numero }}
				</td>
				<td>
					{{ $ordencompra->proveedor->prov_razon_social }}
				</td>
				<td>
					{{ $ordencompra->oc_estado }}
				</td>
				<td>
					{{ $ordencompra->oc_fecha }}
				</td>
				<td><i class="icon dollar"></i>{{ $ordencompra->oc_costo }}</td>
				@if ($ordencompra->oc_estado == 1)
					<td><i class="icon dollar"></i>{{ $ordencompra->costo_total() }}</td>
				@endif
			</tr>
		</tbody>
	</table>

</div>

	<div class="ui raised segment">
	@if ($ordencompra->oc_estado != 1)

		    <h4 class="ui horizontal divider header text-navy2">
		        <i class="icon file text"></i>
		        Recibo
		    </h4>

	    	<table class="ui celled table">
	    		<thead>
					<th style="width: 33%">N° Factura</th>
					<th style="width: 33%">Fecha Recibo</th>
	    			<th style="width: 33%">Costo Total</th>
	    		</thead>
	    		<tbody>
	    			<tr>
						<td>
							{!! Form::number('factura[fac_numero]', null, ['placheholder'=>'', 'required', 'min'=>1]) !!}
						</td>
						<td>
							{!! Form::date('factura[fac_fecha]', null, ['placheholder'=>'', 'required', 'max'=>date('Y-m-d'), 'min'=>$ordencompra->oc_fecha]) !!}
						</td>
						<td>
							{!! Form::text('factura[fac_costo_total]', 0, ['placheholder'=>'', 'readonly'=>true, 'required']) !!}
						</td>
	    			</tr>
	    		</tbody>
	    	</table>

							{!! Form::hidden('factura[orden_id]', $ordencompra->oc_id, ['placheholder'=>'']) !!}

        <div class="segment ui secondary">
            <h4 class="ui horizontal divider header text-navy2">
                <i class="icon user"></i>
                Responsable
            </h4>
            <table class="table small ui">
                <thead>
                    <tr>
                        <th>Rut</th>
                        <th>Nombre</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="field">
                                {!! Form::hidden('factura[responsable_id]', null, null) !!}
                                <div class="ui search responsable fluid category focus" data-tipo="rut">
                                    <div class="ui input">
                                        <input class="prompt" type="text" placeholder="Buscar Responsable" autocomplete="off" name="rut_responsable" required>
                                    </div>
                                </div>
                            </div>
                            
                        </td>
                        <td>
                            <div class="field">
                                <div class="ui search responsable fluid category focus" data-tipo="nom">
                                    <div class="ui input">
                                        <input class="prompt" type="text" placeholder="Buscar Responsable" autocomplete="off" name="nom_responsable" required>
                                    </div>
                                </div>
                            </div>
                            
                        </td>
                        <td class="collapsing">
                            
                            <a class="button ui twitter small icon clean_resp disabled"><i class="icon delete"></i></a>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
        </div>


	@endif



	    <h4 class="ui horizontal divider header text-navy2">
	        <i class="icon cubes"></i>
	        Artículos
	    </h4>


		<table class="ui table celled structured">
			<thead>
				<tr>
					<th rowspan="2">Item</th>
					<th rowspan="2">Artículo</th>
					<th rowspan="2">Tipo</th>
					<th class="center aligned" colspan="2">Cantidad</th>
					<th class="center aligned" colspan="2">Costo</th>
					@if ($ordencompra->oc_estado != 1)
						<th class="center aligned" colspan="3">Recepción</th>
					@endif
				</tr>
					<th class="center aligned">Orden</th>
					<th class="center aligned">Recepción</th>
					<th class="center aligned">Orden</th>
					<th class="center aligned">Recepción</th>
					@if ($ordencompra->oc_estado != 1)
						<th style="width: 17%" class="center aligned">Cantidad</th>
						<th style="width: 17%" class="center aligned">Costo</th>
						<th></th>
					@endif
				<tr>
					
				</tr>
			</thead>
			<tbody>
			@foreach ($ordencompra->lineasArticulos as $cont => $linea)
				@if ($linea->lart_cantidad == $linea->cant_recibida() && $ordencompra->oc_estado != 1)
				<tr class="disabled positive">

				@else
				<tr>
				@endif
					<td>{{ $linea->articulo_item }}</td>
					<td>{{ $linea->articulo->art_nombre }}</td>
					<td>
						{{ $linea->articulo->tipo->tart_nombre }}
					</td>
					<td class="center aligned warning">
						{{ $linea->lart_cantidad }}
					</td>
					<td class="center aligned positive">{{ $linea->cant_recibida() }}</td>
					<td class="center aligned warning">
						<i class="icon dollar"></i>{{ $linea->lart_costo }}
					</td>
					<td class="center aligned positive">
						<i class="icon dollar"></i>{{ $linea->costo_recibo() }}
					</td>
					@if ($ordencompra->oc_estado != 1)
					{{--
						<td>
							{!! Form::number('recibo['.$cont.'][cantidad]', null, ['placheholder'=>'Cantidad', 'min'=>0, 'max'=>($linea->lart_cantidad - $linea->cant_recibida()), 'class'=>'cantidad_input', 'data-tr'=>$cont]) !!}
						</td>
						<td>

							{!! Form::number('recibo['.$cont.'][costo]', null, ['placheholder'=>'Costo', 'min'=>0, 'class'=>'costo_input', 'data-tr'=>$cont, 'data-tipo'=>'costo', 'disabled']) !!}
							{!! Form::hidden('recibo['.$cont.'][linea_id]', $linea->lart_id, null) !!}
						</td>  --}}
						<td data-cant></td>
						<td data-cost></td>
						<td class="collapsing">
							@if ($linea->lart_cantidad != $linea->cant_recibida())
								<a class="button ui small green icon circular btn_linea" data-linea="{{ $linea->lart_id }}" data-max="{{ $linea->lart_cantidad - $linea->cant_recibida() }}" state="1"><i class="icon plus"></i></a>
							@endif
						</td>
					@endif
				</tr>
			@endforeach
			</tbody>
		</table>
</div>

	@if ($ordencompra->oc_estado != 1)
		<div class="field">
			{!! Form::submit('Guardar', ['class'=>'ui button teal']) !!}
		</div>
	{!! Form::close() !!}

	@endif

<script type="text/javascript">
$('.dropdown').dropdown()


$(document).on('click', '.btn_linea', function(){
	var state = $(this).attr('state');
	var id = $(this).attr('data-linea');
	var max = $(this).attr('data-max');
	var td = $(this).parent('td');
	td_cant = $(this).parents('tr').children('td[data-cant]');
	td_cost = $(this).parents('tr').children('td[data-cost]');

	if(state == 1){
	    $('<input type="number" name="recibo['+id+'][cantidad]" max="'+max+'" min="1" value="1" required>').appendTo(td_cant);
	    $('<input type="number" name="recibo['+id+'][costo]" min="0" value="0" class="costo_input" data-tipo="costo" required><input type="hidden" name="recibo['+id+'][linea_id]" value="'+id+'">').appendTo(td_cost);
		$(this).removeClass('green').addClass('red');
		$(this).children('i').removeClass('add').addClass('remove');
		$(this).attr('state', 0)
	}else{
		$(td_cant).html('')
		$(td_cost).html('')
		$(this).removeClass('red').addClass('green');
		$(this).children('i').removeClass('remove').addClass('add');
		$(this).attr('state', 1)
	}
})



$('.ui.search.responsable').search({

    cache         : false,
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
                url: '{{ route('autocomplete.search_responsable') }}',
                type: "post",
                dataType: "json",
                data:{
                    _token:token, rut:settings.urlData.query, tipo:tipo
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
        title   : 'rut',
        description : 'nombre',
        price: 'cargo',
    },
    onSelect: function(result, response){
        if(result.tipo == 'rut'){
            $('input[name="nom_responsable"]').val(result.description)
        }else{
            $('input[name="rut_responsable"]').val(result.description)
        }
        $('.search.responsable').children().children('input').attr('readonly', true)
    	$('input[name="factura[responsable_id]"]').val(result.id);
    	$('.clean_resp').removeClass('disabled')
    }
});

	$('.clean_resp').on('click', function(){
        $('input[name="nom_responsable"]').val('').removeAttr('readonly')
        $('input[name="rut_responsable"]').val('').removeAttr('readonly')
	})

/*
	$('.cantidad_input').on('change', function(){
		var valor = $(this).val();
		if(valor > 0){
			var tr = $(this).attr('data-tr');
			$('input[name="recibo['+tr+'][costo]"]').removeAttr('disabled').val(0)
		}
	})
*/
	$(document).on('change', '.costo_input', function(){
		var val = $(this).val();
			var costo_total = 0;
			$.each($('input[data-tipo="costo"]'), function(index, value){
				if($(value).val() != ''){
					costo_total += parseInt($(value).val());
				}
			})
			console.log(costo_total);
			$('input[name="factura[fac_costo_total]"]').val(costo_total);
	})

    $('#back_btn').on('click', function(){
        $(this).hide();
        $('#form_recibo').hide();
        $('.buscar_oc').show();
        $('input[name="orden_compra"]').val('');
    })



</script>

