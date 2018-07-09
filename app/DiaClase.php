<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiaClase extends Model
{
    protected $table = "dia_clase";

    protected $primaryKey = 'dc_id';

    protected $fillable = ['dc_id', 'semestre_id', 'dc_fecha'];

    public function semestre()
    {
    	return $this->belongsTo('App\Semestre', 'semestre_id', 'sem_id');
    }

    public function clasesRealizadas()
    {
    	return $this->hasMany('App\clasesRealizadas', 'dia_clase_id', 'dc_id');
    }

    public function matriculas()
    {
        return $this->belongsToMany('App\Matricula', 'alumno_asiste', 'dia_clase_id', 'matricula_id')->withPivot('ala_estado');
    }

    public function alumnos_asis($status)
    {
        return $this->belongsToMany('App\Matricula', 'alumno_asiste', 'dia_clase_id', 'matricula_id')->wherePivot('ala_estado', $status);
    }
}
