<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::group(['prefix'=>'admin'], function(){

	Route::resource('user','UserController');
	Route::get('user/{id}/destroy', [
			'uses' => 'UserController@destroy',
			'as'   => 'admin.user.destroy'
		]);


	Route::resource('alumnos','AlumnosController');
	Route::get('alumnos/{id}/destroy', [
			'uses' => 'AlumnosController@destroy',
			'as'   => 'admin.alumnos.destroy'
		]);
	Route::resource('carreras','CarrerasController');
	Route::get('carreras/{id}/destroy', [
			'uses' => 'CarrerasController@destroy',
			'as'   => 'admin.carreras.destroy'
		]);

	Route::resource('asignaturas','AsignaturasController');
	Route::get('asignaturas/{id}/destroy', [
			'uses' => 'AsignaturasController@destroy',
			'as'   => 'admin.asignaturas.destroy'
		]);


	Route::resource('secciones','SeccionesController');
	Route::get('secciones/{id}/destroy', [
			'uses' => 'SeccionesController@destroy',
			'as'   => 'admin.secciones.destroy'
		]);
	Route::post('secciones/asignar_alumno', 'SeccionesController@asignar_alumno');
	Route::post('secciones/asignar_alumno', [
			'uses' => 'SeccionesController@asignar_alumno',
			'as' => 'admin.secciones.asignar_alumno'
		]);
});


++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	Route::get('probando_was', [
			'uses' => 'HomeController@probandowas',
			'as'   => 'home.probandowas'
		]);
