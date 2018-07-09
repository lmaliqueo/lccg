<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enfermedad extends Model
{
    protected $table = "enfermedades";

    protected $primaryKey = 'enf_id';

    protected $fillable = ['enf_id', 'enf_nombre', 'matricula_id'];

    public function matricula()
    {
    	return $this->belongsTo('App\Matricula', 'matricula_id', 'mat_id');
    }
}
