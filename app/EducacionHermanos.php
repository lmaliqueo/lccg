<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EducacionHermanos extends Model
{
    protected $table = "educacion_hermanos";

    protected $primaryKey = 'edh_id';

    protected $fillable = ['edh_id', 'edh_descripcion'];

    public function matriculas(){
    	return $this->belongsToMany('App\Matriculas', '');
    }

}
