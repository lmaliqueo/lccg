<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClasesRealizadas extends Model
{
    protected $table = "clases_realizadas";

    protected $primaryKey = 'cr_id';

    protected $fillable = ['cr_id', 'dia_clase_id', 'clase_id', 'cr_estado', 'cr_observacion'];

    public function clases()
    {
    	return $this->belongsTo('App\Clases', 'clase_id', 'cla_id');
    }

    public function asistencias()
    {
    	return $this->hasMany('App\Asistencia', 'cla_realizados_id', 'cr_id');
    }

    public function diaClase()
    {
        return $this->belongsTo('App\DiaClase', 'dia_clase_id', 'dc_id');
    }
}
