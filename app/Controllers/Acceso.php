<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Acceso extends BaseController
{
    public function activar(string $token)
    {
        $modelo = model(UsuarioModel::class);
        $usuario = $modelo
            ->where('token_activacion', hash('sha256', $token))
            ->where('activo', 0)
            ->first();

        if (! $usuario) {
            return redirect()->to('/entrar')->with('error', lang('App.activacionInvalida'));
        }

        $modelo->update($usuario['id'], [
            'activo'           => 1,
            'token_activacion' => null,
        ]);

        return redirect()->to('/entrar')->with('aviso', lang('App.cuentaActivada'));
    }
}
