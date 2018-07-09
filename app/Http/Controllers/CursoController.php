<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Curso;
use App\ParametrosCursos;
use App\Aulas;
use App\PeriodoAcademico;
use App\Personal;
use App\Cargo;
use App\Matricula;
use App\PlanEstudio;
use App\NivelCurso;
use App\Clases;
use App\Asignatura;
use App\TipoEnsayo;
use App\Horarios;
use App\Horas;
use App\Dias;
use Validator;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\DB;

class CursoController extends Controller
{

	public function __construct()
	{
		$this->middleware('acceso_usuario:Inspector General,Profesor,Jefe UTP', ['only' => ['index']]);
		/*
		$this->middleware('profesor:1', ['only' => ['index']]);
		$this->middleware('inspector:1', ['only' => ['index', 'create', 'store']]);*/
        $this->middleware('periodo', ['only' => ['create', 'update']]);
	}

	public function index()
	{
		return view('cursos.index');
	}

	public function show($id)
	{
		$curso = Curso::find($id);
		$tipo_ensayos = TipoEnsayo::get();
		return view('cursos.view', compact('curso', 'tipo_ensayos'));
	}

	public function create()
	{
		$periodo_actual = PeriodoAcademico::where('pac_estado', 1)->pluck('pac_ano', 'pac_id');
		$per_id = PeriodoAcademico::where('pac_estado', 1)->first();
		$parametros = ParametrosCursos::orderBy('pcur_grado', 'ASC')->pluck('pcur_grado', 'pcur_id');

		$aulas_ocupadas = $per_id->cursos->where('cu_tipo', 1)->where('aula_id', '<>', null)->pluck('aula_id');
		$array_aulas = [];
		/*
		foreach ($aulas_ocupadas as $aula) {
			if ($aula['aula_id'] != NULL) {
				$array_aulas[] = $aula['aula_id'];
			}
		}*/
		$aulas = Aulas::orderBy('aul_numero', 'ASC')->whereNotIn('aul_id', $aulas_ocupadas)->pluck('aul_numero', 'aul_id');

		$profesores_jefes = Curso::select('profesor_id')->where('periodo_id', $per_id->pac_id)->where('cu_tipo', 1)->get()->toArray();

		$array_profe = [];
		foreach ($profesores_jefes as $profesor) {
			if ($profesor['profesor_id'] != NULL) {
				$array_profe[] = $profesor['profesor_id'];
			}
		}
			//dd($array_profe);

		$cargo_profesor = Cargo::where('ca_nombre', 'Profesor')->first();
		$profesores = Personal::where('cargo_id', $cargo_profesor->ca_id)->whereNotIn('pers_id', $array_profe)->pluck('persona_rut', 'pers_id');
		return view('cursos.create', ['aulas'=>$aulas, 'parametros'=>$parametros, 'periodo_actual'=>$periodo_actual, 'profesores'=>$profesores, 'per_id'=>$per_id]);
	}

	public function store(Request $request)
	{
		//dd($request->all());
		$curso = new Curso($request->all());
		//$parametro = ParametrosCursos::where('pcur_grado', $request->parametro_grado)->where('pcur_letra', $request->parametro_letra)->first();
		//$curso->parametros()->associate($parametro);
		$curso->cu_tipo = 1;
		$periodo_actual = PeriodoAcademico::where('pac_estado', 1)->first();
		$curso->periodo()->associate($periodo_actual);


        $validator = Validator::make($request->all(), $curso->rules())->setAttributeNames($curso->attr_name());

        if ($validator->fails()) {
            return redirect()->route('cursos.create')
                        ->withErrors($validator)
                        ->withInput();        	
        	//return response()->json(['success'=>0, 'tipo'=>'alumno', 'errors'=>$validator->errors()]);
        }else{
			$curso->save();
			Flash::success('Se a creado el curso '.$curso->nombreCurso().' de forma exitosa');
	        return redirect()->route('cursos.admin');
        }
	}

	public function edit($id)
	{
		$curso = Curso::find($id);
		$nivel = NivelCurso::where('nic_nivel', $curso->parametros->pcur_grado)->first();
		$planes = PlanEstudio::whereIn('pest_id', $nivel->planEstudios->pluck('pest_id'))->where('pest_estado', 1)->get();
		$periodo_actual = PeriodoAcademico::where('pac_estado', 1)->pluck('pac_ano', 'pac_id');
		$aulas_ocupadas = $curso->periodo->cursos->where('cu_tipo', 1)->where('aula_id', '<>', null)->whereNotIn('cu_id', $curso->cu_id)->pluck('aula_id');
		$aulas = Aulas::orderBy('aul_numero', 'ASC')->whereNotIn('aul_id', $aulas_ocupadas)->pluck('aul_numero', 'aul_id');
		//dd($aulas);
		return view('cursos.edit', compact('curso', 'periodo_actual', 'aulas', 'planes'));
	}

