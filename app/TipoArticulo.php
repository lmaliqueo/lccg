<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoArticulo extends Model
{
    protected $table = "tipo_articulo";

    protected $primaryKey = 'tart_id';

    protected $fillable = ['tart_id', 'tart_nombre'];


    public function articulos()
    {
    	return $this->hasMany('App\Articulos', 'tipo_id', 'tart_id');
    }
}
