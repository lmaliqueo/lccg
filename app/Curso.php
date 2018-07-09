<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table = "curso";

    protected $primaryKey = 'cu_id';

    protected $fillable = ['cu_id', 'periodo_id', 'plan_estudio_id', 'aula_id', 'profesor_id', 'parametro_id', 'cu_tipo'];

public function rules()
{
    return [
        //'al_rut' => 'required|max:12',
        'periodo_id' => 'required',
        //'aula_id' => 'required',
        'profesor_id' => 'required',
        'parametro_id' => 'required',
        'plan_estudio_id' => 'required',
    ];
}

public function attr_name()
{
    return [
        'parametro_id' => 'Grado y Letra',
        'profesor_id' => 'Profesor',
        'plan_estudio_id' => 'Plan de Estudio',
    ];

}

    public function listaAlumnos()
    {
    	return $this->belongsToMany('App\Matricula', 'alumno_esta', 'curso_id', 'matricula_id');
    }

    public function periodo()
    {
    	return $this->belongsTo('App\PeriodoAcademico', 'periodo_id', 'pac_id');
    }

    public function aula()
    {
        return $this->belongsTo('App\Aulas', 'aula_id', 'aul_id');
    }

    public function parametros()
    {
        return $this->belongsTo('App\ParametrosCursos', 'parametro_id', 'pcur_id');
    }

    public function profesorJefe()
    {
        return $this->belongsTo('App\Personal', 'profesor_id', 'pers_id');
    }

    public function nombreCurso()
    {
        return $this->parametros->pcur_grado.'°'.$this->parametros->pcur_letra;
    }

    public function nombreTaller()
    {
        return $this->clases->first()->asignatura->asig_nombre;
    }

    public function clases()
    {
        return $this->hasMany('App\Clases', 'curso_id', 'cu_id');
    }

    public function prom_curso()
    {
        return round($this->listaAlumnos->where('mat_prom_general', '>', 0)->avg('mat_prom_general'), 1);
    }

    public function planEstudio()
    {
        return $this->belongsTo('App\PlanEstudio', 'plan_estudio_id', 'pest_id');
    }
}
