<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asignatura;
use App\Curso;
use App\ParametrosCursos;
use App\Aulas;
use App\PeriodoAcademico;
use App\Personal;
use App\Cargo;
use App\Clases;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;

class TalleresController extends Controller
{
	public function __construct()
	{
        $this->middleware('periodo', ['only' => ['create', 'update']]);
	}

	public function index()
	{
		return view('talleres.index');
	}

	public function show($id)
	{
		$taller = Curso::find($id);
		return view('talleres.view', compact('taller'));
	}

	public function admin()
	{
		$talleres = Curso::where('cu_tipo', 2)->orderBy('cu_id', 'DESC')->paginate(10);
		$asig_talleres = Asignatura::where('asig_tipo', 2)->get();
		return view('talleres.admin', compact('talleres', 'asig_talleres'));
	}

	public function create()
	{
		$periodo_actual = PeriodoAcademico::where('pac_estado', 1)->pluck('pac_ano', 'pac_id');
		$per_id = PeriodoAcademico::where('pac_estado', 1)->first();
		$talleres = Asignatura::where('asig_tipo', 2)->orderBy('asig_nombre', 'DESC')->pluck('asig_nombre', 'asig_id');
		//$aulas_ocupadas = Curso::select('aula_id')->where('periodo_id', $per_id->pac_id)->where('cu_tipo', 2)->get()->toArray();
		$aulas_ocupadas = Curso::where('periodo_id', $per_id->pac_id)->where('aula_id', '<>', null)->where('cu_tipo', 2)->pluck('aula_id');
		//dd($aulas_ocupadas);
		$aulas = Aulas::orderBy('aul_numero', 'ASC')->whereNotIn('aul_id', $aulas_ocupadas)/*->where('aul_tipo', 2)*/->pluck('aul_numero', 'aul_id');


		$cargo_profesor = Cargo::where('ca_nombre', 'Profesor')->first();
		$profesores = Personal::where('cargo_id', $cargo_profesor->ca_id)->pluck('persona_rut', 'pers_id');

		return view('talleres.create', ['periodo_actual'=>$periodo_actual, 'profesores'=>$profesores, 'aulas'=>$aulas, 'talleres'=>$talleres]);
	}

	public function store(Request $request)
	{
		$periodo_actual = PeriodoAcademico::where('pac_estado', 1)->first();
		//dd($request->all());
		$curso = new Curso($request->all());
		$curso->cu_tipo = 2;
		$curso->periodo()->associate($periodo_actual);
		$curso->save();
		$clases = new Clases();
		$clases->curso()->associate($curso);
		$clases->asignatura()->associate($request->taller_id);
		$clases->save();

		Flash::success('Se a creado el taller '.$curso->asig_nombre.' exitosamente');
		return redirect()->route('talleres.admin');
	}

	public function edit($id)
	{
		$periodo_actual = PeriodoAcademico::where('pac_estado', 1)->pluck('pac_ano', 'pac_id');
		$per_id = PeriodoAcademico::where('pac_estado', 1)->first();
		$taller = Curso::find($id);
		$talleres = Asignatura::where('asig_tipo', 2)->orderBy('asig_nombre', 'DESC')->pluck('asig_nombre', 'asig_id');
		$array_aulas = Curso::where('periodo_id', $per_id->pac_id)->where('aula_id', '<>', null)->where('cu_tipo', 2)->whereNotIn('cu_id', [$taller->cu_id])->pluck('aula_id');
		$aulas = Aulas::orderBy('aul_numero', 'ASC')->whereNotIn('aul_id', $array_aulas)->where('aul_tipo', 2)->pluck('aul_numero', 'aul_id');
		return view('talleres.edit', compact('taller', 'periodo_actual', 'talleres', 'aulas'));
	}

	public function update(Request $request, $id)
	{
		$taller = Curso::find($id);
		$asig_taller = Asignatura::find($request->taller_id);
        DB::beginTransaction();
        try {
			$taller->update($request->all());
			$clases = $taller->clases->first();
			$clases->asignatura()->associate($asig_taller);
			$clases->update();
            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
        }
		Flash::info('Se a modificado el taller '.$taller->clases->first()->asignatura->asig_nombre.' exitosamente');
        return redirect()->route('talleres.admin');
	}

	public function destroy($id)
	{

	}

	public function delete_taller(Request $request)
	{
		$taller = Curso::find($request->id);
		$taller->delete();
		return 1;
	}

	public function listarAlumnos()
	{
		$talleres = Asignatura::where('asig_tipo', 2)->orderBy('asig_nombre', 'DESC');
		return view('talleres.lista_alumnos');
	}

	public function info_taller(Request $request)
	{
		$taller = Curso::find($request->id);
		return view('talleres.info_taller', ['taller'=>$taller]);
	}

	public function create_asig_taller()
	{
		return view('talleres.create_asig_taller');
	}

	public function store_asig_taller(Request $request)
	{
		$taller = new Asignatura($request->all());
		$taller->asig_tipo = 2;
		$taller->save();
		Flash::success('Se a agregado el taller '.$taller->asig_nombre.' al sistema');
        return redirect()->route('talleres.admin');
	}
}
