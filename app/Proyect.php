<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyect extends Model
{
    public $timestamps = false;
    protected $table = 'proyectos';

    protected $fillable = [
        'nombre', 'fecha_inicio', 'fecha_fin', 'id_responsable', 'id',
    ];
}
