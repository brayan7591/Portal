<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class instructore extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function programa(){
        return $this->belongsTo('App\Models\programa');
    }

    public function imagen(){
        return $this->morphOne('App\Models\imagene', 'imageable');
    }
}
