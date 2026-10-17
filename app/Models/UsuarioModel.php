<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table            = 'usuarios';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'nombre',
        'correo',
        'contrasena_hash',
        'activo',
        'token_activacion',
        'token_recordarme',
        'token_recuperacion',
        'recuperacion_expira',
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'creado_en';
    protected $updatedField  = 'actualizado_en';
}
