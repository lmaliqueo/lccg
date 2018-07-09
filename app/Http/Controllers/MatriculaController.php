<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Matricula;
use App\Alumno;
use App\Persona;
use App\Apoderado;
use App\Padres;
use App\PeriodoAcademico;
use App\Comuna;
use App\Curso;
use App\EstablecimientoAnterior;
use App\GrupoPauta;
use App\Enfermedad;
use App\TipoEnsayo;
use Validator;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;


class MatriculaController extends Controller
{
    public function __construct()
    {
        $this->middleware('periodo', ['only' => ['menu_retiro', 'create', 'menuTaller', 'admision_alumnos']]);
    }

    public function index()
    {
        return view('matricula.index');
    }

    public function admin(Request $request)
    {
        $search = $request;
        if ($request->has('periodo')) {
            $periodo = PeriodoAcademico::find($request->periodo);
        }else{
            $periodo = PeriodoAcademico::where('pac_estado', 1)->first();
        }
        $periodos = PeriodoAcademico::orderBy('pac_ano', 'DESC')->pluck('pac_ano', 'pac_id');
        if ($periodo == null) {
            $periodo = PeriodoAcademico::orderBy('pac_ano', 'DESC')->first();
        }
        $matriculas = $periodo->matriculas()->search($request)->orderBy('mat_numero', 'ASC')->paginate(10);
        return view('matricula.admin', compact('matriculas', 'periodo', 'request', 'periodos'));
    }

    public function list_alumnos(Request $request)
    {
        $periodo = PeriodoAcademico::where('pac_estado', 1)->first();
        if ($periodo != null) {
            $matriculas = $periodo->matriculas()->SearchAlu($request)->orderBy('mat_numero', 'ASC')->paginate(10);
        }else{
            $matriculas = null;
        }
        return view('matricula.list', compact('matriculas', 'periodo', 'request'));
    }

    public function delete_mat(Request $request)
    {
        if ($request->ajax()) {
            $matricula =  Matricula::find($request['id']);
            foreach ($matricula->padres as $padres) {
                if($padres->matriculas->count() < 2){
                    $padres->delete();
                }
            }
            foreach ($matricula->apoderados as $apods) {
                if($apods->matriculas->count() < 2){
                    $persona = $apods->persona;
                    $persona->delete();
                }
            }
            $alumno = $matricula->alumno;
            if($alumno->matriculas->count() < 2){
                $alumno->delete();
            }
            $matricula->delete();
            return response()->json(['msg'=>'la matrícula se a borrado exitosamente']);
        }
    }

