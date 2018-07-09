

<div class="ui segment basic three wide column inverted no-margin bg-navy2">

<div class="ui grid">
    <div class="three column row" style="padding: 10px;">
        <div class="left floated column">
        <a href="{{ url('/') }}">
            <h4 class="ui header inverted">
                <img class="ui small image no-margin" src="{{ asset('img/logo_lccg.png') }}">
                <div class="content">
                    Liceo Carlos Cousiño Goyenechea
                    <div class="sub header">A-45</div>
                </div>
            </h4>
            </a>
                  
        </div>
        <div class="right floated column">
            <a href="{{ route('usuario.perfil') }}">
                <h4 class="ui header inverted pull-right" style="margin-top: 1px;">
                    <i class="user circle icon"></i>
                    <div class="content">
                        {{ Auth::user()->persona->nombreCompleto() }}
                        <div class="sub header">{{ Auth::user()->rol->name }}</div>
                    </div>
                </h4>
            </a>
        </div>
    </div>
</div>


    </div>


<div class="ui inverted small attached stackable menu bg-navy1" style="border-bottom: 4px solid #FCDD13;">
<div class="ui container">
<div class="right menu">
    <a class="item {{ (Request::is('/')) ? 'active':'' }}" href="{{ url('/') }}"><i class="home large icon"></i> Inicio</a>
    @if (Auth::user()->jefeUtp())
        <a class="item {{ (Request::is('matriculas')) ? 'active':'' }}" href="{{ route('matriculas.index') }}"><i class="open folder outline large icon"></i> Matriculas</a>
        <a class="item {{ (Request::is('academico/index')) ? 'active':'' }}" href="{{ route('academico.index') }}"><i class="book large icon"></i> Académico</a>
        <a class="item {{ (Request::is('cursos')) ? 'active':'' }}" href="{{ route('cursos.index') }}"><i class="edit outline large icon"></i> Cursos</a>
        <a class="item {{ (Request::is('documentos')) ? 'active':'' }}" href="{{ route('documentos.index') }}"><i class="file alternate outline large icon"></i> Documentos</a>
        <a class="item {{ (Request::is('articulos')) ? 'active':'' }}" href="{{ route('articulos.index') }}"><i class="cubes large icon"></i> Inventario</a>
        <a class="item {{ (Request::is('administracion/index')) ? 'active':'' }}" href="{{ route('parametros.index') }}"><i class="settings large icon"></i> Administracion</a>
    @elseif(Auth::user()->administrador())
        <a class="item {{ (Request::is('matriculas')) ? 'active':'' }}" href="{{ route('matriculas.index') }}"><i class="open folder outline large icon"></i> Matriculas</a>
        <a class="item {{ (Request::is('academico/index')) ? 'active':'' }}" href="{{ route('academico.index') }}"><i class="book large icon"></i> Académico</a>
        <a class="item {{ (Request::is('cursos')) ? 'active':'' }}" href="{{ route('cursos.index') }}"><i class="edit outline large icon"></i> Cursos</a>
        <a class="item {{ (Request::is('documentos')) ? 'active':'' }}" href="{{ route('documentos.index') }}"><i class="file alternate outline large icon"></i> Documentos</a>
        <a class="item {{ (Request::is('articulos')) ? 'active':'' }}" href="{{ route('articulos.index') }}"><i class="cubes large icon"></i> Inventario</a>
        {{-- 
        <a class="item" href="{{ route('profesores.index') }}"><i class="male large icon"></i> Profesores</a>
        <a class="item" href="{{ route('usuarios.index') }}"><i class="user outline large icon"></i> Usuarios</a>

         --}}
        <a class="item {{ (Request::is('administracion/index')) ? 'active':'' }}" href="{{ route('parametros.index') }}"><i class="settings large icon"></i> Administracion</a>
    @elseif(Auth::user()->profesor())
        <a class="item {{ (Request::is('cursos')) ? 'active':'' }}" href="{{ route('cursos.index') }}"><i class="edit outline large icon"></i> Cursos</a>
        <a class="item {{ (Request::is('academico/index')) ? 'active':'' }}" href="{{ route('academico.index') }}"><i class="book large icon"></i> Académico</a>
    @elseif(Auth::user()->inspector())
        <a class="item {{ (Request::is('matriculas')) ? 'active':'' }}" href="{{ route('matriculas.index') }}"><i class="open folder outline large icon"></i> Matriculas</a>
        <a class="item {{ (Request::is('academico/index')) ? 'active':'' }}" href="{{ route('academico.index') }}"><i class="book large icon"></i> Académico</a>
        <a class="item {{ (Request::is('cursos')) ? 'active':'' }}" href="{{ route('cursos.index') }}"><i class="edit outline large icon"></i> Cursos</a>

        <a class="item {{ (Request::is('administracion/index')) ? 'active':'' }}" href="{{ route('parametros.index') }}"><i class="settings large icon"></i> Administracion</a>
    @elseif(Auth::user()->apoderado())
        <a class="item {{ (Request::is('alumnos')) ? 'active':'' }}" href="{{ route('alumnos.index') }}"><i class="student large icon"></i> Alumnos</a>
    @elseif(Auth::user()->secretaria())
        <a class="item {{ (Request::is('matriculas')) ? 'active':'' }}" href="{{ route('matriculas.index') }}"><i class="open folder outline large icon"></i> Matriculas</a>

        <a class="item {{ (Request::is('documentos')) ? 'active':'' }}" href="{{ route('documentos.index') }}"><i class="file alternate outline large icon"></i> Documentos</a>
    @endif
    <a class="item danger" href="{{ route('logout') }}" style="background-color: #DB2828;" onclick="event.preventDefault();
    document.getElementById('logout-form').submit();"> <span class="navy2"><i class="sign out icon"></i> Salir</span>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
    </a>
</div>
  
</div>
    
</div>



