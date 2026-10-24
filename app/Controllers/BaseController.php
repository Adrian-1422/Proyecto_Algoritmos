<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class BaseController extends Controller
{


    protected $helpers = ['url', 'form', 'cookie', 'vista'];

    /**
     * @param CLIRequest|IncomingRequest $request
     *
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {

        parent::initController($request, $response, $logger);

        $idioma = session()->get('idioma');
        if ($idioma === 'en' || $idioma === 'es') {
            $this->request->setLocale($idioma);
            service('language')->setLocale($idioma);
        }

        $recordarme = get_cookie('recordarme');
        if (! session()->get('usuario_id') && is_string($recordarme) && $recordarme !== '') {
            $usuario = model(\App\Models\UsuarioModel::class)
                ->where('token_recordarme', hash('sha256', $recordarme))
                ->where('activo', 1)
                ->first();

            if ($usuario) {
                session()->set([
                    'usuario_id'     => $usuario['id'],
                    'usuario_nombre' => $usuario['nombre'],
                ]);
            } else {
                delete_cookie('recordarme');
            }
        }

        $id = session()->get('usuario_id');
        if ($id) {
            $cuenta = model(\App\Models\UsuarioModel::class)->find($id);
            session()->set('es_administrador', $cuenta && (int) $cuenta['administrador'] === 1 ? 1 : 0);
        } else {
            session()->remove('es_administrador');
        }

    }
}
