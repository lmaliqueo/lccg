<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = "proveedor";

    protected $primaryKey = 'prov_id';

    protected $fillable = ['prov_id', 'comuna_id', 'prov_razon_social', 'prov_direccion', 'prov_contacto'];


public function rules()
{
    return [
        'prov_razon_social' => 'required',
        'comuna_id' => 'required',
        'prov_direccion' => 'required',
        'prov_contacto' => 'required',
    ];
}
public function attr_name()
{
    return [
        'prov_razon_social' => 'Razón Social',
        'comuna_id' => 'Comuna',
        'prov_direccion' => 'Dirección',
        'prov_contacto' => 'Contacto',
    ];

}


    public function comuna()
    {
    	return $this->belongsTo('App\Comuna', 'comuna_id', 'com_id');
    }

    public function ordenCompras()
    {
    	return $this->hasMany('App\OrdenCompra', 'proveedor_id', 'prov_id');
    }
}
