<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Perfil extends BaseController
{
    public function index()
    {
        $usuario = $this->usuario();
        if ($usuario === null) {
            return redirect()->to('/entrar');
        }

        return vista('perfil', ['usuario' => $usuario]);
    }

    public function confirmar()
    {
        $usuario = $this->usuario();
        if ($usuario === null) {
            return redirect()->to('/entrar');
        }

        if (! $this->request->is('post')) {
            return vista('perfil_confirmar');
        }

        if (! password_verify((string) $this->request->getPost('contrasena'), $usuario['contrasena_hash'])) {
            return vista('perfil_confirmar', [
                'error' => lang('App.contrasenaActualIncorrecta'),
            ]);
        }

        session()->set('perfil_confirmado', true);

        return redirect()->to('/perfil/editar');
    }

    public function editar()
    {
        $usuario = $this->usuario();
        if ($usuario === null) {
            return redirect()->to('/entrar');
        }

        if (! session()->get('perfil_confirmado')) {
            return redirect()->to('/perfil/confirmar');
        }

        if (! $this->request->is('post')) {
            return vista('perfil_editar', ['usuario' => $usuario]);
        }

        if (! $this->validate([
            'nombre' => [
                'label' => lang('App.nombre'),
                'rules' => 'required|max_length[100]',
            ],
            'correo' => [
                'label' => lang('App.correo'),
                'rules' => 'required|valid_email|max_length[150]|is_unique[usuarios.correo,id,' . $usuario['id'] . ']',
            ],
        ])) {
            return vista('perfil_editar', ['usuario' => $usuario]);
        }

        model(UsuarioModel::class)->update($usuario['id'], [
            'nombre' => $this->request->getPost('nombre'),
            'correo' => $this->request->getPost('correo'),
        ]);
        session()->set('usuario_nombre', $this->request->getPost('nombre'));
        session()->remove('perfil_confirmado');

        return redirect()->to('/perfil')->with('aviso', lang('App.perfilActualizado'));
    }

    public function contrasena()
    {
        $usuario = $this->usuario();
        if ($usuario === null) {
            return redirect()->to('/entrar');
        }

        if (! $this->request->is('post')) {
            return vista('perfil_contrasena');
        }

        if (! password_verify((string) $this->request->getPost('contrasena_actual'), $usuario['contrasena_hash'])) {
            return vista('perfil_contrasena', [
                'error' => lang('App.contrasenaActualIncorrecta'),
            ]);
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
            return vista('perfil_contrasena');
        }

        model(UsuarioModel::class)->update($usuario['id'], [
            'contrasena_hash'  => password_hash($this->request->getPost('contrasena'), PASSWORD_DEFAULT),
            'token_recordarme' => null,
        ]);
        delete_cookie('recordarme');

        return redirect()->to('/perfil')->with('aviso', lang('App.contrasenaActualizada'));
    }

    public function foto()
    {
        $usuario = $this->usuario();
        if ($usuario === null) {
            return redirect()->to('/entrar');
        }

        if (! $this->request->is('post')) {
            return vista('perfil_foto');
        }

        if (! $this->validate([
            'foto' => [
                'label' => lang('App.foto'),
                'rules' => 'uploaded[foto]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]|max_size[foto,2048]',
                'errors' => [
                    'uploaded' => lang('App.errorFoto'),
                    'is_image' => lang('App.errorFoto'),
                    'mime_in'  => lang('App.errorFotoTipo'),
                    'max_size' => lang('App.errorFotoPeso'),
                ],
            ],
        ])) {
            return vista('perfil_foto');
        }

        $archivo = $this->request->getFile('foto');
        $extension = strtolower((string) $archivo->guessExtension());
        if (! in_array($extension, ['jpg', 'jpeg', 'png'], true)) {
            return vista('perfil_foto', ['error' => lang('App.errorFotoTipo')]);
        }

        $this->borrarArchivo($usuario['id'], $usuario['foto'] ?? null);
        $nombre = $usuario['id'] . '.' . $extension;
        $archivo->move(FCPATH . 'fotos', $nombre, true);
        model(UsuarioModel::class)->update($usuario['id'], ['foto' => $nombre]);

        return redirect()->to('/perfil')->with('aviso', lang('App.fotoActualizada'));
    }

    public function eliminar()
    {
        $usuario = $this->usuario();
        if ($usuario === null) {
            return redirect()->to('/entrar');
        }

        if (! $this->request->is('post')) {
            return vista('perfil_eliminar');
        }

        $this->borrarArchivo($usuario['id'], $usuario['foto'] ?? null);
        model(UsuarioModel::class)->update($usuario['id'], ['foto' => null]);

        return redirect()->to('/perfil')->with('aviso', lang('App.fotoEliminada'));
    }

    private function usuario(): ?array
    {
        $id = session()->get('usuario_id');
        if (! $id) {
            return null;
        }

        return model(UsuarioModel::class)->find($id);
    }

    private function borrarArchivo(int $id, ?string $foto): void
    {
        $nombres = [$id . '.jpg', $id . '.jpeg', $id . '.png'];
        if ($foto !== null && $foto !== '') {
            $nombres[] = basename(str_replace('\\', '/', $foto));
        }

        $directorio = rtrim(FCPATH, '/\\') . DIRECTORY_SEPARATOR . 'fotos';
        foreach ($nombres as $nombre) {
            $ruta = $directorio . DIRECTORY_SEPARATOR . $nombre;
            if (is_file($ruta)) {
                unlink($ruta);
            }
        }
    }
}
