<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = "roles";

    protected $primaryKey = 'id';

    protected $fillable = ['id', 'name'];
    
    public function usuarios()
    {
    	return $this->hasMany('App\Usuarios', 'rol_id', 'id');
    }

}
