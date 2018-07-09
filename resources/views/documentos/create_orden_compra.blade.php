@extends('admin.template.main')

@section('title', 'Orden de Compra')

@section('content')


    <p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
                    <i class="file alternate outline icon"></i>
                    <i class="corner yellow clipboard list icon"></i>
                </i>
            </span>
            <span style="border-bottom: 4px solid #FCDD13;">
                Imprimir Orden de Compra
            </span>
        </h2>
        <p>
            {{-- <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('articulos.index') }}"><i class="arrow left icon"></i> Volver</a> --}}
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('documentos.index') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
    </p>
    <div class="buscar_oc segment ui animated fadeIn" id="list_oc">
        <h4 class="ui horizontal divider header text-navy2">
            <i class="icon clipboard list"></i>
            Ordenes de Compra
        </h4>
        {{-- 
        {!! Form::open(['class'=>'ui form']) !!}
        <div class="ui four column centered grid">   
            <div class="column">
                <div class="field text-center">
                    {!! Form::label('orden_compra', 'N° Orden de Compra') !!}
                    <div class="ui search orden_C fluid category focus oc">
                        <div class="ui icon input">
                            <input class="prompt oc" type="text" placeholder="" autocomplete="off" name="orden_compra">
                            <i class="icon left inverted circular search icon_remove" id="remove_prov"></i>
                    </div>
                </div>
            </div>
                
            </div>
        </div>
        {!! Form::close() !!}
         --}}
         <table class="table ui celled">
             <thead>
                 <tr>
                     <th>ID</th>
                     <th>N°</th>
                     <th>Proveedor</th>
                     <th>Fecha</th>
                     <th>Estado</th>
                     <th>Costo Total</th>
                     <th></th>
                 </tr>
             </thead>
             <tbody>
                @foreach ($ordenes as $orden)
                    <tr>
                        <td>{{ $orden->oc_id }}</td>
                        <td>{{ $orden->oc_numero }}</td>
                        <td>{{ $orden->proveedor->prov_razon_social }}</td>
                        <td>{{ $orden->oc_fecha }}</td>
                        <td>{{ $orden->estado() }}</td>
                        <td><i class="icon dollar"></i>{{ $orden->oc_costo }}</td>
                        <td class="collapsing">
                            <a class="button ui small circular twitter icon button_view" data-oc="{{ $orden->oc_id }}"><i class="icon file alternate outline"></i></a>
                        </td>
                    </tr>
                @endforeach
             </tbody>
         </table>
    </div>

<div id="view_oc" class="animated fadeIn" style="display: none;"></div>



<div style="padding-bottom: 100px;"></div>




<script type="text/javascript">

    var token = $('meta[name="csrf-token"]').attr('content');


$(document).on('click', '.button_view', function(){
    var id = $(this).attr('data-oc');
    $.ajax({
        url: '{{ route('documentos.view.orden_compra') }}',
        type: 'post',
        data:{_token:token, id:id},
        success: function(response){
            $('#view_oc').html(response).show();
            $('#list_oc').hide();
        }
    })
})

    $(document).on('click', '.cancelar_oc', function(){
        $('#list_oc').show();
        $('#view_oc').hide().html();
    })


$('.ui.search.orden_C').search({

    cache         : false,
    minCharacters : 1,
    showNoResults : true,
    apiSettings   : {
        responseAsync: function (settings, callback) {


            var items = [];


                    var result;
                    var response = {
                        success: true   // docs say you need to return success: true
                    }
            $.ajax({
                url: '{{ route('autocomplete.search_oc') }}',
                type: "post",
                dataType: "json",
                data:{
                    _token:token, num:settings.urlData.query
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
        description : 'descripcion',
        price: 'estado',
    },
    onSelect: function(result, response){
        console.log(result.id);
            $.ajax({
                url: '{{ route('recibo.form') }}',
                type: 'post',
                //dataType: "JSON",
                data: {_token:token, id:result.id },
                success: function(response) {
                    $('#form_recibo').html(response);
                    $('.buscar_oc').hide();
                    $('#form_recibo').show();
                    $('#back_btn').show();
                }
            });

    }
});

</script>


@endsection