	public function update(Request $request, $id)
	{
		$curso = Curso::find($id);
		$curso->update($request->all());
		Flash::info('Se a modificado el curso '.$curso->nombreCurso().' de forma exitosa');
		return redirect()->route('cursos.admin');
	}

	public function destroy($id)
	{

	}

	public function admin()
	{
		$periodo_actual = PeriodoAcademico::where('pac_estado', 1)->first();
		if (!$periodo_actual) {
			$periodo_actual = PeriodoAcademico::orderBy('pac_ano', 'DESC')->first();
		}
		$cursos = Curso::where('periodo_id', $periodo_actual->pac_id)->where('cu_tipo', 1)->orderBy('parametro_id', 'ASC')->paginate(10);
		return view('cursos.admin', compact('cursos', 'periodo_actual'));
	}


	public function curso_prof()
	{
		$periodo = PeriodoAcademico::where('pac_estado', 1)->first();
		$profesor = \Auth::user()->persona->empleados->first();
		$curso = $profesor->cursos->where('periodo_id', $periodo->pac_id)->first();
		$tipo_ensayos = TipoEnsayo::get();
		return view('cursos.view', compact('curso', 'tipo_ensayos'));
	}

	public function clases_prof()
	{
		$periodo = PeriodoAcademico::where('pac_estado', 1)->first();
		$profesor = \Auth::user()->persona->empleados->first();
		$cursos = $periodo->cursos->pluck('cu_id');
		$clases = $profesor->clases->whereIn('curso_id', $cursos);
		return view('cursos.admin_clases', compact('clases'));
	}



	/*###############################################################*/
	/*########################### ALUMNOS ###########################*/
	/*###############################################################*/


/*
	public function asignarAlumnos($id)
	{
		//$periodo_actual = PeriodoAcademico::where('pac_estado', 1)->first();
		$curso = Curso::find($id);
		
//		dd($curso->listaAlumnos);
		$alu_asignados = [];
		$alumnos_encursos = Matricula::where('periodo_id', $curso->periodo_id)->get();
		foreach ($alumnos_encursos as $asignados) {
			foreach ($asignados->cursos as $matri) {
				if ($matri->cu_id != $curso->cu_id) {
					$alu_asignados[] = $asignados->mat_id;
				}
			}
		}



		$alumnos = Matricula::where('mat_grado_curso', $curso->parametros->pcur_grado)->where('periodo_id', $curso->periodo_id)->whereNotIn('mat_id', $alu_asignados)->orderBy('mat_numero', 'ASC')->paginate(10);
		return view('cursos.alumnos.asignar_alumnos', ['curso'=>$curso, 'alumnos'=>$alumnos]);
	}*/

	public function asignarAluStore(Request $request)
	{
		//dd($request->mat_id);
		$curso = Curso::find($request->curso_id);
		foreach ($request->mat_id as $matricula_id) {
			$curso->listaAlumnos()->attach($matricula_id);
		}
        return redirect()->route('curso.asignar_alumnos', ['id'=>$curso->cu_id]);
	}


	/*----------------------------- Lista Alumnos -----------------------------*/

	public function menu_list_alu()
	{
		$periodo = PeriodoAcademico::where('pac_estado', 1)->first();
		return view('cursos.alumnos.menu_lista', compact('periodo'));
	}

	public function view_list_alu(Request $request)
	{
		$curso = Curso::find($request->id);
		return view('cursos.alumnos.view_lista_alu', compact('curso'));
	}

	public function edit_lista_alu(Request $request)
	{
		$curso = Curso::find($request->id);
		//dd($curso->profesorJefe->persona->nombreCompleto());
		return view('cursos.alumnos.edit_lista_alu', compact('curso'));
	}

	public function store_list_alu(Request $request)
	{
		//dd($request->all());
		foreach ($request->mat as $mat) {
			$matricula = Matricula::find($mat['mat_id']);
			$matricula->mat_posicion_lista = $mat['posicion'];
			$matricula->update();
		}
		return response()->json(1);
	}

	/*###############################################################*/
	/*######################### ASIGNATURAS #########################*/
	/*###############################################################*/

	public function menuAAsignaturas()
	{
		$periodo_actual = PeriodoAcademico::where('pac_estado', 1)->first();
		$cursos = Curso::where('periodo_id', $periodo_actual->pac_id)->where('cu_tipo', 1)->orderBy('parametro_id')->get();
		return view('cursos.asignaturas.menu', ['cursos' => $cursos, 'periodo'=>$periodo_actual]);
	}

