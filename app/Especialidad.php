<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    protected $table = "especialidad";

    protected $primaryKey = 'esp_id';

    protected $fillable = ['esp_id', 'esp_nombre'];


    public function personal()
    {
    	return $this->hasMany('App\Personal');
    }
}
