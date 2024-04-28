<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class competencia extends Model
{
    use HasFactory;

    public function niveles() {
        $niveles = $this->belongsToMany('App\Models\nivele', 'nivel_competencia', 'codigo_competencia', 'nivel', 'codigo', 'nivel');
        $niveles->getBaseQuery()->joins[0]->wheres[1] = ['type' => 'Column', "first" => "niveles.programa_id", "operator" => "=", "second" => "nivel_competencia.programa_id", "boolean" => "and"];
        return $niveles;
    }

    protected $primaryKey = 'codigo';

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
