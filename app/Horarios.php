<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horarios extends Model
{
    protected $table = "horario";

    protected $primaryKey = 'hor_id';

    protected $fillable = ['hor_id', 'hora_id', 'dia_id', 'clases_id', 'hor_dia'];

    public function clases()
    {
    	return $this->belongsTo('App\Clases', 'clases_id', 'cla_id');
    }

    public function horas()
    {
        return $this->belongsToMany('App\Horas', 'horas_horario', 'horario_id', 'horas_id');
    }

    public function dia()
    {
        return $this->belongsTo('App\Dias', 'dia_id', 'di_id');
    }

    public function hora()
    {
        return $this->belongsTo('App\Horas', 'hora_id', 'hors_id');
    }
}
