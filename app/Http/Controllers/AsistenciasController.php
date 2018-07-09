<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clases;
use App\ClasesRealizadas;
use App\Curso;
use App\Matricula;
use App\Aisgnatura;
use App\Asistencia;
use App\Semestre;
use App\DiaClase;
use App\PeriodoAcademico;
use App\Asignatura;
use App\Personal;
use Illuminate\Support\Facades\DB;
use Charts;

class AsistenciasController extends Controller
{

    public function menuAsistencia()
    {
        if(\Auth::user()->profesor()){
            $periodo = PeriodoAcademico::where('pac_estado', 1)->first();
            $profesor = Personal::where('persona_rut', \Auth::user()->persona_rut)->first();
            $cursos_ar = $profesor->clases->pluck('curso_id');
            $cursos = $periodo->cursos->where('cu_tipo', 1)->whereIn('cu_id', $cursos_ar);
            return view('academico.menu_asistencia', compact('cursos', 'periodo'));
        }
        $periodos = PeriodoAcademico::get();
        return view('academico.menu_asistencia', ['periodos' => $periodos]);
    }



    public function guardar_asis(Request $request)
    {
        $semestre = Semestre::find($request->id_semestre);
    	$clase = Clases::find($request->id_clases);
    	$cont = 0;
        DB::beginTransaction();

        try {
            foreach ($request->clases_r as $count => $clases_r) {
                if($clases_r['cr_fecha'] != null){
                    if ($clases_r['id'] != null) {
                        $clase_r_exist = ClasesRealizadas::find($clases_r['id']);
                        if($clases_r['cr_fecha'] != $clase_r_exist->diaClase->dc_fecha){

                            if ($clases_r['cr_fecha'] != null) {
                                $dia_clase = DiaClase::where('dc_fecha', $clases_r['cr_fecha'])->where('semestre_id', $semestre->sem_id)->first();

                                if ($dia_clase != null) {
                                    $clase_r_exist->dia_clase_id = $dia_clase->dc_id;
                                }else{
                                    $diaclase = DiaClase::find($clase_r_exist->dia_clase_id);
                                    if ($diaclase->clasesRealizadas->count() >= 2) {
                                        $new_diaclase = new DiaClase();
                                        $new_diaclase->semestre()->associate($semestre);
                                        $new_diaclase->save();
                                        $clase_r_exist->dia_clase_id = $new_diaclase->dc_id;
                                    }else{
                                        $diaclase->dc_fecha = $clases_r['cr_fecha'];
                                        $diaclase->update();
                                    }
                                    
                                }
                            }else{
                                $clase_r_exist->delete();
                            }
                            $clase_r_exist->update();
                        }
                        $clases[] = $clase_r_exist->cr_id;
                    }else{
                        $realizada = new ClasesRealizadas($clases_r);



                        $dia_clase = DiaClase::where('dc_fecha', $clases_r['cr_fecha'])->where('semestre_id', $semestre->sem_id)->first();

                        if ($dia_clase != null) {
                            $realizada->dia_clase_id = $dia_clase->dc_id;
                        }else{
                            $new_diaclase = new DiaClase();
                            $new_diaclase->semestre()->associate($semestre);
                            $new_diaclase->dc_fecha = $clases_r['cr_fecha'];
                            $new_diaclase->save();
                            $realizada->dia_clase_id = $new_diaclase->dc_id;
                        }

                            //$clase_r_exist->cr_fecha = $clases_r['cr_fecha'];
                            //$clase_r_exist->update();




                        $realizada->cr_estado = 1;
                        $realizada->clase_id = $clase->cla_id;
                        //$realizada->semestre()->associate($semestre);
                        $realizada->save();
                        $clases[] = $realizada->cr_id;
                    }
                    $cont++;
                }
            }
            foreach ($request->asistencia as $i => $alumnos) {
                foreach ($alumnos as $j => $asistencia) {
                    if ($j <= $cont) {
                        if($asistencia['estado'] != null){
                            //dd($asistencia['id']);
                            if ($asistencia['id'] != null) {
                                $asistencia_exist = Asistencia::find($asistencia['id']);
                                $dia_clase = $asistencia_exist->clasesRealizadas->diaClase;
                                $dia_clase->matriculas()->updateexistingpivot($asistencia_exist->matricula_id, ['ala_estado'=>$asistencia['estado']]);
                                if($asistencia['estado'] != $asistencia_exist->asis_estado){
                                    $asistencia_exist->asis_estado = $asistencia['estado'];
                                    $asistencia_exist->update();
                                }
                            }else{
                                $matricula = Matricula::find($asistencia['matricula']);
                                $clases_re = ClasesRealizadas::find($clases[$j-1]);

                                $dia_clase = $clases_re->diaClase;
                                if ($dia_clase->matriculas->where('mat_id', $matricula->mat_id)->count()) {
                                    $dia_clase->matriculas()->updateexistingpivot($matricula->mat_id, ['ala_estado'=>$asistencia['estado']]);
                                }else{
                                    $dia_clase->matriculas()->attach($matricula->mat_id, ['ala_estado'=>$asistencia['estado']]);
                                }




                                $new_asistencia = new Asistencia();
                                $new_asistencia->asis_estado = $asistencia['estado'];
                                $new_asistencia->matricula()->associate($matricula);
                                $new_asistencia->clasesRealizadas()->associate($clases_re);
                                $new_asistencia->save();
                            }

                        }
                        
                    }else{
                        break;
                    }
                }
            }

            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
        }
        return response()->json(1);
    }



