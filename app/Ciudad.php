<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    protected $table = "ciudad";

    protected $primaryKey = 'ciu_id';

    protected $fillable = ['ciu_id', 'region_id','ciu_nombre'];


    public function region()
    {
    	return $this->belongsTo('App\Region', 'region_id', 're_id');
    }

    public function comuna()
    {
    	return $this->hasMany('App\comuna', 'ciudad_id', 'ciu_id');
    }
}