	public function tablaAsignaturas(Request $request)
	{

		$curso = Curso::find($request->id);

		$plan_estudio = $curso->planEstudio;
		$nivel = NivelCurso::where('nic_nivel', $curso->parametros->pcur_grado)->first();
		$arreglo = [];
		foreach ($plan_estudio->asignaturas as $plan) {
			if ($plan->pivot->nivel_id == $nivel->nic_id) {
				$arreglo[] = $plan;
			}
		}
		$cargo_profesor = Cargo::where('ca_nombre', 'Profesor')->first();
		$profesores = Personal::where('cargo_id', $cargo_profesor->ca_id)->pluck('persona_rut', 'pers_id');
		return view('cursos.asignaturas.asignar_asignaturas', ['asignaturas' => $arreglo, 'profesores' => $profesores, 'curso'=>$curso]);
	}



	/*################################################################*/
	/*########################### HORARIOS ###########################*/
	/*################################################################*/

	public function menu_horarios()
	{
		$periodo_actual = PeriodoAcademico::where('pac_estado', 1)->first();
		$periodos = PeriodoAcademico::get();
		if ($periodo_actual) {
			$cursos = Curso::where('cu_tipo', 1)->where('periodo_id', $periodo_actual->pac_id)->get();
		}else{
			$cursos = null;
		}
		return view('cursos.asignaturas.horarios_asignaturas', compact('cursos', 'periodos', 'periodo_actual'));
	}

	public function buscarCurso(Request $request)
	{


		$periodo = PeriodoAcademico::find($request->periodo);
		$cursos = Curso::where('periodo_id', $periodo->pac_id)->where('cu_tipo', 1)->orderBy('parametro_id', 'ASC')->get();

		$data = [];
		foreach ($cursos as $curso) {
			if ($curso->profesor_id != NULL) {
				$profesor = $curso->profesorJefe->persona->nombreCompleto();
			}else{
				$profesor = null;
			}
		//dd($curso->nombreCurso());
			$data[] = '<div class="item item_curso" data-value="'.$curso->cu_id.'" data-prof="'.$profesor.'">'.$curso->nombreCurso().'</div>';
		}

	    return response()->json($data
	    		/*array(
	                    'success' => true,
	                    'data'   => $data
	                )*/); 

	}

	public function verHorarios(Request $request)
	{
		$curso = Curso::find($request->id);
		$plan_estudio = $curso->planEstudio;
		$dias = Dias::get();
		/*
		$dias = [
			1 => 'Lunes',
			2 => 'Martes',
			3 => 'Miercoles',
			4 => 'Jueves',
			5 => 'Viernes'
		];*/
		$clases = $curso->clases;
		$horarios = Horarios::whereIn('clases_id', $curso->clases->pluck('cla_id'))->get();  
		//dd($horarios);
		return view('cursos.asignaturas.horarios', compact('dias', 'curso', 'plan_estudio', 'clases', 'horarios'));
	}

	public function create_horario(Request $request)
	{
		$curso = Curso::find($request->id);
		$dias = Dias::get();
		$horarios = Horarios::whereIn('clases_id', $curso->clases->pluck('cla_id'))->get();  
		/*
		$dias = [
			1 => 'Lunes',
			2 => 'Martes',
			3 => 'Miercoles',
			4 => 'Jueves',
			5 => 'Viernes'
		];*/
		return view('cursos.asignaturas.form_horarios', compact('curso', 'dias', 'horarios'));
	}

	public function guardarHorarios(Request $request)
	{
		//dd($request->all());
		$curso = Curso::find($request->curso_id);
        DB::beginTransaction();
        try {
			foreach ($request->horario as $hors) {
				foreach ($hors as $horarios) {
					if (isset($horarios['horario_id'])) {
						$horario_exist = Horarios::find($horarios['horario_id']);
						if ($horarios['clases_id'] != null) {
							$horario_exist->clases_id = $horarios['clases_id'];
							$horario_exist->update();
						}else{
							$horario_exist->delete();
						}
					}else{
						if ($horarios['clases_id'] != null) {
							$horario_new = new Horarios($horarios);
							$horario_new->save();
						}
					}
					/*
					$horas = Horas::find($horarios[1]['hora_id']);
					$array_horarios = [];
					for ($i = 1; $i <= 5; $i++) {
						if ($horarios[$i]['clases_id'] != null) {
							$hor_exist = Horarios::where('clases_id', $horarios[$i]['clases_id'])->where('hor_dia', $horarios[$i]['hor_dia'])->first();

							if ($hor_exist != null) {
								$array_horarios[] = $hor_exist->hor_id;
							}else{
								$hor_new = new Horarios($horarios[$i]);
								$hor_new->save();
								$array_horarios[] = $hor_new->hor_id;
							}
						}elseif (isset($horarios[$i]['horario_id'])) {
							$horario_exist = Horarios::find($horarios[$i]['horario_id']);
							$horario_exist->horas()->detach($horas->hors_id);
						}
						
					}*/
					/*
					$horas->horarios()->whereIn('clases_id', $curso->clases->pluck('cla_id'))->sync($array_horarios);
					*/
				}
			}
			//$horarios_curso = Horarios::whereIn('clases_id', $curso->clases->pluck('cla_id'))->get();
			//dd($horarios_curso);
			/*
			foreach ($horarios_curso as $hor_cur) {
				if ($hor_cur->horas->count() == 0) {
					$hor_cur->delete();
				}
			}*/

            DB::commit();

        } catch (Exception $e) {

            DB::rollBack();
        }
        return 1;
	}



