<?php

namespace App\Controllers;

use App\Models\TareaModel;

class Tareas extends BaseController
{
    private int $porPagina = 5;

    public function index()
    {
        if ($respuesta = $this->exigirSesion()) {
            return $respuesta;
        }

        $busqueda = trim((string) $this->request->getGet('q'));
        $modelo = model(TareaModel::class);
        $this->filtrar($modelo, $busqueda);
        $total = $modelo->countAllResults();
        $paginas = max(1, (int) ceil($total / $this->porPagina));
        $pagina = max(1, (int) $this->request->getGet('pagina'));
        $pagina = min($pagina, $paginas);
        $this->filtrar($modelo, $busqueda);

        return vista('tareas', [
            'tareas'   => $modelo->orderBy('creado_en', 'DESC')->orderBy('id', 'DESC')->findAll($this->porPagina, ($pagina - 1) * $this->porPagina),
            'pagina'   => $pagina,
            'busqueda' => $busqueda,
        ]);
    }

    public function nueva()
    {
        if ($respuesta = $this->exigirSesion()) {
            return $respuesta;
        }

        if (! $this->request->is('post')) {
            return vista('tarea_nueva');
        }

        if (! $this->validate($this->reglas())) {
            return vista('tarea_nueva');
        }

        model(TareaModel::class)->insert([
            'descripcion' => trim((string) $this->request->getPost('descripcion')),
        ]);

        return redirect()->to('/tareas');
    }

    public function ver(int $id)
    {
        if ($respuesta = $this->exigirSesion()) {
            return $respuesta;
        }

        $tarea = model(TareaModel::class)->find($id);
        if (! $tarea) {
            return redirect()->to('/tareas');
        }

        return vista('tarea', ['tarea' => $tarea]);
    }

    public function editar(int $id)
    {
        if ($respuesta = $this->exigirSesion()) {
            return $respuesta;
        }

        $modelo = model(TareaModel::class);
        $tarea = $modelo->find($id);
        if (! $tarea) {
            return redirect()->to('/tareas');
        }

        if (! $this->request->is('post')) {
            return vista('tarea_editar', ['tarea' => $tarea]);
        }

        if (! $this->validate($this->reglas())) {
            return vista('tarea_editar', ['tarea' => $tarea]);
        }

        $modelo->update($id, [
            'descripcion' => trim((string) $this->request->getPost('descripcion')),
        ]);

        return redirect()->to('/tareas/' . $id);
    }

    public function eliminar(int $id)
    {
        if ($respuesta = $this->exigirSesion()) {
            return $respuesta;
        }

        $modelo = model(TareaModel::class);
        $tarea = $modelo->find($id);
        if (! $tarea) {
            return redirect()->to('/tareas');
        }

        if (! $this->request->is('post')) {
            return vista('tarea_eliminar', ['tarea' => $tarea]);
        }

        $modelo->delete($id);

        return redirect()->to('/tareas');
    }

    private function exigirSesion()
    {
        if (! session()->get('usuario_id')) {
            return redirect()->to('/entrar');
        }

        return null;
    }

    private function filtrar(TareaModel $modelo, string $busqueda): void
    {
        if ($busqueda !== '') {
            $modelo->like('descripcion', $busqueda);
        }
    }

    private function reglas(): array
    {
        return [
            'descripcion' => [
                'label' => lang('App.descripcion'),
                'rules' => 'required|max_length[255]',
            ],
        ];
    }
}
