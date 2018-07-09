<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrupoPauta extends Model
{
    protected $table = "grupo_pauta";

    protected $primaryKey = 'gp_id';

    protected $fillable = ['gp_id', 'gp_descripcion'];

    public function detalles()
    {
    	return $this->hasMany('App\DetallePauta', 'grupopauta_id', 'gp_id');
    }
}