		/*------------------------------- AJAX -------------------------------*/

	public function cargar_asignaturas(Request $request)
	{
		$curso = Curso::find($request->curso);
		$grado = NivelCurso::where('nic_nivel', $request->grado)->first();
		$plan_estudio = $curso->planEstudio;

		$asignaturas = $plan_estudio->asignaturasGrado($grado->nic_id)->get();
		return view('cursos.asignaturas.tabla_asignaturas', ['asignaturas'=> $asignaturas, 'curso'=>$curso]);
	}

	public function buscar_profe_asig(Request $request)
	{
		//dd($request->all());
		if ($request->clases != null) {
			$type = 1;
			$clases = Clases::find($request->clases);
			$data = [
				'clases_id' => $clases->cla_id,
				'title' => 'Cambiar Profesor - '.$clases->asignatura->asig_nombre,
			];
		}elseif ($request->asig != null) {
			$type = 2;
			$asignatura = Asignatura::find($request->asig);
			$data = [
				'asignatura_id'=>$asignatura->asig_id,
				'title' => 'Asignar Profesor - '.$asignatura->asig_nombre,
			];
		}
		return response()->json(['data'=>$data, 'type'=>$type]);
	}


	public function clases_store(Request $request)
	{

		//dd($request->all());

		$profesor = Personal::find($request->clase['profesor_id']);
		if ($request->clase_id != null) {
			$clases = Clases::find($request->clase_id);
			
		}else{
			$clases = new Clases();
			$clases->curso_id = $request->curso_id;
			$clases->asignatura_id = $request->asignatura_id;
		}

		$clases->profesor()->associate($profesor);
		$clases->save();
		
        return response()->json(1);
	}

	public function buscar_param(Request $request)
	{
		$periodo_actual = PeriodoAcademico::where('pac_estado', 1)->first();
		$cursos = $periodo_actual->cursos->where('cu_tipo', 1)->pluck('parametro_id');
		$param_grado = ParametrosCursos::where('pcur_grado', $request->grado)->whereNotIn('pcur_id', $cursos)->get();
		//dd($param_grado);

		$nivel = NivelCurso::where('nic_nivel', $request->grado)->first();
		$array_planes = PlanEstudio::whereIn('pest_id', $nivel->planEstudios->pluck('pest_id'))->where('pest_estado', 1)->get();
		//dd($array_planes);
		$data = [];
		foreach ($param_grado as $param) {
			$data[] = '<div class="item item_curso" data-value="'.$param->pcur_id.'">'.$param->pcur_letra.'</div>';

		}
		$planes = [];
		//dd($nivel->planEstudios);
		foreach ($array_planes as $plan) {
			$planes[] = '<div class="item item_plan" data-value="'.$plan->pest_id.'">'.$plan->pest_numero.'/'.$plan->pest_ano.'</div>';
		}
		return response()->json(compact('data', 'planes'));
	}


	public function cargar_clases(Request $request)
	{
		$curso = Curso::find($request->curso);
		if (\Auth::user()->profesor()) {
			$profesor = Personal::where('persona_rut', \Auth::user()->persona_rut)->first();
			return view('cursos.lista_clases', compact('curso', 'profesor'));
		}
		return view('cursos.lista_clases', compact('curso'));
	}

	public function clase_horarios(Request $request)
	{
		$clase = Clases::find($request->id);
		$cursos = $clase->curso->periodo->cursos->pluck('cu_id');
		$clases = $clase->profesor->clases->whereIn('curso_id', $cursos)->whereNotIn('curso_id', $clase->curso_id);
		$data_horarios = [];
		foreach ($clases as $cla) {
			foreach ($cla->horarios as $horario) {
				$data_horarios[] = [
					'clase_oc' => $cla->asignatura->asig_nombre,
					'hora'=>$horario->hora->hors_numero,
					'dia' => $horario->dia_id,
				];
			}
		}
		$data = [];
		$data = [
			'profesor' => $clase->profesor->persona->nombreCompleto(),
			'clase' => $clase->asignatura->asig_nombre,
			'horarios'=>$data_horarios
		];
		return response()->json($data);
	}

}
