<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
    protected $table = "semestre";

    protected $primaryKey = 'sem_id';

    protected $fillable = ['sem_id', 'periodo_id', 'sem_numero', 'sem_estado', 'sem_fecha_inicio', 'sem_fecha_termino'];

    public function periodo()
    {
    	return $this->belongsTo('App\PeriodoAcademico', 'periodo_id', 'pac_id');
    }

    public function diaClase()
    {
    	return $this->hasMany('App\DiaClase', 'semestre_id', 'sem_id');
    }

    public function notas()
    {
    	return $this->hasMany('App\Notas', 'semestre_id', 'sem_id');
    }

    public function sem_palabras()
    {
        if ($this->sem_numero == 1) {
            return "Primer";
        }elseif ($this->sem_numero == 2) {
            return "Segundo";
        }
    }
}
