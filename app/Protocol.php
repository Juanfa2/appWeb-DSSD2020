<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Protocol extends Model
{
    public $timestamps = false;
    protected $table = 'protocolos';
    protected $primaryKey = "id_protocolo";

    protected $fillable = [
        'nombre', 'id_responsable', 'orden', 'es_local', 'id_proyecto', 'es_local','puntaje', 'fecha_lanzamiento', 'fecha_terminacion', 'comentario'
    ];
}
