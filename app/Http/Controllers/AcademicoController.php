<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PeriodoAcademico;
use App\Curso;
use App\Clases;
use App\Notas;
use App\Matricula;
use App\GrupoPauta;
use App\Concepto;
use App\MateriaEnsayos;
use App\TipoEnsayo;
use App\Ensayo;
use App\Semestre;
use App\clasesRealizadas;
use App\DiaClase;
use App\Cargo;

class AcademicoController extends Controller
{
    public function index()
    {
    	return view('academico.index');
    }



/*----------------------------------------------------------*/
/*-------------------------- AJAX --------------------------*/
/*----------------------------------------------------------*/

	public function listaAsignaturas(Request $request)
	{
		$curso = Curso::find($request->curso);
		$user = \Auth::user();

		if ($user->profesor()) {
			$profesor = Personal::where('persona_rut', $user->persona_rut)->where('cargo_id', 1)->first();
			$clases = Clases::where('curso_id', $curso->cu_id)->where('profesor_id', $profesor->pers_id)->get();
		}else{
			$clases = $curso->clases;
		}

		if ($request->tipo == 1) {
			$color = 'blue';
		}else{
			$color = 'orange';
		}
		foreach ($clases as $clase) {
			$data[] = '<a class="ui button circular inverted '.$color.' button_clase" data-clases="'.$clase->cla_id.'">'.$clase->asignatura->asig_nombre.'</a>';
		}
			$data[] = '<a class="ui button circular inverted green button_curso" data-curso="'.$curso->cu_id.'">General</a>';
		return response()->json($data);
	}




/*##########################################################*/
/*##########################################################*/
/*##################### COMPORTAMIENTO #####################*/
/*##########################################################*/
/*##########################################################*/

	public function evaluarComportamiento()
	{
		$periodos = PeriodoAcademico::orderBy('pac_id', 'DESC')->get();
		if (\Auth::user()->profesor()) {
			$cargo = Cargo::where('ca_nombre', 'Profesor')->first();
			$profesor = \Auth::user()->persona->empleados->where('cargo_id', $cargo->ca_id)->first();
			$periodo = PeriodoAcademico::where('pac_estado', 1)->first();
			$curso = Curso::where('periodo_id', $periodo->pac_id)->where('profesor_id', $profesor->pers_id)->first();
			return view('academico.comportamiento', ['curso'=>$curso]);
		}
		return view('academico.comportamiento', ['periodos'=>$periodos]);
	}

	public function pauta_conceptos(Request $request)
	{
		$alumno = Matricula::find($request->matricula);
		$pauta = GrupoPauta::get();
		//dd($alumno->detallesConceptos);
		return view('academico.pauta_conceptos', ['alumno'=>$alumno, 'pauta'=>$pauta]);
		
	}

	public function createPauta(Request $request)
	{
		$alumno = Matricula::find($request->mat);
		$pauta = GrupoPauta::get();
		$conceptos = Concepto::pluck('con_nombre', 'con_id');
		//dd($conceptos);
		return view('academico.create_pauta', ['alumno'=>$alumno, 'pauta'=>$pauta, 'conceptos'=>$conceptos]);
	}

	public function storePauta(Request $request)
	{
		$alumno = Matricula::find($request->alumno['mat_id']);
		//dd($request->old_conceptos);
		if ($request->old_conceptos != null) {
			foreach ($request->old_conceptos as $edit_conceptos) {
				if ($edit_conceptos['concepto_id'] != null) {
					if ($edit_conceptos['concepto_id'] != $edit_conceptos['old_concepto']) {
	if ($edit_conceptos['old_concepto'] != null) {
		$alumno->detallesConceptos()->updateexistingpivot($edit_conceptos['detalle_id'], ['concepto_id'=>$edit_conceptos['concepto_id']]);

	}else{
		$alumno->detallesConceptos()->attach($edit_conceptos['detalle_id'], ['concepto_id'=>$edit_conceptos['concepto_id']]);

	}
					}
				}
			}
		}else{
			foreach ($request->conceptos as $new_conceptos) {
				if ($new_conceptos['concepto_id'] != null) {
					$alumno->conceptos()->attach($new_conceptos['concepto_id'], ['detallepauta_id'=>$new_conceptos['detalle_id']]);
				}
			}

		}



		$pauta = GrupoPauta::get();
		return view('academico.pauta_conceptos', ['alumno'=>$alumno, 'pauta'=>$pauta]);
	}




/*########################################$##################*/
/*#########################################$#################*/
/*######################### ENSAYOS #########################*/
/*#########################################$#################*/
/*##########################################$################*/

	/*---------------------------------------------------------*/
	public function listaEnsayos($id_tipo, $id_periodo)
	{
		$ensayos = Ensayo::where('tipo_id', $request->tipo)->where('periodo_id', $request->periodo)->get();
		return $ensayos;
	}
	/*---------------------------------------------------------*/

	public function adminEnsayos(Request $request)
	{

		//$this->listaEnsayos($request->tipo, $request->periodo);
		//dd($request->tipo);
		$ensayos = Ensayo::where('tipo_id', $request->tipo)->where('periodo_id', $request->periodo)->get();
		return view('academico.admin_ensayos', ['ensayos'=>$ensayos]);
	}

	public function menuEnsayos()
	{
		$periodos = PeriodoAcademico::get();
		$tipos = TipoEnsayo::get();
		return view('academico.menu_ensayos', ['periodos'=>$periodos, 'tipos'=>$tipos]);
	}

	public function formEnsayo(Request $request)
	{
		//dd($request->all());

		$tipo = TipoEnsayo::find($request->tipo);
		$periodo = PeriodoAcademico::find($request->periodo);

		
		/*
		$alumno = Matricula::find($request->mat_id);
		$tipo_ensayo = TipoEnsayo::find($request->ensayo);
		$materias = $tipo_ensayo->materias;//MateriaEnsayos::get();*/
		return view('academico.form_ensayo', ['periodo'=>$periodo, 'tipo'=>$tipo]);
	}

	public function storeEnsayo(Request $request)
	{
		//dd($request->all());
		$ensayo = new Ensayo($request->ensayo);
		$periodo = PeriodoAcademico::where('pac_estado', 1)->first();
		$ensayo->periodo_id=$periodo->pac_id;
		$ensayo->save();
		foreach ($request->alumno as $alumno) {
			$ensayo->matriculas()->attach($alumno['matricula_id'], ['alr_resultado'=>$alumno['puntaje']]);

			/*
			$ensayo = Ensayo::where('ens_fecha', $request->fecha)->andWhere('periodo_id', $periodo->pac_id)->andWhere('materia_id', $ensayo['materia_id'])->first();
			if ($ensayo != null) {
				
			}*/
		}
	}

	public function listaAlumnosCursos(Request $request)
	{
		
	}

}
