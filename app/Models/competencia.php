<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class competencia extends Model
{
    use HasFactory;

    public function niveles() {
        return $this->belongsToMany('App\Models\competencia', 'nivel_competencia');
    }

    public function getRouteKeyName(){
        return 'codigo';
    }

    public function raps(){
        return $this->hasMany('App\Models\rap', 'codigo_competencia', 'codigo');
    }

    public function conceptos(){
        return $this->hasMany('App\Models\sabere', 'codigo_competencia', 'codigo')->where('saber', 'conocimiento');
    }

    public function saberes(){
        return $this->hasMany('App\Models\sabere', 'codigo_competencia', 'codigo')->where('saber', 'proceso');;
    }

    protected $guarded = [];
}