    public function verAsistencia(Request $request)
    {
        $clase = Clases::find($request->clase);
        $semestre = Semestre::find($request->semestre);

        $mes_actual = date('m');
        $mes_status = [];
        for ($i = 1; $i <= 12 ; $i++) {
            if ($i == $mes_actual) {
                $mes_status[$i] = 'active';
            }else{
                $mes_status[$i] = '';
            }
        }

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

        $dia_clase = DiaClase::select('dc_id')->where('semestre_id', $semestre->sem_id)->whereMonth('dc_fecha', $mes_actual)->get()->toArray();
            $clases_r = clasesRealizadas::where('clase_id', $clase->cla_id)->whereIn('dia_clase_id', $dia_clase)->get();
        //dd($clases_r);
        if ($dia_clase == null) {
            $clases_r = '[]';
        }else{

        }
        $religion = Asignatura::where('asig_nombre', 'Religion')->first();
        //dd($clase->clasesRealizadas);
        return view('asistencias.view_asistencias', compact('clase', 'semestre', 'clases_r', 'mes_status', 'meses', 'religion'));
    }



    public function create_asis(Request $request)
    {
        //dd($request->all());
        $semestre = Semestre::find($request->semestre);
        $clase = Clases::find($request->clase);
        $ult_dia = date("Y-m-d",(mktime(0,0,0,$request->mes+1,1,$semestre->periodo->pac_ano)-1));
        $prim_dia = date("Y-m-d",(mktime(0,0,0,$request->mes,1,$semestre->periodo->pac_ano)));
        if ($prim_dia < $semestre->sem_fecha_inicio) {
            $prim_dia = $semestre->sem_fecha_inicio;
        }
        $mes_text = $request->mes_text;

        $array_dias_clase = $clase->clasesRealizadas->pluck('dia_clase_id');

        $dia_clase = DiaClase::where('semestre_id', $semestre->sem_id)->whereMonth('dc_fecha', $request->mes)->orderBy('dc_fecha', 'ASC')->get();
        $array_dias = $dia_clase->pluck('dc_id');
        /*
        $prim_dia_clases = $dia_clase->where('semestre_id', $semestre->sem_id)->where('dc_fecha', '>=', $prim_dia)->whereIn('dc_id', $array_dias_clase)->first();

        if ($prim_dia_clases != null) {
            $prim_dia = strtotime ( '+1 day' , strtotime ( $prim_dia_clases->dc_fecha ) ) ;
            $prim_dia = date ( 'Y-m-d' , $prim_dia );
        }
*/
        $religion = Asignatura::where('asig_nombre', 'Religion')->first();

        $clases_r = clasesRealizadas::where('clase_id', $clase->cla_id)->whereIn('dia_clase_id', $dia_clase->pluck('dc_id'))->get();
        return view('asistencias.create_asistencias', compact('clase', 'semestre', 'clases_r', 'mes_text', 'ult_dia', 'prim_dia', 'religion'));
    }

