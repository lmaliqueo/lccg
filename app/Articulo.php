<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table = "articulo";

    protected $primaryKey = 'art_item';

    protected $fillable = ['art_item', 'tipo_id', 'bodega_id', 'art_nombre', 'art_descripcion', 'art_cantidad_alta', 'art_cantidad_baja', 'art_cantidad_total'];

public function rules()
{
    return [
        //'persona_rut' => 'required|max:12',
        'art_item' => 'required|unique:articulo',
        'tipo_id' => 'required',
        'art_nombre' => 'required|max:50',
        'art_descripcion' => 'required',
    ];
}

public function rules_update()
{
    return [
        //'persona_rut' => 'required|max:12',
        'tipo_id' => 'required',
        'art_nombre' => 'required|max:50',
        'art_descripcion' => 'required',
    ];
}

public function attr_name()
{
    return [
        //'persona_rut' => 'required|max:12',
        'art_item' => 'Item',
        'tipo_id' => 'Tipo de Artículo',
        'art_nombre' => 'Nombre',
        'art_descripcion' => 'Descripción',
    ];

}

    public function scopeSearch($query, $s)
    {
        $tipos = TipoArticulo::where('tart_nombre', 'like', '%'.$s.'%')->pluck('tart_id');
        return $query->where('art_item', 'like', '%'.$s.'%')
                    ->orWhere('art_nombre', 'like', '%'.$s.'%')
                    ->orWhere('art_descripcion', 'like', '%'.$s.'%')
                    ->orWhereIn('tipo_id', $tipos);
    }


    public function tipo()
    {
    	return $this->belongsTo('App\TipoArticulo', 'tipo_id', 'tart_id');
    }

    public function bodega()
    {
    	return $this->belongsTo('App\Bodega', 'bodega_id', 'bo_id');
    }

    public function lineasArticulos()
    {
        return $this->hasMany('App\LineaArticulo', 'articulo_item', 'art_item');
    }
}
