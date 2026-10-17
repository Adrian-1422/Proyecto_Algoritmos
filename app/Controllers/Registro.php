<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Registro extends BaseController
{
    public function index()
    {
        if (! $this->request->is('post')) {
            return view('registro');
        }

        if (! $this->validate($this->reglas())) {
            return view('registro');
        }

        if (! $this->correoListo()) {
            return view('registro', [
                'error' => lang('App.correoNoConfigurado'),
            ]);
        }

        $modelo = model(UsuarioModel::class);
        $correo = $this->request->getPost('correo');
        $existente = $modelo->where('correo', $correo)->first();

        if ($existente && (int) $existente['activo'] === 1) {
            return view('registro', [
                'error' => lang('App.correoRegistrado'),
            ]);
        }

        $token = bin2hex(random_bytes(32));
        $datos = [
            'nombre'           => $this->request->getPost('nombre'),
            'contrasena_hash'  => password_hash($this->request->getPost('contrasena'), PASSWORD_DEFAULT),
            'activo'           => 0,
            'token_activacion' => hash('sha256', $token),
        ];

        if ($existente) {
            $datos['administrador'] = 0;
            $modelo->update($existente['id'], $datos);
        } else {
            $datos['correo'] = $correo;
            $datos['administrador'] = 0;
            $modelo->insert($datos);
        }

        if (! $this->enviarActivacion($correo, $token)) {
            return view('registro', [
                'error' => lang('App.correoNoEnviado'),
            ]);
        }

        return redirect()->to('/entrar')->with('aviso', lang('App.revisaCorreo'));
    }

    private function reglas(): array
    {
        return [
            'nombre' => [
                'label' => lang('App.nombre'),
                'rules' => 'required|max_length[100]',
            ],
            'correo' => [
                'label' => lang('App.correo'),
                'rules' => 'required|valid_email|max_length[150]',
            ],
            'contrasena' => [
                'label' => lang('App.contrasena'),
                'rules' => 'required',
            ],
            'repetir_contrasena' => [
                'label' => lang('App.repetirContrasena'),
                'rules' => 'required|matches[contrasena]',
            ],
        ];
    }

    private function correoListo(): bool
    {
        $configuracion = config('Email');

        return $configuracion->protocol === 'smtp'
            && $configuracion->SMTPHost !== ''
            && $configuracion->fromEmail !== '';
    }

    private function enviarActivacion(string $destino, string $token): bool
    {
        $correo = service('email');
        $correo->setTo($destino);
        $correo->setSubject(lang('App.asuntoActivacion'));
        $correo->setMessage(lang('App.cuerpoActivacion') . "\n\n" . site_url('activar/' . $token));

        return $correo->send();
    }
}
