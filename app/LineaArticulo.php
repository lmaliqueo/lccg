<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class LineaArticulo extends Model
{
    protected $table = "linea_articulo";
    protected $primaryKey = 'lart_id';

    protected $fillable = ['lart_id', 'ordencompra_id', 'articulo_item', 'lart_cantidad', 'lart_costo'];

    public function rules()
    {
        return [
            'articulo_item' => 'required',
            'lart_cantidad' => 'required',
            'lart_costo' => 'required',
        ];

    }
    
    public function scopeSearch($query, Request $request)
    {
        if ($request->has('fecha_ini') && $request->has('fecha_fin')) {
            $ordenes = OrdenCompra::where('oc_fecha', '>=', $request->fecha_ini)->where('oc_fecha', '<=', $request->fecha_fin)->pluck('oc_id');
            $query->orWhereIn('ordencompra_id', $ordenes);
        }
        if ($request->items != '[]') {
            if ($request->items[0] != null) {
                $query->whereIn('articulo_item', $request->items);
            }
        }
        return $query;
        /*
        $orden = OrdenCompra::where('oc_numero', 'like', '%'.$s.'%')->pluck('oc_id');
        return $query->where('articulo_item', $s)
                    ->orWhereIn('ordencompra_id', $orden);*/
    }

    public function ordenCompra()
    {
    	return $this->belongsTo('App\OrdenCompra', 'ordencompra_id', 'oc_id');
    }

    public function articulo()
    {
    	return $this->belongsTo('App\Articulo', 'articulo_item', 'art_item');
    }

    public function recibos()
    {
        return $this->hasMany('App\Recibo', 'linea_id', 'lart_id');
    }

    public function cant_recibida()
    {
        $cant = 0;
        foreach ($this->recibos as $recibo) {
            if ($recibo->linea_id == $this->lart_id) {
                $cant += $recibo->rec_cantidad;
            }
        }
        return $cant;
    }
    public function costo_recibo()
    {
        $costo = 0;
        foreach ($this->recibos as $recibo) {
            if ($recibo->linea_id == $this->lart_id) {
                $costo += $recibo->rec_costo;
            }
        }
        return $costo;
    }
}
