@extends('admin.template.main')

@section('title', 'Actualizar Factura')

@section('content')


	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="file text outline icon"></i>
					<i class="corner yellow pencil icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
		        Actualizar Factura N° {{ $factura->fac_numero }}
			</span>
        </h2>
        <p>
            {{-- <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('articulos.index') }}"><i class="arrow left icon"></i> Volver</a> --}}
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('facturas.index') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>

{!! Form::open(['route' => ['facturas.update', $factura], 'method'=>'PUT', 'class'=>'ui form']) !!}


    <div class="segment ui raised">
        <h4 class="ui horizontal divider header text-navy2">
            <i class="icon dollar"></i>
            Factura
        </h4>


        <table class="table ui celled">
            <thead>
                <tr>
                    <th style="width: 25%">Numero Factura</th>
                    <td style="width: 25%">{!! Form::number('factura[fac_numero]', $factura->fac_numero, ['min'=>1, 'required']) !!}</td>
                    <th style="width: 25%">Fecha</th>
                    <td style="width: 25%">{!! Form::date('factura[fac_fecha]', $factura->fac_fecha, ['min'=>$factura->orden->oc_fecha, 'max'=>date('Y-m-d'), 'required']) !!}</td>
                </tr>
                <tr>
                    <th>Numero OC</th>
                    <td>
                        {!! Form::hidden('factura[orden_id]', $factura->orden_id, null) !!}
                        {!! Form::text('numero_orden', $factura->orden->oc_numero, ['readonly']) !!}
                    </td>
                    <th>Costo</th>
                    <td>{!! Form::text('factura[fac_costo_total]', $factura->fac_costo_total, ['readonly']) !!}</td>
                </tr>
            </thead>
        </table>

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
                                {!! Form::hidden('factura[responsable_id]', $factura->responsable_id, null) !!}
                                <div class="ui search fluid category focus" data-tipo="rut">
                                    <div class="ui input">
                                        <input readonly class="prompt" type="text" placeholder="Buscar Responsable" autocomplete="off" name="rut_responsable" value="{{ $factura->responsable->persona_rut }}" required>
                                    </div>
                                </div>
                            </div>
                            
                        </td>
                        <td>
                            <div class="field">
                                <div class="ui search fluid category focus" data-tipo="nom">
                                    <div class="ui input">
                                        <input readonly class="prompt" type="text" placeholder="Buscar Responsable" autocomplete="off" value="{{ $factura->responsable->persona->nombreCompleto() }}" name="nom_responsable" required>
                                    </div>
                                </div>
                            </div>
                            
                        </td>
                        <td class="collapsing">
                            
                            <a class="button ui twitter small icon clean_resp"><i class="icon delete"></i></a>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
        </div>

    </div>

    <div class="segment ui raised">
        <h4 class="ui horizontal divider header text-navy2">
            <i class="icon list"></i>
            Lineas Articulo
        </h4>
        <table class="table ui celled">
            <thead>
                <tr>
                    <th style="width: 25%">Item</th>
                    <th style="width: 25%">Artículo</th>
                    <th style="width: 25%">Cantidad</th>
                    <th style="width: 25%">costo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($factura->orden->lineasArticulos as $linea)
                    @php
                        $recibo = $factura->recibos->where('linea_id', $linea->lart_id)->first();
                    @endphp
                    <tr data-tr="{{ $linea->lart_id }}">
                        <td class="td_blocking {{ ($recibo != null) ? '':'disabled' }}">{{ $linea->articulo_item }}</td>
                        <td class="td_blocking {{ ($recibo != null) ? '':'disabled' }}">{{ $linea->articulo->art_nombre }}</td>
                        @if ($recibo != null)
                            <td>
                                <div class="field">
                                    {!! Form::hidden('linea_rec['.$recibo->linea_id.'][rec_id]', $recibo->rec_id, ['required']) !!}
                                    {!! Form::number('linea_rec['.$recibo->linea_id.'][rec_cantidad]', $recibo->rec_cantidad, ['required', 'class'=>'input_blocking', 'min'=>1, 'max'=>( $linea->lart_cantidad - $linea->cant_recibida() + $recibo->rec_cantidad )]) !!}
                                </div>

                            </td>
                            <td>
                                <div class="field">
                                    {!! Form::number('linea_rec['.$recibo->linea_id.'][rec_costo]', $recibo->rec_costo, ['class'=>'input_blocking', 'required', 'min'=>0]) !!}
                                </div>
                            </td>
                        @else
                            <td>
                                <div class="field">
                                    {!! Form::hidden('linea_rec['.$linea->lart_id.'][linea_id]', $linea->lart_id, ['required', 'class'=>'input_blocking', 'disabled']) !!}
                                    {!! Form::number('linea_rec['.$linea->lart_id.'][rec_cantidad]', null, ['disabled', 'class'=>'input_blocking', 'min'=>1, 'max'=>($linea->lart_cantidad - $linea->cant_recibida())]) !!}
                                </div>
                            </td>
                            <td>
                                <div class="field">
                                    {!! Form::number('linea_rec['.$linea->lart_id.'][rec_costo]', null, ['disabled', 'data-tr'=>$linea->lart_id, 'class'=>'input_blocking', 'min'=>0]) !!}
                                </div>
                            </td>
                        @endif
                        <td class="collapsing">
                            <a class="button ui small blue circular icon unblock_tr" {{ ($recibo != null) ? 'style=display:none;':'' }} data-tr="{{ $linea->lart_id }}"><i class="icon pencil"></i></a>
                            <a class="button ui small red circular icon block_tr" {{ ($recibo != null) ? '':'style=display:none;' }} data-tr="{{ $linea->lart_id }}"><i class="icon remove"></i></a>
                        </td>
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
    
