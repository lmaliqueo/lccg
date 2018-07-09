<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clases;

class ClasesController extends Controller
{
    public function index()
    {
    	$clases = Clases::orderBy('asignatura_id', 'ASC')->paginate(10);
        return view('clases.index', ['clases'=>$clases]);
    }

    public function create(Request $request)
    {
        $curso = Curso::find($request->id);
        return view('clases.create', ['curso' = $curso]);
    }

    public function store(Request $request)
    {
        foreach ($request->clases as $clase) {
            $nueva_clase = new Clases();
            $nueva_clase->profesor()->associate($clase['profesor']);
            $nueva_clase->curso()->associate($request->curso);
            $nueva_clase->asignatura()->associate($clase['asignatura']);
            $nueva_clase->save();
        }
        return redirect()->route('cursos.profile', $request->curso);
    }

    public function edit($id)
    {
    	$clases = Clases::find($id);
    }

    public function update()
    {

    }

    public function destroy($id)
    {

    }
}
