<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alumno;
use App\PeriodoAcademico;
use App\Curso;
use App\Matricula;
use App\OrdenCompra;
use App\ParametrosCursos;
use App\Personal;
use App\Persona;
use App\Asignatura;
use App\Clases;
use App\Cargo;
use App\Padres;
use App\Usuario;
use App\Rol;
use App\Apoderado;
use App\Articulo;
use App\Proveedor;
use App\EstablecimientoAnterior;
use App\Institucion;
use Illuminate\Support\Facades\Hash;

class AjaxController extends Controller
{



	public function confirmar_usuario(Request $request)
	{



		$user = \Auth::user();
		if ($request->pass != null) {
			if (Hash::check($request->pass, $user->password)) {
				return response()->json(1);
				
			}else{
				return response()->json(2);
			}
		}else{
			return response()->json(0);
		}
			
	}

/*###################################################################*/
/*############################ MATRICULA ############################*/
/*###################################################################*/

	public function buscarInst(Request $request)
	{
		$instituciones = Institucion::where('inst_nombre', 'LIKE', '%'.$request->nombre.'%')->get();
		$data = [];
		foreach ($instituciones as $inst) {
			$data[] = [
				'id'=>$inst->inst_id,
				'nombre'=>$inst->inst_nombre,
			];
		}
	    return response()->json($data);
	}


	public function buscarColAnt(Request $request)
	{
		$colegios = EstablecimientoAnterior::where('eant_nombre', 'LIKE', '%'.$request->rut.'%')->get();
		$data = [];
		foreach ($colegios as $col) {
			$data[] = [
				'id'=>$col->eant_id,
				'rut'=>$col->eant_nombre,
			];
		}
	    return response()->json($data);
	}

	public function buscarAlumno(Request $request)
	{
		$periodo_actual = PeriodoAcademico::where('pac_estado', 1)->first();


		if($request->tipo == null){
			$alumnos_activos = Matricula::select('alumno_rut')->where('periodo_id', $periodo_actual->pac_id)->whereIn('mat_estado', [0, 1])->pluck('alumno_rut');
			$alumnos = Alumno::where('al_rut', 'LIKE', '%'.$request->rut.'%')->whereNotIn('al_rut', $alumnos_activos)->get();

		}elseif($request->tipo == 'rut'){
			$alumnos = Alumno::where('al_rut', 'LIKE', '%'.$request->rut.'%')->get();

		}elseif($request->tipo == 'nombre'){
			$alumnos = Alumno::where('al_nombres', 'LIKE', '%'.$request->rut.'%')->orWhere('al_apellido_pat', 'LIKE', '%'.$request->rut.'%')->orWhere('al_apellido_mat', 'LIKE', '%'.$request->rut.'%')->get();

		}



		$data = [];
		if($request->tipo == null){
			foreach ($alumnos as $alumno) {
				$last_matricula = Matricula::where('alumno_rut', $alumno->al_rut)->orderBy('mat_id', 'DESC')->first();

				$model_padre = $last_matricula->padres->where('pad_parentesco', 'Padre');
				$model_madre = $last_matricula->padres->where('pad_parentesco', 'Madre');
				$model_apod_1 = $last_matricula->apoderados->where('ap_tipo', 1);
				$model_apod_2 = $last_matricula->apoderados->where('ap_tipo', 2);

				$data[] = [
					'rut' =>$alumno->al_rut,
					'nombre_comp' => $alumno->nombreCompleto(),
					'nombre' => $alumno->al_nombres,
					'ape_pat' => $alumno->al_apellido_pat,
					'ape_mat' => $alumno->al_apellido_mat,
					'genero' => $alumno->al_sexo,
					'fecha_nac' => $alumno->al_fecha_nacimiento,
					'comuna' => $alumno->comuna_id,
					'domicilio' => $alumno->al_domicilio,
					'model_student' => $alumno,
					'model_padre' => (empty($model_padre)) ?	 null : $model_padre->first(),

					'model_madre' => (empty($model_madre)) ? null : $model_madre->first(),

					'model_apod_1' => (empty($model_apod_1)) ? null : $model_apod_1->first(),

					'model_apod_2' => (empty($model_apod_2)) ? null : $model_apod_2->first(),

					'model_persona_1' => ($model_apod_1 == '[]') ? null : $model_apod_1->first()->persona,

					'model_persona_2' => ($model_apod_2 == '[]') ? null : $model_apod_2->first()->persona,

					//'promedio_actual' => $alumno->mat_prom_general,
					
				];

			}
		}else{
			foreach ($alumnos as $alumno) {
				if ($request->tipo == 'rut') {
					$title = $alumno->al_rut;
					$description = $alumno->nombreCompleto();
				}else{
					$title = $alumno->nombreCompleto();
					$description = $alumno->al_rut;
				}
				$data[]=[
					'title'=> $title,
					'description'=> $description,
					'rut' =>$alumno->al_rut,
					'nombre_comp' => $alumno->nombreCompleto(),
					'nombre' => $alumno->al_nombres,
					'ape_pat' => $alumno->al_apellido_pat,
					'ape_mat' => $alumno->al_apellido_mat,
					'genero' => $alumno->al_sexo,
					'fecha_nac' => $alumno->al_fecha_nacimiento,
					'comuna' => $alumno->comuna_id,
					'domicilio' => $alumno->al_domicilio,
				];
			}
		}

	    return response()->json($data);
	}

