<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Alumno;
use App\Padres;
use App\Apoderado;
use App\Persona;
use App\Matricula;
use App\Usuario;
use App\Proveedor;
use App\Asignatura;
use App\Personal;

class ValidationController extends Controller
{

	public function validate_alumno(Request $request)
	{
        if (isset($request->alumno['al_rut_old'])) {
            if ($request->alumno['al_rut_old'] != null) {
                return response()->json(['success'=>1]);
            }
        }
        if (isset($request->alumno['al_rut_exist'])) {
            $model = Alumno::find($request->alumno['al_rut_exist']);
        }else{
            $model = new Alumno();
        }
        $validator = Validator::make($request->alumno, $model->rules())->setAttributeNames($model->attr_name());
        if ($validator->fails()) {
            return response()->json(['success'=>0, 'tipo'=>'alumno', 'errors'=>$validator->errors()]);
        }else{
            return response()->json(['success'=>1]);
        }
	}

    public function validate_padres(Request $request)
    {
        $model = new Padres();
        //dd($request->all());
        if (($request->padres == 1) || ($request->padres == 3)) {
            if ($request->padre['pad_rut_old'] != null) {
                $model = Padres::find($request->padre['pad_rut_old']);
            }elseif (isset($request->padre['pad_rut_exist'])) {
                if ($request->padre['pad_rut_exist'] != null) {
                    $model = Padres::find($request->padre['pad_rut_exist']);
                }
            }
            $validator1 = Validator::make($request->padre, $model->rules())->setAttributeNames($model->attr_name());
            if ($validator1->fails()) {
                return response()->json(['success'=>0, 'tipo'=>'padre', 'errors'=>$validator1->errors()]);
            }
        }
        if (($request->padres == 2) || ($request->padres == 3)) {
            if ($request->madre['pad_rut_old'] != null) {
                $model = Padres::find($request->madre['pad_rut_old']);
            }elseif (isset($request->madre['pad_rut_exist'])) {
                if ($request->madre['pad_rut_exist'] != null) {
                    $model = Padres::find($request->madre['pad_rut_exist']);
                }
            }
            
            $validator2 = Validator::make($request->madre, $model->rules())->setAttributeNames($model->attr_name());
            if ($validator2->fails()) {
                return response()->json(['success'=>0, 'tipo'=>'madre', 'errors'=>$validator2->errors()]);
            }
        }
        return response()->json(['success'=>1]);
    }

    public function validate_apoderados(Request $request)
    {
        /*
        if ($request->apoderado['ap_id'] != null)  {
            $model = Apoderado::find($request->apoderado['ap_id']);
            $validator1 = Validator::make($request->apoderado, $model->rules())->setAttributeNames($model->attr_name());
            if ($validator1->fails()) {
                return response()->json(['success'=>0, 'errors'=>$validator1->errors(), 'tipo'=>'apoderado']);
            }
        }else{
        }*/
            $model = new Apoderado($request->apoderado);
            $validator1 = Validator::make($request->apoderado, $model->rules())->setAttributeNames($model->attr_name());
            if ($validator1->fails()) {
                return response()->json(['success'=>0, 'errors'=>$validator1->errors(), 'tipo'=>'apoderado']);
            }


        if ($request->cant_apod == 2) {
            $model2 = new Apoderado($request->apoderado2);
            $validator2 = Validator::make($request->apoderado2, $model2->rules())->setAttributeNames($model2->attr_name());
            if ($validator2->fails()) {
                return response()->json(['success'=>0, 'errors'=>$validator2->errors(), 'tipo'=>'apoderado2']);
            }
        }

        return response()->json(['success'=>1]);
    }

    public function validate_matricula(Request $request)
    {
        $model = new Matricula($request->matricula);
        $validator = Validator::make($request->matricula, $model->rules())->setAttributeNames($model->attr_name());

        if ($validator->fails()) {
            return response()->json(['success'=>0, 'errors'=>$validator->errors(), 'tipo'=>'matricula']);
        }
        return response()->json(['success'=>1, 'data'=>$request->all(), 'tipo'=>'matricula']);
    }

    public function validate_user(Request $request)
    {
        //dd($request->all());
        $model = new Usuario();
        /*------------- PERSONA -------------*/
        if ($request->step == 1) {
            $validator = Validator::make($request->persona, $model->rules_person());
            if ($validator->fails()) {
                return response()->json(['success'=>0, 'errors'=>$validator->errors()]);
            }
            return response()->json(['success'=>1, 'data'=>$request->all()]);
        }
        /*------------- USUARIO -------------*/
        $validator = Validator::make($request->all(), $model->rules_user());
        if ($validator->fails()) {
            return response()->json(['success'=>0, 'errors'=>$validator->errors()]);
        }
        return response()->json(['success'=>1, 'data'=>$request->all()]);
    }

    public function validate_proveedor(Request $request)
    {
        //dd($request->all());
        $model = new Proveedor();
        $validator = Validator::make($request->proveedor, $model->rules())->setAttributeNames($model->attr_name());


        if ($validator->fails()) {
            return response()->json(['success'=>0, 'errors'=>$validator->errors(), 'tipo'=>'prov']);
        }
        return response()->json(['success'=>1, 'data'=>$request->proveedor, 'tipo'=>'prov']);
    }

    public function validate_asignatura(Request $request)
    {
        //return 1;
        $model = new Asignatura();
        $validator = Validator::make($request->all(), $model->rules())->setAttributeNames($model->attr_name());
        if ($validator->fails()) {
            return response()->json(['success'=>0, 'errors'=>$validator->errors()]);
        }
        return response()->json(['success'=>1, 'data'=>$request->all()]);
    }

    public function validate_empleado(Request $request)
    {
        if (isset($request->empleado['pers_id'])) {
            $model_empl = Personal::find($request->empleado['pers_id']);
            $model_persona = $model_empl->persona;
            //dd($model_persona);
        }else{
            $model_persona = new Persona();
            $model_empl = new Personal();
        }
        $validator = Validator::make($request->persona, $model_persona->rules())->setAttributeNames($model_persona->attr_name());
        if ($validator->fails()) {
            return response()->json(['success'=>0, 'errors'=>$validator->errors(), 'tipo'=>'persona']);
        }
        $validator = Validator::make($request->empleado, $model_empl->rules())->setAttributeNames($model_empl->attr_name());
        return response()->json(['success'=>1, 'data'=>$request->empleado, 'tipo'=>'empleado']);
    }

}
