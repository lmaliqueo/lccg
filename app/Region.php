<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = "region";

    protected $primaryKey = 're_id';

    protected $fillable = ['re_id', 're_nombre'];

    public function ciudades()
    {
    	return $this->hasMany('App\ciudad', 'region_id', 're_id');
    }
}
