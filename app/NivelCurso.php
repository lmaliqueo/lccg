<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NivelCurso extends Model
{
    protected $table = "nivel_cursos";

    protected $primaryKey = 'nic_id';

    protected $fillable = ['nic_id', 'nic_nivel'];

    public function planEstudios()
    {
        return $this->belongsToMany('App\PlanEstudio','plan_organiza', 'nivel_id', 'plan_id')->withPivot('asignatura_id','porg_cant_horas');
    }

    public function asignaturas()
    {
        return $this->belongsToMany('App\Asignatura','plan_organiza', 'nivel_id', 'asignatura_id')->withPivot('plan_id','porg_cant_horas');
    }
}
