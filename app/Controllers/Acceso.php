<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Acceso extends BaseController
{
    public function entrar()
    {
        return view('entrar');
    }

    public function autenticar()
    {
        if (! $this->validate([
            'correo' => [
                'label' => lang('App.correo'),
                'rules' => 'required|valid_email',
            ],
            'contrasena' => [
                'label' => lang('App.contrasena'),
                'rules' => 'required',
            ],
        ])) {
            return view('entrar');
        }

        $modelo = model(UsuarioModel::class);
        $usuario = $modelo->where('correo', $this->request->getPost('correo'))->first();
        $contrasena = $this->request->getPost('contrasena');

        if (! $usuario || ! password_verify($contrasena, $usuario['contrasena_hash'])) {
            return view('entrar', [
                'error' => lang('App.credencialesInvalidas'),
            ]);
        }

        if ((int) $usuario['activo'] !== 1) {
            return view('entrar', [
                'error' => lang('App.cuentaInactiva'),
            ]);
        }

        session()->regenerate(true);
        session()->set([
            'usuario_id'     => $usuario['id'],
            'usuario_nombre' => $usuario['nombre'],
        ]);

        $respuesta = redirect()->to('/');

        if ($this->request->getPost('recordarme')) {
            $token = bin2hex(random_bytes(32));
            $modelo->update($usuario['id'], [
                'token_recordarme' => hash('sha256', $token),
            ]);
            $respuesta->setCookie('recordarme', $token, 60 * 60 * 24 * 30, '', '/', '', false, true, 'Lax');
        } else {
            $modelo->update($usuario['id'], [
                'token_recordarme' => null,
            ]);
            $respuesta->deleteCookie('recordarme');
        }

        return $respuesta;
    }

    public function salir()
    {
        $id = session()->get('usuario_id');
        if ($id) {
            model(UsuarioModel::class)->update($id, [
                'token_recordarme' => null,
            ]);
        }

        session()->destroy();

        return redirect()->to('/')->deleteCookie('recordarme');
    }

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
