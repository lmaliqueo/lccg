<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PeriodoAcademico;
use App\Matricula;
use App\Semestre;
use App\Asignatura;
use App\Curso;
use App\GrupoPauta;
use App\Concepto;
use App\OrdenCompra;
use App\Liceo;
use App\Factura;

class DocumentosController extends Controller
{

	public function index()
	{
		return view('documentos.index');
	}

		/*----------------------------------------------------------*/
		/*-------------------- ALUMNO REGULAR ----------------------*/
		/*----------------------------------------------------------*/


	public function create_cert_alumno_reg()
	{
		$periodo = PeriodoAcademico::where('pac_estado', 1)->first();
		return view('documentos.create_cert_alu', compact('periodo'));
	}

	public function print_cert_alumno(Request $request)
	{
		$matricula = Matricula::find($request->mat_id);
		$obs = $request->observaciones;
		$pdf = \PDF::loadView('documentos.pdf.cert_alu_reg', compact('matricula', 'obs'));
		return $pdf->setPaper('a4')->stream('certificado.pdf');
	}


		/*----------------------------------------------------------*/
		/*----------------- CERTIFICADO DE ESTUDIOS -------------------*/
		/*----------------------------------------------------------*/


	public function create_cert_estudios()
	{
		$periodos = PeriodoAcademico::orderBy('pac_id', 'DESC')->get();
		return view('documentos.create_cert_estudio', ['periodos'=>$periodos]);
	}

	public function print_cert_estudios(Request $request){
		//dd($request->all());
		$matricula = Matricula::find($request->mat_id);
		$asig_comun = Asignatura::where('asig_tipo_asignatura', 1)->pluck('asig_id');

		$asig_reli = Asignatura::where('asig_nombre', 'Religion')->first();
		$religion = $matricula->curso->first()->clases->where('asignatura_id', $asig_reli->asig_id)->first();

		$plan_comun = $matricula->curso->first()->clases->whereIn('asignatura_id', $asig_comun)->whereNotIn('asignatura_id', $asig_reli->asig_id);

		$asig_electivo = Asignatura::where('asig_tipo_asignatura', 2)->pluck('asig_id');
		$plan_electivo = $matricula->curso->first()->clases->whereIn('asignatura_id', $asig_electivo);


		if ($request->semestre != 0) {
			$semestre = Semestre::find($request->semestre);
			$notas = $matricula->notas->where('sem_id', $semestre->sem_id);
		}else{
			$notas = [];
			/*
			$clases = $matricula->curso->first()->clases;

			foreach ($clases as $clase) {
				foreach ($matricula->notas->where('clase_id', $clase->cla_id)->orderBy('semestre_id', 'DESC') as $not) {
					$prom[]
				}
			}

			foreach ($matricula->notas as $nota) {
				$notas[] = [
					'id'=>$nota->clase_id,
					'asig'=>$nota->clase->asignatura->asig_nombre,
					'prof'=>$nota->clase->profesor->persona->nombreCompleto(),
					'prom_1'=>$nota->not_promedio,
				];
			}*/
		}
		$pdf = \PDF::loadView('documentos.pdf.cert_estudios', compact('matricula', 'plan_comun', 'plan_electivo', 'religion'));
		return $pdf->stream('certificado_estudio.pdf');
	}

		/*------------------------------------------------------------*/
		/*------------- CERTIFICADO DE NOTAS PARCIALES ---------------*/
		/*------------------------------------------------------------*/

	public function create_notas_parciales()
	{
		$periodo = PeriodoAcademico::where('pac_estado', 1)->first();
		$periodos = PeriodoAcademico::orderBy('pac_ano', 'DESC')->get();
		return view('documentos.create_inf_notas_par', compact('periodos'));
	}

	public function view_notas_parciales(Request $request)
	{
		$matricula = Matricula::find($request->id);
		if ($request->sem != 'anual') {
			$semestre = Semestre::find($request->sem);
			return view('documentos.view.inf_notas_parciales', compact('matricula', 'semestre'));
		}else{
			return view('documentos.view.inf_notas_parciales', compact('matricula'));
		}
	}

	public function print_notas_parciales(Request $request)
	{
		$matricula = Matricula::find($request->mat_id);
		if ($request->sem_id != null) {
			$semestre = Semestre::find($request->sem_id);
			$pdf = \PDF::loadView('documentos.pdf.inf_not_parciales', compact('matricula', 'semestre'));
		}else{
			$pdf = \PDF::loadView('documentos.pdf.inf_not_parciales_anual', compact('matricula', 'semestre'))->setPaper('a4', 'landscape');
		}
		return $pdf->stream('informe_notas_parciales.pdf');
	}


		/*----------------------------------------------------------*/
		/*---------------- INFORME COMPORTAMIENTO ------------------*/
		/*----------------------------------------------------------*/


	public function create_informe_comp()
	{
		$periodo = PeriodoAcademico::where('pac_estado', 1)->first();
		return view('documentos.create_inf_comp', compact('periodo'));
	}

