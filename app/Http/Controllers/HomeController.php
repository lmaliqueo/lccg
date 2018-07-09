<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alumno;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function probandowas()
    {
        $alumno = new Alumno();
        $tabla = [];
        $fila = null;
        for ($i = 0; $i < 10; $i++) {
            $fila = new Alumno();
            $fila->al_nombres = 'asdasdasd';
            $fila->al_fecha_nacimiento = date('Y-m-d');
            $tabla[] = $fila;
            $tabla = [];
        }
        if (!empty($tabla) || !empty($fila)) {
            if (empty($fila)) {
                echo $tabla;
            }else{
                echo $tabla;
            }
        }else{
            echo $alumno;
        }
    }
}
