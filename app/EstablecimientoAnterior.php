<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstablecimientoAnterior extends Model
{
    protected $table = "establecimiento_anterior";

    protected $primaryKey = 'eant_id';

    protected $fillable = ['eant_id', 'eant_nombre'];


    public function matriculas()
    {
    	return $this->belongsTo('App\Matricula', 'est_anterior_id', 'eant_id');
    }
}
