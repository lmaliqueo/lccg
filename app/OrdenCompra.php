<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdenCompra extends Model
{
    protected $table = "orden_compra";

    protected $primaryKey = 'oc_id';

    protected $fillable = ['oc_id', 'proveedor_id', 'oc_numero', 'oc_fecha', 'oc_costo', 'oc_estado'];

    public function lineasArticulos()
    {
        return $this->hasMany('App\LineaArticulo', 'ordencompra_id', 'oc_id');
    }

    public function proveedor()
    {
    	return $this->belongsTo('App\Proveedor', 'proveedor_id', 'prov_id');
    }

    public function estado()
    {
        return (($this->oc_estado == 1)? 'Finalizado':'Pendiente');
    }

    public function costo_total()
    {
        $costo = 0;
        foreach ($this->lineasArticulos as $linea) {
            $costo += $linea->costo_recibo();
        }
        return $costo;
    }
}
