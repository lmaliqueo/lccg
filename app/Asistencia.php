<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $table = "asistencia";

    protected $primaryKey = 'asis_id';

    protected $fillable = ['asis_id', 'cla_realizados_id', 'matricula_id', 'asis_estado'];

    public function matricula()
    {
    	return $this->belongsTo('App\Matricula', 'matricula_id', 'mat_id');
    }

    public function clasesRealizadas()
    {
    	return $this->belongsTo('App\ClasesRealizadas', 'cla_realizados_id', 'cr_id');
    }
}
