<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class imagene extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function imageable(){
        return $this->morphTo();
    }
}
