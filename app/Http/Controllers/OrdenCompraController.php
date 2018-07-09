<?php

namespace App\Http\Controllers;

use App\OrdenCompra;
use App\Articulo;
use App\Comuna;
use App\LineaArticulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use Laracasts\Flash\Flash;
use App\Proveedor;

class OrdenCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ordenes_compra = OrdenCompra::get();
        return view('orden_compra.admin', compact('ordenes_compra'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articulos = Articulo::orderBy('art_nombre', 'ASC')->pluck('art_nombre', 'art_item');
        $comunas = Comuna::orderBy('com_nombre', 'ASC')->pluck('com_nombre', 'com_id');
        $num_oc = OrdenCompra::get()->count() + 1;


        return view('orden_compra.create', ['articulos'=>$articulos, 'comunas'=>$comunas, 'num_oc'=>$num_oc]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ordencompra = new OrdenCompra($request->orden_compra);
        $ordencompra->oc_estado = 0;

        DB::beginTransaction();
        try {


            if ($request->proveedor['old_proveedor'] != null) {
                $proveedor = Proveedor::find($request->proveedor['old_proveedor']);
                $proveedor->update($request->proveedor);
            }else{
                $proveedor = new Proveedor($request->proveedor);
                $proveedor->save();
            }

            $ordencompra->proveedor()->associate($proveedor);
            $ordencompra->save();

            foreach ($request->item as $item) {
                $linea_art = new LineaArticulo();
                $linea_art->lart_cantidad = $item['cantidad'];
                $linea_art->lart_costo = $item['costo'];
                $articulo = Articulo::find($item['item']);
                $linea_art->articulo()->associate($articulo);
                $linea_art->ordenCompra()->associate($ordencompra);
                //dd($linea_art);
                $linea_art->save();
            }


            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
        }
        Flash::success('Se a creado la orden de compra N° '.$ordencompra->oc_numero.' exitosamente');

        return redirect()->route('orden_compra.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrdenCompra  $ordenCompra
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orden = OrdenCompra::find($id);
        return view('orden_compra.view', compact('orden'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrdenCompra  $ordenCompra
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $orden = OrdenCompra::find($id);
        $comunas = Comuna::orderBy('com_nombre', 'ASC')->pluck('com_nombre', 'com_id');
        return view('orden_compra.edit', compact('orden', 'comunas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrdenCompra  $ordenCompra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $orden = OrdenCompra::find($id);
        //$array_lineas = [];
        //dd($request->all());

        DB::beginTransaction();
        try {
            foreach ($request->linea as $linea) {
                if (isset($linea['lart_id'])) {
                    $linea_exist = LineaArticulo::find($linea['lart_id']);
                    if ($linea['state'] == 1) {
                        $linea_exist->update($linea);
                        //$array_lineas[] = $linea_exist->lart_id;
                    }else{
                        $linea_exist->delete();
                    }
                }else{
                    $new_linea = new LineaArticulo($linea);
                    $new_linea->ordenCompra()->associate($orden);
                    //dd($new_linea);
                    $new_linea->save();
                    //$array_lineas[] = $new_linea->lart_id;
                }
            }
            if ($request->proveedor['prov_id'] == null) {
                $proveedor = new Proveedor($request->proveedor);
                $proveedor->save();
                //$request->orden['proveedor_id'] = $proveedor->prov_id;
            }else{
                $proveedor = Proveedor::find($request->proveedor['prov_id']);
                $proveedor->update($request->proveedor);
            }
            $orden->proveedor()->associate($proveedor);
            $orden->update($request->orden);
                //dd($orden);
            //$orden->lineasArticulos()->sync($array_lineas);

            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
        }
        Flash::info('Se a modificado la ordem de compra N° '.$orden->oc_numero.' exitosamente');

        return redirect()->route('orden_compra.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrdenCompra  $ordenCompra
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrdenCompra $ordenCompra)
    {
        //
    }

    public function delete_orden(Request $request)
    {
        $orden = OrdenCompra::find($request->id);
        $orden->delete();
        return 1;
    }
}
