<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PeriodoAcademico;
use App\Liceo;
use App\Semestre;
use App\Asignatura;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\DB;

class PeriodoController extends Controller
{
    public function index()
    {
    	$periodos = PeriodoAcademico::orderBy('pac_id','ASC')->paginate(10);
    	return view('periodo.index', ['periodos'=>$periodos]);
    }

    public function show($id)
    {
        $periodo = PeriodoAcademico::find($id);
        return view('periodo.view', compact('periodo'));
    }

    public function create()
    {
        $periodo_ant = PeriodoAcademico::orderBy('pac_ano', 'DESC')->first();
    	return view('periodo.create', compact('periodo_ant'));
    }

    public function store(Request $request)
    {
        $periodo_ant = PeriodoAcademico::where('pac_estado', 1)->first();
        $liceo = Liceo::where('lic_id', 1)->first();
        /*
    	if ($periodo_ant != NULL) {
	    	$periodo_ant->pac_estado = 0;
	    	$periodo_ant->save();
    	}*/
    	$periodo = new PeriodoAcademico($request->all());
        $periodo->liceo()->associate($liceo);
    	$periodo->pac_estado = 1;
    	$periodo->save();
    	return redirect()->route('parametros.admin.periodos');
    }

    public function edit($id)
    {
        $periodo = PeriodoAcademico::find($id);
    	if ($periodo->pac_estado != 2) {
            return view('periodo.edit', compact('periodo'));
        }
    }

    public function update(Request $request, $id)
    {
        $periodo = PeriodoAcademico::find($id);
        DB::beginTransaction();
        try {
            $periodo->update($request->periodo);
            if (isset($request->semestre)) {
                foreach ($request->semestre as $semestre) {
                    $old_sem = Semestre::find($semestre['sem_id']);
                    if ($old_sem != null) {
                        $old_sem->update($semestre);
                    }
                }
            }
            Flash::info('Se a modificado el periodo académico '.$periodo->pac_ano.' de forma exitosa');

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
        return redirect()->route('parametros.admin.periodos');
    }

    public function destroy($id)
    {

    }

    public function addSemestre(Request $request)
    {
        $periodo = PeriodoAcademico::find($request->id);
        $cant_sem = $periodo->semestres->count();
        $cant_sem++;
        return view('periodo.add_semestre', ['periodo'=>$periodo, 'cant_sem'=>$cant_sem]);
    }

    public function storeSemestre(Request $request)
    {
        $semestre = new Semestre($request->all());
        $semestre->sem_estado = 0;
        $semestre->save();
        return redirect()->route('parametros.admin.periodos');
    }

    public function actSemestre(Request $request)
    {
        $semestre = Semestre::find($request->id);
        $semestre->sem_estado = 1;
        $semestre->update();
        if ($semestre->sem_numero == 1) {
            $sem_2 = $semestre->periodo->semestres->where('sem_numero', 2)->first();
            if ($sem_2 != null) {
                $sem_2->sem_estado = 0;
                $sem_2->update();
            }
        }
        Flash::info('El '.$semestre->sem_numero.'° semestre del año '.$semestre->periodo->pac_ano.' esta activo');
        return 1;

    }

    public function finSemestre(Request $request)
    {
        $semestre = Semestre::find($request->id);
        $relig = Asignatura::where('asig_nombre', 'Religion')->first();
        $clases_relig = $relig->clases->whereIn('curso_id', $semestre->periodo->cursos->pluck('cu_id'))->pluck('cla_id');

        $alumnos = $semestre->periodo->matriculas;
        foreach ($alumnos->where('mat_estado', '<>', 3) as $alumno) {
            $prom_al = $alumno->notas->where('not_promedio', '<>', null)->whereNotIn('clases_id', $clases_relig)->avg('not_promedio');
            $alumno->mat_prom_general = round($prom_al, 1);
            $alumno->mat_prom_asis = $alumno->prom_asis_anual();
            //dd($alumno->mat_prom_general);
            $alumno->update();
        }
        Flash::success('se a finalizado el '.$semestre->sem_numero.'° semestre del año '.$semestre->periodo->pac_ano);

        $semestre->sem_estado = 2;
        $semestre->update();
        return 1;
    }

    public function finPeriodo(Request $request)
    {
        $periodo = PeriodoAcademico::find($request->id);
        DB::beginTransaction();
        try {
            foreach ($periodo->matriculas->where('mat_estado', 1) as $alumno) {
                if ($alumno->mat_prom_general >= 4) {
                    $alumno->mat_estado = 2;
                }else{
                    $alumno->mat_estado = 4;
                }
                $alumno->update();
            }
            $periodo->pac_estado = 2;
            $periodo->update();
            DB::commit();
            Flash::success('se a finalizado el año escolar '.$periodo->pac_ano);
        } catch (Exception $e) {
            DB::rollBack();
        }
        return 1;
    }
}
