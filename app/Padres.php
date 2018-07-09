<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Padres extends Model
{
    protected $table = "padres";

    protected $primaryKey = 'pad_rut';

    public $incrementing = false;

    protected $fillable = ['pad_rut', 'pad_nombres', 'pad_apellido_pat', 'pad_apellido_mat', 'pad_parentesco', 'pad_domicilio', 'pad_nivel_estudio', 'pad_sit_laboral', 'pad_profesion', 'pad_renta', 'pad_fecha_nacimiento'];


public function rules()
{
    if (empty($this->pad_rut)) {
        return [
            'pad_rut' => 'required|max:12|min:11|unique:padres',
            'pad_nombres' => 'required|alpha_spaces|max:50',
            'pad_apellido_pat' => 'required|alpha|max:30',
            'pad_apellido_mat' => 'required|alpha|max:30',
            //'pad_parentesco' => 'required',
            'pad_sit_laboral' => 'required|max:50|alpha_spaces',
            'pad_nivel_estudio' => 'required|alpha_spaces|max:30',
            'pad_profesion' => 'nullable|max:50|alpha_spaces',
            'pad_fecha_nacimiento' => 'required',
            'pad_domicilio' => 'required|max:100',
            'pad_renta' => 'nullable|max:11',
        ];
    }else{
        return [
            'pad_rut' => 'required|max:12|min:11|unique:padres,pad_rut,'.$this->pad_rut.',pad_rut',
            'pad_nombres' => 'required|alpha_spaces|max:50',
            'pad_apellido_pat' => 'required|alpha|max:30',
            'pad_apellido_mat' => 'required|alpha|max:30',
            //'pad_parentesco' => 'required',
            'pad_sit_laboral' => 'required|max:50|alpha_spaces',
            'pad_nivel_estudio' => 'required|alpha_spaces|max:30',
            'pad_profesion' => 'nullable|max:50|alpha_spaces',
            'pad_fecha_nacimiento' => 'required',
            'pad_domicilio' => 'required|max:100',
            'pad_renta' => 'nullable|max:11',
        ];
    }
}

public function attr_name()
{
    return [
        'pad_rut' => 'Rut',
        'pad_nombres' => 'Nombres',
        'pad_apellido_pat' => 'Apellido Paterno',
        'pad_apellido_mat' => 'Apellido Materno',
        //'pad_parentesco' => 'required',
        'pad_sit_laboral' => 'Situación Laboral',
        'pad_nivel_estudio' => 'Nivel de Estudio',
        'pad_fecha_nacimiento' => 'Fecha de Nacimiento',
        'pad_domicilio' => 'Domicilio',
    ];
}


    public function matriculas()
    {
    	return $this->belongsToMany('App\Matricula', 'alumno_tiene', 'padres_rut', 'matricula_id');
    }

    public function nombreCompleto()
    {
        return $this->pad_nombres.' '.$this->pad_apellido_pat.' '.$this->pad_apellido_mat;
    }

    public function nombreCorto()
    {
        $nombre_corto = [];
        $nombre = str_split($this->pad_nombres);
        $apellido = str_split($this->pad_apellido_pat);
        foreach ($nombre as $nomb) {
            if ($nomb != ' ') {
                $nombre_corto[] = $nomb;
            }else{
                break;
            }
        }
        $nombre_persona = implode("", $nombre_corto);
        return $nombre_persona.' '.$this->pad_apellido_pat;
    }
}
