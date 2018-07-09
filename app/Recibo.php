<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Recibo extends Model
{
    protected $table = "recibo";

    protected $primaryKey = 'rec_id';

    protected $fillable = ['rec_id', 'linea_id', 'factura_id', 'rec_cantidad', 'rec_costo'];


    public function scopeSearch($query, Request $request)
    {
        if ($request->has('fecha_ini') && $request->has('fecha_fin')) {
            $facturas = Factura::where('fac_fecha', '>=', $request->fecha_ini)->where('fac_fecha', '<=', $request->fecha_fin)->pluck('fac_id');
            $query->whereIn('factura_id', $facturas);
        }
        if ($request->has('items')) {
            //dd($request->items);
            if ($request->items[0] != null) {
                $lineas = LineaArticulo::whereIn('articulo_item', $request->items)->pluck('lart_id');
                $query->whereIn('linea_id', $lineas);
            }
        }
        return $query;

/*
        $linea = LineaArticulo::where('articulo_item', 'like', '%'.$s.'%')->pluck('lart_id');
        $orden = OrdenCompra::where('oc_numero', 'like', '%'.$s.'%')->pluck('oc_id');
        $factura = Factura::where('fac_numero', 'like', '%'.$s.'%')->orWhereIn('orden_id', $orden)->pluck('fac_id');
        return $query->whereIn('linea_id', $linea)
                    ->orWhereIn('factura_id', $factura);*/
    }



    public function factura()
    {
    	return $this->belongsTo('App\Factura', 'factura_id', 'fac_id');
    }

    public function linea()
    {
    	return $this->belongsTo('App\LineaArticulo', 'linea_id', 'lart_id');
    }
}
