<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Concepto extends Model
{
    protected $table = "conceptos";

    protected $primaryKey = 'con_id';

    protected $fillable = ['con_id', 'con_nombre', 'con_descripcion'];

    public function detalles()
    {
        return $this->belongsToMany('App\DetallePauta', 'eva_comportamiento', 'concepto_id', 'detallepauta_id')->withPivot('matricula_id');
    }

    public function matriculas()
    {
        return $this->belongsToMany('App\Matricula', 'eva_comportamiento', 'concepto_id', 'matricula_id')->withPivot('detallepauta_id');
    }
}