	public function view_informe_comp(Request $request)
	{
		$matricula = Matricula::find($request->mat);
		$pauta = GrupoPauta::get();
		return view('documentos.view.informe_comp', compact('matricula', 'pauta'));
	}

	public function print_informe_comp(Request $request)
	{
		$matricula = Matricula::find($request->mat_id);
		$pauta = GrupoPauta::get();
		$conceptos = Concepto::orderBy('con_id', 'DESC')->get();
		$pdf = \PDF::loadView('documentos.pdf.inf_comportamiento', compact('matricula', 'pauta', 'conceptos'));
		return $pdf->stream('informe_comportamiento.pdf');
	}

		/*-----------------------------------------------------------*/
		/*-------------------- NOTAS POR CURSO ----------------------*/
		/*-----------------------------------------------------------*/


	public function create_notas_curso()
	{
		$periodo = PeriodoAcademico::where('pac_estado', 1)->first();
		return view('documentos.create_inf_notas_cur', compact('periodo'));
	}

	public function print_notas_curso(Request $request)
	{
		$semestre = Semestre::find($request->semestre);
		$curso = Curso::find($request->curso);
		//$pdf = \PDF::loadView('documentos.pdf.inf_not_curso', compact('semestre', 'curso'));
		$pdf = \PDF::loadView('documentos.pdf.inf_not_final', compact('semestre', 'curso'));
		return $pdf->stream('informe_notas_parciales_curso.pdf');
	}


		/*-----------------------------------------------------------*/
		/*-------------------- ASISTENCIAS POR CURSO ----------------------*/
		/*-----------------------------------------------------------*/

	public function create_inf_asis()
	{
		$periodos = PeriodoAcademico::orderBy('pac_ano', 'DESC')->get();
		return view('documentos.create_asis_curso', compact('periodos'));
	}

	public function print_asis_curso(Request $request)
	{
		$semestre = Semestre::find($request->semestre);
		$curso = Curso::find($request->curso);
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
        $inicio = date("n", strtotime($semestre->sem_fecha_inicio));
        $fin = date("n", strtotime($semestre->sem_fecha_termino));
        $cont = 0;
        for ($i=$inicio; $i <= $fin; $i++) { 
            $meses_asis[$i]['mes'] = $meses[$i];
            $meses_asis[$i]['num'] = $i;
            $cont++;
        }
        $cont;




		$pdf = \PDF::loadView('documentos.pdf.inf_asis_curso', compact('semestre', 'curso', 'cont', 'meses_asis'));
		return $pdf->stream('informe_asistencia_curso.pdf');
	}

		/*----------------------------------------------------------*/
		/*---------------- CALENDARIO DE ADMISION ------------------*/
		/*----------------------------------------------------------*/


	public function create_calendario_adm()
	{
		$periodos = PeriodoAcademico::get();
		return view('documentos.create_calendario_adm', compact('periodos'));
	}

	public function print_calend_admision(Request $request)
	{
		$periodo = PeriodoAcademico::find($request->periodo);
		$pdf = \PDF::loadView('documentos.pdf.inf_not_curso', compact('periodo'))->setPaper('a4', 'landscape');
		return $pdf->stream('informe_notas_parciales_curso.pdf');
	}


		/*-----------------------------------------------------------*/
		/*-------------------- ORDEN DE COMPRA ----------------------*/
		/*-----------------------------------------------------------*/


	public function create_orden_compra()
	{
		$ordenes = OrdenCompra::get();
		return view('documentos.create_orden_compra', compact('ordenes'));
	}

	public function view_orden_compra(Request $request)
	{
		$orden = OrdenCompra::find($request->id);
		//dd($orden);
		return view('documentos.view.orden_compra', compact('orden'));
	}

	public function print_orden_compra(Request $request)
	{
		$orden = OrdenCompra::find($request->oc_id);
		//dd($orden);
		$liceo = Liceo::first();
		$pdf = \PDF::loadView('documentos.pdf.orden_compra', compact('orden', 'liceo'));
		return $pdf->stream('orden_compra.pdf');
	}


		/*-----------------------------------------------------------*/
		/*------------------------ FACTURA --------------------------*/
		/*-----------------------------------------------------------*/

	public function create_factura()
	{
		$facturas = Factura::get();
		return view('documentos.create_factura', compact('facturas'));
	}

	public function view_factura(Request $request)
	{
		$factura = Factura::find($request->id);
		return view('documentos.view.factura', compact('factura'));
	}

	public function print_factura(Request $request)
	{
		$factura = Factura::find($request->fac_id);
		$liceo = Liceo::first();
		//dd($factura);
		$pdf = \PDF::loadView('documentos.pdf.factura', compact('factura', 'liceo'));
		return $pdf->stream('factura.pdf');
	}





		/*-----------------------------------------------------------*/



	public function curso_lista_al(Request $request)
	{
		$curso = Curso::find($request->id);
		$tipo_inf = $request->tipo_inf;
		//dd($request->tipo_inf);
		return view('documentos.lista_alumnos', compact('curso', 'tipo_inf'));
	}
}
