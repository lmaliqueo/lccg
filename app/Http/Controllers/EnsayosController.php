<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PeriodoAcademico;
use App\TipoEnsayo;
use App\Ensayo;
use App\ParametrosCursos;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;

class EnsayosController extends Controller
{

	public function index_simce()
	{
		$periodo_actual = PeriodoAcademico::where('pac_estado', 1)->first();

		$simce = TipoEnsayo::where('ten_tipo', 'simce')->first();

		$pruebas_simces = $simce->ensayos->where('periodo_id', $periodo_actual->pac_id);

		return view('ensayos.index_simce', ['pruebas_simces'=>$pruebas_simces, 'periodo_actual'=>$periodo_actual]);

	}


	public function create_simce()
	{
		$periodo_actual = PeriodoAcademico::where('pac_estado', 1)->first();
		$grados = ParametrosCursos::whereIn('pcur_grado', [1, 2, 3])->get();
		$cursos = [];
		foreach ($grados as $grado) {
			foreach ($grado->cursos->whereIn('periodo_id', [$periodo_actual->pac_id]) as $count => $cu) {
					$cursos[$grado->pcur_grado][] = $cu;
			}
			
		}
				//dd($cursos);

		$simce = TipoEnsayo::where('ten_tipo', 'simce')->first();

		return view('ensayos.create_simce', ['periodo_actual'=>$periodo_actual, 'simce'=>$simce, 'grados'=>$grados, 'cursos'=>$cursos]);
	}

	public function store_simce(Request $request)
	{
		$simce = new Ensayo($request->ensayo);
		//dd($simce);
        DB::beginTransaction();
        try {
			$simce->save();
			foreach ($request->alumno as $alumno) {
				if ($alumno['puntaje'] != null) {
					$simce->matriculas()->attach($alumno['matricula'], ['alr_resultado'=>$alumno['puntaje']]);
				}
			}
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

		Flash::success('El ensayo SIMCE de '.$simce->materia->mens_nombre.' se a creado de forma exitosa');

		return redirect()->route('ensayos.simce.index');

	}

	public function view_simce($id)
	{
		$simce = Ensayo::find($id);
		return view('ensayos.view_simce', ['simce'=>$simce]);
	}

	public function edit_simce($id)
	{
		$simce = Ensayo::find($id);
		$materias = TipoEnsayo::where('ten_tipo', 'simce')->first()->materias;
		$periodo = PeriodoAcademico::where('pac_estado', 1)->first();
		$grados = ParametrosCursos::whereIn('pcur_grado', [1, 2, 3])->get();
		//$cursos = $grados->cursos->where('periodo_id', $simce->periodo_id);
		return view('ensayos.edit_simce', compact('simce', 'materias', 'grados'));
	}

	public function update_simce(Request $request, $id)
	{
		$simce = Ensayo::find($id);
        DB::beginTransaction();
        $array_al = [];
        $i = 1;
        try {
        	foreach ($request->alumno as $al) {
        		if ($al['alr_resultado'] != null) {
	        		$array_al[$i] = [
	        			'matricula_id'=>$al['matricula_id'],
	        			'alr_resultado'=>$al['alr_resultado']
	        		];
	        		$i++;
        		}
        	}
			$simce->update($request->ensayo);
			$simce->matriculas()->sync($array_al);
        	//dd($array_al);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
		Flash::info('El ensayo SIMCE de '.$simce->materia->mens_nombre.' se a modificado correctamente');
		return redirect()->route('ensayos.simce.index');
	}



	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/


	public function index_psu()
	{
		$periodos = PeriodoAcademico::get();
		$periodo_actual = $periodos->where('pac_estado', 1)->first();
		$ensayos = $periodo_actual->ensayos->where('tipo_id', 1);
		return view('ensayos.index_psu', ['periodos'=>$periodos, 'periodo_actual'=>$periodo_actual, 'ensayos'=>$ensayos]);
	}


	public function create_psu()
	{
		$periodo = PeriodoAcademico::where('pac_estado', 1)->first();
		$psu = TipoEnsayo::where('ten_tipo', 'psu')->first();
		return view('ensayos.create_psu', ['periodo'=>$periodo, 'psu'=>$psu]);
	}

	public function store_psu(Request $request)
	{
		$periodo = PeriodoAcademico::where('pac_estado', 1)->first();
		$psu = new Ensayo($request->ensayo);
		$tipo = TipoEnsayo::where('ten_tipo', 'psu')->first();
		$psu->tipo()->associate($tipo);
		$psu->periodo()->associate($periodo);
		//dd($psu);
        DB::beginTransaction();
        try {
			$psu->save();
			foreach ($request->alumno as $alumno) {
				$psu->matriculas()->attach($alumno['matricula_id'], ['alr_resultado'=>$alumno['puntaje']]);
			}
            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
        }

		Flash::success('El ensayo PSU de '.$psu->materia->mens_nombre.' se a creado de forma exitosa');

		return redirect()->route('ensayos.psu.index');
	}

	public function view_psu($id)
	{
		$psu = Ensayo::find($id);
		return view('ensayos.view_psu', ['psu'=>$psu]);
	}

	public function edit_psu($id)
	{
		$psu = Ensayo::find($id);
		//dd($psu->matriculas);
		return view('ensayos.edit_psu', compact('psu'));
	}

	public function update_psu(Request $request, $id)
	{
		$psu = Ensayo::find($id);
        DB::beginTransaction();
        //dd($request->alumno);
        try {
			$psu->update($request->ensayo);
			$psu->matriculas()->sync($request->alumno);
            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
        }
		Flash::info('El ensayo PSU de '.$psu->materia->mens_nombre.' se a modificado con correctamente');
		return redirect()->route('ensayos.psu.index');

	}


	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/


	public function delete_ensayo(Request $request)
	{
		$ensayo = Ensayo::find($request->id);
		$ensayo->delete();

		return 1;
	}

}
