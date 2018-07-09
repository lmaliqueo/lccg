<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    protected $table = "asignatura";

    protected $primaryKey = 'asig_id';

    protected $fillable = ['asig_id', 'asig_nombre', 'asig_nombre_corto', 'asig_tipo_asignatura', 'asig_tipo'];


public function rules()
{
    return [
        //'persona_rut' => 'required|max:12',
        'asig_nombre' => 'required|alpha_spaces',
        'asig_nombre_corto' => 'required|alpha',
        //'asig_tipo_asignatura' => 'required',
        'asig_tipo_asignatura' => 'required',
    ];
}

public function attr_name()
{
    return [
        //'persona_rut' => 'required|max:12',
        'asig_nombre' => 'Nombre',
        'asig_nombre_corto' => 'Nombre Corto',
        'asig_tipo_asignatura' => 'Tipo de Asignatura',
    ];

}


    public function clases()
    {
    	return $this->hasMany('App\Clases', 'asignatura_id', 'asig_id');
    }

    public function planEstudios()
    {
        return $this->belongsToMany('App\PlanEstudio','plan_organiza', 'asignatura_id', 'plan_id')->withPivot('nivel_id','porg_cant_horas');
    }

    public function nivelCursos()
    {
        return $this->belongsToMany('App\NivelCurso','plan_organiza', 'nivel_id', 'asignatura_id')->withPivot('plan_id','porg_cant_horas');
    }


    public function profesores()
    {
        return $this->belongsToMany('App\Personal', 'profesor_especializa', 'asignatura_id', 'profesor_id');
    }

    public function tipo()
    {
        if ($this->asig_tipo == 1) {
            return 'Asignatura Curso';
        }else{
            return 'Taller';
        }
    }

    public function tipo_asig()
    {
        if ($this->asig_tipo_asignatura == 1) {
            return 'Básico';
        }elseif($this->asig_tipo_asignatura == 2){
            return 'Electivo';
        }
    }
}
