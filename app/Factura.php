<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $table = "factura";

    protected $primaryKey = 'fac_id';

    protected $fillable = ['fac_id', 'orden_id', 'responsable_id', 'fac_numero', 'fac_fecha', 'fac_costo_total'];


    public function scopeSearch($query, $s)
    {
        $resp = Personal::where('persona_rut', 'like', '%'.$s.'%')->pluck('pers_id');
        $orden = OrdenCompra::where('oc_numero', 'like', '%'.$s.'%')->pluck('oc_id');
        return $query->where('fac_numero', $s)
                    ->orWhereIn('orden_id', $orden)
                    ->orWhereIn('responsable_id', $resp);
    }

    public function orden()
    {
    	return $this->belongsTo('App\OrdenCompra', 'orden_id', 'oc_id');
    }

    public function responsable()
    {
    	return $this->belongsTo('App\Personal', 'responsable_id', 'pers_id');
    }

    public function recibos()
    {
    	return $this->hasMany('App\Recibo', 'factura_id', 'fac_id');
    }
}
