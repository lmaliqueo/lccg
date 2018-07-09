<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dias extends Model
{
    protected $table = "dias";

    protected $primaryKey = 'di_id';

    protected $fillable = ['di_id', 'di_nombre'];

    public function horarios()
    {
        return $this->hasMany('App\Horarios', 'dia_id', 'di_id');
    }

}
