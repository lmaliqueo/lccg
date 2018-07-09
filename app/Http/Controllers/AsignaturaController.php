<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asignatura;
use App\PlanEstudio;
use App\PeriodoAcademico;
use App\NivelCurso;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;

class AsignaturaController extends Controller
{
	public function index()
	{
		return view('asignaturas.index');
	}

	public function create()
	{
		return view('asignaturas.create');
	}

	public function store(Request $request)
	{
		$asignatura = new Asignatura($request->all());
		$asignatura->asig_tipo = 1;
		$asignatura->save();
		Flash::success('Se a creado la asignatura '.$asignatura->asig_nombre.' de forma exitosa');
		return redirect()->route('asignaturas.admin');
	}

	public function edit($id)
	{
		$asignatura = Asignatura::find($id);
		return view('asignaturas.edit', compact('asignatura'));
	}

	public function update(Request $request, $id)
	{
		$asignatura = Asignatura::find($id);
		$asignatura->update($request->all());
		Flash::info('Se a modificado la asignatura '.$asignatura->asig_nombre.' de forma exitosa');
		return redirect()->route('asignaturas.admin');
	}

	public function destroy($id)
	{

	}

	public function admin()
	{
		$asignaturas = Asignatura::orderBy('asig_id', 'ASC')->where('asig_tipo', 1)->paginate(10);
		return view('asignaturas.admin', ['asignaturas'=>$asignaturas]);
	}

/*##############################################################*/
/*####################### PLAN-ACADEMICO #######################*/
/*##############################################################*/

	public function createPlanEstudio()
	{
		$año = date('Y');
		$array_años = [];
		for ($i = 0; $i < 50; $i++) {
			$array_años[$año] = $año;
			$año--;
		}

		$asignaturas = Asignatura::where('asig_tipo', 1)->orderBy('asig_id', 'ASC')->get();
		$niveles = NivelCurso::orderBy('nic_nivel', 'ASC')->pluck('nic_nivel', 'nic_id');
		//dd($periodo_actual);
		return view('asignaturas.plan_estudio.create_plan_estudio', ['asignaturas' => $asignaturas, 'periodo' => $año, 'niveles'=>$niveles, 'array_años'=>$array_años]);
	}

	public function storePlanEstudio(Request $request)
	{
		//dd($request->all());
		/*$plan_estudio = PlanEstudio::where('pest_estado', 1)->first();

		if ($plan_estudio != null) {
			$plan_estudio->pest_ano_termino = date('Y');
			$plan_estudio->pest_estado = 0;
			$plan_estudio->save();
			
		}*/

		$new_plan = new PlanEstudio($request->plan_estudio);
		$new_plan->pest_ano_inicio = date('Y');
		$new_plan->pest_estado = 1;


        DB::beginTransaction();
        try {
			$new_plan->save();
			foreach ($request->horas as $count => $horas) {
				foreach ($request->niveles as $nivel) {
					if ($nivel == $horas['nivel']) {
						$new_plan->nivelCursos()->attach($horas['nivel'], ['asignatura_id'=>$horas['asignaturas'], 'porg_cant_horas'=>$horas['horas']]);
						break;
					}
				}
			}

            DB::commit();

        } catch (Exception $e) {

            DB::rollBack();
        }

        Flash::success('Se a creado el Plan de Estudio con el Decreto '.$new_plan->decreto_plan().' exitosamente');
		return redirect()->route('plan_estudio.admin_planes');


	}

	public function delete_plan(Request $request)
	{
		$plan = PlanEstudio::find($request->id);
		$plan->delete();
		return 1;
	}





	public function table_plan_estudio(Request $request)
	{
		$plan = PlanEstudio::where('pest_ano_inicio', $request->id)->where('pest_estado', 1)->first();
		$asignaturas = $plan->asignaturasGrado($request->grado)->get();
		return view('asignaturas.plan_estudio.plan_estudio', ['asignaturas'=>$asignaturas]);
	}

	public function verPlanEstudio($id)
	{
		$planes = PlanEstudio::orderBy('pest_ano_inicio')->get();
		$plan = $planes->find($id);
		return view('asignaturas.plan_estudio.ver_planes', ['planes' => $planes, 'plan'=>$plan]);
	}

	public function editPlanEstudio($id)
	{
		$plan = PlanEstudio::find($id);
		$año = date('Y');
		$array_años = [];
		for ($i = 0; $i < 50; $i++) {
			$array_años[$año] = $año;
			$año--;
		}
		$asignaturas = Asignatura::where('asig_tipo', 1)->orderBy('asig_id', 'ASC')->get();
		return view('asignaturas.plan_estudio.edit_plan', compact('plan', 'array_años', 'asignaturas'));
	}

	public function updatePlanEstudio(Request $request, $id)
	{
		$plan = PlanEstudio::find($id);

		$asig_array = [];

        DB::beginTransaction();
        try {

			foreach ($request->horas as $count => $horas) {
				foreach ($request->niveles as $nivel) {
					if ($nivel == $horas['nivel_id']) {
						$asig_array[] = [
							'asignatura_id' => $horas['asignatura_id'],
							'nivel_id' => $horas['nivel_id'],
							'porg_cant_horas' => $horas['porg_cant_horas'],
						];
						break;
					}
				}
			}


			//dd($asignaturas);


        	$plan->update($request->plan_estudio);
        	$plan->asignaturas()->sync($asig_array);
            DB::commit();

        } catch (Exception $e) {

            DB::rollBack();
        }

        Flash::info('Se a modificado el Plan de Estudio con el Decreto '.$plan->decreto_plan().' de forma exitosa');
		return redirect()->route('plan_estudio.admin_planes');

	}

	/*---------------------- AJAX ----------------------*/


	public function buscar_asig(Request $request)
	{
		//dd($request->all());
		$asignatura = Asignatura::find($request->id);
		$data = [
			'id' => $asignatura->asig_id,
			'nombre' => $asignatura->asig_nombre,
			'nombre_corto' => $asignatura->asig_nombre_corto,
			'tipo' => $asignatura->asig_tipo_asignatura,
			'grado' => $request->grado,
		];
		return response()->json($data);
	}

	public function admin_planes()
	{
		$planes = PlanEstudio::orderBy('pest_id', 'DESC')->get();
		return view('asignaturas.plan_estudio.admin_plan', ['planes'=>$planes]);
	}

	public function statePlanEstudio(Request $request)
	{
		//dd($request->estado);
		$plan = PlanEstudio::find($request->id);
		$plan->pest_estado = $request->estado;
		$plan->update();
		return 1;
	}

}
