<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Liceo extends Model
{
    protected $table = "liceo";

    protected $primaryKey = 'lic_id';

    protected $fillable = ['lic_id', 'lic_rol_base_datos', 'lic_fecha_resol_rec_ofic', 'lic_numero_resol_rec_ofic', 'lic_numero', 'lic_letra', 'lic_nombre', 'lic_direccion', 'lic_jornada', 'lic_semestres'];


    public function periodos()
    {
    	return $this->hasMany('App\PeriodoAcademico', 'liceo_id', 'lic_id');
    }

    public function num_lic()
    {
    	return $this->lic_letra.'-'.$this->lic_numero;
    }

    public function decreto_coop()
    {
        return $this->lic_numero_resol_rec_ofic.'/'.$this->lic_fecha_resol_rec_ofic;
    }
}
