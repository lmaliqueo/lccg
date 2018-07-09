@extends('admin.template.main')

@section('title', 'Error')

@section('content')


<br>

<div class="ui two column centered grid" style="margin: 30px;">
    <div class="column center aligned">
	    <h2 class="ui icon red header">
			<i class="disabled warning sign icon" style="margin-bottom: 30px"></i>
			<div class="content">
				Error 401: Usted no puede ingresar a esta ruta
				<div class="sub header">
					No tiene los permisos suficientes para acceder a esta función
				</div>
			</div>
	    </h2>
	    <br>
	    <br>
	    <p>
			<a class="button ui blue icon labeled" href="{{ url('/') }}"><i class="icon home"></i> Volver a Inicio</a>
	    </p>
    </div>
</div>







@endsection
