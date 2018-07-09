<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $table = "alumno";

    protected $primaryKey = 'al_rut';

    protected $fillable = ['al_rut', 'al_nombres', 'al_apellido_pat', 'al_apellido_mat', 'al_contacto', 'comuna_id', 'al_domicilio', 'al_sexo', 'al_fecha_nacimiento', 'al_fono', 'al_proc_escolar'];

    public $incrementing = false;


public function rules()
{
    if (empty($this->al_rut)) {
        return [
            'al_rut' => 'required|max:12|min:11|unique:alumno',
            'al_nombres' => 'required|alpha_spaces|max:50',
            'al_apellido_pat' => 'required|alpha|max:30',
            'al_apellido_mat' => 'required|alpha|max:30',
            'comuna_id' => 'required',
            'al_sexo' => 'required',
            'al_fecha_nacimiento' => 'required',
            'al_domicilio' => 'required|max:100',
            'al_contacto' => 'max:10',
        ];
    }else{
        return [
            'al_rut' => 'required|max:12|min:11|unique:alumno,al_rut,'.$this->al_rut.',al_rut',
            'al_nombres' => 'required|alpha_spaces|max:50',
            'al_apellido_pat' => 'required|alpha|max:30',
            'al_apellido_mat' => 'required|alpha|max:30',
            'comuna_id' => 'required',
            'al_sexo' => 'required',
            'al_fecha_nacimiento' => 'required',
            'al_domicilio' => 'required|max:100',
            'al_contacto' => 'max:10',
        ];
    }
}

public function attr_name()
{
    return [
        'al_rut' => 'Rut',
        'al_nombres' => 'Nombres',
        'al_apellido_pat' => 'Apellido Paterno',
        'al_apellido_mat' => 'Apellido Materno',
        'comuna_id' => 'Comuna',
        'al_sexo' => 'Género',
        'al_fecha_nacimiento' => 'Nacimiento',
        'al_domicilio' => 'Domicilio',
        'al_fono' => 'Contactos',
        'al_proc_escolar' => 'Procedimiento Escolar',
    ];

}

/*
    public function persona()
    {
    	$this->belongsTo('App\Persona');
    }
*/
    public function matriculas()
    {
    	return $this->hasMany('App\Matricula', 'alumno_rut', 'al_rut');
    }

    public function comuna()
    {
        return $this->belongsTo('App\Comuna', 'comuna_id', 'com_id');
    }

    public function nombreCompleto()
    {
        return $this->al_nombres.' '.$this->al_apellido_pat.' '.$this->al_apellido_mat;
    }

    public function nombreCompletoB()
    {
        return $this->al_apellido_pat.' '.$this->al_apellido_mat.' '.$this->al_nombres;
    }

    public function nombreCorto()
    {
        $nombre_corto = [];
        $nombre = str_split($this->al_nombres);
        $apellido = str_split($this->al_apellido_pat);
        foreach ($nombre as $nomb) {
            if ($nomb != ' ') {
                $nombre_corto[] = $nomb;
            }else{
                break;
            }
        }
        $nombre_persona = implode("", $nombre_corto);
        return $nombre_persona.' '.$this->al_apellido_pat;
    }
    public function letra_sexo(){
        if ($this->al_sexo == 'masculino') {
            return 'M';
        }else{
            return 'F';
        }
    }
}
