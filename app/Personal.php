<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    protected $table = "personal";

    protected $primaryKey = 'pers_id';

    protected $fillable = ['pers_id', 'persona_rut', 'institucion_id', 'cargo_id', 'pers_estado'];


public function rules_prof($id = null)
{
    if (!isset($this->pers_id)) {
        return [
            'pe_rut'=>'unique:personal|min:11',
            'especialidad'=>'required',
            'nombre_inst'=>'required|max:100|alpha_spaces'
        ];
    }else{
        return [
            'pe_rut'=>'unique:personal,persona_rut,'.$this->pers_id.',pers_id|min:11',
            'especialidad'=>'required',
            'nombre_inst'=>'required|max:100|alpha_spaces'
        ];
    }
}

public function rules()
{
    if (!isset($this->pers_id)) {
        return [
            //'pe_rut'=>'unique:personal|min:11',
            'cargo_id'=>'required'
        ];
    }else{
        return [
            //'pe_rut'=>'unique:personal,persona_rut,'.$this->pers_id.',pers_id',
            'cargo_id'=>'required'
        ];
    }
}

public function attr_name()
{
    return [
        'nombre_inst'=>'Institución',
        'cargo_id'=>'Cargo',
    ];

}


    public function persona()
    {
    	return $this->belongsTo('App\Persona', 'persona_rut', 'pe_rut');
    }

    public function cargo()
    {
    	return $this->belongsTo('App\Cargo', 'cargo_id', 'ca_id');
    }

    public function especialidad()
    {
    	return $this->belongsToMany('App\Asignatura', 'profesor_especializa', 'profesor_id', 'asignatura_id');
    }

    public function institucion()
    {
    	return $this->belongsTo('App\Institucion', 'institucion_id', 'inst_id');
    }

    public function clases()
    {
        return $this->hasMany('App\Clases', 'profesor_id', 'pers_id');
    }

    public function cursos()
    {
        return $this->hasMany('App\Curso', 'profesor_id', 'pers_id');
    }

    public function estado()
    {
        if ($this->pers_estado) {
            return 'Habilitado';
        }else{
            return 'Inhabilidato';
        }
    }
}
