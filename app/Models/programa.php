<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class programa extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function imagenes(){
        return $this->hasMany('App\Models\galeria');
    }

    public function eventos(){
        return $this->hasMany('App\Models\evento');
    }

    public function proyectos(){
        return $this->hasMany('App\Models\proyecto');
    }

    public function libros(){
        return $this->hasMany('App\Models\biblioteca');
    }

    public function egresados(){
        return $this->hasMany('App\Models\personajes_destacado')->where('rol', 'Egresado');
    }

    public function voceros(){
        return $this->hasMany('App\Models\vocero');
    }

    public function instructores(){
        return $this->hasMany('App\Models\instructore');
    }

    public function aprendices(){
        return $this->hasMany('App\Models\personajes_destacado')->where('rol', 'Aprendiz');
    }

    public function niveles(){
        return $this->hasMany('App\Models\nivele');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