	public function buscarPadres(Request $request)
	{
		//dd($request->all());
		$padres = Padres::where('pad_rut', 'LIKE', '%'.$request->rut.'%')->where('pad_parentesco', $request->tipo)->get();
		$data = [];
		foreach ($padres as $padre) {
			if ($request->tipo == 'Padre') {
				$data[] = [
					'rut' =>$padre->pad_rut,
					'nombre_comp' => $padre->pad_nombres,
					'model_padre' => $padre,
				];
			}else{
				$data[] = [
					'rut' =>$padre->pad_rut,
					'nombre_comp' => $padre->pad_nombres,
					'model_madre' => $padre,
				];
			}
		}
	    return response()->json($data);
	}

	public function buscarApoderado(Request $request)
	{
		$personas = Persona::where('pe_rut', 'LIKE', '%'.$request->rut.'%')->get();
		$data= [];
		foreach ($personas as $persona) {
			if ($request->tipo == 1) {
				$data[] = [
					'rut'=>$persona->pe_rut,
					'nombre_comp'=>$persona->nombreCompleto(),
					'model_persona_1'=>$persona,
					'tipo_apod' => $request->tipo,
				];

			}else{
				$data[] = [
						'rut'=>$persona->pe_rut,
						'nombre_comp'=>$persona->nombreCompleto(),
						'model_persona_2'=>$persona,
						'tipo_apod' => $request->tipo,
					];
			}
		}
		/*
		$apoderados = Apoderado::where('persona_rut', 'LIKE', '%'.$request->rut.'%')->where('ap_tipo', $request->tipo)->get();
		$data = [];
		//dd($apoderados);
		foreach ($apoderados as $apoderado) {
			if ($request->tipo == 1) {
				$data[] = [
					'rut' =>$apoderado->persona_rut,
					'nombre_comp' => $apoderado->persona->nombreCompleto(),
					'model_apod_1' => $apoderado,
					'model_persona_1' => $apoderado->persona,
					'tipo_apod'=> $apoderado->ap_tipo,
				];
			}else{
				$data[] = [
					'rut' =>$apoderado->persona_rut,
					'nombre_comp' => $apoderado->persona->nombreCompleto(),
					'model_apod_2' => $apoderado,
					'model_persona_2' => $apoderado->persona,
					'tipo_apod'=> $apoderado->ap_tipo,
				];
			}
		}
		*/
	    return response()->json($data);
	}


/*###################################################################*/
/*############################ PROFESORES ############################*/
/*###################################################################*/

