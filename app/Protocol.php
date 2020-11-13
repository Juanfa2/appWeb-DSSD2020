<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Protocol extends Model
{
    public $timestamps = false;
    protected $table = 'protocolos';

    protected $fillable = [
        'nombre', 'id_responsable', 'orden', 'es_local','id_proyecto'
    ];
}
