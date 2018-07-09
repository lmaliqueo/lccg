<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apoderado extends Model
{
    protected $table = "apoderado";

    protected $primaryKey = 'ap_id';

    protected $fillable = ['ap_id', 'persona_rut', 'ap_tipo', 'ap_parentesco', 'ap_direccion'];

public function rules($rut_old = null)
{
    if ($this->persona_rut == null) {
        return [
            //'persona_rut' => 'required|max:12',
            'pe_rut' => 'required|max:12|unique:persona',
            'pe_nombres' => 'required|alpha_spaces',
            'pe_apellido_pat' => 'required|alpha',
            'pe_apellido_mat' => 'required|alpha',
            'ap_parentesco' => 'required|alpha',
            'ap_direccion' => 'required',
            'pe_contacto' => 'max:10',
        ];
    }else{
        return [
            //'persona_rut' => 'required|max:12',
            'pe_rut' => 'required|max:12|unique:persona,pe_rut,'.$this->persona_rut.',pe_rut',
            'pe_nombres' => 'required|alpha_spaces',
            'pe_apellido_pat' => 'required|alpha',
            'pe_apellido_mat' => 'required|alpha',
            'ap_parentesco' => 'required|alpha',
            'ap_direccion' => 'required',
            'pe_contacto' => 'max:10',
        ];
    }
}

public function attr_name()
{
    return [
        //'persona_rut' => 'required|max:12',
        'pe_rut' => 'Rut',
        'pe_nombres' => 'Nombres',
        'pe_apellido_pat' => 'Apellido Paterno',
        'pe_apellido_mat' => 'Apellido Materno',
        'ap_parentesco' => 'Parentesco',
        'ap_direccion' => 'Dirección',
    ];

}

    public function persona()
    {
    	return $this->belongsTo('App\Persona', 'persona_rut', 'pe_rut');
    }

    public function matriculas()
    {
        return $this->belongsToMany('App\Matricula', 'apoderado_representa', 'apoderado_id', 'matricula_id');
    }
}
