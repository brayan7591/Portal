<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class personajes_destacado extends Model
{
    use HasFactory;

    public function programa(){
        return $this->belongsTo('App\Models\programa');
    }
}