$('.unblock_tr').on('click', function(){
    var tr = $(this).attr('data-tr');
    $(this).parent().parent('tr').children('td').removeClass('disabled').children('.field').children('input').removeAttr('disabled').attr('required','')
    $(this).hide();
    $('input[name="linea_rec['+tr+'][rec_cantidad]"]').val(1);
    $('input[name="linea_rec['+tr+'][rec_costo]"]').val(0);
    $(this).parent('td').children('.block_tr').show();
})

$('.block_tr').on('click', function(){
    var tr = $(this).attr('data-tr');
    $(this).parent().parent('tr').children('.td_blocking').addClass('disabled')
    $(this).parent().parent('tr').children('td').children('.field').children('.input_blocking').attr('disabled', '').removeAttr('required')
    $(this).hide();
    $(this).parent('td').children('.unblock_tr').show();
    $('input[name="linea_rec['+tr+'][rec_cantidad]"]').val('');
    $('input[name="linea_rec['+tr+'][rec_costo]"]').val('');
})


$('.ui.search').search({

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
        title   : 'title',
        description : 'description',
        price: 'cargo',
    },
    onSelect: function(result, response){
        if(result.tipo == 'rut'){
            $('input[name="nom_responsable"]').val(result.description).attr('readonly')
        }else{
            $('input[name="rut_responsable"]').val(result.description).attr('readonly')
        }
        $('input[name="factura[responsable_id]"]').val(result.id);
        $(this).children('.input').children('input').attr('readonly')
        $('input[type="submit"]').removeClass('disabled')
        $('.clean_resp').removeClass('disabled')
    }
});


$('.clean_resp').on('click', function(){
    $('input[name="nom_responsable"]').val('').removeAttr('readonly')

    $('input[name="rut_responsable"]').val('').removeAttr('readonly')
    $('input[name="factura[responsable_id]"]').val('')
    $('input[type="submit"]').addClass('disabled')
    $(this).addClass('disabled')
})

</script>







@endsection
