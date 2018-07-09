<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallePauta extends Model
{
    protected $table = "detalle_pauta";

    protected $primaryKey = 'dp_id';

    protected $fillable = ['dp_id', 'grupopauta_id', 'dp_descripcion'];

    public function pauta()
    {
    	return $this->belongsTo('App\GrupoPauta', 'grupopauta_id', 'gp_id');
    }

    public function conceptos()
    {
        return $this->belongsToMany('App\Concepto', 'eva_comportamiento', 'detallepauta_id', 'concepto_id')->withPivot('matricula_id');
    }

    public function matriculas()
    {
        return $this->belongsToMany('App\Matricula', 'eva_comportamiento', 'detallepauta_id', 'matricula_id')->withPivot('concepto_id');
    }
}
