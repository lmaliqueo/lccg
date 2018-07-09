<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $table = "cargo";

    protected $primaryKey = 'ca_id';

    protected $fillable = ['ca_id', 'ca_nombre'];


    public function personal()
    {
    	return $this->hasMany('App\Personal', 'cargo_id', 'ca_id');
    }

}
