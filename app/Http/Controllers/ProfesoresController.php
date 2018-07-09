<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cargo;
use App\Asignatura;
use App\Personal;
use App\Persona;
use App\PeriodoAcademico;
use App\Institucion;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;
use Validator;

class ProfesoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profesores.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $asignaturas = Asignatura::where('asig_tipo', 1)->pluck('asig_nombre', 'asig_id');
        return view('profesores.create', ['asignaturas'=>$asignaturas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $cargo = Cargo::where('ca_nombre', 'profesor')->first();
        $profesor = new Personal($request->profesor);
        $persona = new Persona($request->persona);

        $validator = Validator::make($request->persona, $persona->rules_create())->setAttributeNames($persona->attr_name());
            if ($validator->fails()) {
                return redirect()->route('profesores.create')
                        ->withErrors($validator)
                        ->withInput();          
            }
        $validator = Validator::make($request->profesor, $profesor->rules_prof())->setAttributeNames($profesor->attr_name());
            if ($validator->fails()) {
                return redirect()->route('profesores.create')
                        ->withErrors($validator)
                        ->withInput();          
            }

        DB::beginTransaction();
        try {
            $persona->save();
            $profesor->persona()->associate($persona);
            $profesor->cargo()->associate($cargo);

            if ($request->profesor['institucion_id'] == null) {
                $new_inst = new Institucion();
                $new_inst->inst_nombre = $request->profesor['nombre_inst'];
                $new_inst->save();
                $profesor->institucion()->associate($new_inst);
            }

            /*

            $inst = Institucion::where('inst_nombre', $request->profesor['institucion'])->first();
            if ($inst == null) {
                $new_inst = new Institucion();
                $new_inst->inst_nombre = $request->profesor['institucion'];
                $new_inst->save();
                $profesor->institucion()->associate($new_inst);
            }else{
                $profesor->institucion()->associate($inst);
            }
            if ($request->profesor['institucion_id'] == null) {
                $insti = new Institucion();
                $insti->inst_nombre = $request->profesor['institucion'];
                $insti->save();
                $profesor->institucion()->associate($insti);
            }
            */
            $profesor->pers_estado = 1;
            $profesor->save();
            $profesor->especialidad()->attach($request->profesor['especialidad']);

            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
        }

        Flash::success('Se a ingresado el profesor '.$profesor->persona->nombreCompleto().' de forma exitosa');
        return redirect()->route('profesores.admin');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $periodos = PeriodoAcademico::get();
        $profesor = Personal::find($id);
        return view('profesores.view', compact('profesor', 'periodos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $asignaturas = Asignatura::where('asig_tipo', 1)->pluck('asig_nombre', 'asig_id');
        $profesor = Personal::find($id);
        //dd($especialidades);
        return view('profesores.edit', ['profesor'=>$profesor, 'asignaturas'=>$asignaturas]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $profesor = Personal::find($id);

        $validator = Validator::make($request->persona, $profesor->persona->rules())->setAttributeNames($profesor->persona->attr_name());
            if ($validator->fails()) {
                return redirect()->route('profesores.edit', $profesor->pers_id)
                        ->withErrors($validator)
                        ->withInput();          
            }
        $validator = Validator::make($request->profesor, $profesor->rules_prof())->setAttributeNames($profesor->attr_name());
            if ($validator->fails()) {
                return redirect()->route('profesores.edit', $profesor->pers_id)
                        ->withErrors($validator)
                        ->withInput();          
            }


        DB::beginTransaction();
        try {
            $req_prof = $request->profesor;
            if ($request->profesor['institucion_id'] == null) {
                $new_inst = new Institucion();
                $new_inst->inst_nombre = $request->profesor['nombre_inst'];
                $new_inst->save();
                $req_prof['institucion_id'] = $new_inst->inst_id;
                //$profesor->institucion()->associate($new_inst);
            }

/*
            if ($request->profesor['institucion'] != $profesor->institucion->inst_nombre) {
                $inst = Institucion::where('inst_nombre', $request->profesor['institucion'])->first();
                if ($inst == null) {
                    $new_inst = new Institucion();
                    $new_inst->inst_nombre = $request->profesor['institucion'];
                    $new_inst->save();
                    $profesor->institucion()->associate($new_inst);
                }else{
                    $profesor->institucion()->associate($inst);
                }

            }
*/

            $profesor->persona->update($request->persona);
            $profesor->update($req_prof);
            $profesor->especialidad()->sync($request->profesor['especialidad']);

            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
        }




/*
        if ($request->profesor['institucion_id'] == null) {
            $insti = Institucion::where('inst_nombre', $request->profesor['institucion_id'])->first();
            if ($insti == null) {
                $insti = new Institucion();
                $insti->inst_nombre = $request->profesor['institucion'];
                $insti->save();
            }
            $profesor->institucion()->associate($insti);
        }
*/
        //$persona->save();
        //$profesor->save();
        Flash::info('Se a modificado el profesor '.$profesor->persona->nombreCompleto().' de forma exitosa');

        return redirect()->route('profesores.admin');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function admin()
    {
        $cargo = Cargo::where('ca_nombre', 'profesor')->first();
        $profesores = Personal::where('cargo_id', $cargo->ca_id)->where('pers_estado', 1)->get();
        return view('profesores.admin', ['profesores'=>$profesores]);
    }
}
