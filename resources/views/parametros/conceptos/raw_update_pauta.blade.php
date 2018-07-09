@extends('admin.template.main')

@section('title', 'Administrar Conceptos')

@section('content')


	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="settings icon"></i>
					<i class="corner blue file text outline icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #2185D0;">
		        Pauta Comportamiento
			</span>
        </h2>
        <p>
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('parametros.index') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>
@if ($grupo_pauta != '[]')
	<div class="ui segment">
		    <h4 class="ui horizontal divider header text-navy2">
		        <i class="icon file text outline"></i>
		        Pauta Conceptos
		    </h4>
		<p>
	    	<a id="modalButton" class="ui button circular small teal labeled icon" header="Nuevo Grupo de Concepto" url="{{ route('parametros.create.pauta') }}"><i class="icon add"></i> Crear grupo Conceptos</a>

		</p>
		<table class="ui table celled sortable">
		@foreach ($grupo_pauta as $count => $grupo)
			<thead>
				<tr>
					<th class="selectable">{{ $count+1 }}.- {{ $grupo->gp_descripcion }}  <span class="pull-right" style="display: none;"><i class="icon blue pencil"></i></span></th>
					<th class="collapsing">
						<a class="ui teal small circular icon button add_detalle_pauta" grupo="{{ $grupo->gp_id }}"><i class="add icon"></i></a>
					</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($grupo->detalles as $i => $detalle)
					<tr>
						<td class="selectable modalButton" headers="Modificar Detalle Pauta {{ $count+1 }}.{{ $i+1 }}" url="route" style="padding-left: 30px"><a>{{ $count+1 }}.{{ $i+1 }}.- {{ $detalle->dp_descripcion }} <span class="pull-right" style="display: none;"><i class="icon blue pencil"></i></span></a></td>
						<td></td>
					</tr>
				@endforeach
			</tbody>
		@endforeach
		</table>
	</div>

@else
	<p class="text-center">
    	<a id="modalButton" class="ui button teal labeled icon" header="Nuevo Grupo de Concepto" url="{{ route('parametros.create.pauta') }}"><i class="icon add"></i> Crear grupo Conceptos</a>

	</p>
@endif


<div class="ui raised segment">
		    <h4 class="ui horizontal divider header text-navy2">
		        <i class="icon legal"></i>
		        Conceptos
		    </h4>
	<div>
	    <a class="ui modalButton button teal small labeled icon circular" header="Nuevo Concepto" url="{{ route('parametros.create.conceptos') }}"><i class="icon add"></i> Nuevo Concepto</a>
	</div>
	<table class="ui table celled selectable">
	    <thead>
	        <tr>
	            <th>ID</th>
	            <th>Nombre</th>
	            <th>Descripción</th>
	            <th></th>
	        </tr>
	    </thead>
	    <tbody>
	        @foreach ($conceptos as $concepto)
	            <tr>
	                <td>{{ $concepto->con_id }}</td>
	                <td>{{ $concepto->con_nombre }}</td>
	                <td>{{ $concepto->con_descripcion }}</td>
	                <td></td>
	            </tr>
	        @endforeach
	    </tbody>
	</table>
	
</div>








<script type="text/javascript">
		var token = $('meta[name="csrf-token"]').attr('content');
	$('.add_detalle_pauta').on('click', function(){
		var grupo = $(this).attr('grupo');
        $.ajax({
            url: '{{ route('parametros.create.detalle_pauta') }}',
            type: "post",
            data: {_token:token, grupo: grupo },
            success: function(response) {
                $('.modalContent').html(response);
                $('#modaldiv')    
                 //.find('.modalContent')
                 //.load(response);
                 //.html(response)
                 .modal('show');
                 $('.header-modal').html('Crear Detalle Pauta');
            }
        })
	})


	$('td').mouseenter(function(){
		$(this).children('a').children('span').transition('vertical flip').show();
	})
	$('td').mouseleave(function(){
		$(this).children('a').children('span').transition('vertical flip');
	})

	$('th[class="selectable"]').mouseenter(function(){
		$(this).children('span').transition('vertical flip').show();
	})
	$('th[class="selectable"]').mouseleave(function(){
		$(this).children('span').transition('vertical flip');
	})


</script>


@endsection
