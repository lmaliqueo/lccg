@extends('admin.template.main')

@section('title', 'Ver Planes de Estudios')

@section('content')



	<p>
        <h2 class="ui header text-navy2">
            <span style="padding: 10px;">
                <i class="big icons">
					<i class="clipboard outline icon"></i>
					<i class="corner yellow search icon"></i>
                </i>
            </span>
			<span style="border-bottom: 4px solid #FCDD13;">
		        Ver Planes de Estudios
			</span>
        </h2>
        <p>
            {{-- <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('asignaturas.index') }}"><i class="arrow left icon"></i> Volver</a> --}}
            <a class="tiny ui labeled icon bg-navy2 text-white button" href="{{ route('plan_estudio.admin_planes') }}"><i class="arrow left icon"></i> Volver</a>
        </p>
	</p>

<div class="segment ui raised secondary">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon clipboard outline"></i>
        Plan de Estudio
    </h4>

    <table class="table ui celled">

        <thead>
            <tr>
                <th style="width: 25%;">ID</th>
                <td style="width: 25%;">{{ $plan->pest_id }}</td>
                <th style="width: 25%;">Estado</th>
                <td style="width: 25%;">{{ $plan->estado() }}</td>
            </tr>
            <tr>
                <th>Decreto Plan Estudio</th>
                <td>{{ $plan->pest_numero.'/'.$plan->pest_ano }}</td>
                <th>Decreto Evaluación</th>
                <td>{{ $plan->pest_eval_num.'/'.$plan->pest_eval_ano }}</td>
            </tr>
        </thead>
    </table>


</div>
    <div class="text-center margin-bottom">
        <div class="ui pointing menu compact margin-bottom">

            @foreach ($plan->niveles_plan() as $count => $nivel)
                <a value="{{ $nivel->nic_nivel }}" class="item menu_grado {{ ($count == 0) ? 'active':'' }}" data-tab="cursos_{{ $nivel->nic_nivel }}">{{ $nivel->nic_nivel }}° Grado</a>
            @endforeach

        </div>
        
    </div>
<div class="segment ui raised">
    <h4 class="ui horizontal divider header text-navy2">
        <i class="icon copy"></i>
        Asignaturas
    </h4>
    @foreach ($plan->niveles_plan() as $count => $nivel)
        <div class="ui bottom attached tab animated fadeIn {{ ($count == 0) ? 'active':'' }}" data-tab="cursos_{{ $nivel->nic_nivel }}">

                <table class="table ui celled">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Asignatura</th>
                            <th>Nombre Corto</th>
                            <th>Tipo</th>
                            <th class="collapsing">Cant. Horas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($plan->asignaturas()->orderBy('asig_tipo_asignatura', 'ASC')->wherePivot('nivel_id', '=', $nivel->nic_id)->get() as $asig)
                            <tr>
                                <td>{{ $asig->asig_id }}</td>
                                <td>{{ $asig->asig_nombre }}</td>
                                <td>{{ $asig->asig_nombre_corto }}</td>
                                <td>{{ $asig->tipo_asig() }}</td>
                                <td>{{ $asig->pivot->porg_cant_horas }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


        </div>
    @endforeach
</div>



@endsection
