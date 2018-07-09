<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Matricula;
use App\Alumno;
use App\PeriodoAcademico;
use App\TipoEnsayo;

class AlumnosController extends Controller
{



	public function info_alumno(Request $request)
	{
		$alumno = Alumno::find($request->rut);
		$matriculas = Matricula::where('alumno_rut', $alumno->al_rut)->join('periodo_academico as pac', 'matricula.periodo_id', '=', 'pac.pac_id')->orderBy('pac_ano', 'DESC')->get();

        $meses = [
            1=>'Enero',
            2=>'Febrero',
            3=>'Marzo',
            4=>'Abril',
            5=>'Mayo',
            6=>'Junio',
            7=>'Julio',
            8=>'Agosto',
            9=>'Septiembre',
            10=>'Octubre',
            11=>'Noviembre',
            12=>'Diciembre',
        ];

        $meses_asis = [];
        $meses_count = [];
        foreach ($matriculas as $mat) {
        	foreach ($mat->periodo->semestres as $semestre) {
	            $inicio = date("n", strtotime($semestre->sem_fecha_inicio));
	            $fin = date("n", strtotime($semestre->sem_fecha_termino));
	            $cont = 0;
	            for ($i=$inicio; $i <= $fin; $i++) { 
	                $meses_asis[$semestre->sem_id][$i]['mes'] = $meses[$i];
	                $meses_asis[$semestre->sem_id][$i]['num'] = $i;
	                $cont++;
	            }
	            $meses_count[$semestre->sem_id] = $cont;
        	}
        }
        $ensayos = TipoEnsayo::get();



		return view('alumno.info_alumno', compact('alumno', 'matriculas', 'meses_asis', 'meses_count', 'ensayos'));
	}

	public function index()
	{
		$periodo = PeriodoAcademico::where('pac_estado', 1)->first();
		$alumnos=[];
		if (\Auth::user()->administrador()) {
			$alumnos = $periodo->matriculas()->paginate(5);
		}
		if (\Auth::user()->apoderado()) {
			$apoderados = \Auth::user()->persona->apoderados;
			foreach ($apoderados as $apod) {
				foreach ($apod->matriculas->where('periodo_id', $periodo->pac_id) as $alu) {
					$alumnos[] = $alu;
				}
			}
			//dd($apoderados);
		}
		return view('alumno.index', compact('periodo', 'alumnos'));
	}

	public function show($id){
		$alumno = Matricula::find($id);
		$curso = $alumno->curso->first();
        $ensayos = TipoEnsayo::get();
		return view('alumno.view', compact('alumno', 'curso', 'ensayos'));
	}
}
