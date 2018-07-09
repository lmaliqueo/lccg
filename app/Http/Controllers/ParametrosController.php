<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ParametrosCursos;
use App\PeriodoAcademico;
use App\Liceo;
use App\Aulas;
use App\Concepto;
use App\GrupoPauta;
use App\DetallePauta;
use App\MateriaEnsayos;
use App\TipoEnsayo;
use App\Ensayo;
use App\Horas;
use Laracasts\Flash\Flash;

class ParametrosController extends Controller
{

	/*---------------------------------------------------------*/
	/*----------------------- INDEX ---------------------------*/
	/*---------------------------------------------------------*/
    public function index()
    {
        //return view('parametros.index');
        return view('parametros.index_administracion');
    }

    public function indexAdministracion()
    {
        return view('parametros,index_administracion');
    }
	/*---------------------------------------------------------*/
	/*----------------------- CREATE --------------------------*/
	/*---------------------------------------------------------*/
    public function createParametrosCursos()
    {
    	return view('parametros.cursos.create_cursos');
    }

    public function createPeriodo()
    {
    	return view('parametros.periodos.create_periodo');
    }

    public function createAulas()
    {
    	return view('parametros.aulas.create_aulas');
    }

    public function createConceptos()
    {
        return view('parametros.conceptos.create_conceptos');
    }

    public function createPauta()
    {
        return view('parametros.conceptos.create_pauta');
    }
    public function createDetallePauta(Request $request)
    {
        return view('parametros.conceptos.create_detalle_pauta', ['grupo'=>$request->grupo]);
    }

    public function createMateriaEnsayo()
    {
        $tipo_ensayos = TipoEnsayo::pluck('ten_tipo', 'ten_id');
        $materias = MateriaEnsayos::get();
        return view('parametros.ensayos.create_materia_ensayo', ['tipo_ensayos'=>$tipo_ensayos]);
    }

    public function createHoras()
    {
        $periodo = PeriodoAcademico::where('pac_estado', 1)->first();
        return view('parametros.horas.create_horas', compact('periodo'));
    }


	/*---------------------------------------------------------*/
	/*------------------------ STORE --------------------------*/
	/*---------------------------------------------------------*/

    public function storeCurso(Request $request)
    {
    	$param_curso = new ParametrosCursos($request->all());
    	$param_curso->save();
        return redirect()->route('parametros.admin.cursos');
    }

    public function storeAulas(Request $request)
    {
    	$sala = new Aulas($request->all());
    	$sala->save();
        return redirect()->route('parametros.admin.aulas');
    }

    public function storeConceptos(Request $request)
    {
        $concepto = new Concepto($request->all());
        $concepto->save();
        return redirect()->route('parametros.view.pauta_comportamiento');
    }

    public function storeGrupoPauta(Request $request)
    {
        $grupos = new GrupoPauta($request->all());
        $grupos->save();
        return redirect()->route('parametros.view.pauta_comportamiento');
    }

    public function storeDetallePauta(Request $request)
    {
        $detalle = new DetallePauta($request->all());
        $detalle->save();
        return redirect()->route('parametros.view.pauta_comportamiento');
    }

    public function storeMateriaEnsayo(Request $request)
    {
        $materia_exist = MateriaEnsayos::where('mens_nombre', $request->materia['mens_nombre'])->first();
        if ($materia_exist != Null) {
            $materia_exist->tipoEnsayos()->attach($request->tipo, ['status'=>1]);
        }else{
            $materia = new MateriaEnsayos($request->materia);
            $materia->save();
            $materia->tipoEnsayos()->attach($request->tipo, ['status'=>1]);
        }
        //dd($tipo_ensayo);
        return redirect()->route('parametros.admin.ensayo');
    }

    public function storeHoras(Request $request)
    {
        //dd($request->all());
        $horas = new Horas($request->all());
        $horas->save();
        Flash::success('Se a ingresado la hora N°'.$horas->hors_numero.' con éxito');
        return redirect()->route('parametros.admin.horas');
    }


	/*---------------------------------------------------------*/
	/*------------------------ VIEW ---------------------------*/
	/*---------------------------------------------------------*/

    public function viewLiceo()
    {
    	$liceo = Liceo::where('lic_id', 1)->first();
    	return view('parametros.liceo.view_liceo', ['liceo'=>$liceo]);
    }

    public function viewPautaConcepto()
    {
        $grupo_pauta = GrupoPauta::get();
        $conceptos = Concepto::get();
        return view('parametros.conceptos.pauta_conceptos', ['grupo_pauta'=>$grupo_pauta, 'conceptos'=>$conceptos]);
    }
	/*---------------------------------------------------------*/
	/*------------------------ EDIT ---------------------------*/
	/*---------------------------------------------------------*/

    public function editLiceo()
    {
        $liceo = Liceo::find(1);
        return view('parametros.liceo.edit_liceo', ['liceo'=>$liceo]);
    }

