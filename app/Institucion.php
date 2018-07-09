<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    protected $table = "institucion";

    protected $primaryKey = 'inst_id';

    protected $fillable = ['inst_id', 'inst_nombre'];


    public function profesores()
    {
    	return $this->hasMany('App\Personal');
    }
}
