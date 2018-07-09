<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aulas extends Model
{
    protected $table = "aulas";

    protected $primaryKey = 'aul_id';

    protected $fillable = ['aul_id', 'aul_numero', 'aul_tipo'];

    public function cursos()
    {
    	return $this->hasMany('App\Cursos');
    }

    public function tipo()
    {
    	if ($this->aul_tipo == 1) {
    		return 'Sala de Clases';
    	}
    	if ($this->aul_tipo == 2) {
    		return 'Sala de Estudios';
    	}
    	if ($this->aul_tipo == 3) {
    		return 'Sala de Actividades';
    	}
    }

}
