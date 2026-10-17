<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Usuarios extends BaseController
{
    private int $porPagina = 5;

    public function index()
    {
        if ($this->administrador() === null) {
            return $this->rechazar();
        }

        $modelo = model(UsuarioModel::class);
        $total = $modelo->countAllResults();
        $paginas = max(1, (int) ceil($total / $this->porPagina));
        $pagina = max(1, (int) $this->request->getGet('pagina'));
        $pagina = min($pagina, $paginas);

        return vista('usuarios', [
            'usuarios' => $modelo->orderBy('creado_en', 'DESC')->orderBy('id', 'DESC')->findAll($this->porPagina, ($pagina - 1) * $this->porPagina),
            'pagina'   => $pagina,
        ]);
    }

    public function nuevo()
    {
        if ($this->administrador() === null) {
            return $this->rechazar();
        }

        if (! $this->request->is('post')) {
            return vista('usuario_nuevo');
        }

        if (! $this->validate($this->reglas(null, true))) {
            return vista('usuario_nuevo');
        }

        model(UsuarioModel::class)->insert([
            'nombre'          => $this->request->getPost('nombre'),
            'correo'          => $this->request->getPost('correo'),
            'contrasena_hash' => password_hash($this->request->getPost('contrasena'), PASSWORD_DEFAULT),
            'activo'          => 1,
            'administrador'   => 0,
        ]);

        return redirect()->to('/usuarios');
    }

    public function ver(int $id)
    {
        if ($this->administrador() === null) {
            return $this->rechazar();
        }

        $usuario = model(UsuarioModel::class)->find($id);
        if (! $usuario) {
            return redirect()->to('/usuarios');
        }

        return vista('usuario', ['usuario' => $usuario]);
    }

    public function editar(int $id)
    {
        if ($this->administrador() === null) {
            return $this->rechazar();
        }

        $modelo = model(UsuarioModel::class);
        $usuario = $modelo->find($id);
        if (! $usuario) {
            return redirect()->to('/usuarios');
        }

        if (! $this->request->is('post')) {
            return vista('usuario_editar', ['usuario' => $usuario]);
        }

        $nueva = (string) $this->request->getPost('contrasena');
        $repetir = (string) $this->request->getPost('repetir_contrasena');
        if (! $this->validate($this->reglas($id, $nueva !== '' || $repetir !== ''))) {
            return vista('usuario_editar', ['usuario' => $usuario]);
        }

        $datos = [
            'nombre'        => $this->request->getPost('nombre'),
            'correo'        => $this->request->getPost('correo'),
            'activo'        => $this->request->getPost('activo') ? 1 : 0,
            'administrador' => $this->request->getPost('administrador') ? 1 : 0,
        ];
        if ($nueva !== '' || $repetir !== '') {
            $datos['contrasena_hash'] = password_hash($nueva, PASSWORD_DEFAULT);
        }

        $modelo->update($id, $datos);
        if ((int) session()->get('usuario_id') === $id) {
            session()->set('usuario_nombre', $datos['nombre']);
        }

        return redirect()->to('/usuarios/' . $id);
    }

    public function eliminar(int $id)
    {
        $admin = $this->administrador();
        if ($admin === null) {
            return $this->rechazar();
        }

        $modelo = model(UsuarioModel::class);
        $usuario = $modelo->find($id);
        if (! $usuario) {
            return redirect()->to('/usuarios');
        }

        if (! $this->request->is('post')) {
            return vista('usuario_eliminar', ['usuario' => $usuario]);
        }

        if ((int) $admin['id'] === $id) {
            return vista('usuario_eliminar', [
                'usuario' => $usuario,
                'error'   => lang('App.noEliminarPropio'),
            ]);
        }

        if (! empty($usuario['foto'])) {
            $ruta = rtrim(FCPATH, '/\\') . DIRECTORY_SEPARATOR . 'fotos' . DIRECTORY_SEPARATOR . basename($usuario['foto']);
            if (is_file($ruta)) {
                unlink($ruta);
            }
        }

        $modelo->delete($id);

        return redirect()->to('/usuarios');
    }

    private function administrador(): ?array
    {
        $id = session()->get('usuario_id');
        if (! $id) {
            return null;
        }

        $usuario = model(UsuarioModel::class)->find($id);

        return $usuario && (int) $usuario['administrador'] === 1 ? $usuario : null;
    }

    private function rechazar()
    {
        if (! session()->get('usuario_id')) {
            return redirect()->to('/entrar');
        }

        return redirect()->to('/');
    }

    private function reglas(?int $id, bool $contrasenaObligatoria): array
    {
        $correo = 'required|valid_email|max_length[150]|is_unique[usuarios.correo';
        $correo .= $id === null ? ']' : ',id,' . $id . ']';

        $reglas = [
            'nombre' => [
                'label' => lang('App.nombre'),
                'rules' => 'required|max_length[100]',
            ],
            'correo' => [
                'label' => lang('App.correo'),
                'rules' => $correo,
            ],
        ];

        if ($contrasenaObligatoria) {
            $reglas['contrasena'] = [
                'label' => lang('App.contrasena'),
                'rules' => 'required',
            ];
            $reglas['repetir_contrasena'] = [
                'label' => lang('App.repetirContrasena'),
                'rules' => 'required|matches[contrasena]',
            ];
        }

        return $reglas;
    }
}
