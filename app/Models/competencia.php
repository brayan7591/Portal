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

    protected $guarded = [];
}
