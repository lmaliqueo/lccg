<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Articulo;
use App\TipoArticulo;
use App\Bodega;
use App\OrdenCompra;
use App\LineaArticulo;
use App\Proveedor;
use App\Comuna;
use App\Factura;
use App\Personal;
use App\Recibo;
use Illuminate\Support\Facades\DB;
use Validator;
use Laracasts\Flash\Flash;

class ArticulosController extends Controller
{
    public function index()
    {
    	return view('articulos.index');
    }

    public function create()
    {
        $tipos = TipoArticulo::orderBy('tart_nombre', 'ASC')->pluck('tart_nombre', 'tart_id');
        return view('articulos.create', ['tipos'=>$tipos]);
    }

    public function store(Request $request)
    {
        $articulo = new Articulo($request->all());
        $bodega = Bodega::find(1);
        $validator = Validator::make($request->all(), $articulo->rules())->setAttributeNames($articulo->attr_name())->validate();

        $articulo->bodega()->associate($bodega);
        $articulo->art_cantidad_alta=0;
        $articulo->art_cantidad_baja=0;
        $articulo->art_cantidad_total=0;
        //dd($articulo);
        $articulo->save();
        Flash::success('Se a creado el artículo '.$articulo->art_nombre.' exitosamente');
        return redirect()->route('articulos.index');
    }

    public function edit($id)
    {
        $tipos = TipoArticulo::orderBy('tart_nombre', 'ASC')->pluck('tart_nombre', 'tart_id');
        $articulo = Articulo::find($id);
        return view('articulos.edit', ['articulo'=>$articulo, 'tipos'=>$tipos]);
    }

    public function update(Request $request, $id)
    {
        $articulo = Articulo::find($id);
        $validator = Validator::make($request->all(), $articulo->rules_update())->setAttributeNames($articulo->attr_name())->validate();
        if ($validator->fails()) {
            return redirect()->route('articulos.edit', $id)
                        ->withErrors($validator)
                        ->withInput();          
            //return response()->json(['success'=>0, 'errors'=>$validator->errors()]);
        }
        $articulo->update($request->all());
        Flash::info('Se a modificado el artículo '.$articulo->art_nombre.' de forma exitosa');
        return redirect()->route('articulos.admin');
    }

    public function destroy($id)
    {

    }

    public function show($id)
    {
        $articulos = Articulo::orderBy('art_item', 'ASC')->paginate(10);
        return view('articulos.index', ['articulos'=>$articulos]);
    }

    public function admin(Request $request)
    {
        $s = $request->input('s');
        $articulos = Articulo::orderBy('art_item', 'ASC')
                                ->search($s)
                                ->paginate(10);
        return view('articulos.admin', compact('articulos', 's'));
    }

/*------------------------------------------------------*/
/*-------------------- ORDEN COMPRA --------------------*/
/*------------------------------------------------------*/

    public function indexOC(Request $request)
    {
        $request = $request;
        $articulos = Articulo::pluck('art_item','art_item');
        //dd($articulos);
        $linea_articulos = LineaArticulo::search($request)->orderBy('articulo_item', 'ASC')->paginate(10);
        return view('articulos.index_oc', compact('linea_articulos', 'request', 'articulos'));
    }

    public function createOC()
    {
        $articulos = Articulo::orderBy('art_nombre', 'ASC')->pluck('art_nombre', 'art_item');
        $comunas = Comuna::orderBy('com_nombre', 'ASC')->pluck('com_nombre', 'com_id');
        $num_oc = OrdenCompra::get()->count() + 1;


        return view('articulos.orden_compra', ['articulos'=>$articulos, 'comunas'=>$comunas, 'num_oc'=>$num_oc]);
    }

    public function storeOC(Request $request)
    {
        //dd($request->all());
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




        return redirect()->route('articulos.index');
    }


/*------------------------------------------------------*/
/*----------------------- RECIBO -----------------------*/
/*------------------------------------------------------*/

     public function listRecibo(Request $request)
     {
        $request = $request;
        $articulos = Articulo::pluck('art_item', 'art_item');
        $recibos = Recibo::search($request)->join('linea_articulo as reb', 'recibo.linea_id', '=', 'reb.lart_id')->orderBy('reb.articulo_item', 'ASC')->paginate(10);
        return view('articulos.recibos.list', compact('recibos', 'request', 'articulos'));
     }

    public function reciboArticulos()
    {
        $ordenes_compra = OrdenCompra::where('oc_estado', 0)->pluck('oc_numero', 'oc_id');
        return view('articulos.recibo', ['ordenes_compra'=>$ordenes_compra]);
    }

    public function formRecibo(Request $request)
    {
        $ordencompra = OrdenCompra::find($request->id);
        $num_facturas = Factura::count();
        //dd($ordencompra->lineasArticulos);
        return view('articulos.form_recibo', ['ordencompra'=>$ordencompra, 'num_facturas'=>$num_facturas]);
    }

    public function storeRecibo(Request $request)
    {
        //dd($request->factura);
        $factura = new Factura($request->factura);
        //$factura->fac_numero = 1;
        //$factura->fac_costo_total = 0;
        DB::beginTransaction();
        try {
            $factura->save();
            $complete = 1;
            foreach ($request->recibo as $recibo) {
                if ($recibo['cantidad'] != null) {
                    $new_recibo = new Recibo();
                    $new_recibo->rec_cantidad = $recibo['cantidad'];
                    $new_recibo->rec_costo = $recibo['costo'];
                    $new_recibo->factura()->associate($factura->fac_id);
                    $new_recibo->linea()->associate($recibo['linea_id']);
                    $new_recibo->save();

                    $articulo = Articulo::find($new_recibo->linea->articulo_item);
                    $articulo->art_cantidad_total += $new_recibo->rec_cantidad;
                    $articulo->art_cantidad_alta += $new_recibo->rec_cantidad;
                    $articulo->update();

                    if ($new_recibo->linea->cant_recibida() != $new_recibo->linea->lart_cantidad) {
                        $complete = 0;
                    }
                }
            }
            if ($complete == 1) {
                $orden = OrdenCompra::find($factura->orden_id);
                $orden->oc_estado = 1;
                $orden->save();
            }
            
            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
            
        }
        Flash::success('Se a creado la factura N° '.$factura->fac_numero.' exitosamente');
        return redirect()->route('articulos.index');
    }

    public function index_factura(Request $request)
    {
        $s = $request->input('s');
        $facturas = Factura::orderBy('fac_fecha', 'DESC')
                            ->search($s)
                            ->paginate(10);
        return view('articulos.index_facturas', compact('facturas', 's'));
    }

    public function view_factura($id)
    {
        $factura = Factura::find($id);
        return view();
    }
}
