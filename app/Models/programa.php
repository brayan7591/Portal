<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class programa extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function aprendices(){
        return $this->hasMany('App\Models\aprendice');
    }

    public function niveles(){
        return $this->hasMany('App\Models\nivele');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
