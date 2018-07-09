<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ensayo extends Model
{
    protected $table = "ensayo";

    protected $primaryKey = 'ens_id';

    protected $fillable = ['ens_id', 'periodo_id', 'tipo_id', 'materia_id', 'ens_grado_curso', 'ens_fecha'];

    public function periodo()
    {
    	return $this->belongsTo('App\PeriodoAcademico', 'periodo_id', 'pac_id');
    }

    public function tipo(){
    	return $this->belongsTo('App\TipoEnsayo', 'tipo_id', 'ten_id');
    }

    public function materia()
    {
    	return $this->belongsTo('App\MateriaEnsayos', 'materia_id', 'mens_id');
    }

    public function matriculas()
    {
    	return $this->belongsToMany('App\Matricula', 'alumno_realiza', 'ensayo_id', 'matricula_id')->withPivot('alr_resultado');
    }

}
