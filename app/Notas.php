<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notas extends Model
{
    protected $table = "notas";

    protected $primaryKey = 'not_id';

    protected $fillable = ['not_id', 'semestre_id','matricula_id', 'clase_id', 'not_nota1', 'not_nota2', 'not_nota3', 'not_nota4', 'not_nota5', 'not_nota6', 'not_nota7', 'not_nota8', 'not_nota9', 'not_nota10', 'not_nota11', 'not_nota12', 'not_promedio'];

    public function matricula()
    {
    	return $this->belongsTo('App\Matricula', 'matricula_id', 'mat_id');
    }

    public function clase()
    {
    	return $this->belongsTo('App\Clases', 'clase_id', 'cla_id');
    }

    public function semestre()
    {
        return $this->belongsTo('App\Semestre', 'semestre_id', 'sem_id');
    }

    public function tdColorNota($attr)
    {
        if ($attr != null) {
            if ($attr < 4) {
                return "negative";
            }
            return "positive";
        }
        return;
    }
}
