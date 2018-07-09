<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horas extends Model
{
    protected $table = "horas";

    protected $primaryKey = 'hors_id';

    protected $fillable = ['hors_id', 'periodo_id', 'hors_numero','hors_hora_inicio', 'hors_hora_termino'];

    public function periodo()
    {
    	return $this->belongsTo('App\PeriodoAcademico', 'periodo_id', 'pac_id');
    }
/*
    public function horarios()
    {
        return $this->belongsToMany('App\Horarios', 'horas_horario', 'horas_id', 'horario_id');
    }*/

    public function horarios()
    {
        return $this->hasMany('App\Horarios', 'hora_id', 'hors_id');
    }
}
