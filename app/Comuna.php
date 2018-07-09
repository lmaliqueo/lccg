<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comuna extends Model
{
    protected $table = "comuna";

    protected $primaryKey = 'com_id';

    protected $fillable = ['com_id', 'ciudad_id','com_nombre'];


    public function ciudad()
    {
    	return $this->belongsTo('App\Ciudad', 'ciudad_id', 'ciu_id');
    }

    public function alumnos()
    {
    	return $this->hasMany('App\Alumno', 'comuna_id', 'com_id');
    }
}