    public function show($id)
    {
    	$matricula = Matricula::find($id);

        $periodo = $matricula->periodo;
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
        foreach ($periodo->semestres as $semestre) {
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

        $pauta = GrupoPauta::get();
        $curso = $matricula->curso->first();
        $array_mes = $matricula->diaClases()->whereMonth('dc_fecha', 10)->get()->pluck('dc_id');
        $array_asis = [];
        if ($curso != null) {
            if($curso->clases != '[]'){
                $array_asis = $curso->clases[0]->clasesRealizadas()->whereIn('dia_clase_id', $array_mes)->get()->pluck('cr_id');
            }
        }
        $ensayos = TipoEnsayo::get();
        //dd($meses_asis);

        return view('matricula.view', compact('matricula', 'pauta', 'curso', 'ensayos', 'meses_asis', 'meses_count'));
    }

    public function create()
    {
        $periodo = PeriodoAcademico::where('pac_estado', 1)->first();
        $cursos = Curso::where('periodo_id', $periodo->pac_id)->where('cu_tipo', 1)->pluck('parametro_id', 'cu_id');
        $comunas = Comuna::orderBy('com_nombre', 'ASC')->pluck('com_nombre', 'com_id');
        return view('matricula.form', compact('comunas', 'cursos', 'periodo'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        /*------------ ALUMNO ANTIGUO ------------*/
        if ($request->alumno['al_rut_old'] != null) {
            $alumno = Alumno::find($request->alumno['al_rut_old']);
        }else{
            $alumno = new Alumno($request->alumno);
        }

        if (($request->padres == 1) || ($request->padres == 3)) {
                /*------------ PADRE ANTIGUO ------------*/
                if ($request->padre['pad_rut_old'] != null) {
                    $padre = Padres::find($request->padre['pad_rut_old']);
                }else{
                    $padre = new Padres($request->padre);
                    $padre->pad_parentesco = 'Padre';

                }

        }
        if (($request->padres == 2) || ($request->padres == 3)) {
                /*------------ MADRE ANTIGUO ------------*/
                if ($request->madre['pad_rut_old'] != null) {
                    $madre = Padres::find($request->madre['pad_rut_old']);
                }else{
                    $madre = new Padres($request->madre);
                    $madre->pad_parentesco = 'Madre';
                }

        }





        /*------------ APODERADO1 ANTIGUO ------------*/
        /*
        if ($request->apoderado['ap_id'] != null) {
            $apoderado = Apoderado::find($request->apoderado['ap_id']);
        }else{

        }
        */
        $apoderado = Apoderado::where('persona_rut', $request->apoderado['pe_rut'])->where('ap_parentesco', $request->apoderado['ap_parentesco'])->where('ap_tipo', 1)->first();
        if ($apoderado == null) {
            $apoderado = new Apoderado($request->apoderado);
            if ($apoderado->persona_rut != null) {
                $persona_ap1 = Persona::find($apoderado->persona_rut);
            }else{
                $persona_ap1 = new Persona($request->apoderado);
            }
        }else{
            $persona_ap1 = $apoderado->persona;
        }
        $apoderado->ap_tipo = 1;
        //dd($apoderado);

        /*------------ APODERADO2 ANTIGUO ------------*/
        if ($request->cant_apod == 2) {
            /*
            if ($request->apoderado2['ap_id'] != null) {
                $apoderado2 = Apoderado::find($request->apoderado2['ap_id']);
            }else{
            }*/

            $apoderado2 = Apoderado::where('persona_rut', $request->apoderado2['pe_rut'])->where('ap_parentesco', $request->apoderado2['ap_parentesco'])->where('ap_tipo', 2)->first();
            if ($apoderado2 == null) {
                $apoderado2 = new Apoderado($request->apoderado2);
                if ($apoderado2->persona_rut != null) {
                    $persona_ap2 = Persona::find($apoderado2->persona_rut);
                }else{
                    $persona_ap2 = new Persona($request->apoderado2);
                }
                $apoderado2->ap_tipo = 2;
            }else{
                $persona_ap2 = $apoderado2->persona;
            }
            $apoderado->ap_tipo == 2;            
        }
        $matricula = new Matricula($request->matricula);
        $periodo_actual = PeriodoAcademico::where('pac_estado', 1)->first();

        //dd($request->cant_apod);

        DB::beginTransaction();
        try {
            if ($request->alumno['al_rut_old'] == null) {
                $alumno->save();
            }else{
                $alumno->update();
            }

            if (($request->padres == 1) || ($request->padres == 3)) {
                if ($request->padre['pad_rut_old'] == null) {
                    $padre->save();

                }else{
                    $padre->update($request->padre);
                }

            }
            if (($request->padres == 2) || ($request->padres == 3)) {
                if ($request->madre['pad_rut_old'] == null) {
                    $madre->save();
                }else{
                    $madre->update($request->madre);
                }

            }


            if ($apoderado->ap_id == null) {
                if ($apoderado->persona_rut == null) {
                    $persona_ap1->save();
                }else{
                    $persona_ap1->update($request->apoderado);
                }
                $apoderado->persona()->associate($persona_ap1);
                $apoderado->save();
            }else{
                $apoderado->update($request->apoderado);
            }

            if ($request->cant_apod == 2) {
                if ($apoderado2->ap_id == null) {
                    if ($apoderado2->persona_rut != null) {
                        $persona_ap2->save();
                    }else{
                        $persona_ap2->update($request->apoderado2);
                    }
                    $apoderado2->persona()->associate($persona_ap2);
                    $apoderado2->save();
                }else{
                    $apoderado2->update($request->apoderado2);
                }
            }

            $matricula->alumno()->associate($alumno);
            $matricula->periodo()->associate($periodo_actual);

            //dd($matricula);

            if (($request->matricula['establecimiento_ant'] != null) && ($request->matricula['est_anterior_id'] == null)) {
                $cole_ant = new EstablecimientoAnterior();
                $cole_ant->eant_nombre = $request->matricula['establecimiento_ant'];
                $cole_ant->save();
                $matricula->escuela()->associate($cole_ant);
                $matricula->mat_tipo_alumno = 1;
            }else{
                $matricula->mat_tipo_alumno = 2;
            }


            /*
            if ($request->colegio_ant['nombre'] != NULL) {
                $anterior_guardado = EstablecimientoAnterior::where('eant_nombre', $request->colegio_ant['nombre'])->first();
                if ($anterior_guardado != NULL) {
                    $matricula->escuela()->associate($anterior_guardado);
                }else{
                    $anterior = new EstablecimientoAnterior();
                    $anterior->eant_nombre = $request->colegio_ant['nombre'];
                    $anterior->save();
                    $matricula->escuela()->associate($anterior);
                }
                $matricula->mat_tipo_alumno = 1;
            }else{
                $matricula->mat_tipo_alumno = 2;
            }*/
            $matricula->mat_estado = 0;
            //$matricula->mat_fecha_ingreso = date('Y-m-d');

            if ($matricula->mat_clases_religion == null) {
                $matricula->mat_clases_religion = 0;
            }

            if ($matricula->mat_condicional==null) {
                $matricula->mat_condicional = 0;
            }


            $matricula->save();

            if ($request->enfermedades != null) {
                foreach ($request->enfermedades as $enfermedad) {
                    $enf = new Enfermedad($enfermedad);
                    $enf->matricula()->associate($matricula);
                    $enf->save();
                }
            }

            if (($request->padres == 1) || ($request->padres == 3)) {
                $matricula->padres()->attach($padre->pad_rut);
            }
            if (($request->padres == 2) || ($request->padres == 3)) {
                $matricula->padres()->attach($madre->pad_rut);
            }

            $matricula->apoderados()->attach($apoderado);
            if ($request->cant_apod == 2) {
                $matricula->apoderados()->attach($apoderado2);
            }



            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
        }




        /*if ($request->curso != NULL) {
            $matricula->cursos()->attach($request->curso);
        }*/
        Flash::success('Se a ingresado la matrícula N° '.$matricula->mat_numero.' del alumno '.$matricula->alumno->nombreCompleto().' de forma exitosa');

        return redirect()->route('matriculas.admin');
    }
    public function edit($id)
    {
        $matricula = Matricula::find($id);
        $padre = $matricula->padres->where('pad_parentesco', 'Padre')->first();
        $madre = $matricula->padres->where('pad_parentesco', 'Madre')->first();
        $apod1 = $matricula->apoderados->where('ap_tipo', 1)->first();
        $apod2 = $matricula->apoderados->where('ap_tipo', 2)->first();
        $comunas = Comuna::orderBy('com_nombre', 'ASC')->pluck('com_nombre', 'com_id');
        //dd($apod1);
        return view('matricula.edit', compact('matricula', 'comunas', 'padre', 'madre', 'apod1', 'apod2'));
    }

    /*----------------------------------------------------------------------------*/
    /*----------------------------- UPDATE MATRICULA -----------------------------*/
    /*----------------------------------------------------------------------------*/

    public function update_alumno(Request $request, $id)
    {
        $matricula = Matricula::find($id);
        dd($request->all());
        $alumno = $matricula->alumno;
        //$alumno->update($request->alumno);
        Flash::info('Se a modificado la matrícula N° "'.$matricula->mat_numero.'" del alumno "'.$matricula->alumno->nombreCompleto().'"');

        return redirect()->route('matriculas.edit', $matricula->mat_id);
    }

    public function update_padres(Request $request, $id)
    {
        $matricula = Matricula::find($id);
        $padre = $matricula->padres->where('pad_parentesco', 'Padre')->first();
        $madre = $matricula->padres->where('pad_parentesco', 'Madre')->first();
        DB::beginTransaction();
        //dd($padre);

        try {
            if (($request->padres == 1) || ($request->padres == 3)) {
                if ($padre == null) {
                    $padre = new Padres($request->padre);
                    $padre->pad_parentesco = 'Padre';
                    $padre->save();
                    $matricula->padres()->attach($padre);
                }else{
                    $padre->update($request->padre);
                }
            }
            if(($request->padres == 2) || ($request->padres == 3)){
                if ($madre == null) {
                    $madre = new Padres($request->madre);
                    $madre->pad_parentesco = 'Madre';
                    $madre->save();
                    $matricula->padres()->attach($madre);
                }else{
                    $madre->update($request->madre);
                }
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
        Flash::info('Se han modificado los padres del alumno "'.$matricula->alumno->nombreCompleto().'"');
        return redirect()->route('matriculas.edit', $matricula->mat_id);
    }

    public function update_apoderados(Request $request, $id)
    {
        $matricula = Matricula::find($id);
        dd($request->all());
        $apoderado1 = $matricula->apoderado->where('ap_tipo', 1)->first();
        $apoderado2 = $matricula->apoderado->where('ap_tipo', 2)->first();
        $apoderado1->update($request->apoderado);
        if ($apoderado2 != null) {
            $apoderado2->update($request->apoderado2);
        }
        Flash::info('Se han modificado los apoderados del alumno "'.$matricula->alumno->nombreCompleto().'"');
        return redirect()->route('matriculas.edit', $matricula->mat_id);

    }

    public function update_matricula(Request $request, $id)
    {
        $matricula = Matricula::find($id);
        DB::beginTransaction();

        try {
            $req = $request->matricula;
            if (($request->matricula['establecimiento_ant'] != null) && ($request->matricula['est_anterior_id'] == null)) {
                $cole_ant = new EstablecimientoAnterior();
                $cole_ant->eant_nombre = $request->matricula['establecimiento_ant'];
                $cole_ant->save();
                $req['est_anterior_id'] = $cole_ant->eant_id;
                //dd($req);

            }
            $matricula->update($req);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
        Flash::info('Se a modificado la matrícula N° '.$matricula->mat_numero.' del alumno "'.$matricula->alumno->nombreCompleto().'"');

        return redirect()->route('matriculas.edit', $matricula->mat_id);
    }

    /*----------------------------------------------------------------------------*/
    /*----------------------------------------------------------------------------*/
    /*----------------------------------------------------------------------------*/


    public function update(Request $request, $id)
    {
        $matricula = Matricula::find($id);
        $alumno = $matricula->alumno;
        $update_padre = null;
        $new_padre = null;
        $new_madre = null;
        $data_padres = [];
        $data_apods = [];
        $padre = null;
        $madre = null;
        $apod2 = null;

            //dd($request->all());

/*++++++++++++++++++++++++++++++++++++ VALIDAR REQUEST ++++++++++++++++++++++++++++++++++++*/




/*------------------------------- PADRE -------------------------------*/

        if(($request->padres == 1 || $request->padres == 3) && ($request->padre['pad_rut_old'] == null)){
            $new_padre = Padres::find($request->padre['pad_rut']);
            if ($new_padre == null) {
                $new_padre = new Padre($request->padre);
            }
        }

/*------------------------------- MADRE -------------------------------*/

        if(($request->padres == 2 || $request->padres == 3) && ($request->madre['pad_rut_old'] == null)){
            $new_madre = Padres::find($request->madre['pad_rut']);
            if ($new_madre == null) {
                $new_madre = new Padre($request->madre);
            }
        }

        if ($request->padres == 1 || $request->padres == 3) {
            $padre = Padres::find($request->padre['pad_rut_old']);
        }
        if ($request->padres == 2 || $request->padres == 3) {
            $madre = Padres::find($request->madre['pad_rut_old']);
        }
/*------------------------------- APODERADO 1 -------------------------------*/

        if ($request->apod1['ap_id_old'] == null) {
            $new_apod1 = Apoderado::find($request->apod1['ap_id']);
            if ($new_apod1 == null) {
                $new_apod1 = new Apoderado($request->apod1);
                $new_persona1 = Persona::find($request->apod1['pe_rut']);
                if ($new_persona1 == null) {
                    $new_persona1 = new Persona($request->apod1);
                    $new_persona1->pe_rut = $request->apod1['pe_rut'];
                }
                $new_apod1->persona()->associate($new_persona1);
            }else{
                $new_persona1 = $new_apod1->persona;
            }
        }
        $apod1 = Apoderado::find($request->apod1['ap_id_old']);

/*------------------------------- APODERADO 2 -------------------------------*/

        if (($request->cant_apod == 2) && ($request->apod2['ap_id_old'] == null)) {
            $new_apod2 = Apoderado::find($request->apod2['ap_id']);
            if ($new_apod2 == null) {
                $new_apod2 = new Apoderado($request->apod2);
                $new_persona2 = Persona::find($request->apod2['pe_rut']);
                if ($new_persona2 == null) {
                    $new_persona2 = new Persona($request->apod2);
                    $new_persona2->pe_rut = $request->apod2['pe_rut'];
                }
                $new_apod2->persona()->associate($new_persona2);
            }else{
                $new_persona2 = $new_apod2->persona;
            }
        }
        if ($request->cant_apod == 2) {
            $apod2 = Apoderado::find($request->apod2['ap_id_old']);
        }

        DB::beginTransaction();
        try {
/*------------------------------- APODERADO 1 -------------------------------*/
            if ($apod1 != null) {
                $validator = Validator::make($request->apod1, $apod1->rules())->setAttributeNames($apod1->attr_name())->validate();
                $pers1 = $apod1->persona;
                $pers1->update($request->apod1);
                $apod1->update($request->apod1);
                $data_apods[] = $apod1->ap_id;
            }elseif($request->apod1['ap_id_old'] == null){
                $validator = Validator::make($request->apod1, $new_apod1->rules())->setAttributeNames($new_apod1->attr_name())->validate();
                if ($new_persona1->count()) {
                    $new_persona1->update($request->apod1);
                }else{
                    $new_persona1->save();
                }
                if ($new_apod1->count()) {
                    $new_apod1->update($request->apod1);
                }else{
                    $new_apod1->save();
                }
                $data_apods[] = $new_apod1->ap_id;
            }
/*------------------------------- APODERADO 2 -------------------------------*/
            if ($apod2 != null) {
                $validator = Validator::make($request->apod2, $apod2->rules())->setAttributeNames($apod2->attr_name())->validate();
                $pers2 = $apod2->persona;
                $pers2->update($request->apod2);
                $apod2->update($request->apod2);
                $data_apods[] = $apod2->ap_id;
            }elseif(($request->cant_apod == 2) && ($request->apod2['ap_id_old'] == null)){
                $validator = Validator::make($request->apod2, $new_persona2->rules())->setAttributeNames($new_persona2->attr_name())->validate();
                if($new_persona2->count()){
                    $new_persona2->update($request->apod2);
                }else{
                    $new_persona2->save();
                }
                if ($new_apod2->count()) {
                    $new_apod2->update($request->apod2);
                }else{
                    $new_apod2->save();
                }
                $data_apods[] = $new_apod2->ap_id;
            }
/*------------------------------- PADRE -------------------------------*/
            if ($padre != null) {
                $validator = Validator::make($request->padre, $padre->rules())->setAttributeNames($padre->attr_name())->validate();
                /*
                if ($validator->fails()) { // validar datos de padre
                    return redirect()->route('matriculas.edit', $id)
                                ->withErrors($validator)
                                ->withInput();
                }*/
                $padre->update($request->padre);
                $data_padres[] = $padre->pad_rut;
            }elseif(($request->padres == 1 || $request->padres == 3) && ($request->padre['pad_rut_old'] == null)){
                $validator = Validator::make($request->padre, $new_padre->rules())->setAttributeNames($new_padre->attr_name())->validate();
                if($new_padre->count()){
                    $new_padre->update($request->padre);
                }else{
                    $new_padre->save();
                }
                $data_padres[] = $new_padre->pad_rut;
            }
/*------------------------------- MADRE -------------------------------*/
            if ($madre != null) {
                $validator = Validator::make($request->madre, $madre->rules())->setAttributeNames($madre->attr_name())->validate();
                $madre->update($request->madre);
                $data_padres[] = $madre->pad_rut;
            }elseif(($request->padres == 2 || $request->padres == 3) && ($request->madre['pad_rut_old'] == null)){
                $validator = Validator::make($request->madre, $new_madre->rules())->setAttributeNames($new_madre->attr_name())->validate();
                if($new_madre->exists()){
                    $new_madre->update($request->madre);
                }else{
                    $new_madre->save();
                }
                $data_padres[] = $new_madre->pad_rut;
            }
            if ($data_padres != '[]') {
                $matricula->padres()->sync($data_padres);
            }
            if ($data_apods != '[]') {
                $matricula->apoderados()->sync($data_apods);
            }
            $validator = Validator::make($request->alumno, $alumno->rules())->setAttributeNames($alumno->attr_name())->validate();
            $validator = Validator::make($request->matricula, $matricula->rules())->setAttributeNames($matricula->attr_name())->validate();
            $alumno->update($request->alumno);
            $matricula->update($request->matricula);

            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
        }
        Flash::info('Se a modificado la matrícula N° '.$matricula->mat_numero.' del alumno '.$matricula->alumno->nombreCompleto());

        return redirect()->route('matriculas.admin');

    }

    public function destroy()
    {

    }

    public function buscar()
    {
        return view('matricula.buscar');
    }


/*########################################################*/
/*######################## CURSO ########################*/
/*########################################################*/



    public function asignarCurso()
    {
        $periodo_actual = PeriodoAcademico::where('pac_estado', 1)->first();
        $id = $_post['id'];
        $matricula = Matricula::find($id);
        $cursos = Curso::where('periodo_id', $periodo_actual)->pluck('parametro_id', 'cu_id');
        return view('matricula.asignar_curso', ['cursos' => $cursos, 'matricula' => $matricula]);
    }

    public function guardarAsigCurso()
    {
        $id_mat = $_POST['id_mat'];
        $id_cu = $_post['id_cu'];
        $matricula = Matricula::find($id);
        $curso = Curso::find($id_cu);
        $matricula->cursos()->attach($curso);
        return redirect()->route('matriculas.index');
    }

/*########################################################*/
/*######################## RETIRO ########################*/
/*########################################################*/


    public function menu_retiro()
    {
        $periodo = PeriodoAcademico::where('pac_estado', 1)->first();
        return view('matricula.menu_retiro', compact('periodo'));
    }

    public function info_matricula(Request $request)
    {
        $alumno = Matricula::find($request->id);
        //dd($alumno);
        return view('matricula.datos_alumno', ['alumno'=>$alumno]);
    }

    public function retirar_alumno(Request $request)
    {
        $alumno = Matricula::find($request->mat_id);
        $alumno->mat_estado = 3;
        DB::beginTransaction();
        try {
            $alumno->update($request->retiro);
            //dd($alumno);

            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
        }
        Flash::error('El alumno "'.$alumno->alumno->nombreCompleto().'" con numero de matrícula de "'.$alumno->mat_numero.'°" a sido retirado');
        return 1;
    }

/*########################################################*/
/*####################### TALLERES #######################*/
/*########################################################*/

    public function menuTaller()
    {
        $periodo = PeriodoAcademico::where('pac_estado', 1)->first();

        return view('matricula.menu_taller', compact('periodo'));
    }

    public function inscribirTaller(Request $request)
    {
        //dd($request->all());
        $alumno = Matricula::find($request->mat_id);
        $taller = Curso::find($request->ta_id);
        $alumno->cursos()->attach($taller);
        Flash::success('Se a inscrito el alumno "'.$alumno->alumno->nombreCompleto().'" con numero de matrícula de "'.$alumno->mat_numero.'°" al taller de "'.$taller->clases->first()->asignatura->asig_nombre.'" de forma exitosa');
        return 1;
    }

/*########################################################*/
/*####################### ADMISION #######################*/
/*########################################################*/



    public function admision_alumnos()
    {
        $periodo = PeriodoAcademico::where('pac_estado', 1)->first();
        return view('matricula.admision.admision', ['periodo'=>$periodo]);
    }

    public function lista_alu_curso(Request $request)
    {
        $curso = Curso::find($request->id);
        return view('matricula.lista_alumnos_curso', ['curso'=>$curso]);
    }

    public function lista_alu_admision(Request $request)
    {
        //dd($request->all());
        $curso = Curso::find($request->curso);
        $periodo = PeriodoAcademico::where('pac_estado', 1)->first();
        $alumnos = Matricula::where('periodo_id', $periodo->pac_id)->where('mat_grado_curso', $request->grado)->where('mat_estado', 0)->get();
        return view('matricula.admision.lista_alumnos_admision', ['alumnos'=>$alumnos, 'curso'=>$curso, 'periodo'=>$periodo]);
    }

    public function store_admision(Request $request)
    {
        //$matriculas = Matricula::whereIn('mat_id', $request->mat_id)->get();
        $curso = Curso::find($request->curso);
        //dd($curso);
        //$curso->listaAlumnos()->attach($request->mat_id);
        $data = [];
        foreach ($request->matricula as $mat) {
            $matricula = Matricula::find($mat['mat_id']);
            $curso->listaAlumnos()->attach($matricula);

            $data[]='<tr class="positive"><td>'.$matricula->mat_numero.'</td><td>'.$matricula->alumno_rut.'</td><td>'.$matricula->alumno->nombreCompleto().'</td><td>'.$matricula->mat_estado.'</td></tr>';
            $matricula->mat_estado = 1;
            $matricula->mat_numero = $mat['mat_numero'];
            $matricula->save();
        }
        //dd($data);
        return response()->json(['status'=>1, 'array_mat'=>$request->mat_id, 'data'=>$data]);
    }

    public function view_matricula($id)
    {
        $matricula = Matricula::find($id);
        return view('matricula.view_matricula', compact('matricula'));
    }
}
