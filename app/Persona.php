<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = "persona";

    protected $primaryKey = 'pe_rut';

    protected $fillable = ['pe_rut', 'pe_nombres', 'pe_apellido_pat', 'pe_apellido_mat', 'pe_contacto'];

	public $incrementing = false;

public function rules()
{
    if (!isset($this->pe_rut)) {
        return [
            'pe_rut' => 'required|max:12|min:11|unique:persona',
            'pe_nombres' => 'required|alpha_spaces|max:50',
            'pe_apellido_pat' => 'required|alpha|max:30',
            'pe_apellido_mat' => 'required|alpha|max:30',
            'pe_contacto' => 'max:10',
        ];
    }else{
        return [
            'pe_rut' => 'required|max:12|min:11|unique:persona,pe_rut,'.$this->pe_rut.',pe_rut',
            'pe_nombres' => 'required|alpha_spaces|max:50',
            'pe_apellido_pat' => 'required|alpha|max:30',
            'pe_apellido_mat' => 'required|alpha|max:30',
            'pe_contacto' => 'max:10',
        ];
    }
}

public function rules_create()
{
    return [
        'pe_rut' => 'required|max:12|unique:persona',
        'pe_nombres' => 'required|alpha_spaces|max:50',
        'pe_apellido_pat' => 'required|alpha|max:30',
        'pe_apellido_mat' => 'required|alpha|max:30',
        'pe_contacto' => 'max:10',
    ];
}

public function attr_name()
{
    return [
        'pe_rut' => 'Rut',
        'pe_nombres' => 'Nombres',
        'pe_apellido_pat' => 'Apellido Paterno',
        'pe_apellido_mat' => 'Apellido Materno',
    ];

}


    public function apoderados()
    {
    	return $this->hasMany('App\Apoderado', 'persona_rut', 'pe_rut');
    }

    public function empleados()
    {
    	return $this->hasMany('App\Personal', 'persona_rut', 'pe_rut');
    }

    public function nombreCompleto()
    {
        return $this->pe_nombres.' '.$this->pe_apellido_pat.' '.$this->pe_apellido_mat;
    }

    public function nombreCorto()
    {
        $nombre_corto = [];
        $nombre = str_split($this->pe_nombres);
        $apellido = str_split($this->pe_apellido_pat);
        foreach ($nombre as $nomb) {
            if ($nomb != ' ') {
                $nombre_corto[] = $nomb;
            }else{
                break;
            }
        }
        $nombre_persona = implode("", $nombre_corto);
        return $nombre_persona.' '.$this->pe_apellido_pat;
    }
}
