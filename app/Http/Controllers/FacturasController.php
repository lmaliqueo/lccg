<?php

namespace App\Http\Controllers;

use App\Factura;
use App\Recibo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;

class FacturasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $s = $request->input('s');
        $facturas = Factura::orderBy('fac_fecha', 'DESC')
                            ->search($s)
                            ->paginate(10);
        return view('facturas.admin', compact('facturas', 's'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $factura = Factura::find($id);
        return view('facturas.view', compact('factura'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $factura = Factura::find($id);
        return view('facturas.edit', compact('factura'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $factura = Factura::find($id);
        DB::beginTransaction();
        try {
            foreach ($request->linea_rec as $recibo) {
                if (isset($recibo['rec_cantidad'])) {
                    if (isset($recibo['rec_id'])) {
                        $recibo_old = Recibo::find($recibo['rec_id']);
                        $recibo_old->update($recibo);
                    }else{
                        $recibo_new = new Recibo($recibo);
                        $recibo_new->factura()->associate($factura);
                        $recibo_new->save();
                        //dd($recibo_new);
                    }
                }elseif($recibo['rec_id'] != null){
                    $recibo_old = Recibo::find($recibo['rec_id']);
                    $recibo_old->delete();
                }
            }
            $factura->update($request->factura);
            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
        }
        Flash::info('Se a modificado la factura N° '.$factura->fac_numero.' de forma correcta');
        return redirect()->route('facturas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function destroy(Factura $factura)
    {
        //
    }

    public function delete_factura(Request $request)
    {
        $factura = Factura::find($request->id);
        $orden = $factura->orden;
        $orden->oc_estado = 0;
        $orden->update();
        $factura->delete();
        return 1;
    }
}
