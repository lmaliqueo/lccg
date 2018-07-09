@extends('admin.template.main')

@section('title', 'Orden de Compra')

@section('content')


    <p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
                    <i class="file alternate outline icon"></i>
                    <i class="corner yellow dollar icon"></i>
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
    <div class="buscar_oc segment ui animated fadeIn" id="list_fac">
        <h4 class="ui horizontal divider header text-navy2">
            <i class="icon dollar"></i>
            Facturas
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
                     <th>N° OC</th>
                     <th>Responsable</th>
                     <th>Fecha</th>
                     <th>Costo Total</th>
                     <th></th>
                 </tr>
             </thead>
             <tbody>
                @foreach ($facturas as $factura)
                    <tr>
                        <td>{{ $factura->fac_id }}</td>
                        <td>{{ $factura->fac_numero }}</td>
                        <td>{{ $factura->orden->oc_numero }}</td>
                        <td>{{ $factura->responsable->persona->nombreCompleto() }}</td>
                        <td>{{ $factura->fac_fecha }}</td>
                        <td><i class="icon dollar"></i>{{ $factura->fac_costo_total }}</td>
                        <td class="collapsing">
                            <a class="button ui small circular twitter icon button_view" data-fac="{{ $factura->fac_id }}"><i class="icon file alternate outline"></i></a>
                        </td>
                    </tr>
                @endforeach
             </tbody>
         </table>
    </div>

<div id="view_fac" class="animated fadeIn" style="display: none;"></div>



<div style="padding-bottom: 100px;"></div>




<script type="text/javascript">

    var token = $('meta[name="csrf-token"]').attr('content');


$(document).on('click', '.button_view', function(){
    var id = $(this).attr('data-fac');
    $.ajax({
        url: '{{ route('documentos.view.factura') }}',
        type: 'post',
        data:{_token:token, id:id},
        success: function(response){
            $('#view_fac').html(response).show();
            $('#list_fac').hide();
        }
    })
})

    $(document).on('click', '.cancelar_oc', function(){
        $('#list_fac').show();
        $('#view_fac').hide().html();
    })



</script>


@endsection
