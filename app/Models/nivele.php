<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nivele extends Model
{
    use HasFactory;

    public function competencias() {
        $competencias = $this->belongsToMany('App\Models\competencia', 'nivel_competencia', 'nivel', 'codigo_competencia', 'nivel', 'codigo');
        $competencias->getQuery()->where('nivel_competencia.programa_id', '=', $this->programa_id);
        return $competencias;
    }

    public function getRouteKeyName(){
        return 'nivel';
    }

    protected $guarded = [];

}
