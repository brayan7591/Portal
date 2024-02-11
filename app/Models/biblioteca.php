<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class biblioteca extends Model
{
    use HasFactory;

    protected $fillable = [
        'IdBiblioteca',
        'Titulo',
        'FechaEstreno',
        'Editorial',
        'Imagen',
        'Formato',
        'FechaIngreso',
        'ProgramaFormacion',
        'Copias',
        'Estado'
    ];
}