    public function index_grafico()
    {


        $mes_actual = date('m');
        $mes_status = [];
        for ($i = 1; $i <= 12 ; $i++) {
            if ($i == $mes_actual) {
                $mes_status[$i] = 'active';
            }else{
                $mes_status[$i] = '';
            }
        }

        $periodos = PeriodoAcademico::orderBy('pac_ano', 'DESC')->get();

        $semestre = Semestre::whereIn('sem_estado', [1, 2])->first();
        $fecha_ini = DiaClase::select('dc_fecha')->orderBy('dc_fecha', 'ASC')->first();
        $fecha_fin = DiaClase::select('dc_fecha')->orderBy('dc_fecha', 'DESC')->first();
        $dias_clases = DiaClase::where('semestre_id', $semestre->sem_id)->orderBy('dc_fecha', 'ASC')->get();



        return view('asistencias.index_grafico', ['periodos'=>$periodos, 'fecha_fin'=>$fecha_fin, 'fecha_ini'=>$fecha_ini, 'mes_status'=>$mes_status]);
    }

    public function viewAsisMes(Request $request)
    {
        //dd($request->all());
        $clase = Clases::find($request->clase);
        $semestre = Semestre::find($request->semestre);



        $mes_text = $request->mes_text;
        $mes = $request->mes;
        if ($mes != 'ano') {
            $dia_clase = $semestre->diaClase()->whereMonth('dc_fecha', $request->mes)->pluck('dc_id');
        }else{
            $dia_clase = $semestre->diaClase->pluck('dc_id');
        }
        $clases_r = clasesRealizadas::where('clase_id', $clase->cla_id)->whereIn('dia_clase_id', $dia_clase)->get();
        $religion = Asignatura::where('asig_nombre', 'Religion')->first();

        //dd($clases_r);
        //dd($clase->clasesRealizadas);
        return view('asistencias.table_asis', compact('clase', 'semestre', 'clases_r', 'mes_text', 'mes', 'religion'));
    }





