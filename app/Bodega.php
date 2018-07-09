<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bodega extends Model
{
    protected $table = "bodega";

    protected $primaryKey = 'bo_id';

    protected $fillable = ['bo_id', 'bo_costo'];


    public function articulos()
    {
    	return $this->hasMany('App\Articulos', 'bodega_id', 'bo_id');
    }
}
