<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use App\Persona;
use App\Cargo;
use App\Personal;
use App\Rol;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;
use Validator;

class UsuarioController extends Controller
{
	public function index()
	{
		return view('usuarios.index');
	}

	public function show($id)
	{
		$user = Usuario::find($id);
		return view('usuarios.view', compact('user'));
	}

	public function create()
	{
		$cargos = Cargo::/*whereNotIn('ca_nombre', ['Profesor'])->*/pluck('ca_nombre', 'ca_id');
		$roles = Rol::get();
		return view('usuarios.create', ['cargos' => $cargos, 'roles' => $roles]);
	}

	public function store(Request $request)
	{
		//dd($request->all());
		$usuario = new Usuario($request->all());
		$persona = Persona::find($request->persona['persona_rut']);
		if ($persona != null) {
			$usuario->persona()->associate($persona);
		}else{
			$persona_new = new Persona($request->persona);
			$persona_new->pe_rut = $request->persona['persona_rut'];
			if ($request->personal['cargo_id'] != null) {
				$empleado = new Personal($request->personal);
				$empleado->pers_estado = 1;
				$empleado->persona_rut = $request->persona['persona_rut'];
			}
		}

		DB::beginTransaction();
        try {
			if ($persona == null) {
				$persona_new->save();
	        	$empleado->persona()->associate($persona_new);
	        	$empleado->save();
				$usuario->persona()->associate($persona_new);
			}        	
			$usuario->us_estado = 1;
			$usuario->password = Hash::make($request->password); //bcrypt($request->us_password);
			$usuario->save();
			DB::commit();

        } catch (Exception $e) {
			DB::rollBack();
        }

        Flash::success('Se a creado el usuario '.$usuario->us_username.' de forma exitosa');

		return redirect()->route('usuarios.admin');
	}

	public function edit($id)
	{
		$usuario = Usuario::find($id);
		return view('usuarios.edit', compact('usuario'));
	}

	public function update(Request $request, $id)
	{
		$usuario = Usuario::find($id);
		$persona = $usuario->persona;

        $validator = Validator::make($request->persona, $persona->rules());
        if ($validator->fails()) {
            return redirect()->route('usuarios.edit', $id)
                        ->withErrors($validator)
                        ->withInput();        	
            //return response()->json(['success'=>0, 'errors'=>$validator->errors()]);
        }

        $validator_user = Validator::make($request->usuario, $usuario->rules_user());
        if ($validator_user->fails()) {
            return redirect()->route('cursos.create')
                        ->withErrors($validator_user)
                        ->withInput();        	
            //return response()->json(['success'=>0, 'errors'=>$validator_user->errors()]);
        }


		DB::beginTransaction();
        try {


			$persona->update($request->persona);
			$usuario->update($request->usuario);
			if (isset($request->usuario['password'])) {
				$pass = Hash::make($request->usuario['password']);
				$usuario->password = $pass;
				$usuario->update();
			}
			DB::commit();

        } catch (Exception $e) {
			DB::rollBack();
        }
        Flash::info('El usuario '.$usuario->us_username.' a sido modificado de forma exitosa');
		return redirect()->route('usuarios.admin');
		//$usario->save();
	}

	public function delete_user(Request $request)
	{
		$usuario = Usuario::find($request->id);
		$usuario->delete();
		return 1;
	}

	public function admin()
	{
		$usuarios = Usuario::orderBy('us_id', 'ASC')->paginate(10);
		return view('usuarios.admin', ['usuarios' => $usuarios]);
	}

	public function estadoUser(Request $request)
	{
		$user = Usuario::find($request->id);
		if ($request->estado == 1) {
			$user->us_estado = 1;
			$user->update();
			$data = [
				'id' => $user->us_id,
				'status'=>$user->us_estado,
				'estado'=>$user->estado(),
			];
			return response()->json($data);
		}elseif ($request->estado == 0) {
			$user->us_estado = 0;
			$user->update();
			$data = [
				'id' => $user->us_id,
				'status'=>$user->us_estado,
				'estado'=>$user->estado(),
				'button'=>'<a class="ui button small green icon inverted state_user" id_user="'.$user->us_id.'" name="activar"><i class="check icon"></i></a>'
			];
			return response()->json($data);
		}
	}

	public function desactivarUser(Request $request)
	{
		$user = Usuario::find($request->id);
		$user->us_estado = 1;
		$user->save();
		return;
	}

	public function perfil()
	{
		$user = \Auth::user();
		return view('usuarios.perfil', compact('user'));
	}

	public function edit_pass()
	{
		return view('usuarios.edit_pass');
	}

	public function update_pass(Request $request)
	{
		$user = \Auth::user();
		if (Hash::check($request->user['old_pass'], $user->password)) {
			if ($request->user['new_pass'] == $request->user['conf_new_pass']) {
				$user->password = Hash::make($request->user['new_pass']);
				$user->update();
	        	Flash::info('La clave de este usuario se a modificado con éxito');
			}else{
        		Flash::error('La clave ingresada es incorrecto');
			}
		}else{
        	Flash::error('La clave ingresada es incorrecto');

		}
		//dd($request->all());
		return redirect()->route('usuario.perfil');
	}
}
