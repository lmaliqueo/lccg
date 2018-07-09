@extends('admin.template.main')

@section('title', 'Ver Usuario')

@section('content')

<div class="margin-bottom">
	<div class="ui black ribbon label">
	<h2 class="ui huge header add icon text-white"> &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
	Ver Usuario</h2>
	</div>
	
</div>

<h2 class="ui header dividing">
	<i class="user outline icon"></i>
	<div class="content">
		{{ $user->name }}
		
	</div>
</h2>




@endsection