	public function buscarProfesorCurso(Request $request)
	{
		$periodo_actual = PeriodoAcademico::where('pac_estado', 1)->first();
		if($request->prof_jefes == 1){
			$prof_jefes = Cursos::select('profesor_id')->where('periodo_id', $periodo_actual->pac_id)->get()->toArray();
			$profesores = Personal::whereNotIn('pers_id', $prof_jefes)->where('persona_rut', 'LIKE', '%'.$request->rut.'%')->where('pers_estado', 1)->get();

		}else{
			$profesores = Personal::where('persona_rut', 'LIKE', '%'.$request->rut.'%')->where('pers_estado', 1)->get();
		}
		$data = [];
		foreach ($profesores as $prof) {
			$data[] = [
				'nombre'=>$prof->persona,
			];
		}
	}



/*###################################################################*/
/*############################ ARTICULOS ############################*/
/*###################################################################*/

	public function buscarArticulos()
	{

	}

	public function buscarProveedor()
	{

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

	public function buscarSemestre(Request $request)
	{
		$periodo = PeriodoAcademico::find($request->periodo);
		$data = [];
		foreach ($periodo->semestres as $semestre) {
			if ($semestre->sem_estado == 0) {
				$data[] = '<div class="item disabled" data-value="'.$semestre->sem_id.'">'.$semestre->sem_numero.'° Semestre</div>';
			}else{
				$data[] = '<div class="item" data-value="'.$semestre->sem_id.'">'.$semestre->sem_numero.'° Semestre</div>';
			}
		}
		$data[] = '<div class="item" data-value="0">Año Completo</div>';
    	return response()->json($data);
	}

/*###################################################################*/
/*############################ SEARCH ############################*/
/*###################################################################*/


	public function search_mat_pendientes(Request $request)
	{
		$matriculas = Matricula::where('alumno_rut', 'LIKE', '%'.$request->rut.'%')/*->where('mat_estado', 0)*/->get();
		$data = [];
		foreach ($matriculas as $mat) {
			$data[] = [
				'id' => $mat->mat_id,
				'rut' => $mat->alumno_rut,
				'nombre' => $mat->alumno->nombreCompleto(),
				'estado' => $mat->mat_estado,
				'genero' => $mat->alumno->al_sexo,
			];
		}

		return response()->json($data);
	}



	public function searchMatricula(Request $request)
	{
		//dd($request->all());

		if ($request->periodo != null) {
			$periodo = PeriodoAcademico::find($request->periodo);
		}else{
			$periodo = PeriodoAcademico::where('pac_estado', 1)->first();
		}

		if ($request->curso != null) {
			$curso = Curso::find($request->curso);
			
			$array = $curso->listaAlumnos->pluck('mat_id');
			$matriculas = Matricula::where('alumno_rut', 'LIKE', '%'.$request->rut.'%')->whereIn('mat_id', $array)->get();
			
		}

		if($request->tipo == 'rut'){
			$matriculas = Matricula::where('alumno_rut', 'LIKE', '%'.$request->rut.'%')->where('periodo_id', $periodo->pac_id)->get();
		}elseif($request->tipo == 'nombre'){
			$alumnos = Alumno::where('al_nombres', 'LIKE', '%'.$request->rut.'%')->orWhere('al_apellido_pat', 'LIKE', '%'.$request->rut.'%')->orWhere('al_apellido_mat', 'LIKE', '%'.$request->rut.'%')->pluck('al_rut');
			$matriculas = Matricula::whereIn('alumno_rut', $alumnos)->where('periodo_id', $periodo->pac_id)->get();
		}
		if($request->id_mats != null){
			$matriculas = $matriculas->whereNotIn('mat_id', $request->id_mats);
		}


		$data = [];

		foreach ($matriculas as $alu) {


			$talleres_ins = null;
			if($request->taller != null){
				$array_talleres = $alu->talleres->pluck('cu_id');
				$talleres = $periodo->cursos->where('cu_tipo', 2)->whereNotIn('cu_id', $array_talleres);
				foreach ($talleres as $ta) {
					$talleres_ins[] = '<div class="item" data-value="'.$ta->cu_id.'">'.$ta->nombreTaller().'</div>';
				}
			}



			if ($request->tipo == 'rut') {
				$title = $alu->alumno_rut;
				$description = $alu->alumno->nombreCompleto();
			}else{
				$title = $alu->alumno->nombreCompleto();
				$description = $alu->alumno_rut;
			}

			$data[] = [
				'title' => $title,
				'description' => $description,
				'model' => $alu,
				'id' => $alu->mat_id,
				'rut' => $alu->alumno_rut,
				'nombre' => $alu->alumno->nombreCompleto(), 
				'matricula' => $alu->mat_id,
				'numero' => $alu->mat_numero,
				'genero' => $alu->alumno->al_sexo,
				'comuna' => $alu->alumno->comuna->com_nombre,
				'ingreso' => $alu->mat_fecha_ingreso,
				'promedio' => $alu->mat_prom_general,
				'curso_al' => ($alu->curso->first() != null) ? $alu->curso->first()->nombreCurso():'<em class="text-red">Sin Curso</em>',
				'curso_id' => ($alu->curso->first() != null) ? $alu->curso->first()->cu_id:null,
				'estado' => '<div class="label ui '.(($alu->mat_estado == 1) ? 'blue':'red').'">'.$alu->estado().'</div>',
				'talleres' => $talleres_ins,
				];

		}
		$req ['items'] = $data;
		//dd($data);
		if ($request->curso != null) {
			return response()->json($data);
		}
			return response()->json($data);

	}

	public function searchOc(Request $request)
	{
		$ordenes = OrdenCompra::where('oc_numero', 'LIKE', '%'.$request->num.'%')->get();
		$data = [];
		foreach ($ordenes as $orden) {
			$data[] = [
				'title'=> 'Orden #'.$orden->oc_numero,
				'descripcion' => 'Proveedor: '.$orden->proveedor->prov_razon_social,
				'estado' => $orden->estado(),
				'id' => $orden->oc_id,
			];
		}
		return response()->json($data);
	}

	public function searchEnsayoCursos(Request $request)
	{
		//	1 = SIMCE, 2 = PSU
		if ($request->ensayo == 1) {

		}else{
			$parametros = ParametrosCursos::select('pcur_id')->where('pcur_grado', 4)->get();
			$cursos = Curso::/*where('parametro_id', $parametros)->*/where('cu_tipo', 1)->where('periodo_id', $request->periodo)->get();
			$data = [];
			foreach ($cursos as $curso) {
				$data[] = '<div class="item item_curso" data-value="'.$curso->cu_id.'">'.$curso->nombreCurso().'</div>';
			}
			return response()->json($data);
		}
	}

	public function searchMateriasEnsayo(Request $request)
	{
		$tipo_ensayo = TipoEnsayo::find($request->tipo_id);
		$data = [];
		foreach ($tipo_ensayo->materias as $materia) {
				$data[] = '<div class="item item_curso" data-value="'.$materia->mens_id.'">'.$materia->mens_nombre.'</div>';
		}
		return response()->json($data);
	}

	public function searchCursosGrado(Request $request)
	{
		//dd($request->all());
		$grado = ParametrosCursos::where('pcur_grado', $request->grado)->get()->pluck('pcur_id');
		$cursos = Curso::where('periodo_id', $request->periodo)->whereIn('parametro_id', $grado)->get();
		$data = [];
		foreach ($cursos as $curso) {
			$data[] = '<div class="item item_curso" data-value="'.$curso->cu_id.'">'.$curso->nombreCurso().'</div>';
		}
		return response()->json($data);
	}


	public function searchProfesor(Request $request)
	{
		if ($request->asig != null) {
			$asignatura = Asignatura::find($request->asig);
			$array_prof = $asignatura->profesores->pluck('pers_id');
			$profesores = Personal::where('persona_rut', 'LIKE', '%'.$request->rut.'%')->whereIn('pers_id', $array_prof)->get();
			if ($request->clases != null) {
				$clases = Clases::find($request->clases);
				$array_prof = $clases->profesores->pluck('pers_id');
				$profesores = $profesores->whereNotIn('pers_id', $array_prof);
			}
		}elseif($request->clases != null){
			$clases = Clases::find($request->clases);
			$array_prof = $clases->profesor->pluck('pers_id');
			$profesores = Personal::where('persona_rut', 'LIKE', '%'.$request->rut.'%')->whereIn('pers_id', $array_prof)->whereNotIn('pers_id', [$clases->profesor_id])->get();
			//dd($profesores);
		}else{
			$periodo = PeriodoAcademico::where('pac_estado', 1)->first();
			if ($request->prof_jefe == 1) {
				$prof_jefes = $periodo->cursos()->where('cu_tipo', 1)->pluck('profesor_id');
				if ($request->tipo == 'rut') {
					$profesores = Personal::where('persona_rut', 'LIKE', '%'.$request->rut.'%')->whereNotIn('pers_id', $prof_jefes)->get();
				}elseif($request->tipo == 'nom'){
					$personas = Persona::where('pe_nombres', 'LIKE', '%'.$request->rut.'%')->orWhere('pe_apellido_pat', 'LIKE', '%'.$request->rut.'%')->orWhere('pe_apellido_mat', 'LIKE', '%'.$request->rut.'%')->pluck('pe_rut');
					$profesores = Personal::whereIn('persona_rut', $personas)->whereNotIn('pers_id', $prof_jefes)->get();
				}
			}elseif ($request->prof_taller == 1) {
				$prof_taller = $periodo->cursos()->where('cu_tipo', 2)->pluck('profesor_id');
				$persona = Persona::where('pe_nombres', 'LIKE', '%'.$request->rut.'%')->orWhere('pe_apellido_mat', 'LIKE', '%'.$request->rut.'%')->orWhere('pe_apellido_pat', 'LIKE', '%'.$request->rut.'%')->orWhere('pe_rut', 'LIKE', '%'.$request->rut.'%')->pluck('pe_rut');
				$profesores = Personal::whereIn('persona_rut', $persona)->whereNotIn('pers_id', $prof_taller)->get();
			}
		}
		$data = [];
		foreach ($profesores as $prof) {


			if ($request->tipo == 'rut') {
				$title = $prof->persona_rut;
				$description = $prof->persona->nombreCompleto();
			}else{
				$title = $prof->persona->nombreCompleto();
				$description = $prof->persona_rut;
			}
			$data[] = [
				'title'=> $title,
				'description' => $description,
				'rut'=>$prof->persona_rut,
				'nombre_comp' => $prof->persona->nombreCompleto(),
				'nombres'=>$prof->persona->pe_nombres,
				'ape_pat' => $prof->persona->pe_apellido_pat,
				'ape_mat' => $prof->persona->pe_apellido_pat,
				'prof_id' => $prof->pers_id,
				'tipo' => $request->tipo,
			];
		}
		return response()->json($data);
	}


	public function searchPersonaUser(Request $request)
	{

		$usuarios = Usuario::select('persona_rut')->get()->toArray();

		$cargos = Cargo::select('ca_id')->whereIn('ca_nombre', ['Profesor', 'Jefe UTP', 'Director'])->get()->toArray();
		$personal = Personal::where('persona_rut', 'LIKE', '%'.$request->rut.'%')->whereIn('cargo_id', $cargos)->whereNotIn('persona_rut', $usuarios)->get();
		$apoderado = Apoderado::where('persona_rut', 'LIKE', '%'.$request->rut.'%')->whereNotIn('persona_rut', $usuarios)->get();
		//dd($personal);
		//$persona = Persona::where('pe_rut', 'LIKE', '%'.$request->rut.'%')->get();
		$data = [];


		foreach ($personal as $empl) {
			$rol = Rol::where('name', $empl->cargo->ca_nombre)->first();
			$data[] = [
				'rut'=>$empl->persona_rut,
				'nombre_comp' => $empl->persona->nombreCompleto(),
				'tipo' => '<label class="label ui blue small">'.$empl->cargo->ca_nombre.'</label>',
				'cargo' => $empl->cargo->ca_nombre,
				'rol' => $rol->id,
				'model' => $empl,
			];
		}
		foreach ($apoderado as $apod) {
			$rol = Rol::where('name', 'Apoderado')->first();
			$data[] = [
				'rut'=>$apod->persona_rut,
				'nombre_comp' => $apod->persona->nombreCompleto(),
				'tipo' => '<label class="label ui teal small">Apoderado</label>',
				'cargo' => '',
				'rol' => $rol->id,
				'model' => $apod,
			];
		}

		$req ['items'] = $data;


		return response()->json($data);
		//return response()->json($req);
	}


	public function searchArticulos(Request $request)
	{
		if ($request->items != null) {
			$articulos = Articulo::where('art_item', 'LIKE', '%'.$request->item.'%')->whereNotIn('art_item', $request->items)->get();
			
			//dd($articulos);
		}else{
			$articulos = Articulo::where('art_item', 'LIKE', '%'.$request->item.'%')->get();
		}
		$data = [];
		foreach ($articulos as $art) {
			$data[] = [
				'item' => $art->art_item,
				'nombre' => $art->art_nombre,
				'tipo' => $art->tipo->tart_nombre,
				'model' => $art,
			];
		}
		return response()->json($data);
	}

	public function searchProveedor(Request $request)
	{
		$proveedores = Proveedor::where('prov_razon_social', 'LIKE', '%'.$request->razon.'%')->get();
		$data = [];
		foreach ($proveedores as $prov) {
			$data[] = [
				'nombre' => $prov->prov_razon_social,
				'descripcion' => $prov->prov_direccion,
				'comuna' => $prov->comuna->com_nombre,
				'model'=> $prov,
			];			
		}
		return response()->json($data);
	}

	public function searchResponsable(Request $request)
	{
		if ($request->tipo == 'rut') {
			$responsables = Personal::where('persona_rut', 'LIKE', '%'.$request->rut.'%')->get();
		}elseif($request->tipo == 'nom'){
			$personas = Persona::where('pe_nombres', 'LIKE', '%'.$request->rut.'%')->orWhere('pe_apellido_pat', 'LIKE', '%'.$request->rut.'%')->orWhere('pe_apellido_mat', 'LIKE', '%'.$request->rut.'%')->pluck('pe_rut');
			$responsables = Personal::whereIn('persona_rut', $personas)->get();
		}
		//$responsables = Personal::where('persona_rut', 'LIKE', '%'.$request->rut.'%')->get();
		$data = [];
		foreach ($responsables as $resp) {
			if ($request->tipo == 'rut') {
				$title = $resp->persona_rut;
				$description = $resp->persona->nombreCompleto();
			}else{
				$title = $resp->persona->nombreCompleto();
				$description = $resp->persona_rut;
			}
			$data[] = [
				'title'=>$title,
				'description'=>$description,
				'rut' => $resp->persona_rut,
				'nombre' => $resp->persona->nombreCompleto(),
				'cargo' => $resp->cargo->ca_nombre,
				'tipo' => $request->tipo,
			];
		}
		return response()->json($data);
	}

}