    public function view_grafico(Request $request)
    {

        if (($request->curso1 != null) && ($request->curso2 != null)) {
            $curso1 = Curso::find($request->curso1);
            $curso2 = Curso::find($request->curso2);

            $alumnos1 = $curso1->listaAlumnos->pluck('mat_id');
            $alumnos2 = $curso2->listaAlumnos->pluck('mat_id');

            $asis_curso1 = [];
            $asis_curso2 = [];
        }

        $curso = Curso::find($request->curso);
        $cant_alumnos = Matricula::where('periodo_id', $request->periodo)->count();

        if ($request->estado == 1) {
            $sub_title = 'Alumnos Presentes';
        }else{
            $sub_title = 'Alumnos Ausentes';
        }

        if ($request->mes != null) {
            $title = 'Asistencias - '.$request->mes.' - '.$sub_title;
        }else{
            $title = 'Asistencias - '.$sub_title;
        }

        if (($request->semestre == null) || ($request->semestre == 0)) {
            $semestres = Semestre::where('periodo_id', $request->periodo)->pluck('sem_id');
            if (($request->mes_date != null) && ($request->mes_date != 'ano')) {
                $dias_clases = DiaClase::whereIn('semestre_id', $semestres)->whereMonth('dc_fecha', $request->mes_date)->orderBy('dc_fecha')->get();
            }else{
                $dias_clases = DiaClase::whereIn('semestre_id', $semestres)->where('dc_fecha', '>=', $request->fecha_ini)->where('dc_fecha', '<=', $request->fecha_fin)->orderBy('dc_fecha')->get();
            }
        }else{
            if (($request->mes_date != null) && ($request->mes_date != 'ano')) {
                $dias_clases = DiaClase::where('semestre_id', $request->semestre)->whereMonth('dc_fecha', $request->mes_date)->orderBy('dc_fecha')->get();
            }else{
                $dias_clases = DiaClase::where('semestre_id', $request->semestre)->where('dc_fecha', '>=', $request->fecha_ini)->where('dc_fecha', '<=', $request->fecha_fin)->orderBy('dc_fecha')->get();
            }
        }


        $array_asis_h = [];
        $array_asis_m = [];
        $array_dias = [];
        $array_asis_total = [];
        $array_curso1 = [];
        $array_curso2 = [];

        foreach ($dias_clases as $dias) {
            $cont_h = 0;
            $cont_m = 0;
            $cont_total = 0;
            $array_dias[] = $dias->dc_fecha;
            /*
            if ($request->curso != null) {
                foreach ($curso->listaAlumnos as $cont => $alumno) {
                    if ($alumno->mat_id == $dia->matricula_id) {
                        $array_dias[] = $dias->dc_fecha;
                        if ($alumno->alumno->al_sexo == 'masculino') {
                            $cont_h++;
                        }else{
                            $cont_m++;
                        }
                    }
                }
            }else{*/

            if (($request->curso1 != null) && ($request->curso2 != null)) {
                $asis_curso1 = $dias->alumnos_asis($request->estado)->whereIn('mat_id', $alumnos1)->count();
                $array_curso1[] = $asis_curso1;


                $asis_curso2 = $dias->alumnos_asis($request->estado)->whereIn('mat_id', $alumnos2)->count();
                $array_curso2[] = $asis_curso2;
                $array_asis_total[] = $asis_curso1 + $asis_curso2;
            }else{


                if($curso != null){
                    $alumnos_curso = $curso->listaAlumnos()->pluck('mat_id');
                    $asisten = $dias->alumnos_asis($request->estado)->whereIn('matricula_id', $alumnos_curso)->get();
                        //dd($asisten);
                    foreach ($dias->alumnos_asis($request->estado)->whereIn('matricula_id', $alumnos_curso)->get() as $asis) {
                        if ($asis->alumno->al_sexo == 'masculino') {
                            $cont_h++;
                            $cont_total++;
                        }elseif($asis->alumno->al_sexo == 'femenino'){
                            $cont_m++;
                            $cont_total++;
                        }
                        
                    }

                }else{
                    foreach ($dias->alumnos_asis($request->estado)->get() as $asis) {
                        //dd($asis);
                        if ($asis->alumno->al_sexo == 'masculino') {
                            $cont_h++;
                            $cont_total++;
                        }elseif($asis->alumno->al_sexo == 'femenino'){
                            $cont_m++;
                            $cont_total++;
                        }
                        
                    }

                }

                //}
                    //dd($cont_h);
                    $prom_alumnos = ($cont_total/$cant_alumnos)*100;


                //if (($cont_m != 0) || ($cont_h != 0)) {
                    $array_asis_h[] = $cont_h;
                    $array_asis_m[] = $cont_m;
                    $array_asis_total[] = $cont_total;
                //}

            }


        }
        if ($curso != null) {
            $title = $title.' - '.$curso->nombreCurso();
        }

        if (($request->curso1 != null) && ($request->curso2 != null)) {
            $chart = Charts::multi('line', 'highcharts')
                //->colors(['blue', 'pink'])
                ->title($title)
                ->labels($array_dias)
                ->dataset($curso1->nombreCurso(), $array_curso1)
                ->dataset($curso2->nombreCurso(), $array_curso2)
                ->dataset('Total', $array_asis_total);
        }else{
            $chart = Charts::multi('line', 'highcharts')
                //->colors(['blue', 'pink'])
                ->title($title)
                ->labels($array_dias)
                ->dataset('Hombres', $array_asis_h)
                ->dataset('Mujeres', $array_asis_m)
                ->dataset('Total', $array_asis_total);

        }


        /*
        if ($request->genero == 'masculino') {
            $chart = Charts::multi('line', 'highcharts')
                //->colors(['blue', 'pink'])
                ->title($title)
                ->labels($array_dias)
                ->dataset('Hombres', $array_asis_h);
                //->dataset('Mujeres', $array_asis_m)
                //->dataset('Total', $array_asis_total)
        }elseif ($request->genero == 'femenino') {
            $chart = Charts::multi('line', 'highcharts')
                //->colors(['blue', 'pink'])
                ->title($title)
                ->labels($array_dias)
                ->dataset('Mujeres', $array_asis_m);
                //->dataset('Hombres', $array_asis_h)
                //->dataset('Total', $array_asis_total)
        }else{*/
        //}

        return view('asistencias.chart_content', ['chart' => $chart,]);
    }

/**************************************************************************************/
/**************************************************************************************/
    protected function grafico_curso($request)
    {
        $curso = Curso::find($request->curso);



        if ($request->semestre == null) {
            $semestres = Semestre::select('sem_id')->where('periodo_id', $request->periodo)->get()->toArray();
            if ($request->mes_date != null) {
                $dias_clases = DiaClase::where('semestre_id', $semestres)->whereMonth('dc_fecha', $request->mes_date)->orderBy('dc_fecha')->get();
            }else{
                $dias_clases = DiaClase::where('semestre_id', $semestres)->whereMonth('dc_fecha', $request->mes_date)->orderBy('dc_fecha')->get();
            }
        }else{
            if ($request->mes_date != null) {
                $dias_clases = DiaClase::where('semestre_id', $request->semestre)->where('dc_fecha', '>=', $request->fecha_ini)->where('dc_fecha', '<=', $request->fecha_fin)->orderBy('dc_fecha')->get();
            }else{
                $dias_clases = DiaClase::where('semestre_id', $request->semestre)->where('dc_fecha', '>=', $request->fecha_ini)->where('dc_fecha', '<=', $request->fecha_fin)->orderBy('dc_fecha')->get();
            }
        }
        $array_asis_h = [];
        $array_asis_m = [];
        $array_dias = [];

        foreach ($dias_clases as $dia) {
            $cont_h = 0;
            $cont_m = 0;
            /*
            if ($request->curso != null) {
                foreach ($curso->listaAlumnos as $cont => $alumno) {
                    if ($alumno->mat_id == $dia->matricula_id) {
                        $array_dias[] = $dias->dc_fecha;
                        if ($alumno->alumno->al_sexo == 'masculino') {
                            $cont_h++;
                        }else{
                            $cont_m++;
                        }
                    }
                }
            }else{*/
                foreach ($dias->matriculas as $asis) {
                    if (($asis->alumno->al_sexo == 'masculino') && ($asis->pivot->ala_estado == 1)) {
                        $cont_h++;
                    }elseif(($asis->alumno->al_sexo == 'femenino') && ($asis->pivot->ala_estado == 1)){
                        $cont_m++;
                    }
                    
                }
            //}
            if (($cont_m != 0) || ($cont_h != 0)) {
                $array_asis_h[] = $cont_h;
                $array_asis_m[] = $cont_m;
            }
        }
        $chart = Charts::multi('line', 'highcharts')
            //->colors(['blue', 'pink'])
            ->title("Asistencias")
            ->labels($array_dias)
            ->dataset('Hombres', $array_asis_h)
            ->dataset('Mujeres', $array_asis_m);

    }

    protected function grafico_fechas($request)
    {

    }

    protected function grafico_generos($request)
    {

    }
/**************************************************************************************/
/**************************************************************************************/
}
