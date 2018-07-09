<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoEnsayo extends Model
{
    protected $table = "tipo_ensayo";

    protected $primaryKey = 'ten_id';

    protected $fillable = ['ten_id', 'ten_tipo', 'ten_descripcion'];

    public function ensayos()
    {
    	return $this->hasMany('App\Ensayo', 'tipo_id', 'ten_id');
    }

    public function materias()
    {
    	return $this->belongsToMany('App\MateriaEnsayos', 'tipo_ensayos_tienen', 'tipo_ensayo_id', 'materia_id')->withPivot('status');
    }

}
