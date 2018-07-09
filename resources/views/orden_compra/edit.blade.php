@extends('admin.template.main')

@section('title', 'Actualizar Orden de Compra')

@section('content')


	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="clipboard list icon"></i>
					<i class="corner yellow pencil icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
		        Actualizar Orden de Compra N° {{ $orden->oc_numero }}
			</span>
        </h2>
        <p>
            {{-- <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('articulos.index') }}"><i class="arrow left icon"></i> Volver</a> --}}
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('orden_compra.index') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>

{!! Form::open(['route' => ['orden_compra.update', $orden], 'method'=>'PUT', 'class'=>'ui form']) !!}
    <div class="ui raised segment">

        <h4 class="ui horizontal divider header text-navy2">
            <i class="icon clipboard outline"></i>
            Orden de Compra
        </h4>

        <table class="ui celled table">
            <thead>
                <tr>
                    <th style="width: 25%">N° Orden</th>
                    <td style="width: 25%">
                        <div class="field">
                            {!! Form::number('orden[oc_numero]', $orden->oc_numero, ['placheholder'=>'', 'required', 'min'=>1]) !!}
                        </div>
                    </td>
                    <th style="width: 25%">Fecha Orden</th>
                    <td style="width: 25%">
                        <div class="field">
                            {!! Form::date('orden[oc_fecha]', $orden->oc_fecha, ['placheholder'=>'', 'required', 'max'=>date('Y-m-d')]) !!}
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Proveedor</th>
                    <td>
                        <div class="field">
                            {!! Form::text('proveedor', $orden->proveedor->prov_razon_social, ['placheholder'=>'', 'required', 'readonly', 'class'=>'ui input focus proveedor']) !!}
                            {!! Form::hidden('proveedor[prov_id]', $orden->proveedor_id, ['placheholder'=>'', 'required', 'class'=>'proveedor']) !!}
                        </div>
                    </td>
                    <th>Costo Estimado</th>
                    <td>
                        <div class="field required">
                            {!! Form::number('orden[oc_costo]', $orden->oc_costo, ['placheholder'=>'', 'required', 'readonly']) !!}
                        </div>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                </tr>
            </tbody>
        </table>

        <div class="segment ui raised secondary">
            <h4 class="ui horizontal divider header text-navy2">
                <i class="icon shipping "></i>
                Proveedor
            </h4>
            <table class="table ui celled small">
                <thead>
                    <tr>
                        <th style="width: 25%">Razon Social</th>
                        <td style="width: 25%">
                            <div class="field">
                                <div class="ui search fluid category focus proveedor">
                                    <div class="ui icon input">
                                        <input class="prompt proveedor" type="text" placeholder="" autocomplete="off" name="proveedor[prov_razon_social]" value="{{ $orden->proveedor->prov_razon_social }}" readonly required>
                                        <i class="icon inverted red circular remove link icon_remove" id="remove_prov" {{-- style="display: none;" --}}></i>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <th style="width: 25%">Comuna</th>
                        <td style="width: 25%">
                            <div class="field">
                                {!! Form::select('proveedor[comuna_id]', $comunas, $orden->proveedor->comuna_id, ['placeholder'=>'', 'class'=>'ui search dropdown proveedor', 'required']) !!}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Dirección</th>
                        <td>
                            <div class="field">
                                {!! Form::text('proveedor[prov_direccion]', $orden->proveedor->prov_direccion, ['placeholder'=>'', 'class'=>'proveedor', 'required']) !!}
                            </div>
                        </td>
                        <th>Contacto</th>
                        <td>
                            {!! Form::text('proveedor[prov_contacto]', $orden->proveedor->prov_contacto, ['placeholder'=>'', 'class'=>'proveedor', 'required', 'tipo-input'=>'number', 'maxlength'=>9]) !!}
                        </td>
                    </tr>
                </thead>
            </table>
        </div>

    </div>
    <div class="ui raised segment">

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

        <table class="table ui celled">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Descripcion</th>
                    <th>Costo</th>
                    <th>Cantidad</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="p_scents">
                @foreach ($orden->lineasArticulos as $cont => $linea)
                    <tr tr-linea="{{ $linea->articulo_item }}">
                        <td>{{ $linea->articulo_item }}</td>
                        <td>{{ $linea->articulo->art_nombre }}</td>
                        <td>{{ $linea->articulo->tipo->tart_nombre }}</td>
                        <td>{{ $linea->articulo->art_descripcion }}</td>
                        <td>
                            <div class="field">
                                {!! Form::number('linea['.$linea->articulo_item.'][lart_costo]', $linea->lart_costo, ['placheholder'=>'', 'required', 'class'=>'form-item', 'data-tipo'=>'costo' ]) !!}
                            </div>
                        </td>
                        <td>
                            <div class="field">
                                {!! Form::number('linea['.$linea->articulo_item.'][lart_cantidad]', $linea->lart_cantidad, ['placheholder'=>'', 'required', 'min'=>$linea->cant_recibida(), 'data-tipo'=>'cantidad', 'class'=>'form-item']) !!}
                                {!! Form::hidden('linea['.$linea->articulo_item.'][lart_id]', $linea->lart_id, null) !!}
                                {!! Form::hidden('linea['.$linea->articulo_item.'][articulo_item]', $linea->articulo_item, ['class'=>'item_art']) !!}
                                {!! Form::hidden('linea['.$linea->articulo_item.'][state]', 1, null) !!}
                            </div>
                        </td>
                        <td class="collapsing"><a class="ui button small circular red icon remove_linea" data-tr="{{ $linea->articulo_item }}"><i class="remove icon"></i></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="field">
        {!! Form::submit('Guardar', ['class'=>'ui button teal']) !!}
    </div>
{!! Form::close() !!}