Route::middleware('auth')->group(function(){

	Route::get('/', function () {
	    return view('welcome');
	});

/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*+++++++++++++++++++++++++++++++++++++ ALUMNO +++++++++++++++++++++++++++++++++++++++++*/
/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/



	Route::group(['prefix'=>'alumno/menu'], function(){

		Route::post('datos_alumno', [
				'uses' => 'AlumnosController@info_alumno',
				'as'   => 'alumnos.info_alumno'
			]);

	});






	Route::resource('alumnos','AlumnosController');

/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*+++++++++++++++++++++++++++++++++++ DOCUMENTOS +++++++++++++++++++++++++++++++++++++++*/
/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

	Route::resource('documentos','DocumentosController');
	Route::group(['prefix'=>'documentos/menu'], function(){
		Route::get('admin', [
				'uses' => 'DocumentosController@admin',
				'as'   => 'documentos.admin'
			]);


		/*----------------------------------------------------------*/
		/*-------------------- ALUMNO REGULAR ----------------------*/
		/*----------------------------------------------------------*/

		Route::get('create_cert_alu', [
				'uses' => 'DocumentosController@create_cert_alumno_reg',
				'as'   => 'documentos.cert_alu_reg'
			]);

		Route::post('print_cert_alu', [
				'uses' => 'DocumentosController@print_cert_alumno',
				'as'   => 'documentos.print.cert_alu_reg'
			]);



		/*-----------------------------------------------------------*/
		/*---------------- CERTIFICADO DE ESTUDIOS ------------------*/
		/*-----------------------------------------------------------*/

		Route::get('create_cert_estudios', [
				'uses' => 'DocumentosController@create_cert_estudios',
				'as'   => 'documentos.cert_estudios'
			]);
		Route::post('print_cert_estudios', [
				'uses' => 'DocumentosController@print_cert_estudios',
				'as'   => 'documentos.print.cert_estudios'
			]);

		/*------------------------------------------------------------*/
		/*---------------- INFORME PARCIAL DE NOTAS ------------------*/
		/*------------------------------------------------------------*/

		Route::get('create_inf_notas', [
				'uses' => 'DocumentosController@create_notas_parciales',
				'as'   => 'documentos.inf_notas_parciales'
			]);

		Route::post('ver_notas_parc', [
				'uses' => 'DocumentosController@view_notas_parciales',
				'as'   => 'documentos.view.notas_parciales'
			]);


		Route::post('print_informe_notas', [
				'uses' => 'DocumentosController@print_notas_parciales',
				'as'   => 'documentos.print.inf_notas_parciales'
			]);


		/*----------------------------------------------------------*/
		/*---------------- INFORME COMPORTAMIENTO ------------------*/
		/*----------------------------------------------------------*/

		Route::get('create_informe_comport', [
				'uses' => 'DocumentosController@create_informe_comp',
				'as'   => 'documentos.informe_comportamiento'
			]);


		Route::post('ver_inf_comp', [
				'uses' => 'DocumentosController@view_informe_comp',
				'as'   => 'documentos.view.informe_comportamiento'
			]);

		Route::post('imprimir_inf_comp', [
				'uses' => 'DocumentosController@print_informe_comp',
				'as'   => 'documentos.print.informe_comportamiento'
			]);


		/*-----------------------------------------------------------*/
		/*-------------------- ASISTENCIAS POR CURSO ----------------------*/
		/*-----------------------------------------------------------*/

		Route::get('create_inf_asis_cur', [
				'uses' => 'DocumentosController@create_inf_asis',
				'as'   => 'documentos.informe_asis'
			]);


		Route::post('print_informe_asis_curso', [
				'uses' => 'DocumentosController@print_asis_curso',
				'as'   => 'documentos.print.inf_asis_curso'
			]);



		/*-----------------------------------------------------------*/
		/*-------------------- NOTAS POR CURSO ----------------------*/
		/*-----------------------------------------------------------*/

		Route::get('create_notas_curso', [
				'uses' => 'DocumentosController@create_notas_curso',
				'as'   => 'documentos.notas_curso'
			]);
		Route::post('print_informe_notas_curso', [
				'uses' => 'DocumentosController@print_notas_curso',
				'as'   => 'documentos.print.inf_notas_curso'
			]);

		/*----------------------------------------------------------*/
		/*---------------- CALENDARIO DE ADMISION ------------------*/
		/*----------------------------------------------------------*/

		Route::get('create_calend_admision', [
				'uses' => 'DocumentosController@create_calendario_adm',
				'as'   => 'documentos.calendario_adm'
			]);

		Route::post('print_calendario_admision', [
				'uses' => 'DocumentosController@print_calendario_adm',
				'as'   => 'documentos.print.calendario_adm'
			]);

		/*-----------------------------------------------------------*/
		/*-------------------- ORDEN DE COMPRA ----------------------*/
		/*-----------------------------------------------------------*/

		Route::get('create_orden_compra', [
				'uses' => 'DocumentosController@create_orden_compra',
				'as'   => 'documentos.orden_compra'
			]);
		Route::post('ver_oc', [
				'uses' => 'DocumentosController@view_orden_compra',
				'as'   => 'documentos.view.orden_compra'
			]);
		Route::post('imprimir_orden_compra', [
				'uses' => 'DocumentosController@print_orden_compra',
				'as'   => 'documentos.print.orden_compra'
			]);

		/*-----------------------------------------------------------*/
		/*------------------------ FACTURA --------------------------*/
		/*-----------------------------------------------------------*/

		Route::get('create_factura', [
				'uses' => 'DocumentosController@create_factura',
				'as'   => 'documentos.facturas'
			]);
		Route::post('ver_fac', [
				'uses' => 'DocumentosController@view_factura',
				'as'   => 'documentos.view.factura'
			]);
		Route::post('imprimir_factura', [
				'uses' => 'DocumentosController@print_factura',
				'as'   => 'documentos.print.factura'
			]);






		Route::post('lista_alumnos', [
				'uses' => 'DocumentosController@curso_lista_al',
				'as'   => 'documentos.list_alu'
			]);

	});






/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*+++++++++++++++++++++++++++++++++++ PROFESORES +++++++++++++++++++++++++++++++++++++++*/
/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

	Route::resource('profesores','ProfesoresController');
	Route::group(['prefix'=>'profesores/menu'], function(){
		Route::get('admin', [
				'uses' => 'ProfesoresController@admin',
				'as'   => 'profesores.admin'
			]);
	});



/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*+++++++++++++++++++++++++++++++++++ MATRICULAS +++++++++++++++++++++++++++++++++++++++*/
/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/



	Route::resource('matriculas','MatriculaController');


	Route::group(['prefix'=>'matriculas/menu', 'middleware'=>['acceso_usuario:Inspector General,Administrador,Secretaria,Jefe UTP']], function(){
		Route::get('list', [
				'uses' => 'MatriculaController@list_alumnos',
				'as'   => 'matriculas.list'
			]);
		Route::get('admin', [
				'uses' => 'MatriculaController@admin',
				'as'   => 'matriculas.admin'
			]);
		Route::get('buscar', [
				'uses' => 'MatriculaController@buscar',
				'as'   => 'matriculas.buscar'
			]);
		Route::get('retirar_alumno', [
				'uses' => 'MatriculaController@menu_retiro',
				'as'   => 'matriculas.menu_retiro'
			])->middleware('inspector');
			Route::post('borrar_mat', [
				'uses' => 'MatriculaController@delete_mat',
				'as'   => 'matriculas.delete_mat'
			]);
			Route::post('info_matricula', [
				'uses' => 'MatriculaController@info_matricula',
				'as'   => 'matriculas.info_matricula'
			]);
			Route::post('retirar_alumno', [
				'uses' => 'MatriculaController@retirar_alumno',
				'as'   => 'matriculas.retirar'
			]);
			Route::get('ver_matricula/{id}', [
				'uses' => 'MatriculaController@view_matricula',
				'as'   => 'matriculas.view_mat'
			]);
		/*---------------------------------------------------------*/
		/*------------------------ UPDATE --------------------------*/
		/*---------------------------------------------------------*/

		Route::match(['put', 'patch'], 'actualizar_matricula/{id}', [
				'uses' => 'MatriculaController@update_matricula',
				'as'   => 'matriculas.update.matricula'
			]);
		Route::match(['put', 'patch'], 'actualizar_alumno/{id}', [
				'uses' => 'MatriculaController@update_alumno',
				'as'   => 'matriculas.update.alumno'
			]);
		Route::match(['put', 'patch'], 'actualizar_padres/{id}', [
				'uses' => 'MatriculaController@update_padres',
				'as'   => 'matriculas.update.padres'
			]);
		Route::match(['put', 'patch'], 'actualizar_apoderados/{id}', [
				'uses' => 'MatriculaController@update_apoderados',
				'as'   => 'matriculas.update.apoderados'
			]);

		/*---------------------------------------------------------*/
		/*------------------------ UPDATE --------------------------*/
		/*---------------------------------------------------------*/


		/*---------------------------------------------------------*/
		/*------------------------ INSC TALLER --------------------------*/
		/*---------------------------------------------------------*/

		Route::get('inscribir_taller', [
				'uses' => 'MatriculaController@menuTaller',
				'as'   => 'matriculas.menu_taller'
			])->middleware('jefeutp');

			Route::post('ins_taller_alu', [
				'uses' => 'MatriculaController@inscribirTaller',
				'as'   => 'matriculas.ins_taller'
			])->middleware('jefeutp');


		/*---------------------------------------------------------*/
		/*------------------------ ADMISION --------------------------*/
		/*---------------------------------------------------------*/


		Route::get('menu_admision', [
				'uses' => 'MatriculaController@admision_alumnos',
				'as'   => 'matriculas.admision'
			]);

			Route::post('lista_curso', [
				'uses' => 'MatriculaController@lista_alu_curso',
				'as'   => 'matriculas.lista_alumnos_curso'
			]);

			Route::post('lista_alumnos', [
				'uses' => 'MatriculaController@lista_alu_admision',
				'as'   => 'matriculas.lista_alumnos_admision'
			]);

			Route::post('guardar_admision', [
				'uses' => 'MatriculaController@store_admision',
				'as'   => 'matriculas.store_admision'
			]);


	});


	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++ ENSAYOS ++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

	Route::group(['prefix'=>'ensayos', 'middleware'=>['jefeutp']], function(){

		/*---------------------------------------------------------*/
		/*------------------------- PSU ---------------------------*/
		/*---------------------------------------------------------*/

		Route::get('psu', [
				'uses' => 'EnsayosController@index_psu',
				'as'   => 'ensayos.psu.index'
			])->middleware('jefeutp');

		Route::get('create_psu', [
				'uses' => 'EnsayosController@create_psu',
				'as'   => 'ensayos.psu.create'
			]);

		Route::post('store_psu', [
				'uses' => 'EnsayosController@store_psu',
				'as'   => 'ensayos.psu.store'
			]);
		Route::get('view_psu/{id}', [
				'uses' => 'EnsayosController@view_psu',
				'as'   => 'ensayos.psu.view'
			]);

		Route::get('psu/{id}/edit', [
				'uses' => 'EnsayosController@edit_psu',
				'as'   => 'ensayos.psu.edit'
			]);

		Route::match(['put', 'patch'], 'actualizar_psu/{id}', [
				'uses' => 'EnsayosController@update_psu',
				'as'   => 'ensayos.psu.update'
			]);

		/*---------------------------------------------------------*/
		/*------------------------ SIMCE --------------------------*/
		/*---------------------------------------------------------*/

		Route::get('simce', [
				'uses' => 'EnsayosController@index_simce',
				'as'   => 'ensayos.simce.index'
			]);

		Route::get('create_simce', [
				'uses' => 'EnsayosController@create_simce',
				'as'   => 'ensayos.simce.create'
			]);

		Route::post('store_simce', [
				'uses' => 'EnsayosController@store_simce',
				'as'   => 'ensayos.simce.store'
			]);
		Route::get('view_simce/{id}', [
				'uses' => 'EnsayosController@view_simce',
				'as'   => 'ensayos.simce.view'
			]);
		Route::get('simce/{id}/edit', [
				'uses' => 'EnsayosController@edit_simce',
				'as'   => 'ensayos.simce.edit'
			]);

		Route::match(['put', 'patch'], 'actualizar_simce/{id}', [
				'uses' => 'EnsayosController@update_simce',
				'as'   => 'ensayos.simce.update'
			]);

		Route::post('borrar_ensayo', [
			'uses' => 'EnsayosController@delete_ensayo',
			'as'   => 'ensayos.delete'
			]);
	});






	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++ ACADEMICO ++++++++++++++++++++++++++++++++++++++*/
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/


	Route::group(['middleware' => ['acceso_usuario:Inspector General,Jefe UTP,Profesor'], 'prefix'=>'academico'], function(){
		Route::get('index', [
				'uses' => 'AcademicoController@index',
				'as'   => 'academico.index'
			]);
		/*
		Route::post('clases', [
				'uses' => 'AcademicoController@listaAsignaturas',
				'as'   => 'academico.lista_asig'
			]);*/
		Route::post('load_clases', [
				'uses' => 'CursoController@cargar_clases',
				'as'   => 'curso.cargar_clases'
			]);
		/*---------------------------------------------------------*/
		/*------------------------ NOTAS --------------------------*/
		/*---------------------------------------------------------*/
		Route::get('notas', [
				'uses' => 'NotasController@menuNotas',
				'as'   => 'academico.menu_notas'
			]);
		Route::post('mostrar_notas', [
				'uses' => 'NotasController@mostrarNotas',
				'as'   => 'academico.mostrar_notas'
			]);
		Route::post('guardar_notas', [
				'uses' => 'NotasController@guardarNotas',
				'as'   => 'academico.guardar_notas'
			])->middleware('profesor');

		/*---------------------------------------------------------*/
		/*------------------------ ASISTENCIA --------------------------*/
		/*---------------------------------------------------------*/

		Route::get('asistencia', [
				'uses' => 'AsistenciasController@menuAsistencia',
				'as'   => 'academico.menu_asistencia'
			]);
		Route::post('ver_asistencia', [
				'uses' => 'AsistenciasController@verAsistencia',
				'as'   => 'asistencia.ver_asistencia'
			]);

		Route::post('ver_mes_asistencia', [
				'uses' => 'AsistenciasController@viewAsisMes',
				'as'   => 'asistencia.view_mes_asis'
			]);




		Route::post('guardar_asistencia', [
				'uses' => 'AsistenciasController@guardar_asis',
				'as'   => 'academico.save_asis'
			]);

		Route::post('crear_asistencias', [
				'uses' => 'AsistenciasController@create_asis',
				'as'   => 'academico.crear_asis'
			]);

		Route::get('grafico_asis', [
				'uses' => 'AsistenciasController@index_grafico',
				'as'   => 'asistencia.index_grafico'
			]);

		Route::post('cargar_grafico', [
				'uses' => 'AsistenciasController@view_grafico',
				'as'   => 'asistencia.view_grafico'
			]);

		/*---------------------------------------------------------*/
		/*------------------------ COMPORTAMIENTO --------------------------*/
		/*---------------------------------------------------------*/

		Route::get('comportamiento', [
				'uses' => 'AcademicoController@evaluarComportamiento',
				'as'   => 'academico.eva_comportamiento'
			]);
		Route::post('mostrar_pauta', [
				'uses' => 'AcademicoController@pauta_conceptos',
				'as'   => 'academico.pauta_conceptos'
			]);
		Route::post('create_pauta', [
				'uses' => 'AcademicoController@createPauta',
				'as'   => 'academico.create_pauta'
			]);
		Route::post('store_pauta', [
				'uses' => 'AcademicoController@storePauta',
				'as'   => 'academico.store_pauta'
			]);


		/*---------------------------------------------------------*/
		/*------------------------ ENSAYOS --------------------------*/
		/*---------------------------------------------------------*/

		Route::get('resultados_ensayos', [
				'uses' => 'AcademicoController@menuEnsayos',
				'as'   => 'academico.menu_ensayos'
			]);

		Route::post('form_ensayo', [
				'uses' => 'AcademicoController@formEnsayo',
				'as'   => 'academico.form_ensayos'
			]);

		Route::post('guardar_resultados', [
				'uses' => 'AcademicoController@storeEnsayo',
				'as'   => 'academico.store_ensayos'
			]);

		Route::post('admin_ensayos', [
				'uses' => 'AcademicoController@adminEnsayos',
				'as'   => 'academico.admin_ensayos'
			]);

	});



	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*+++++++++++++++++++++++++++++++++++++ ASIGNATURAS +++++++++++++++++++++++++++++++++++++*/
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

	Route::resource('asignaturas','AsignaturaController');
	Route::group(['prefix'=>'asignaturas/menu'], function(){
		Route::get('admin', [
				'uses' => 'AsignaturaController@admin',
				'as'   => 'asignaturas.admin'
			]);

	});

	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++ ARTICULOS ++++++++++++++++++++++++++++++++++++++*/
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

	Route::resource('articulos','ArticulosController');
		Route::get('/ordencompra', [
				'uses' => 'ArticulosController@ordencompra',
				'as'   => 'articulos.ordencompra'
			]);
		Route::get('/recibo', [
				'uses' => 'ArticulosController@reciboArticulos',
				'as'   => 'articulos.recibo_articulos'
			]);
	Route::group(['prefix'=>'articulos/menu'], function(){
		Route::get('admin', [
				'uses' => 'ArticulosController@admin',
				'as'   => 'articulos.admin'
			]);
		Route::get('lista', [
				'uses' => 'ArticulosController@list',
				'as'   => 'articulos.list'
			]);
	});


	Route::resource('periodo','PeriodoController');
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++ CURSO ++++++++++++++++++++++++++++++++++++++++*/
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	Route::resource('cursos','CursoController');
	Route::group(['prefix'=>'cursos/menu'], function(){
		Route::get('admin', [
				'uses' => 'CursoController@admin',
				'as'   => 'cursos.admin'
			])->middleware('inspector');
		Route::post('asignar_alumnos_store', [
				'uses' => 'CursoController@asignarAluStore',
				'as'   => 'curso.asigna_alu_store'
			]);

	});
	Route::group([ 'prefix'=>'curso'], function(){
	/*----------------------------- Lista Alumnos -----------------------------*/
		Route::get('menu_lista', [
				'uses' => 'CursoController@menu_list_alu',
				'as'   => 'curso.menu_list_al'
			])->middleware('jefeutp');
		Route::post('lista_alumnos', [
				'uses' => 'CursoController@view_list_alu',
				'as'   => 'curso.view_lista'
			]);
		Route::post('editar_lista', [
				'uses' => 'CursoController@edit_lista_alu',
				'as'   => 'curso.edit_lista'
			]);
		Route::post('guardar_lista', [
				'uses' => 'CursoController@store_list_alu',
				'as'   => 'curso.store_list_alu'
			]);





/*
		Route::get('asignar_alumnos/{id}', [
				'uses' => 'CursoController@asignarAlumnos',
				'as'   => 'curso.asignar_alumnos'
			]);
*/


		Route::get('asignar_asignaturas', [
				'uses' => 'CursoController@menuAAsignaturas',
				'as'   => 'curso.asignar_asignaturas'
			])->middleware('acceso_usuario:Inspector General,Jefe UTP');
		Route::post('tabla_asignaturas', [
				'uses' => 'CursoController@tablaAsignaturas',
				'as'   => 'curso.tabla_asignaturas'
			]);


		Route::get('horarios_asignaturas', [
				'uses' => 'CursoController@menu_horarios',
				'as'   => 'curso.horarios_asignaturas'
			])->middleware('jefeutp');
		Route::post('buscar_curso', [
				'uses' => 'CursoController@buscarCurso',
				'as'   => 'curso.buscar_curso'
			]);
		Route::post('ver_horarios', [
				'uses' => 'CursoController@verHorarios',
				'as'   => 'curso.ver_horarios'
			]);
		Route::post('crear_horario', [
				'uses' => 'CursoController@create_horario',
				'as'   => 'curso.create_horario'
			]);
		Route::post('guardar_horarios', [
				'uses' => 'CursoController@guardarHorarios',
				'as'   => 'curso.guardar_horarios'
			]);


		/*------------------------------- AJAX -------------------------------*/


		Route::post('tabla_asig', [
				'uses' => 'CursoController@cargar_asignaturas',
				'as'   => 'curso.ajax.cargar_asig'
			]);

		Route::post('buscar_profe_asig', [
				'uses' => 'CursoController@buscar_profe_asig',
				'as'   => 'curso.ajax.buscar_profe_asig'
			]);

		Route::post('guardar_clases', [
				'uses' => 'CursoController@clases_store',
				'as'   => 'curso.ajax.store_clases'
			]);

		Route::post('dropdown_param', [
				'uses' => 'CursoController@buscar_param',
				'as'   => 'curso.ajax.buscar_param'
			]);

		Route::post('horarios_clase', [
				'uses' => 'CursoController@clase_horarios',
				'as'   => 'curso.ajax.clase_horarios'
			]);

	});
	Route::group(['middleware'=>['profesor'], 'prefix'=>'cursos/profesor'], function(){
		Route::get('curso_prof', [
				'uses' => 'CursoController@curso_prof',
				'as'   => 'cursos.prof_jefe.curso'
			]);
		Route::get('clases_prof', [
				'uses' => 'CursoController@clases_prof',
				'as'   => 'cursos.prof_jefe.clases'
			]);
	});

	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++ EMPLEADOS ++++++++++++++++++++++++++++++++++++++*/
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/



	Route::resource('empleados','PersonalController');
	Route::group(['prefix'=>'empleados/menu'], function(){
		Route::get('admin', [
				'uses' => 'PersonalController@admin',
				'as'   => 'empleados.admin'
			]);
		Route::post('eliminar_empleado', [
				'uses' => 'PersonalController@delete_empleado',
				'as'   => 'empleados.delete_empleado'
			]);

		Route::get('crear_cargo', [
				'uses' => 'PersonalController@create_cargo',
				'as'   => 'empleados.create_cargo'
			]);
		Route::post('guardar_cargo', [
				'uses' => 'PersonalController@store_cargo',
				'as'   => 'empleados.store_cargo'
			]);
		Route::post('modificar_estado', [
				'uses' => 'PersonalController@edit_status',
				'as'   => 'empleados.edit_status'
			]);
	});

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++ TALLERES ++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

	Route::resource('talleres','TalleresController');
	Route::group(['prefix'=>'talleres/menu'], function(){
		Route::get('admin', [
				'uses' => 'TalleresController@admin',
				'as'   => 'talleres.admin'
			]);
		Route::get('habilitar', [
				'uses' => 'TalleresController@habilitar',
				'as'   => 'talleres.habilitar'
			]);
		Route::get('lista_alumnos', [
				'uses' => 'TalleresController@listarAlumnos',
				'as'   => 'talleres.lista_alumnos'
			]);

			Route::post('info_taller', [
				'uses' => 'TalleresController@info_taller',
				'as'   => 'talleres.info_taller'
			]);
			Route::post('borrar_taller', [
					'uses' => 'TalleresController@delete_taller',
					'as'   => 'talleres.delete_taller'
				]);






		Route::get('asig_taller', [
				'uses' => 'TalleresController@create_asig_taller',
				'as'   => 'talleres.create_asig_taller'
			]);
		Route::post('guardar_taller', [
				'uses' => 'TalleresController@store_asig_taller',
				'as'   => 'talleres.store_asig_taller'
			]);
	});


	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++ PLAN ESTUDIO ++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

	Route::group(['prefix'=>'plan_estudio', 'middleware'=>'jefeutp'], function(){


		Route::get('admin', [
				'uses' => 'AsignaturaController@admin_planes',
				'as'   => 'plan_estudio.admin_planes'
			]);

		Route::get('create', [
				'uses' => 'AsignaturaController@createPlanEstudio',
				'as'   => 'plan_estudio.create'
			]);
		Route::post('store', [
				'uses' => 'AsignaturaController@storePlanEstudio',
				'as'   => 'plan_estudio.store'
			]);
		Route::get('ver/{id}', [
				'uses' => 'AsignaturaController@verPlanEstudio',
				'as'   => 'plan_estudio.ver_planes'
			]);

		Route::get('edit/{id}', [
				'uses' => 'AsignaturaController@editPlanEstudio',
				'as'   => 'plan_estudio.edit_plan'
			]);

		Route::match(['put', 'patch'], 'actualizar_plan/{id}', [
				'uses' => 'AsignaturaController@updatePlanEstudio',
				'as'   => 'plan_estudio.update_plan'
			]);

		Route::post('borrar_plan', [
				'uses' => 'AsignaturaController@delete_plan',
				'as'   => 'plan_estudio.delete_plan'
			]);

	/*-------------------------------- AJAX --------------------------------*/

		Route::post('search_asig', [
				'uses' => 'AsignaturaController@buscar_asig',
				'as'   => 'plan_estudio.ajax.buscar_asig'
			]);
		Route::post('modificar_estado', [
				'uses' => 'AsignaturaController@statePlanEstudio',
				'as'   => 'plan_estudio.ajax.update_state'
			]);
	});






	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++ ORDEN COMPRA ++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	Route::resource('orden_compra','OrdenCompraController');

	Route::group(['prefix'=>'ordencompra'], function(){
		Route::get('create', [
				'uses' => 'ArticulosController@createOC',
				'as'   => 'ordencompra.create'
			]);
		Route::get('index', [
				'uses' => 'ArticulosController@indexOC',
				'as'   => 'ordencompra.index'
			]);
		Route::post('store', [
				'uses' => 'ArticulosController@storeOC',
				'as'   => 'ordencompra.store'
			]);
	/*++++++++++++++++++++++++++++++++++++ ORDEN COMPRA ++++++++++++++++++++++++++++++++++++*/
		Route::post('borrar_oc', [
				'uses' => 'OrdenCompraController@delete_orden',
				'as'   => 'orden_compra.delete_orden'
			]);
	});



	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++ PROVEEDORES ++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

	Route::resource('proveedores','ProveedorController');

	Route::group(['prefix'=>'proveedor'], function(){
		Route::post('borrar_prov', [
				'uses' => 'ProveedorController@delete_prov',
				'as'   => 'proveedor.delete_prov'
			]);

	});



	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++ RECIBO ++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/




	Route::group(['prefix'=>'recibo'], function(){
		Route::post('form', [
				'uses' => 'ArticulosController@formRecibo',
				'as'   => 'recibo.form'
			]);
		Route::post('store', [
				'uses' => 'ArticulosController@storeRecibo',
				'as'   => 'recibo.store'
			]);
		Route::get('list', [
				'uses' => 'ArticulosController@listRecibo',
				'as'   => 'recibo.list'
			]);

	});


	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++ FACTURAs ++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/


	Route::resource('facturas','FacturasController');

	Route::group(['prefix'=>'factura'], function(){
		Route::get('index', [
				'uses' => 'ArticulosController@index_factura',
				'as'   => 'factura.index'
			]);
		Route::get('view', [
				'uses' => 'ArticulosController@view_factura',
				'as'   => 'factura.view'
			]);
		Route::post('borrar_oc', [
				'uses' => 'FacturasController@delete_factura',
				'as'   => 'factura.delete_factura'
			]);
	});




	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*+++++++++++++++++++++++++++++++++++++ PARAMETROS +++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/






	Route::group(['middleware'=>['acceso_usuario:Inspector General,Jefe UTP'], 'prefix'=>'administracion'], function(){
		Route::get('index', [
				'uses' => 'ParametrosController@index',
				'as'   => 'parametros.index'
			]);

		/*---------------------------------------------------------*/
		/*------------------------ CURSO --------------------------*/
		/*---------------------------------------------------------*/

		Route::get('admin_param_cursos', [
				'uses' => 'ParametrosController@adminCursos',
				'as'   => 'parametros.admin.cursos'
			]);

		Route::get('crear_cursos', [
				'uses' => 'ParametrosController@createParametrosCursos',
				'as'   => 'parametros.create.cursos'
			]);
		Route::post('guardar_curso', ['uses'=>'ParametrosController@storeCurso', 'as'=>'parametros.store.cursos']);


		/*---------------------------------------------------------*/
		/*----------------------- PERIODO -------------------------*/
		/*---------------------------------------------------------*/
		Route::get('admin_periodos', [
				'uses' => 'ParametrosController@adminPeriodos',
				'as'   => 'parametros.admin.periodos'
			]);

		Route::get('crear_periodo', [
				'uses' => 'ParametrosController@createPeriodo',
				'as'   => 'parametros.create.periodo'
			]);
		Route::post('guardar_periodo', ['uses'=>'ParametrosController@storePeriodo', 'as'=>'parametros.store.periodo']);

		Route::post('add_semestre', ['uses'=>'PeriodoController@addSemestre', 'as'=>'periodo.add_semestre']);

		Route::post('save_semestre', ['uses'=>'PeriodoController@storeSemestre', 'as'=>'periodo.store_semestre']);

		Route::post('activar_semestre', ['uses'=>'PeriodoController@actSemestre', 'as'=>'periodo.active_sem']);

		Route::post('finalizar_semestre', ['uses'=>'PeriodoController@finSemestre', 'as'=>'periodo.fin_sem']);

		Route::post('finalizar_periodo', [
				'uses' => 'PeriodoController@finPeriodo',
				'as'   => 'periodo.fin_periodo'
			]);

		/*---------------------------------------------------------*/
		/*------------------------ AULAS --------------------------*/
		/*---------------------------------------------------------*/

		Route::get('admin_aulas', [
				'uses' => 'ParametrosController@adminAulas',
				'as'   => 'parametros.admin.aulas'
			]);
		Route::get('crear_aulas', [
				'uses' => 'ParametrosController@createAulas',
				'as'   => 'parametros.create.aulas'
			]);
		Route::post('guardar_aulas', ['uses'=>'ParametrosController@storeAulas', 'as'=>'parametros.store.aulas']);

		Route::get('editar_aula/{id?}', [
				'uses' => 'ParametrosController@editAula',
				'as'   => 'parametros.edite.aulas'
			]);

		Route::match(['put', 'patch'], 'actualizar_aulas/{id}', [
				'uses' => 'ParametrosController@updateAula',
				'as'   => 'parametros.update.aulas'
			]);

		/*---------------------------------------------------------*/
		/*------------------------ HORAS --------------------------*/
		/*---------------------------------------------------------*/

		Route::get('admin_horas', [
				'uses' => 'ParametrosController@adminHoras',
				'as'   => 'parametros.admin.horas'
			]);

		Route::get('crear_horas', [
				'uses' => 'ParametrosController@createHoras',
				'as'   => 'parametros.create.horas'
			]);

		Route::post('guardar_horas', ['uses'=>'ParametrosController@storeHoras', 'as'=>'parametros.store.horas']);

		/*---------------------------------------------------------*/
		/*------------------------ LICEO --------------------------*/
		/*---------------------------------------------------------*/

		Route::get('view_liceo', [
				'uses' => 'ParametrosController@viewLiceo',
				'as'   => 'parametros.view.liceo'
			]);

		Route::get('create_liceo', [
				'uses' => 'ParametrosController@createLiceo',
				'as'   => 'parametros.create.liceo'
			]);

		Route::get('guardar_liceo', [
				'uses' => 'ParametrosController@storeLiceo',
				'as'   => 'parametros.store.liceo'
			]);

		Route::get('editar_liceo/{id?}', [
				'uses' => 'ParametrosController@editLiceo',
				'as'   => 'parametros.edite.liceo'
			]);

		Route::match(['put', 'patch'], 'actualizar_liceo/{id}', [
				'uses' => 'ParametrosController@updateLiceo',
				'as'   => 'parametros.update.liceo'
			]);

		/*---------------------------------------------------------*/
		/*---------------------- CONCEPTOS ------------------------*/
		/*---------------------------------------------------------*/

		Route::get('admin_conceptos', [
				'uses' => 'ParametrosController@adminConceptos',
				'as'   => 'parametros.admin.conceptos'
			]);

		Route::get('crear_conceptos', [
				'uses' => 'ParametrosController@createConceptos',
				'as'   => 'parametros.create.conceptos'
			]);
		Route::post('guardar_conceptos', ['uses'=>'ParametrosController@storeConceptos', 'as'=>'parametros.store.conceptos']);
		Route::get('pauta_comportamiento', [
				'uses' => 'ParametrosController@viewPautaConcepto',
				'as'   => 'parametros.view.pauta_comportamiento'
			]);
		Route::get('create_pauta', [
				'uses' => 'ParametrosController@createPauta',
				'as'   => 'parametros.create.pauta'
			]);
		Route::get('edit_pauta', [
				'uses' => 'ParametrosController@editPauta',
				'as'   => 'parametros.edit.pauta'
			]);
		Route::post('guardar_grupo', ['uses'=>'ParametrosController@storeGrupoPauta', 'as'=>'parametros.store.grupo_pauta']);
		Route::post('create_detalle', [
				'uses' => 'ParametrosController@createDetallePauta',
				'as'   => 'parametros.create.detalle_pauta'
			]);
		Route::post('guardar_detalle', ['uses'=>'ParametrosController@storeDetallePauta', 'as'=>'parametros.store.detalle_pauta']);


		Route::match(['put', 'patch'], 'actualizar_grupo_pauta/{id}', [
				'uses' => 'ParametrosController@updateGrupoPauta',
				'as'   => 'parametros.update.grupo_pauta'
			]);

		/*---------------------- edit ------------------------*/

		Route::get('pauta_conceptos/{id}/actualizar_grupo', [
				'uses' => 'ParametrosController@edit_grupo_pauta',
				'as'   => 'parametros.edit.grupo_pauta'
			]);
		Route::get('pauta_conceptos/{id}/actualizar_detalle', [
				'uses' => 'ParametrosController@edit_detalle_pauta',
				'as'   => 'parametros.edit.detalle_pauta'
			]);
		Route::get('pauta_conceptos/{id}/actualizar_conceptos', [
				'uses' => 'ParametrosController@edit_conceptos',
				'as'   => 'parametros.edit.conceptos'
			]);

		Route::get('horas/{id}/actualizar_horas', [
				'uses' => 'ParametrosController@edit_horas',
				'as'   => 'parametros.edit.horas'
			]);



		Route::match(['put', 'patch'], 'update_grupo/{id}', [
				'uses' => 'ParametrosController@update_grupo_pauta',
				'as'   => 'parametros.update.grupo_pauta'
			]);
		Route::match(['put', 'patch'], 'update_detalle/{id}', [
				'uses' => 'ParametrosController@update_detalle_pauta',
				'as'   => 'parametros.update.detalle_pauta'
			]);
		Route::match(['put', 'patch'], 'update_conc/{id}', [
				'uses' => 'ParametrosController@update_conceptos',
				'as'   => 'parametros.update.conceptos'
			]);

		Route::match(['put', 'patch'], 'update_horas/{id}', [
				'uses' => 'ParametrosController@update_horas',
				'as'   => 'parametros.update.horas'
			]);



		/*---------------------------------------------------------*/
		/*----------------------- ENSAYOS -------------------------*/
		/*---------------------------------------------------------*/

		Route::get('ensayos', [
				'uses' => 'ParametrosController@adminEnsayos',
				'as'   => 'parametros.admin.ensayo'
			]);

		Route::get('create_materia_ensayo', [
				'uses' => 'ParametrosController@createMateriaEnsayo',
				'as'   => 'parametros.create.materia_ensayo'
			]);
		Route::post('guardar_maeteria_ensayo', ['uses'=>'ParametrosController@storeMateriaEnsayo', 'as'=>'parametros.store.materia_ensayo']);


	});




	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++ USUARIOS ++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

	Route::resource('usuarios','UsuarioController');
	Route::group(['middleware'=>'admin' ,'prefix'=>'usuarios/menu'], function(){
		Route::get('admin', [
				'uses' => 'UsuarioController@admin',
				'as'   => 'usuarios.admin'
			]);
		Route::get('perfil', [
				'uses' => 'UsuarioController@perfil',
				'as'   => 'usuario.perfil'
			]);

		Route::get('cambiar_pass', [
				'uses' => 'UsuarioController@edit_pass',
				'as'   => 'usuario.edit_pass'
			]);
		Route::post('borrar_usuario', [
			'uses' => 'UsuarioController@delete_user',
			'as'   => 'usuario.delete_user'
		]);

		Route::post('modificar_pass', ['uses'=>'UsuarioController@update_pass', 'as'=>'usuario.update_pass']);


		Route::post('modif_user', ['uses'=>'UsuarioController@estadoUser', 'as'=>'usuario.modificar_estado']);
	});


	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++ AJAX ++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

	Route::group(['prefix'=>'ajax'], function(){
		Route::post('buscar_curso', [
				'uses' => 'AjaxController@buscarCurso',
				'as'   => 'ajax.buscar_curso'
			]);
		Route::post('buscar_ensayo_cursos', [
				'uses' => 'AjaxController@searchEnsayoCursos',
				'as'   => 'ajax.search_ensayo_cursos'
			]);
		Route::post('confirm_user', [
				'uses' => 'AjaxController@confirmar_usuario',
				'as'   => 'ajax.confirm_user'
			]);
		Route::post('buscar_semestre', [
				'uses' => 'AjaxController@buscarSemestre',
				'as'   => 'ajax.buscar_semestre'
			]);
		Route::post('search_cursos', [
				'uses' => 'AjaxController@searchCursosGrado',
				'as'   => 'ajax.search_cursos_grado'
			]);
	});
	Route::group(['prefix'=>'autocomplete'], function(){


		/*------------------------ MATRICULA ------------------------*/
		Route::post('search_alumnos', [
				'uses' => 'AjaxController@buscarAlumno',
				'as'   => 'autocomplete.search_students'
			]);
		Route::post('search_padres', [
				'uses' => 'AjaxController@buscarPadres',
				'as'   => 'autocomplete.search_padres'
			]);
		Route::post('search_apoderado', [
				'uses' => 'AjaxController@buscarApoderado',
				'as'   => 'autocomplete.search_apod'
			]);
		Route::post('search_col', [
				'uses' => 'AjaxController@buscarColAnt',
				'as'   => 'autocomplete.search_col_ant'
			]);

		/*------------------------ MATRICULA ------------------------*/





		/*------------------------ USUARIO ------------------------*/

		Route::post('search_persona_usuario', [
				'uses' => 'AjaxController@searchPersonaUser',
				'as'   => 'autocomplete.search_person_user'
			]);

		/*------------------------ USUARIO ------------------------*/




		Route::post('search_matricula', [
				'uses' => 'AjaxController@searchMatricula',
				'as'   => 'autocomplete.search_matricula'
			]);
		Route::post('search_oc', [
				'uses' => 'AjaxController@searchOc',
				'as'   => 'autocomplete.search_oc'
			]);


		Route::post('search_profesor', [
				'uses' => 'AjaxController@searchProfesor',
				'as'   => 'autocomplete.search_profesor'
			]);
		
		Route::post('search_mat_pend', [
				'uses' => 'AjaxController@search_mat_pendientes',
				'as'   => 'autocomplete.search_mat_pendientes'
			]);
		



		/*------------------------ ORDEN COMPRA ------------------------*/

		Route::post('search_articulos', [
				'uses' => 'AjaxController@searchArticulos',
				'as'   => 'autocomplete.search_articles'
			]);
		
		Route::post('search_proveedor', [
				'uses' => 'AjaxController@searchProveedor',
				'as'   => 'autocomplete.search_proveedor'
			]);
		
		Route::post('search_responsable', [
				'uses' => 'AjaxController@searchResponsable',
				'as'   => 'autocomplete.search_responsable'
			]);

		/* -------------------------- PROFESOR -------------------------- */

		Route::post('search_institucion', [
				'uses' => 'AjaxController@buscarInst',
				'as'   => 'autocomplete.search_inst'
			]);

	});

/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*+++++++++++++++++++++++++++++++++++ VALIDACIONES +++++++++++++++++++++++++++++++++++++++*/
/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

	Route::group(['prefix'=>'validate'], function(){
		Route::match(['post', 'put'], 'validar_alumno', [
				'uses' => 'ValidationController@validate_alumno',
				'as'   => 'validate.validate_student'
			]);
		Route::match(['post', 'put'], 'validar_padres', [
				'uses' => 'ValidationController@validate_padres',
				'as'   => 'validate.validate_padres'
			]);
		Route::match(['post', 'put'], 'validar_apoderados', [
				'uses' => 'ValidationController@validate_apoderados',
				'as'   => 'validate.validate_apoderados'
			]);
		Route::match(['post', 'put'], 'validar_matricula', [
				'uses' => 'ValidationController@validate_matricula',
				'as'   => 'validate.validate_matricula'
			]);
		Route::post('validar_usuario', [
				'uses' => 'ValidationController@validate_user',
				'as'   => 'validate.validate_user'
			]);
		Route::post('validar_prov', [
				'uses' => 'ValidationController@validate_proveedor',
				'as'   => 'validate.validate_proveedor'
			]);
		Route::match(['post', 'put'],'validar_asig', [
				'uses' => 'ValidationController@validate_asignatura',
				'as'   => 'validate.validate_asig'
			]);
		Route::match(['post', 'put'],'validar_empl', [
				'uses' => 'ValidationController@validate_empleado',
				'as'   => 'validate.validate_empl'
			]);
	});



});




Auth::routes();

Route::get('/home', 'HomeController@index');
