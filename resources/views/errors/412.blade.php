@extends('admin.template.main')

@section('title', 'Error')

@section('content')


<br>

<div class="ui two column centered grid" style="margin: 30px;">
    <div class="column center aligned">
	    <h2 class="ui icon red header">
			<i class="disabled warning sign icon" style="margin-bottom: 30px"></i>
			<div class="content">
				Error 412: Esta ruta no esta habilitada
				<div class="sub header">
					Debe haber un periodo académico activo para realizar esta acción
				</div>
			</div>
	    </h2>
	    <br>
	    <p>
			<a class="button ui blue icon labeled" href="{{ url('/') }}"><i class="icon home"></i> Volver a Inicio</a>
	    </p>
    </div>
</div>







@endsection