<script type="text/javascript">

    var token = $('meta[name="csrf-token"]').attr('content');




    $(document).on('change', '.form-item', function() { 
        var tipo = $(this).attr('data-tipo');
        var item = $(this).parent().parent('tr').attr('tr-linea');
        var val = $(this).val();
        var costo_total = 0;
        if(item == undefined){
            var item = $(this).parent().parent().parent('tr').attr('tr-linea');
        }
        if(tipo == 'costo'){
            $.each($('input[data-tipo="costo"]'), function(index, value){
                costo_total += parseInt($(value).val());
                //console.log(costo_total)
            })
            $('input[name="orden[oc_costo]"]').val(costo_total)
        }

    })



    $('.remove_linea').on('click', function(){
        var tr = $(this).attr('data-tr');
        $('tr[tr-linea="'+tr+'"]').hide();
        $('input[name="linea['+tr+'][state]"]').val(0);
    })

    $(document).on('click', '.remove_tr', function(){
        $(this).parent().parent('tr').remove();
    })

$('.ui.search.articulos').search({

    //type          : 'category',
    cache         : false,
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
    var tr = '<tr tr_item="'+result.model.art_item+'" class="animated fadeInDown"><td>'+result.model.art_item+'<input class="item_art" name="linea['+result.model.art_item+'][articulo_item]" type="hidden" value="'+result.model.art_item+'"></td><td>'+result.model.art_nombre+'</td><td>'+result.tipo+'</td><td>'+result.model.art_descripcion+'</td><td><div class="ui labeled input"><label for="amount" class="ui label">$</label><input class="form-item" data-tipo="costo" name="linea['+result.model.art_item+'][lart_costo]" type="number" value="0" min="0"></div></td><td><input class="form-item" name="linea['+result.model.art_item+'][lart_cantidad]" data-tipo="cantidad" type="number" value="1" min="1"></td><td class="collapsing"><a class="ui button small negative circular icon remove_tr" tr_item="'+result.model.art_item+'"><i class="icon remove"></i></a></td></tr>';

            $(tr).appendTo(scntDiv);
    }
});


$('.ui.search.proveedor').search({

    cache         : false,
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
            /*
            if(index == 'prov_id'){
                $('input[name="orden[proveedor_id]"]').val(value)
            }*/
            if(index == 'prov_razon_social'){
                $('input[name="proveedor"]').val(value)
            }
        })
        console.log(result.model.prov_id)
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

$('.icon_edit_prov').on('click', function(){

})

$('.prompt.proveedor').on('change', function(){
    var valor = $(this).val();
    $('input[name="proveedor"]').val(valor)
})



</script>








@endsection
