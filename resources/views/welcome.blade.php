@extends('admin.template.main')

@section('title')
    Inicio de welcome
@endsection

@section('content')

<br>
	<h1 class="centered header ui">
		<em style="border-bottom: 5px solid #FCDD13;">BIENVENIDOS A NUESTRA PLATAFORMA EDUCACIONAL</em>
		<div class="sub header" style="margin-top:5px">Sistema de Gestión Académica para el Liceo Carlos Cousiño Goyenechea</div>
	</h1>


<br>
<div class="ui four column centered grid" style="margin: 30px;">
	@if (Auth::user()->profesor())
		<div class="column center aligned">
			<a href="{{ route('academico.index') }}">
				<h2 class="ui grey center aligned icon header button_pulse">
					<i class="circular book icon"></i>
					<div class="content">
						Académico
					</div>
				</h2>
			</a>
		</div>

		<div class="column center aligned">
			<a href="{{ route('cursos.index') }}">
				<h2 class="ui center grey aligned icon header button_pulse">
					<i class="circular edit outline icon"></i>
					<div class="content">
						Cursos
					</div>
				</h2>
			</a>
		</div>
	@endif
	@if (Auth::user()->apoderado())
		<div class="column center aligned">
			<a href="{{ route('alumnos.index') }}">
				<h2 class="ui center grey aligned icon header button_pulse">
					<i class="circular student icon"></i>
					<div class="content">
						Alumnos
					</div>
				</h2>
			</a>
		</div>
	@endif
	@if (Auth::user()->inspector())
		<div class="column center aligned">
			<a href="{{ route('matriculas.index') }}">
				<h2 class="ui center grey aligned icon header button_pulse">
					<i class="circular open folder outline icon"></i>
					<div class="content">
						Matrícula
					</div>
				</h2>
			</a>
		</div>
		<div class="column center aligned">
			<a href="{{ route('academico.index') }}">
				<h2 class="ui grey center aligned icon header button_pulse">
					<i class="circular book icon"></i>
					<div class="content">
						Académico
					</div>
				</h2>
			</a>
		</div>
		<div class="column center aligned">
			<a href="{{ route('cursos.index') }}">
				<h2 class="ui center grey aligned icon header button_pulse">
					<i class="circular edit outline icon"></i>
					<div class="content">
						Cursos
					</div>
				</h2>
			</a>
		</div>
		<div class="column center aligned">
			<a href="{{ route('documentos.index') }}">
				<h2 class="ui center grey aligned icon header button_pulse">
					<i class="circular file alternate outline icon"></i>
					<div class="content">
						Documentos
					</div>
				</h2>
			</a>
		</div>
		<div class="column center aligned">
			<a href="{{ route('parametros.index') }}">
				<h2 class="ui center grey aligned icon header button_pulse">
					<i class="circular settings icon"></i>
					<div class="content">
						Administración
					</div>
				</h2>
			</a>
		</div>
	@endif
	@if (Auth::user()->secretaria())
		<div class="column center aligned">
			<a href="{{ route('matriculas.index') }}">
				<h2 class="ui center grey aligned icon header button_pulse">
					<i class="circular open folder outline icon"></i>
					<div class="content">
						Matrícula
					</div>
				</h2>
			</a>
		</div>

		<div class="column center aligned">
			<a href="{{ route('documentos.index') }}">
				<h2 class="ui center grey aligned icon header button_pulse">
					<i class="circular file alternate outline icon"></i>
					<div class="content">
						Documentos
					</div>
				</h2>
			</a>
		</div>
	@endif
	@if (Auth::user()->administrador())
		<div class="column center aligned">
			<a href="{{ route('matriculas.index') }}">
				<h2 class="ui center grey aligned icon header button_pulse">
					<i class="circular open folder outline icon"></i>
					<div class="content">
						Matrícula
					</div>
				</h2>
			</a>
		</div>
		<div class="column center aligned">
			<a href="{{ route('academico.index') }}">
				<h2 class="ui grey center aligned icon header button_pulse">
					<i class="circular book icon"></i>
					<div class="content">
						Académico
					</div>
				</h2>
			</a>
		</div>

		<div class="column center aligned">
			<a href="{{ route('cursos.index') }}">
				<h2 class="ui center grey aligned icon header button_pulse">
					<i class="circular edit outline icon"></i>
					<div class="content">
						Cursos
					</div>
				</h2>
			</a>
		</div>
		<div class="column center aligned">
			<a href="{{ route('documentos.index') }}">
				<h2 class="ui center grey aligned icon header button_pulse">
					<i class="circular file alternate outline icon"></i>
					<div class="content">
						Documentos
					</div>
				</h2>
			</a>
		</div>
		<div class="column center aligned">
			<a href="{{ route('articulos.index') }}">
				<h2 class="ui center grey aligned icon header button_pulse">
					<i class="circular cubes icon"></i>
					<div class="content">
						Inventario
					</div>
				</h2>
			</a>
		</div>
		<div class="column center aligned">
			<a href="{{ route('parametros.index') }}">
				<h2 class="ui center grey aligned icon header button_pulse">
					<i class="circular settings icon"></i>
					<div class="content">
						Administración
					</div>
				</h2>
			</a>
		</div>
	@endif
	@if (Auth::user()->jefeUtp())
		<div class="column center aligned">
			<a href="{{ route('matriculas.index') }}">
				<h2 class="ui center grey aligned icon header button_pulse">
					<i class="circular open folder outline icon"></i>
					<div class="content">
						Matrícula
					</div>
				</h2>
			</a>
		</div>
		<div class="column center aligned">
			<a href="{{ route('academico.index') }}">
				<h2 class="ui grey center aligned icon header button_pulse">
					<i class="circular book icon"></i>
					<div class="content">
						Académico
					</div>
				</h2>
			</a>
		</div>

		<div class="column center aligned">
			<a href="{{ route('cursos.index') }}">
				<h2 class="ui center grey aligned icon header button_pulse">
					<i class="circular edit outline icon"></i>
					<div class="content">
						Cursos
					</div>
				</h2>
			</a>
		</div>
		<div class="column center aligned">
			<a href="{{ route('documentos.index') }}">
				<h2 class="ui center grey aligned icon header button_pulse">
					<i class="circular file alternate outline icon"></i>
					<div class="content">
						Documentos
					</div>
				</h2>
			</a>
		</div>
		<div class="column center aligned">
			<a href="{{ route('articulos.index') }}">
				<h2 class="ui center grey aligned icon header button_pulse">
					<i class="circular cubes icon"></i>
					<div class="content">
						Inventario
					</div>
				</h2>
			</a>
		</div>
		<div class="column center aligned">
			<a href="{{ route('parametros.index') }}">
				<h2 class="ui center grey aligned icon header button_pulse">
					<i class="circular settings icon"></i>
					<div class="content">
						Administración
					</div>
				</h2>
			</a>
		</div>
	@endif

</div>




@endsection