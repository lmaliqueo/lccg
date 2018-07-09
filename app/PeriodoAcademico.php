<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeriodoAcademico extends Model
{
    protected $table = "periodo_academico";

    protected $primaryKey = 'pac_id';

    protected $fillable = ['pac_id', 'liceo_id', 'pac_ano', 'pac_fecha_inicio', 'pac_fecha_termino', 'pac_estado'];


    public function liceo()
    {
    	return $this->belongsTo('App\Liceo', 'liceo_id', 'lic_id');
    }

    public function matriculas()
    {
    	return $this->hasMany('App\Matricula', 'periodo_id', 'pac_id');
    }

    public function cursos()
    {
    	return $this->hasMany('App\Curso', 'periodo_id', 'pac_id');
    }

    public function semestres()
    {
        return $this->hasMany('App\Semestre', 'periodo_id', 'pac_id');
    }

    public function ensayos()
    {
        return $this->hasMany('App\Ensayo', 'periodo_id', 'pac_id');
    }

    public function horas()
    {
        return $this->hasMany('App\Horas', 'periodo_id', 'pac_id');
    }
    
    public function estado()
    {
        return ($this->pac_estado == 1) ? 'Activo':'Finalizado';
    }

}
