<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Personal;
use App\Cargo;
use App\Persona;
use App\Institucion;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\DB;
use Validator;

class PersonalController extends Controller
{
	public function index()
	{
		return view('personal.index');
	}

	public function show($id)
	{
		$empleado = Personal::find($id);
		return view('personal.show', compact('empleado'));
	}

	public function admin()
	{
		$personal = Personal::orderBy('pers_estado', 'DESC')->orderBy('cargo_id', 'ASC')->paginate(10);
		$cargos = Cargo::get();
		return view('personal.admin', compact('personal', 'cargos'));
	}

	public function create()
	{
		$cargos = Cargo::orderBy('ca_nombre', 'ASC')->whereNotIn('ca_nombre', ['Profesor'])->pluck('ca_nombre', 'ca_id');
		return view('personal.create', ['cargos'=>$cargos]);
	}

	public function store(Request $request)
	{
		$empleado = new Personal($request->personal);
		$persona = new Persona($request->persona);
		$empleado->persona()->associate($persona);
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->persona, $persona->rules_create())->setAttributeNames($persona->attr_name());
            if ($validator->fails()) {
            	return redirect()->route('empleados.create')
                        ->withErrors($validator)
                        ->withInput();        	
            }
            $validator2 = Validator::make($request->personal, $empleado->rules())->setAttributeNames($empleado->attr_name());
            if ($validator2->fails()) {
            	return redirect()->route('empleados.create')
                        ->withErrors($validator2)
                        ->withInput();        	
            }
            /*
			if ($request->profesor['institucion'] != NULL) {
				$estudios = Institucion::where('inst_nombre', $request->profesor['institucion'])->first();
				if ($estudios == NULL) {
					$estudios = new Institucion();
					$estudios->inst_nombre = $request->profesor['institucion'];
					$estudios->save();
				}
				$empleado->institucion()->associate($estudios);
			}*/

	//		dd($empleado);
			$persona->save();
			$empleado->pers_estado = 1;
			$empleado->save();

            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
        }

        Flash::success('Se a ingresado al sistema el empleado "'.$empleado->persona->nombreCompleto().'" de forma exitosa');
        return redirect()->route('empleados.admin');
	}

	public function edit($id)
	{
		$empleado = Personal::find($id);
		$cargos = Cargo::pluck('ca_nombre', 'ca_id');
		return view('personal.edit', compact('empleado', 'cargos'));
	}

	public function update(Request $request, $id)
	{
		$empleado = Personal::find($id);
		$persona = $empleado->persona;
		$persona->update($request->persona);
		$empleado->update($request->empleado);
        Flash::info('Se a modificado el empleado "'.$empleado->persona->nombreCompleto().'" exitosamente');
        return redirect()->route('empleados.admin');
	}

	public function delete_empleado(Request $request)
	{
		$empleado = Personal::find($request->id);
		$empleado->persona->delete();
        return 1;
	}

	public function create_cargo()
	{
		return view('personal.create_cargo');
	}

	public function store_cargo(Request $request)
	{
		$cargo = new Cargo($request->all());
		$cargo->save();
        Flash::success('Se agregado el cargo "'.$cargo->ca_nombre.'" al sistema');
        return redirect()->route('empleados.admin');
	}

	public function edit_status(Request $request)
	{
		$empleado = Personal::find($request->id);
		$data = [];
		if ($request->estado == 1) {
			$empleado->pers_estado = 1;
			$empleado->update();
			$data = [
				'id' => $empleado->pers_id,
				'status'=>$empleado->pers_estado,
				'estado'=>$empleado->estado(),
			];
		}elseif ($request->estado == 0) {
			$empleado->pers_estado = 0;
			$empleado->update();
			$data = [
				'id' => $empleado->pers_id,
				'status'=>$empleado->pers_estado,
				'estado'=>$empleado->estado(),
				/*
				'button'=>'<a class="ui button small green icon inverted state_user" id_user="'.$empleado->pers_id.'" name="activar"><i class="check icon"></i></a>'*/
			];
		}
		return response()->json($data);
	}
}
