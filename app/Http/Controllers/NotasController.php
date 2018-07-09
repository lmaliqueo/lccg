<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Curso;
use App\Clases;
use App\Notas;
use App\PeriodoAcademico;
use App\Semestre;
use App\Personal;
use App\Asignatura;

class NotasController extends Controller
{
    public function menuNotas()
    {
		if(\Auth::user()->profesor()){
			$periodo = PeriodoAcademico::where('pac_estado', 1)->first();
			$profesor = Personal::where('persona_rut', \Auth::user()->persona_rut)->first();
			$cursos_ar = $profesor->clases->pluck('curso_id');
			$cursos = $periodo->cursos->where('cu_tipo', 1)->whereIn('cu_id', $cursos_ar);
    		return view('notas.menu_notas', compact('periodo', 'cursos'));
		}
		$periodos = PeriodoAcademico::get();
    	return view('notas.menu_notas', ['periodos' => $periodos]);
    }

    public function tablaNotas(Request $request)
    {
    	$clase = Clases::find($request->clases_id);
    	return view('notas_alumnos', compact('clase'));
    }

	public function mostrarNotas(Request $request)
	{
		//dd($request->all());
		$semestre = Semestre::find($request->semestre);
		$clase = Clases::find($request->clase);
    	$religion = Asignatura::where('asig_nombre', 'Religion')->first();
		//$notas = $clase->notas->where('semestre_id', $semestre->sem_id)->get();
		return view('notas.notas_alumnos', compact('clase', 'semestre', 'religion'));
	}

	public function guardarNotas(Request $request)
	{
		$clase = Clases::find($request->clase);
		$relig = Asignatura::where('asig_nombre', 'Religion')->first();
		$semestre = Semestre::find($request->semestre);
		if($clase->asignatura_id != $relig->asig_id){
			$cant = $clase->curso->listaAlumnos->count();
		}else{
			$cant = $clase->curso->listaAlumnos->where('mat_clases_religion', 1)->count();
		}
		//dd($request->curso_notas);
		$data = [];
		for ($i=2; $i < $cant+2 ; $i++) { 
			$flag = 0;
			foreach ($request->curso_notas[$i] as $count => $array) {
				if ($count == 1) {
					foreach ($array as $contador => $notas) {
						if ($contador == 0) {
							if ($notas == null) {
								$edit_notas = new Notas();
								$edit_notas->matricula_id = $request->curso_notas[$i][0];
								$edit_notas->clase_id = $clase->cla_id;
								//dd($edit_notas);
							}else{
								$flag = 1;
								$edit_notas = Notas::find($notas);
								//dd($edit_notas);
							}
						}else{
							$edit_notas->not_nota1 = $array[1];
							$edit_notas->not_nota2 = $array[2];
							$edit_notas->not_nota3 = $array[3];
							$edit_notas->not_nota4 = $array[4];
							$edit_notas->not_nota5 = $array[5];
							$edit_notas->not_nota6 = $array[6];
							$edit_notas->not_nota7 = $array[7];
							$edit_notas->not_nota8 = $array[8];
							$edit_notas->not_nota9 = $array[9];
							$edit_notas->not_nota10 = $array[10];
							$edit_notas->not_nota11 = $array[11];
							$edit_notas->not_nota12 = $array[12];
						}
					}
				}elseif($count == 2){
					$edit_notas->not_promedio = $array;
				}
			}
			if ($flag == 0) {
				$edit_notas->semestre()->associate($semestre);
				$edit_notas->save();
			}else{
				$edit_notas->update();
			}
			$data[] = [
				'id'=>$edit_notas->not_id,
				'mat'=>$edit_notas->matricula_id,
			];
			//$request->curso_notas[$i] = 
		}
		return response()->json($data);
	}
}