    public function editAula($id)
    {
        $aula = Aulas::find($id);
        return view('parametros.aulas.edit', compact('aula'));
    }

    public function editPauta()
    {
        $grupo_pauta = GrupoPauta::get();
        $conceptos = Concepto::get();
        return view('parametros.conceptos.edit_pauta', compact('grupo_pauta', 'conceptos'));
    }

    public function edit_grupo_pauta($id)
    {
        $grupo = GrupoPauta::find($id);
        return view('parametros.conceptos.edit.edit_grupo_pauta', compact('grupo'));
    }

    public function edit_detalle_pauta($id)
    {
        $detalle = DetallePauta::find($id);
        return view('parametros.conceptos.edit.edit_detalle', compact('detalle'));
    }

    public function edit_conceptos($id)
    {
        $concepto = Concepto::find($id);
        return view('parametros.conceptos.edit.edit_conceptos', compact('concepto'));
    }

    public function edit_horas($id)
    {
        $horas = Horas::find($id);
        return view('parametros.horas.edit_horas', compact('horas'));
    }

	/*---------------------------------------------------------*/
	/*----------------------- UPDATE --------------------------*/
	/*---------------------------------------------------------*/

    public function updateLiceo(Request $request, $id)
    {
        //dd($logo);

        $liceo = Liceo::find($id);
        if ($request->file('logo')) {
            $logo = $request->file('logo');
            $name = 'logo_docs.'.$logo->getClientOriginalExtension();
            $path = public_path() . '/img/';
            $logo->move($path, $name);
            $liceo->lic_logo = $name;
            
        }
        $liceo->update($request->all());
        return redirect()->route('parametros.view.liceo');
    }

    public function updateAula(Request $request, $id)
    {
        $aula = Aulas::find($id);
        $aula->update($request->all());
        return redirect()->route('parametros.admin.aulas');
    }

    public function update_grupo_pauta(Request $request, $id)
    {
        $grupo = GrupoPauta::find($id);
        $grupo->update($request->all());
        Flash::info('Se a modificado el grupo #'.$grupo->gp_id.' correctamente');
        return redirect()->route('parametros.edit.pauta');
    }

    public function update_detalle_pauta(Request $request, $id)
    {
        $detalle = DetallePauta::find($id);
        $detalle->update($request->all());
        $index = 0;
        foreach ($detalle->pauta->detalles as $i => $val) {
            if ($val->dp_id == $detalle->dp_id) {
                $index = $i+1;
                break;
            }
        }
        Flash::info('Se a modificado el detalle #'.$detalle->pauta->gp_id.'.'.$index.' correctamente');
        return redirect()->route('parametros.edit.pauta');
    }

    public function update_conceptos(Request $request, $id)
    {
        $concepto = Concepto::find($id);
        $concepto->update($request->all());
        Flash::info('Se a modificado el concepto #'.$concepto->con_id.' correctamente');
        return redirect()->route('parametros.edit.pauta');
    }

    public function update_horas(Request $request, $id)
    {
        $horas = Horas::find($id);
        $horas->update($request->all());
        Flash::info('Se a modificado el la hora N°'.$horas->hors_numero.' correctamente');
        return redirect()->route('parametros.admin.horas');
    }

	/*---------------------------------------------------------*/
	/*----------------------- DESTROY -------------------------*/
	/*---------------------------------------------------------*/

    /*---------------------------------------------------------*/
    /*------------------------ ADMIN --------------------------*/
    /*---------------------------------------------------------*/

    public function adminAulas()
    {
        $aulas = Aulas::orderBy('aul_numero', 'ASC')->paginate(10);
        return view('parametros.aulas.admin_aulas', ['aulas'=>$aulas]);
    }

    public function adminPeriodos()
    {
        $periodos = PeriodoAcademico::orderBy('pac_ano', 'DESC')->paginate(10);
        return view('parametros.periodos.admin_periodos', ['periodos'=>$periodos]);
    }

    public function adminCursos()
    {
        $param_cursos = ParametrosCursos::orderBy('pcur_grado', 'DESC')->paginate(10);
        return view('parametros.cursos.admin_cursos', ['param_cursos'=>$param_cursos]);
    }

    public function adminConceptos()
    {
        $conceptos = Concepto::orderBy('con_id', 'ASC')->paginate(10);
        return view('parametros.conceptos.admin_conceptos', ['conceptos' => $conceptos]);
    }


    public function adminEnsayos()
    {
        $tipo_ensayos = TipoEnsayo::get();
        $materias = MateriaEnsayos::get();
        $ensayos = Ensayo::get();
        return view('parametros.ensayos.admin_ensayos', ['tipo_ensayos'=>$tipo_ensayos, 'materias'=>$materias, 'ensayos'=>$ensayos]);
    }

    public function adminHoras()
    {
        $periodo = PeriodoAcademico::where('pac_estado', 1)->first();
        return view('parametros.horas.admin_horas', compact('periodo'));
    }
}
