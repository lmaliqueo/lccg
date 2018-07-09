@extends('admin.template.main')

@section('title', 'Lista de Usuarios')

@section('content')


<div class="margin-bottom">
	<div class="ui ui-black ribbon label">
	<h2 class="ui huge header add icon text-white"> &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
	Administrar Usuarios </h2>
	</div>
	<hr class="style-two ">
	
</div>

		<div class="ui styled fluid accordion margin-bottom">
		  <div class="title">
		    <i class="dropdown icon"></i>
		    Busqueda avanzada
		  </div>
		  <div class="content">
		    <p class="transition hidden">A dog is a type of domesticated animal. Known for its loyalty and faithfulness, it can be found as a welcome guest in many households across the world.</p>
		  </div>
		</div>

<br>

<div class="ui grid">
	<div class="one wide column"></div>
	<div class="fourteen wide column">
		<table class="ui selectable compact celled table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Nombre</th>
					<th>Email</th>
					<th>Tipo</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
			@foreach($users as $user)
				<tr>
					<td class="collapsing">{{ $user->id }}</td>
					<td>{{ $user->name }}</td>
					<td>{{ $user->email }}</td>
					<td>{{ $user->type }}</td>
					<td class="collapsing">
						<a class="ui icon button teal" href="{{ route('user.show', $user->id) }}" data-tooltip="Ver usuario"  data-inverted=""><i class="eye icon"></i></a>
						<a class="ui icon button primary" href="{{ route('user.edit', $user->id) }}" data-tooltip="Modificar usuario"  data-inverted=""><i class="pencil icon"></i></a>
						<a href="{{ route('admin.user.destroy', $user->id) }}" class="ui icon button negative" onclick="return confirm('desea eleminarlo')" data-tooltip="Eliminar usuario"  data-inverted="" ><i class="trash icon"></i></a>
					</td>
				</tr>
			@endforeach
			</tbody>
			<tfoot>
			    <tr><th colspan="5">
			    	{!! $users->render() !!}

			    </th>
			</tfoot>
		</table>
	</div>
</div>

@endsection

