<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanEstudio extends Model
{
    protected $table = "plan_estudio";

    protected $primaryKey = 'pest_id';

    protected $fillable = ['pest_id', 'pest_ano_inicio', 'pest_numero', 'pest_ano', 'pest_eval_num', 'pest_eval_ano', 'pest_ano_termino', 'pest_estado'];


    public function asignaturas()
    {
        return $this->belongsToMany('App\Asignatura','plan_organiza', 'plan_id', 'asignatura_id')->withPivot('nivel_id','porg_cant_horas');
    }

    public function nivelCursos()
    {
        return $this->belongsToMany('App\NivelCurso','plan_organiza', 'plan_id', 'nivel_id')->withPivot('asignatura_id','porg_cant_horas');
    }


    public function asignaturasGrado($grado)
    {
        return $this->belongsToMany('App\Asignatura','plan_organiza', 'plan_id', 'asignatura_id')->wherePivot('nivel_id', $grado)->withPivot('nivel_id','porg_cant_horas');
    }

    public function niveles_plan()
    {
        $niveles_plan = $this->nivelCursos->pluck('nic_id');
        $niveles = NivelCurso::whereIn('nic_id', $niveles_plan)->get();
        return $niveles;
    }

    public function estado()
    {
        if ($this->pest_estado == 1) {
            return 'Activo';
        }else{
            return 'Inactivo';
        }
    }

    public function decreto_plan()
    {
        return $this->pest_numero.'/'.$this->pest_ano;
    }
    public function decreto_eval()
    {
        return $this->pest_eval_num.'/'.$this->pest_eval_ano;
    }
}
