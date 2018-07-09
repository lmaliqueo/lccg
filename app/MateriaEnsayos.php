<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MateriaEnsayos extends Model
{
    protected $table = "materia_ensayos";

    protected $primaryKey = 'mens_id';

    protected $fillable = ['mens_id', 'mens_nombre'];

    public function ensayos()
    {
    	return $this->hasMany('App\Ensayo', 'alumno_realiza', 'ensayo_id', 'mens_id');
    }

    public function matriculas()
    {
    	return $this->belongsToMany('App\Matricula', 'alumno_realiza', 'materia_id', 'matricula_id')->withPivot('alr_resultado');
    }

    public function tipoEnsayos()
    {
        return $this->belongsToMany('App\TipoEnsayo', 'tipo_ensayos_tienen', 'materia_id', 'tipo_ensayo_id')->withPivot('status');
    }

}
