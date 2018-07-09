<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParametrosCursos extends Model
{
    protected $table = "parametro_cursos";

    protected $primaryKey = 'pcur_id';

    protected $fillable = ['pcur_id', 'pcur_grado', 'pcur_letra'];

    public function cursos()
    {
    	return $this->hasMany('App\Curso', 'parametro_id', 'pcur_id');
    }

    public function curso_palabras()
    {
    	if ($this->pcur_grado == 1) {
    		return 'PRIMER';
    	}elseif($this->pcur_grado == 2){
    		return 'SEGUNDO';
    	}elseif($this->pcur_grado == 3){
    		return 'TERCERO';
    	}else{
    		return 'CUARTO';
    	}
    }

    public function nombre_palabras()
    {
        return $this->curso_palabras().' AÑO "'.$this->pcur_letra.'"';
    }
}
