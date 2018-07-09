<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{

	//protected $guard = 'users';

    protected $table = "usuario";

    protected $primaryKey = 'us_id';

    protected $fillable = ['us_id', 'rol_id','persona_rut', 'us_username', 'us_email', 'us_password', 'us_estado', 'remember_token', 'password'];
    
    protected $hidden = [
        'password', 'remember_token',
    ];





public function rules_person()
{
    return [
        //'persona_rut' => 'required|max:12',
        'persona_rut' => 'required|max:12|min:11',
        'pe_nombres' => 'required|alpha_spaces',
        'pe_apellido_pat' => 'required|alpha',
        'pe_apellido_mat' => 'required|alpha',
    ];
}

public function rules_user($id = null)
{
    if (!isset($this->us_id)) {
        return [
            //'persona_rut' => 'required|max:12',
            'rol_id' => 'required',
            'us_username' => 'required',
            'us_email' => 'required|email|unique:usuario',
            'password' => 'required|min:6',
        ];
    }else{
        return [
            //'persona_rut' => 'required|max:12',
            'us_username' => 'required',
            'us_email' => 'required|email|unique:usuario,us_email,'.$this->us_id.',us_id',
            'password' => 'min:6',
        ];

    }
}

    public function hasRole($rol)
    {
        return $this->rol->name === $rol;
    }




    public function rol()
    {
        return $this->belongsTo('App\Rol', 'rol_id', 'id');
    }


    public function persona()
    {
    	return $this->belongsTo('App\Persona', 'persona_rut', 'pe_rut');
    }

    public function administrador()
    {
        return $this->rol_id === 1;
    }

    public function director()
    {
        return $this->rol_id === 2;
    }

    public function jefeUtp()
    {
        return $this->rol_id === 3;
    }

    public function inspector()
    {
        return $this->rol_id === 4;
    }

    public function secretaria()
    {
        return $this->rol_id === 5;
    }

    public function profesor()
    {
        return $this->rol_id === 6;
    }
    public function apoderado()
    {
        return $this->rol_id === 7;
    }

    public function estado()
    {
        return ($this->us_estado) ? 'Activo':'Inactivo';
    }
}
