<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clases extends Model
{
    protected $table = "clases";

    protected $primaryKey = 'cla_id';

    protected $fillable = ['cla_id', 'curso_id', 'asignatura_id', 'profesor_id'];

    public function curso()
    {
    	return $this->belongsTo('App\Curso', 'curso_id', 'cu_id');
    }

    public function asignatura()
    {
    	return $this->belongsTo('App\Asignatura', 'asignatura_id', 'asig_id');
    }

    public function profesor()
    {
    	return $this->belongsTo('App\Personal', 'profesor_id', 'pers_id');
    }

    public function horarios()
    {
    	return $this->hasMany('App\Horarios', 'clases_id', 'cla_id');
    }

    public function notas()
    {
        return $this->hasMany('App\Notas', 'clase_id', 'cla_id');
    }

    public function clasesRealizadas()
    {
        return $this->hasMany('App\ClasesRealizadas', 'clase_id', 'cla_id');
    }

    public function prom_clases_sem($sem)
    {
        $alu_ret = $this->curso->listaAlumnos->where('mat_estado', 3)->pluck('mat_id');
        $prom = $this->notas->where('semestre_id', $sem)->whereNotIn('matricula_id', $alu_ret)->where('not_promedio', '<>', null)->avg('not_promedio');
        if ($prom != null) {
            return (strlen($prom) == 1) ? $prom.'.0': round($prom, 1) ;
        }else{
            return '-';
        }
    }

    public function prom_clases()
    {
        $semestres_id = $this->curso->periodo->semestres->where('sem_estado', 2)->pluck('sem_id');
        $alu_ret = $this->curso->listaAlumnos->where('mat_estado', 3)->pluck('mat_id');

        $prom = $this->notas->whereIn('semestre_id', $semestres_id)->whereNotIn('matricula_id', $alu_ret)->where('not_promedio', '<>', null)->avg('not_promedio');
        if ($prom != null) {
            return (strlen($prom) == 1) ? $prom.'.0': round($prom, 1) ;
        }else{
            return '-';
        }
    }

}
