<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Recuperacion extends BaseController
{
    public function index()
    {
        if (! $this->request->is('post')) {
            return view('recuperar');
        }

        if (! $this->validate([
            'correo' => [
                'label' => lang('App.correo'),
                'rules' => 'required|valid_email|max_length[150]',
            ],
        ])) {
            return view('recuperar');
        }

        if (! $this->correoListo()) {
            return view('recuperar', [
                'error' => lang('App.correoNoConfigurado'),
            ]);
        }

        $aviso = lang('App.avisoRecuperacion');
        $modelo = model(UsuarioModel::class);
        $usuario = $modelo
            ->where('correo', $this->request->getPost('correo'))
            ->where('activo', 1)
            ->first();

        if (! $usuario) {
            return view('recuperar', ['aviso' => $aviso]);
        }

        $token = bin2hex(random_bytes(32));
        $modelo->update($usuario['id'], [
            'token_recuperacion'  => hash('sha256', $token),
            'recuperacion_expira' => date('Y-m-d H:i:s', time() + 3600),
        ]);

        if (! $this->enviarEnlace($usuario['correo'], $token)) {
            $modelo->update($usuario['id'], [
                'token_recuperacion'  => null,
                'recuperacion_expira' => null,
            ]);

            return view('recuperar', [
                'error' => lang('App.correoNoEnviadoRecuperacion'),
            ]);
        }

        return view('recuperar', ['aviso' => $aviso]);
    }

    public function nueva(string $token)
    {
        $modelo = model(UsuarioModel::class);
        $usuario = $this->usuarioPorToken($modelo, $token);

        if (! $usuario) {
            return redirect()->to('/recuperar')->with('error', lang('App.enlaceRecuperacionInvalido'));
        }

        if (! $this->request->is('post')) {
            return view('nueva_contrasena', ['token' => $token]);
        }

        if (! $this->validate([
            'contrasena' => [
                'label' => lang('App.nuevaContrasena'),
                'rules' => 'required',
            ],
            'repetir_contrasena' => [
                'label' => lang('App.repetirContrasena'),
                'rules' => 'required|matches[contrasena]',
            ],
        ])) {
            return view('nueva_contrasena', ['token' => $token]);
        }

        $usuario = $this->usuarioPorToken($modelo, $token);
        if (! $usuario) {
            return redirect()->to('/recuperar')->with('error', lang('App.enlaceRecuperacionInvalido'));
        }

        $modelo->update($usuario['id'], [
            'contrasena_hash'     => password_hash($this->request->getPost('contrasena'), PASSWORD_DEFAULT),
            'token_recuperacion'  => null,
            'recuperacion_expira' => null,
            'token_recordarme'    => null,
        ]);
        delete_cookie('recordarme');

        return redirect()->to('/entrar')->with('aviso', lang('App.contrasenaActualizada'));
    }

    private function usuarioPorToken(UsuarioModel $modelo, string $token): ?array
    {
        $usuario = $modelo->where('token_recuperacion', hash('sha256', $token))->first();
        if (! $usuario) {
            return null;
        }

        $expira = strtotime((string) $usuario['recuperacion_expira']);
        if ($expira === false || $expira < time()) {
            $modelo->update($usuario['id'], [
                'token_recuperacion'  => null,
                'recuperacion_expira' => null,
            ]);

            return null;
        }

        return $usuario;
    }

    private function correoListo(): bool
    {
        $configuracion = config('Email');

        return $configuracion->protocol === 'smtp'
            && $configuracion->SMTPHost !== ''
            && $configuracion->fromEmail !== '';
    }

    private function enviarEnlace(string $destino, string $token): bool
    {
        $correo = service('email');
        $correo->setTo($destino);
        $correo->setSubject(lang('App.asuntoRecuperacion'));
        $correo->setMessage(lang('App.cuerpoRecuperacion') . "\n\n" . site_url('restablecer/' . $token));

        return $correo->send();
    }
}
